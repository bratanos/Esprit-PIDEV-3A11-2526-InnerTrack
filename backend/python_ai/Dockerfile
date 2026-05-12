FROM python:3.9-slim

WORKDIR /app

# Install dependencies for NLTK and PyTorch
RUN apt-get update && apt-get install -y gcc

# Copy requirements and install
COPY requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

# Download NLTK data
RUN python -c "import nltk; nltk.download('punkt'); nltk.download('stopwords'); nltk.download('punkt_tab')"

# Copy the rest of the application
COPY . .

# Expose port 7860 (Hugging Face default)
EXPOSE 7860

# Command to run the Flask app on port 7860
# Note: You may need to change 'app.py' or the command based on what your main python file is named.
CMD ["flask", "run", "--host=0.0.0.0", "--port=7860"]
