# 🎓 InnerTrack Web - Teacher Presentation & Defense Guide

This guide is written specifically to help you explain your project to your teacher. It translates the technical Codebase into easy-to-understand explanations of **How**, **What**, and **Why**.

---

## 🏗️ 1. The Big Picture: Architecture (How it's set up)

**If your teacher asks: "What architecture did you use and how is the project structured?"**

**Your Answer:**
> "The project is built using the **Symfony Framework** which rigidly follows the **MVC (Model-View-Controller)** design pattern. 
> 
> Here is how data flows through my application:
> 1. **Route/Request:** A user clicks a button or visits a URL (e.g., `/login`).
> 2. **Controller:** Symfony routes this to a specific Controller method. The controller acts as the brain—it takes the Request, checks permissions, and asks the database for data.
> 3. **Model (Entities):** The controller uses **Doctrine ORM** to talk to the database. Instead of writing raw SQL, I use PHP Objects (Entities) like `User` or `Message`. Doctrine handles translating these objects into database rows.
> 4. **View (Twig):** Once the controller has the data, it passes it to a **Twig template**. Twig generates the final HTML that the user sees in their browser."

---

## 🔄 2. Explaining Key Flows (How pieces communicate)

### Flow A: The Registration & Email Verification Flow
*Show them `WebAuthController.php` -> `register()` and `verifyEmail()`*

**How to explain it:**
> "When a user registers, I don't just save them and log them in. Security is important.
> 1. In `WebAuthController::register`, I receive the form data manually and validate it (checking if the email is valid, passwords match, etc.).
> 2. I create a new `User` entity, hash their password using Symfony's `UserPasswordHasherInterface`, and set their status to `'PENDING'`.
> 3. I generate a random 6-digit code, save it in the `EmailVerificationCode` entity linked to the user, and use my `EmailSender` service to email it to them.
> 4. They are redirected to the verification page. Only when they enter the correct code in `verifyEmail()` do I change `$user->setIsVerified(true)` and update their status to `'ACTIVE'`."

### Flow B: The Security & Login Flow
*Show them `config/packages/security.yaml` and `src/Security/UserChecker.php`*

**How to explain it:**
> "Authentication is handled natively by the Symfony Security component. 
> 1. In `security.yaml`, I defined firewalls. The `web` firewall handles form logins.
> 2. I implemented a custom `UserChecker`. Before Symfony lets someone log in, `checkPreAuth()` is automatically called. 
> 3. In this function, if the user's status is `'BLOCKED'` or they haven't verified their email, I throw a `CustomUserMessageAccountStatusException` which stops the login and shows an error message.
> 4. If login is successful, my `LoginSuccessHandler` updates their `lastLogin` timestamp in the database before redirecting them to the dashboard."

### Flow C: The Dynamic Messaging System
*Show them `MessagingController.php` -> `api_messages_get()` and `api_messages_send()`*

**How to explain it:**
> "To make the chat feel fast and modern without reloading the whole page, I used API endpoints.
> 1. When a user opens a chat, the Twig template loads the basic frame. 
> 2. Then, JavaScript in the frontend calls `api_messages_get()`. This controller fetches the `Message` entities linked to that `Conversation`, formats them as JSON, and returns them to the browser to display.
> 3. When setting up the chat, I ensure security: The controller first checks `if ($conversation->getClient()->getId() !== $user->getId() ...)` to guarantee a user can't read a conversation they don't belong to."

---

## 🧩 3. Explaining Key Entities (The Database Models)

**If your teacher asks: "Show me your database relationships."**

*Show them `User.php`*

**Your Answer:**
> "My database revolves around the `User` entity. However, because a user can be either a normal 'Client' or a 'Therapist', I used a modular approach.
> * The `User` class holds data common to everyone: email, password, roles, status.
> * I have a `TherapistProfile` entity and a `ClientProfile` entity.
> * These have a `@ORM\OneToOne` relationship with the `User`. 
> * **Why?** This prevents the `User` table from becoming cluttered with fields that only apply to therapists (like `licenseNumber` or `specialization`). It keeps the database normalized and logic clean."

---

## 🎯 4. Important Functions to Show Off

Here are three specific functions you should highlight to show you understand good programming practices:

### 1. Handling File Uploads & External APIs
**Where:** `UserProfileController.php` -> `uploadPicture()`
**Explain to teacher:** 
> "Instead of cluttering our server's hard drive with user images, I integrated an external API (ImgBB). In this function, I use Symfony's `HttpClientInterface` to send the uploaded image file directly to ImgBB. I read the JSON response, extract the public URL, and save *that URL* to my database. This is a great example of microservice integration."

### 2. Manual Server-Side Validation
**Where:** `UserProfileController.php` -> `index()` (Lines 44-70)
**Explain to teacher:** 
> "I didn't trust the frontend to send correct data. In my profile update method, I pull raw variables from `$request->request->get()`. Before I touch the database, I trim strings, check for maximum lengths, and run a Regular Expression (`preg_match`) on the phone number. Only if my `$errors` array is completely empty do I persist the changes to the database. This prevents SQL errors and broken data."

### 3. Smart Localization (Multi-Language)
**Where:** `EventSubscriber/LocaleSubscriber.php`
**Explain to teacher:** 
> "I built an Event Subscriber that listens to `KernelEvents::REQUEST`. Every single time a page loads, before the controller is even called, this script runs. It checks if the user is logged in, checks their `UserSettings` entity for their preferred language (FR or EN), and dynamically changes the Symfony request locale. This ensures language preferences persist across devices because they are tied to the database, not just cookies."

---

## 🙋‍♂️ 5. Answering Potential "Gotcha" Questions

**Teacher:** *"Why didn't you use Symfony's built-in Form classes (FormBuilder / FormTypes)?"*
**Your Answer:** *"My frontend uses heavily customized Tailwind CSS and Alpine.js. While Symfony forms are powerful, they generate a lot of rigid HTML. Controlling the exact HTML in Twig and extracting the data manually via the `Request` object in the controller gave me absolute pixel-perfect control over the modern UI design."*

**Teacher:** *"How do you handle security and prevent hacking?"*
**Your Answer:** *"I rely on Doctrine ORM which automatically escapes all SQL queries, preventing SQL Injection. For XSS (Cross-Site Scripting), Twig automatically escapes all variables rendered on the screen. Finally, all my private routes check user permissions verifying if they own the resource (like checking Conversation IDs against the logged-in User ID) before taking action."*

**Teacher:** *"What happens if an image path in the database is from an older version of the desktop app?"*
**Your Answer:** *"In my `User` entity, I created a custom getter called `getProfilePictureUrl()`. It acts as an adapter. If the picture string starts with `http`, it serves it normally. If it's an old absolute desktop path, the function extracts just the filename using `basename()` and prepends the correct web folder path `/uploads/profiles/`. This ensures backwards compatibility without having to modify the data."*
