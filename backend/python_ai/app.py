import os
os.environ['HF_HUB_DISABLE_SYMLINKS_WARNING'] = '1' 
from flask import Flask, request, jsonify
from transformers import pipeline
from sumy.parsers.plaintext import PlaintextParser
from sumy.nlp.tokenizers import Tokenizer
from sumy.summarizers.lsa import LsaSummarizer
import nltk
import re

app = Flask(__name__)

# Load once at startup — free HuggingFace model, runs 100% locally
emotion_classifier = pipeline(
    "text-classification",
    model="j-hartmann/emotion-english-distilroberta-base",
    top_k=3  # return top 3 emotions
)

EMOTION_META = {
    "joy":      {"emoji": "😊", "color": "#22c55e", "label": "Joy"},
    "sadness":  {"emoji": "😔", "color": "#60a5fa", "label": "Sadness"},
    "anger":    {"emoji": "😤", "color": "#f87171", "label": "Anger"},
    "fear":     {"emoji": "😰", "color": "#a78bfa", "label": "Fear"},
    "disgust":  {"emoji": "😣", "color": "#fb923c", "label": "Disgust"},
    "surprise": {"emoji": "😲", "color": "#f59e0b", "label": "Surprise"},
    "neutral":  {"emoji": "😐", "color": "#94a3b8", "label": "Neutral"},
}

def extract_key_points(text: str, count: int = 4) -> list[str]:
    """Extractive summarization — picks the most informative sentences."""
    try:
        # Clean text
        clean = re.sub(r'\s+', ' ', text.strip())
        parser = PlaintextParser.from_string(clean, Tokenizer("english"))
        summarizer = LsaSummarizer()
        summary = summarizer(parser.document, count)
        return [str(s) for s in summary if len(str(s)) > 20]
    except Exception:
        # Fallback: return first N sentences
        sentences = re.split(r'(?<=[.!?])\s+', text)
        return [s.strip() for s in sentences[:count] if len(s.strip()) > 20]


@app.route('/analyze', methods=['POST'])
def analyze():
    data = request.get_json(silent=True)
    if not data or 'text' not in data:
        return jsonify({"error": "Missing 'text' field"}), 400

    text = data['text'][:2000]  # cap to avoid slow inference

    # ── Emotion detection ──
    try:
        raw_emotions = emotion_classifier(text)[0]  # list of {label, score}
        emotions = []
        for e in raw_emotions:
            key = e['label'].lower()
            meta = EMOTION_META.get(key, {"emoji": "🔵", "color": "#94a3b8", "label": key.title()})
            emotions.append({
                "label":   meta["label"],
                "emoji":   meta["emoji"],
                "color":   meta["color"],
                "score":   round(e['score'] * 100),
            })
    except Exception as ex:
        emotions = [{"label": "Neutral", "emoji": "😐", "color": "#94a3b8", "score": 100}]

    # ── Key points ──
    key_points = extract_key_points(text, count=4)

    return jsonify({
        "emotions":   emotions,
        "key_points": key_points,
    })


@app.route('/health', methods=['GET'])
def health():
    return jsonify({"status": "ok"})


if __name__ == '__main__':
    app.run(port=5001, debug=False)