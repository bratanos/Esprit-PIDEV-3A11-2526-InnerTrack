# InnerTrack - Mental Health & Wellbeing Platform

InnerTrack is a comprehensive mental health management platform consisting of a **Symfony Web Backend** (with an Administrative Dashboard) and a **JavaFX Desktop Client**. The platform provides tools for journaling, article management, psychological testing, and event coordination, all enhanced by AI-driven insights.

---

## 🏛️ Project Architecture

### 1. Backend (Symfony Web App)
Located in the `/backend` directory.
- **Framework**: Symfony 6.4 (PHP 8.1+)
- **Database**: MySQL / MariaDB
- **Key Modules**:
  - **Journaling**: Habit tracking and daily entries with mood analysis.
  - **Articles**: Educational content with AI-generated insights and category/tag management.
  - **Events**: Coordination for workshops, conferences, and forums with automated waitlists.
  - **Moderation**: Admin tools for managing reports, chat locks, and user bans.
  - **API**: JWT-secured endpoints for the JavaFX desktop client.

### 2. Desktop Client (JavaFX App)
Located in the `/frontend` directory.
- **Framework**: JavaFX 17+ (Maven)
- **Architecture**: MVC with a central `ViewManager` and `SessionManager`.
- **Key Features**: 
  - Role-based dashboards (Patient, Therapist, Admin).
  - Real-time interaction with the Symfony database via JDBC.
  - Premium UI using modern CSS tokens and HSL color variables.

### 3. AI Microservices (Python)
- **Article AI (Flask)**: Generates readability scores and content insights for articles.
- **Chatbot & Image Gen (FastAPI)**: Provides an interactive AI agent and generates event posters using StabilityAI.

---

## 🚀 Getting Started

### Backend Setup (Symfony)
1. **Navigate to backend**: `cd backend`
2. **Install dependencies**: `composer install` & `npm install`
3. **Configure Environment**: Copy `.env` to `.env.local` and set your `DATABASE_URL`.
4. **Database Initialization**:
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```
5. **Seed Data**: (Optional) Run the custom seeding command:
   ```bash
   php bin/console app:seed-data
   ```
6. **Start Server**: `symfony server:start`

### Frontend Setup (JavaFX)
1. **Navigate to frontend**: `cd frontend`
2. **Configure Environment**: Update `src/main/resources/config/config.properties` (or `.env` if used) with your local database credentials and backend API URL.
3. **Build & Run**:
   ```bash
   mvn clean javafx:run
   ```

### AI Services Setup
1. **Navigate to AI directories**: `cd backend/python_ai` or `cd Chatbot`
2. **Install requirements**: `pip install -r requirements.txt`
3. **Run services**: 
   - Article AI: `python app.py` (Port 5001)
   - Chatbot: `uvicorn agent:app --port 8001`

---

## 🛠️ Key Functionalities

### Administrative Moderation
The admin dashboard (`/admin`) allows for:
- **Sanctions Management**: View and revert temporary chat locks or permanent user bans.
- **Report Review**: Analyze reported content with AI-assisted summaries to speed up moderation.

### AI Integration
- **Article Insights**: When creating an article, the AI analyzes the text to provide a readability score.
- **Event Posters**: Generate professional posters for events based on their title and description directly from the dashboard.

### Collaborative Development
- **JavaFX Styling**: Styles are scoped to prevent global breakage. Use `variables.css` for theme colors.
- **Branch Strategy**: The `main` branch contains the latest stable merged state (`mergedlocal`).

---

## 🔒 Security
- **Web**: Uses Symfony Security with `ROLE_ADMIN`, `ROLE_PSYCHOLOGUE`, and `ROLE_USER`.
- **Desktop**: Authentication handled via the `WebAuthController` which communicates with Symfony's security system.

---

## 📄 License
This project is proprietary and intended for the InnerTrack development team.
