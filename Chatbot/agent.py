import os
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from dotenv import load_dotenv
from fastapi.middleware.cors import CORSMiddleware
from openai import OpenAI
from pathlib import Path
import base64
import io
from huggingface_hub import InferenceClient


load_dotenv(dotenv_path=Path(__file__).with_name(".env"), override=True)
app = FastAPI()

# Allow CORS from your frontend
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # en prod: mets ton domaine
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Persistent session context
sessions: dict[str, list[dict[str, str]]] = {}

# Request model
class UserInput(BaseModel):
    session_id: str
    message: str
    user_id: int | None = None  # gardé optionnel si ton frontend l’envoie

_client: OpenAI | None = None

def get_client() -> OpenAI:
    global _client
    if _client is None:
        api_key = os.getenv("OPENAI_API_KEY", "").strip()
        base_url = os.getenv("OPENAI_BASE_URL", "https://api.openai.com/v1").strip()
        if not api_key:
            raise ValueError("OPENAI_API_KEY is missing in .env")
        _client = OpenAI(api_key=api_key, base_url=base_url)
    return _client

def trim_history(messages: list[dict[str, str]]) -> None:
    # conserve system + N derniers messages
    max_turns = int(os.getenv("MAX_TURNS", "20"))
    max_msgs = 1 + (max_turns * 2)  # ~ user+assistant
    if len(messages) > max_msgs:
        system_msg = messages[0]
        messages[:] = [system_msg] + messages[-(max_turns * 2):]

def ask_chatgpt(session_id: str, question: str) -> str:
    model = os.getenv("OPENAI_MODEL", "openai/gpt-4.1").strip()

    if session_id not in sessions:
        sessions[session_id] = [{
            "role": "system",
            "content": os.getenv(
                "SYSTEM_PROMPT",
                "You are a helpful assistant. Always respond with short, concise answers."
            )
        }]

    messages = sessions[session_id]
    messages.append({"role": "user", "content": question})
    trim_history(messages)

    try:
        client = get_client()
        response = client.chat.completions.create(
            model=model,
            messages=messages,
            max_tokens=int(os.getenv("MAX_TOKENS", "500")),
            temperature=float(os.getenv("TEMPERATURE", "0.4")),
            extra_headers={
                "HTTP-Referer": os.getenv("REFERER_URL", "http://localhost:8000"),
                "X-Title": os.getenv("APP_TITLE", "innertrack"),
            },
        )

        reply = (response.choices[0].message.content or "").strip()
        messages.append({"role": "assistant", "content": reply})
        trim_history(messages)
        return reply or "..."

    except Exception as e:
        return f"Error: {type(e).__name__}: {e}"

@app.get("/health")
def health():
    return {"status": "ok"}

@app.post("/interact")
def interact(input: UserInput):
    reply = ask_chatgpt(input.session_id, input.message)
    return {"response": reply}

# Define a Pydantic model to accept event_name and session_id
class EventDescriptionRequest(BaseModel):
    event_name: str


@app.post("/generate_event_description")
def generate_event_description(input: EventDescriptionRequest):
    client = get_client()
    response = client.chat.completions.create(
        model=os.getenv("OPENAI_MODEL", "openai/gpt-4.1").strip(),
        messages=[
            {
                "role": "system",
                "content": (
                    "You are an event organizer. Write a short, engaging event description "
                    "in 2–3 sentences. Return only the description, no extra text."
                ),
            },
            {"role": "user", "content": f"Event name: {input.event_name}"},
        ],
        max_tokens=200,
        temperature=0.7,
        extra_headers={
            "HTTP-Referer": os.getenv("REFERER_URL", "http://localhost:8000"),
            "X-Title": os.getenv("APP_TITLE", "innertrack"),
        },
    )
    description = (response.choices[0].message.content or "").strip()
    return {"description": description}


class EventImageRequest(BaseModel):
    description: str
    session_id: str

@app.post("/generate_event_image")
def generate_event_image(input: EventImageRequest):
    try:
        # Step 1: use Claude (via OpenRouter) to craft a rich image prompt
        openrouter_client = get_client()
        claude_response = openrouter_client.chat.completions.create(
            model="anthropic/claude-3-5-haiku",
            max_tokens=256,
            messages=[
                {
                    "role": "system",
                    "content": (
                        "You are an expert at writing prompts for AI image generators. "
                        "Given an event description, output a single vivid image prompt "
                        "that captures the scene, style, and mood. Output the prompt only — no extra text."
                    ),
                },
                {"role": "user", "content": input.description},
            ],
            extra_headers={
                "HTTP-Referer": os.getenv("REFERER_URL", "http://localhost:8000"),
                "X-Title": os.getenv("APP_TITLE", "innertrack"),
            },
        )
        image_prompt = (claude_response.choices[0].message.content or "").strip()

        # Step 2: generate the image with Hugging Face
        hf_token = os.getenv("HF_TOKEN", "").strip()
        if not hf_token:
            raise ValueError("HF_TOKEN is missing in .env")
        hf_client = InferenceClient(token=hf_token)
        image = hf_client.text_to_image(
            image_prompt,
            model="stabilityai/stable-diffusion-xl-base-1.0",
        )
        buffer = io.BytesIO()
        image.save(buffer, format="JPEG")
        image_b64 = base64.b64encode(buffer.getvalue()).decode("utf-8")
        return {"image_url": f"data:image/jpeg;base64,{image_b64}"}
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"{type(e).__name__}: {e}")

