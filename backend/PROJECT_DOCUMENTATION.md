# InnerTrack Web - Project Documentation

## 1. Project Overview

**Purpose & Description:**
InnerTrack Web is a Symfony-based application designed to bridge the gap between mental health professionals (Psychologues) and normal users (Clients/Users). It supports an overarching infrastructure originally designed for a JavaFX client, providing a modern web interface for communication, dashboards, mapping, and administration. It integrates real-time messaging, map-based therapist discovery, and a robust administrative moderation panel.

**Tech Stack:**
*   **Framework:** Symfony 6.4 (PHP >= 8.1)
*   **Database:** MariaDB (10.4.32) via Doctrine ORM (^3.6)
*   **Frontend Design:** Twig (^3.0), TailwindCSS (`symfonycasts/tailwind-bundle`), Alpine.js (implied via Twig UI logic).
*   **Security:** Symfony Security Bundle, `lexik/jwt-authentication-bundle`, custom `LoginSuccessHandler` and `UserChecker`.

**Directory Structure:**
*   `src/Controller/`: Action controllers serving templates and JSON APIs.
*   `src/Entity/`: Doctrine ORM data models.
*   `src/Repository/`: Data fetching classes.
*   `src/Security/`: Authentication event handlers and validators.
*   `src/Service/`: Business logic services (e.g., Email).
*   `src/EventSubscriber/`: Event listeners (e.g., Locale management).
*   `config/`: Symfony configuration bundles (YAML files).
*   `templates/`: Twig views defining the "Digital Sanctuary" frontend.

---

## 2. Architecture & Design

**MVC Architecture:**
The project follows standard Model-View-Controller patterns driven by Symfony:
1.  **Request:** Hits `public/index.php`.
2.  **Routing:** Attributes map the URL to a specific Controller method.
3.  **Controller:** Handles incoming data, performs lightweight validation, and orchestrates calls to repositories or external HTTP services (like ImgBB). Note: The project relies heavily on direct `$request->request->get()` reads rather than Symfony FormTypes.
4.  **Database/Service Layer:** Interacts with `EntityManagerInterface` to persist Doctrine entities.
5.  **Response:** Returns a standard `Response` rendering a `twig` template, or a `JsonResponse` for asynchronous UI elements (like chat polling or modal submissions).

---

## 3. Configuration

### `config/packages/doctrine.yaml`
Configures the Doctrine DBAL/ORM to use MariaDB.
```yaml
doctrine:
    dbal:
        url: '%env(resolve:DATABASE_URL)%'
        server_version: 'mariadb-10.4.32'
    orm:
        auto_generate_proxy_classes: true
        naming_strategy: doctrine.orm.naming_strategy.underscore_number_aware
        auto_mapping: true
```
*Purpose:* Hardcodes the MariaDB version to ensure proper SQL generation across different developer environments.

### `config/services.yaml`
```yaml
parameters:
    imgbb_api_key: '%env(IMGBB_API_KEY)%'

services:
    _defaults:
        autowire: true
        autoconfigure: true
    App\:
        resource: '../src/'
        exclude: ['../src/DependencyInjection/', '../src/Entity/', '../src/Kernel.php']
```
*Purpose:* Maps environment variables (`IMGBB_API_KEY`) into the Symfony container for programmatic injection.

---

## 4. Routing
Routing is strictly Attribute-based above controller methods.

*   `#[Route('/login', name: 'app_login')]`: Base web login path.
*   `#[Route('/messages/{id}', name: 'app_messages_show', methods: ['GET'])]`: Specific conversation view.
*   `#[Route('/api/report', name: 'api_report_user', methods: ['POST'])]`: Asynchronous JSON endpoint for submitting user reports.

---

## 5. Controllers

### `WebAuthController.php`
Manages the onboarding flow. Uses native server-side validation.
```php
// Handles user registration.
#[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
public function register(Request $request, EmailSender $emailSender): Response
{
    // Fetches manual input, validates email formats, checks for matching passwords.
    // Creates standard User entities, roles, and a linked EmailVerificationCode for mailing.
}
```

### `UserProfileController.php`
Handles updates to standard user traits and specific Client/Therapist sub-profiles.
```php
// Modifies user state
#[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
public function index(Request $request): Response
{
    // Applies server-side validation to strings, formats phone numbers.
    // Differentiates save targets based on $isTherapist variable.
}
```

### `ContactRequestController.php`
Allows therapists to Accept, Reject, or Postpone mapping-based contact requests.
```php
#[Route('/requests/{id}/accept', name: 'contact_request_accept', methods: ['POST'])]
public function accept(ContactRequest $request): RedirectResponse
{
    // Changes status to ACCEPTED
    // Instantiates a new `Conversation` entity allowing messaging.
    // Fires a Notification to the client.
}
```

---

## 6. Entities & Database

### The User Entity Structure
The application uses a polymorphic split, where the `User` table holds authentication and generic data, while extensions are made using `@ORM\OneToOne` associations to specific profile tables (e.g., `ClientProfile`, `TherapistProfile`). 

#### `User.php`
```php
#[ORM\Entity(repositoryClass: \App\Repository\UserRepository::class)]
#[ORM\Table(name: 'user')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\OneToOne(targetEntity: ClientProfile::class, mappedBy: 'user')]
    private ?ClientProfile $clientProfile = null;

    #[ORM\OneToOne(targetEntity: TherapistProfile::class, mappedBy: 'user')]
    private ?TherapistProfile $therapistProfile = null;
    
    // Fallback logic for Profile Picture paths to support external and local paths
    public function getProfilePictureUrl(): ?string { ... }
}
```
*Purpose:* Handles Security authentication, roles (`ROLE_USER`, `ROLE_PSYCHOLOGUE`, `ROLE_ADMIN`), status (`PENDING`, `ACTIVE`, `BLOCKED`).

#### Support Entities
*   **`Conversation` & `Message`**: Standard chat entities. `Conversation` bridges a Client and Therapist `User` ID, and `Message` stores individual texts linked locally via `ManyToOne`.
*   **`ContactRequest`**: A gateway request created from the map, bridging two users before a `Conversation` opens.
*   **`BlockedUser` & `Report`**: Entities driving the administrative moderation and user-privacy tools.
*   **`UserSettings`**: Extends User to store Light/Dark themes, font sizes, and localization choices.

---

## 7. Repositories

Most queries in the system utilize `ServiceEntityRepository` default methods (`find`, `findOneBy`). Raw queries are occasionally defined using `$conn->executeQuery()` for complex statistical aggregations (found inside `DashboardController.php`).

---

## 8. Services & Business Logic

### `EmailSender.php`
Abstracts out Symfony's internal `MailerInterface`.
```php
class EmailSender {
    public function sendVerificationEmail(string $to, string $otp): void
    {
        $email = (new Email())
            ->from('no-reply@innertrack.tn')
            ->to($to)
            ->subject('Vérifiez votre email - InnerTrack')
            ->html("...");
        $this->mailer->send($email);
    }
}
```
*Purpose:* Hardcodes HTML outputs and sends 6-digit OTP codes required for onboarding and password resets.

---

## 9. Forms

*Note: This specific Symfony architecture bypasses the traditional `src/Form/AbstractType` generation paradigm.*

Instead of `symfony/form`, all incoming HTTP data in the backend is manually verified directly through `$request->request->get('fieldName')` using strict server-side conditional logic (e.g., checking `strlen` and testing RegEx) before interacting with Doctrine `flush()`. 

---

## 10. Security

### `config/packages/security.yaml`
```yaml
security:
    role_hierarchy:
        ROLE_ADMIN: [ROLE_PSYCHOLOGUE, ROLE_USER]
        ROLE_PSYCHOLOGUE: ROLE_USER

    firewalls:
        web:
            provider: app_user_provider
            user_checker: App\Security\UserChecker
            form_login:
                login_path: app_login
                check_path: app_login
                default_target_path: app_dashboard
                success_handler: App\Security\LoginSuccessHandler
```

### Components
1.  **`UserChecker.php`**: Prevents unverified (`$user->isVerified() === false`) or administratively moderated (`$user->getStatus() === 'BLOCKED'`) users from connecting. Implements `checkPreAuth()`.
2.  **`LoginSuccessHandler.php`**: Intercepts successful authentications bound for `app_dashboard` in order to inject the current `DateTime` into the User's `lastLogin` metric.

---

## 11. Events & Subscribers

### `LocaleSubscriber.php`
```php
class LocaleSubscriber implements EventSubscriberInterface
{
    public function onKernelRequest(RequestEvent $event): void
    {
        // Intercepts the HTTP request to set Localization options
        // Derived from UserSettings entity (e.g. 'FR' or 'EN') 
        // Falls back to session cookie or default container variables.
    }
}
```
*Purpose:* Listens to `KernelEvents::REQUEST` (priority 20) to ensure Twig translates its keys dynamically on every page load based on user database preference.

---

## 12. Console Commands

No custom `.php` script console commands exist in the core tree at this time (`src/Command`). Standard `bin/console` handles caching and doctrine migrations.

---

## 13. API Endpoints

The system relies on internal AJAX APIs for reactive Web interactions. Example:

### `GET /_messaging/api/{id}`
**Action:** Fetches chat message histories for asynchronous JS polling.
**Returns:**
```json
[
  {
    "id": 142,
    "content": "Bonjour!",
    "senderId": 12,
    "senderName": "Mark Henderson",
    "sentAt": "2026-04-05 10:11:00",
    "isMe": false
  }
]
```

### `POST /api/block`
**Action:** Writes a `BlockedUser` entity line item to break contact rules between two users.
**Payload:** `{"userId": 5}`

---

## 14. Templates (Twig)

*   **`base.html.twig`**: Core HTML5 wrapper importing fonts, Alpine.js, Tailwind compiled links, and dynamic `<html lang="{{ app.request.locale }}">`.
*   **`layouts/dashboard.html.twig`**: Extensive navigation wrapper containing the system sidebars, profile avatar headers, and active links.
*   **Theme Integration**: Twig renders variables out of the `userSettings` element, dynamically casting classes like `dark` or `text-lg` automatically onto the wrapper based on the session user settings cache.

---

## 15. Tests

Uses `phpunit/phpunit` (specified in `composer.json` block `require-dev: ^11.5`) but no test coverage metrics or directories (`tests/`) currently exist holding functional logic.

---

## 16. Dependency & Bundle Reference

*   `doctrine/orm`: Standard object-relational mapping logic.
*   `lexik/jwt-authentication-bundle`: Enables the issuance of JSON Web Tokens (`api/login`).
*   `nelmio/cors-bundle`: Allows Cross-Origin assertions, bridging the potential JavaFX implementations.
*   `symfony/ux-turbo`: Enables faster DOM refreshes for real-time Twig interaction without full reloads.
*   `symfonycasts/tailwind-bundle`: Compiles utility CSS classes natively. 
*   `symfonycasts/verify-email-bundle`: Helper architectures for e-mail based onboarding.
