<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* pages/dashboard/therapist.html.twig */
class __TwigTemplate_03beccc0c7ad5f4ec7cf9524e9a69ba9 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "layouts/dashboard.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/dashboard/therapist.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/dashboard/therapist.html.twig"));

        $this->parent = $this->load("layouts/dashboard.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Therapist Portal - InnerTrack";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 6
        yield "<div class=\"space-y-12\">
    <!-- Hero Welcome -->
    <section class=\"space-y-2\">
        <h2 class=\"font-headline text-4xl lg:text-5xl text-on-surface font-extrabold tracking-tight\">Welcome back, Dr. ";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, true, false, 9), "lastName", [], "any", true, true, false, 9)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 9, $this->source); })()), "user", [], "any", false, false, false, 9), "lastName", [], "any", false, false, false, 9), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 9, $this->source); })()), "user", [], "any", false, false, false, 9), "firstName", [], "any", false, false, false, 9))) : (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 9, $this->source); })()), "user", [], "any", false, false, false, 9), "firstName", [], "any", false, false, false, 9))), "html", null, true);
        yield " 👩‍⚕️</h2>
        <p class=\"text-on-surface-variant text-lg\">Your sanctuary for patient care and therapeutic management.</p>
    </section>

    <!-- Stats Grid -->
    <section class=\"grid grid-cols-1 md:grid-cols-3 gap-8\">
        <div class=\"sanctuary-gradient bg-gradient-to-br from-primary to-indigo-800 p-8 rounded-xl shadow-xl shadow-primary/10 flex justify-between items-center text-white overflow-hidden relative group\">
            <div class=\"relative z-10\">
                <p class=\"text-sm font-medium opacity-80 uppercase tracking-widest\">Active Patients</p>
                <h3 class=\"text-5xl font-extrabold mt-1\">";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["activePatients"]) || array_key_exists("activePatients", $context) ? $context["activePatients"] : (function () { throw new RuntimeError('Variable "activePatients" does not exist.', 18, $this->source); })())), "html", null, true);
        yield "</h3>
            </div>
            <span class=\"material-symbols-outlined text-7xl opacity-20 group-hover:scale-110 transition-transform duration-500\" data-icon=\"group\">group</span>
        </div>
        
        <div class=\"bg-surface-container-low p-8 rounded-xl flex justify-between items-center text-on-surface border-l-4 border-secondary overflow-hidden relative group shadow-sm\">
            <div class=\"relative z-10\">
                <p class=\"text-sm font-medium text-on-surface-variant uppercase tracking-widest\">Pending Requests</p>
                <h3 class=\"text-5xl font-extrabold mt-1 text-secondary\">";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["pendingRequests"]) || array_key_exists("pendingRequests", $context) ? $context["pendingRequests"] : (function () { throw new RuntimeError('Variable "pendingRequests" does not exist.', 26, $this->source); })())), "html", null, true);
        yield "</h3>
            </div>
            <span class=\"material-symbols-outlined text-7xl text-secondary opacity-10 group-hover:scale-110 transition-transform duration-500\" data-icon=\"person_add\">person_add</span>
        </div>
        
        <div class=\"bg-surface-container-lowest p-8 rounded-xl shadow-sm flex justify-between items-center text-on-surface border border-outline-variant/10 overflow-hidden relative group\">
            <div class=\"relative z-10\">
                <p class=\"text-sm font-medium text-on-surface-variant uppercase tracking-widest\">Unread Notifications</p>
                <h3 class=\"text-5xl font-extrabold mt-1 text-primary\">";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["unreadNotifs"]) || array_key_exists("unreadNotifs", $context) ? $context["unreadNotifs"] : (function () { throw new RuntimeError('Variable "unreadNotifs" does not exist.', 34, $this->source); })()), "html", null, true);
        yield "</h3>
            </div>
            <span class=\"material-symbols-outlined text-7xl text-primary opacity-10 group-hover:scale-110 transition-transform duration-500\" data-icon=\"notifications\">notifications</span>
        </div>
    </section>

    <!-- Main Workspace Layout -->
    <div class=\"grid grid-cols-1 lg:grid-cols-12 gap-12\">
        <!-- Left: Transactions & Feeds -->
        <div class=\"lg:col-span-8 space-y-12\">
            <!-- Pending Requests Table -->
            <section>
                <div class=\"flex items-center justify-between mb-6\">
                    <h3 class=\"font-headline text-2xl font-bold\">Pending Contact Requests</h3>
                    <a href=\"#\" class=\"text-primary font-semibold text-sm hover:underline\">View all</a>
                </div>
                
                <div class=\"bg-surface-container-lowest border border-outline-variant/20 rounded-xl overflow-hidden shadow-sm\">
                    <div class=\"overflow-x-auto\">
                        <table class=\"w-full text-left border-collapse\">
                            <thead>
                                <tr class=\"bg-surface-container-low text-on-surface-variant text-xs uppercase tracking-widest\">
                                    <th class=\"px-6 py-4 font-semibold\">Patient Name</th>
                                    <th class=\"px-6 py-4 font-semibold\">Message</th>
                                    <th class=\"px-6 py-4 font-semibold\">Date</th>
                                    <th class=\"px-6 py-4 font-semibold text-right\">Actions</th>
                                </tr>
                            </thead>
                            <tbody class=\"divide-y divide-outline-variant/10\">
                            ";
        // line 63
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::slice($this->env->getCharset(), (isset($context["pendingRequests"]) || array_key_exists("pendingRequests", $context) ? $context["pendingRequests"] : (function () { throw new RuntimeError('Variable "pendingRequests" does not exist.', 63, $this->source); })()), 0, 3));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["req"]) {
            // line 64
            yield "                                <tr class=\"hover:bg-surface-container transition-colors\">
                                    <td class=\"px-6 py-5\">
                                        <div class=\"flex items-center gap-3\">
                                            <div class=\"w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container font-bold text-xs uppercase overflow-hidden\">
                                                ";
            // line 68
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["req"], "client", [], "any", false, false, false, 68), "profilePictureUrl", [], "any", false, false, false, 68)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 69
                yield "                                                    <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["req"], "client", [], "any", false, false, false, 69), "profilePictureUrl", [], "any", false, false, false, 69), "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["req"], "client", [], "any", false, false, false, 69), "firstName", [], "any", false, false, false, 69), "html", null, true);
                yield "\" class=\"w-full h-full object-cover\">
                                                ";
            } else {
                // line 71
                yield "                                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["req"], "client", [], "any", false, false, false, 71), "firstName", [], "any", false, false, false, 71)), "html", null, true);
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["req"], "client", [], "any", false, false, false, 71), "lastName", [], "any", false, false, false, 71)), "html", null, true);
                yield "
                                                ";
            }
            // line 73
            yield "                                            </div>
                                            <span class=\"font-semibold text-sm\">";
            // line 74
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["req"], "client", [], "any", false, false, false, 74), "fullName", [], "any", false, false, false, 74), "html", null, true);
            yield "</span>
                                        </div>
                                        <span class=\"text-xs test-on-surface-variant\">";
            // line 76
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["req"], "client", [], "any", false, false, false, 76), "email", [], "any", false, false, false, 76), "html", null, true);
            yield "</span>
                                    </td>
                                    <td class=\"px-6 py-5 text-sm text-on-surface-variant max-w-xs truncate\">
                                        ";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["req"], "message", [], "any", true, true, false, 79)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["req"], "message", [], "any", false, false, false, 79), "No specific message provided...")) : ("No specific message provided...")), "html", null, true);
            yield "
                                    </td>
                                    <td class=\"px-6 py-5 text-sm\">";
            // line 81
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["req"], "createdAt", [], "any", false, false, false, 81), "M d, Y"), "html", null, true);
            yield "</td>
                                    <td class=\"px-6 py-5 text-right space-x-2\">
                                        <form method=\"post\" action=\"";
            // line 83
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("contact_request_accept", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["req"], "id", [], "any", false, false, false, 83)]), "html", null, true);
            yield "\" class=\"inline\">
                                            <button class=\"bg-secondary text-white px-4 py-1.5 rounded-xl shadow-sm text-xs font-bold hover:shadow-md transition-shadow\">Accept</button>
                                        </form>
                                        <form method=\"post\" action=\"";
            // line 86
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("contact_request_reject", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["req"], "id", [], "any", false, false, false, 86)]), "html", null, true);
            yield "\" class=\"inline\">
                                            <button class=\"border border-red-500 text-red-600 px-4 py-1.5 rounded-xl text-xs font-bold hover:bg-red-50 transition-colors\">Decline</button>
                                        </form>
                                    </td>
                                </tr>
                            ";
            $context['_iterated'] = true;
        }
        // line 91
        if (!$context['_iterated']) {
            // line 92
            yield "                                <tr>
                                    <td colspan=\"4\" class=\"px-6 py-12 text-center text-on-surface-variant text-sm bg-white\">
                                        <div class=\"flex flex-col items-center justify-center opacity-60\">
                                            <span class=\"material-symbols-outlined text-4xl mb-2\" data-icon=\"inbox\">inbox</span>
                                            <p>No pending contact requests. You're all caught up!</p>
                                        </div>
                                    </td>
                                </tr>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['req'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 101
        yield "                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Recent Conversations -->
            <section>
                <h3 class=\"font-headline text-2xl font-bold mb-6\">Recent Conversations</h3>
                <div class=\"space-y-4\">
                    ";
        // line 111
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(Twig\Extension\CoreExtension::slice($this->env->getCharset(), (isset($context["activePatients"]) || array_key_exists("activePatients", $context) ? $context["activePatients"] : (function () { throw new RuntimeError('Variable "activePatients" does not exist.', 111, $this->source); })()), 0, 3));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["conversation"]) {
            // line 112
            yield "                        ";
            $context["otherUser"] = CoreExtension::getAttribute($this->env, $this->source, $context["conversation"], "client", [], "any", false, false, false, 112);
            // line 113
            yield "                        ";
            $context["lastMsg"] = Twig\Extension\CoreExtension::last($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["conversation"], "messages", [], "any", false, false, false, 113));
            // line 114
            yield "                        <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_messages_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["conversation"], "id", [], "any", false, false, false, 114)]), "html", null, true);
            yield "\" class=\"block bg-surface-container-lowest border border-outline-variant/10 p-6 rounded-2xl flex items-center justify-between group cursor-pointer hover:shadow-xl hover:shadow-primary/5 hover:-translate-y-1 transition-all\">
                            <div class=\"flex items-center gap-5\">
                                <div class=\"relative\">
                                    <div class=\"w-12 h-12 rounded-full bg-primary-container text-primary flex items-center justify-center font-extrabold text-lg overflow-hidden\">
                                        ";
            // line 118
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["otherUser"]) || array_key_exists("otherUser", $context) ? $context["otherUser"] : (function () { throw new RuntimeError('Variable "otherUser" does not exist.', 118, $this->source); })()), "profilePictureUrl", [], "any", false, false, false, 118)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 119
                yield "                                            <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["otherUser"]) || array_key_exists("otherUser", $context) ? $context["otherUser"] : (function () { throw new RuntimeError('Variable "otherUser" does not exist.', 119, $this->source); })()), "profilePictureUrl", [], "any", false, false, false, 119), "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["otherUser"]) || array_key_exists("otherUser", $context) ? $context["otherUser"] : (function () { throw new RuntimeError('Variable "otherUser" does not exist.', 119, $this->source); })()), "firstName", [], "any", false, false, false, 119), "html", null, true);
                yield "\" class=\"w-full h-full object-cover\">
                                        ";
            } else {
                // line 121
                yield "                                            ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["otherUser"]) || array_key_exists("otherUser", $context) ? $context["otherUser"] : (function () { throw new RuntimeError('Variable "otherUser" does not exist.', 121, $this->source); })()), "firstName", [], "any", false, false, false, 121)), "html", null, true);
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["otherUser"]) || array_key_exists("otherUser", $context) ? $context["otherUser"] : (function () { throw new RuntimeError('Variable "otherUser" does not exist.', 121, $this->source); })()), "lastName", [], "any", false, false, false, 121)), "html", null, true);
                yield "
                                        ";
            }
            // line 123
            yield "                                    </div>
                                    <div class=\"absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-500 rounded-full border-2 border-white\"></div>
                                </div>
                                <div>
                                    <h4 class=\"font-bold text-sm text-on-surface\">";
            // line 127
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["otherUser"]) || array_key_exists("otherUser", $context) ? $context["otherUser"] : (function () { throw new RuntimeError('Variable "otherUser" does not exist.', 127, $this->source); })()), "fullName", [], "any", false, false, false, 127), "html", null, true);
            yield "</h4>
                                    <p class=\"text-sm text-on-surface-variant truncate max-w-[200px] sm:max-w-xs mt-0.5\">
                                        ";
            // line 129
            if ((($tmp = (isset($context["lastMsg"]) || array_key_exists("lastMsg", $context) ? $context["lastMsg"] : (function () { throw new RuntimeError('Variable "lastMsg" does not exist.', 129, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 130
                yield "                                            \"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["lastMsg"]) || array_key_exists("lastMsg", $context) ? $context["lastMsg"] : (function () { throw new RuntimeError('Variable "lastMsg" does not exist.', 130, $this->source); })()), "content", [], "any", false, false, false, 130), "html", null, true);
                yield "\"
                                        ";
            } else {
                // line 132
                yield "                                            <i>Started a new conversation</i>
                                        ";
            }
            // line 134
            yield "                                    </p>
                                </div>
                            </div>
                            <span class=\"text-xs text-slate-400 font-bold tracking-wide whitespace-nowrap bg-gray-50 px-3 py-1 rounded-md\">
                                ";
            // line 138
            if ((($tmp = (isset($context["lastMsg"]) || array_key_exists("lastMsg", $context) ? $context["lastMsg"] : (function () { throw new RuntimeError('Variable "lastMsg" does not exist.', 138, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 139
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["lastMsg"]) || array_key_exists("lastMsg", $context) ? $context["lastMsg"] : (function () { throw new RuntimeError('Variable "lastMsg" does not exist.', 139, $this->source); })()), "sentAt", [], "any", false, false, false, 139), "M d"), "html", null, true);
                yield "
                                ";
            } else {
                // line 141
                yield "                                    ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["conversation"], "createdAt", [], "any", false, false, false, 141), "M d"), "html", null, true);
                yield "
                                ";
            }
            // line 143
            yield "                            </span>
                        </a>
                    ";
            $context['_iterated'] = true;
        }
        // line 145
        if (!$context['_iterated']) {
            // line 146
            yield "                        <div class=\"bg-surface-container-lowest border border-outline-variant/10 p-10 rounded-2xl text-center text-on-surface-variant flex flex-col items-center gap-3\">
                            <span class=\"material-symbols-outlined text-4xl opacity-50\" data-icon=\"chat_bubble_outline\">chat_bubble_outline</span>
                            <p class=\"font-medium\">You have no active conversations yet.</p>
                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['conversation'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 151
        yield "                </div>
            </section>
        </div>

        <!-- Right Sidebar: Profile & Quick Info -->
        <aside class=\"lg:col-span-4 space-y-8\">
            <div class=\"bg-surface-container-highest p-8 rounded-[2rem] relative overflow-hidden flex flex-col justify-center\">
                <!-- Abstract Background Decoration -->
                <div class=\"absolute -top-12 -right-12 w-40 h-40 bg-secondary opacity-10 rounded-full blur-3xl\"></div>
                <div class=\"absolute -bottom-12 -left-12 w-40 h-40 bg-primary opacity-10 rounded-full blur-3xl\"></div>
                <div class=\"relative z-10 flex flex-col items-center text-center\">
                    ";
        // line 162
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 162, $this->source); })()), "user", [], "any", false, false, false, 162), "profilePictureUrl", [], "any", false, false, false, 162)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 163
            yield "                        <img alt=\"Dr. ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, true, false, 163), "lastName", [], "any", true, true, false, 163)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 163, $this->source); })()), "user", [], "any", false, false, false, 163), "lastName", [], "any", false, false, false, 163), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 163, $this->source); })()), "user", [], "any", false, false, false, 163), "firstName", [], "any", false, false, false, 163))) : (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 163, $this->source); })()), "user", [], "any", false, false, false, 163), "firstName", [], "any", false, false, false, 163))), "html", null, true);
            yield "\" class=\"w-24 h-24 rounded-full object-cover border-4 border-white shadow-xl mb-6\" loading=\"lazy\" src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 163, $this->source); })()), "user", [], "any", false, false, false, 163), "profilePictureUrl", [], "any", false, false, false, 163), "html", null, true);
            yield "\"/>
                    ";
        } else {
            // line 165
            yield "                        <div class=\"w-24 h-24 rounded-full bg-primary-container text-primary flex items-center justify-center font-extrabold text-3xl border-4 border-white shadow-xl mb-6\">
                            ";
            // line 166
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 166, $this->source); })()), "user", [], "any", false, false, false, 166), "firstName", [], "any", false, false, false, 166)), "html", null, true);
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 166, $this->source); })()), "user", [], "any", false, false, false, 166), "lastName", [], "any", false, false, false, 166)), "html", null, true);
            yield "
                        </div>
                    ";
        }
        // line 169
        yield "                    <h4 class=\"font-headline text-2xl font-bold text-on-surface\">Dr. ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, true, false, 169), "lastName", [], "any", true, true, false, 169)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 169, $this->source); })()), "user", [], "any", false, false, false, 169), "lastName", [], "any", false, false, false, 169), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 169, $this->source); })()), "user", [], "any", false, false, false, 169), "firstName", [], "any", false, false, false, 169))) : (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 169, $this->source); })()), "user", [], "any", false, false, false, 169), "firstName", [], "any", false, false, false, 169))), "html", null, true);
        yield "</h4>
                    <p class=\"text-xs text-primary font-bold uppercase tracking-widest mb-8 mt-1\">Clinical Psychologist</p>
                    
                    <div class=\"w-full space-y-3 text-left\">
                    </div>
                    
                    <a href=\"";
        // line 175
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile");
        yield "\" class=\"mt-8 text-primary font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all group px-6 py-2 bg-white rounded-full shadow-sm hover:shadow-md border border-outline/10\">
                        Edit Profile Details
                        <span class=\"material-symbols-outlined text-sm\" data-icon=\"edit\">edit</span>
                    </a>
                </div>
            </div>

            <!-- Journey Path Bespoke Component -->
            <div class=\"bg-surface-container-low p-8 rounded-[2rem] border border-outline/20\">
                <h5 class=\"font-extrabold text-xs mb-8 uppercase tracking-[0.2em] text-on-surface-variant flex items-center justify-between\">
                    Global Patient Progress
                    <span class=\"material-symbols-outlined text-[18px]\">trending_up</span>
                </h5>
                <div class=\"relative flex flex-col gap-8 h-48 items-center justify-center\">
                    <!-- Soft Curved Progress Mockup -->
                    <svg class=\"absolute inset-0 w-full h-full text-secondary/10 fill-none stroke-current\" style=\"stroke-width: 4; stroke-linecap: round;\" viewbox=\"0 0 100 100\">
                        <path d=\"M 10 90 C 20 60, 40 40, 50 50 S 80 40, 90 10\"></path>
                    </svg>
                    <svg class=\"absolute inset-0 w-full h-full text-secondary fill-none stroke-current\" style=\"stroke-width: 4; stroke-linecap: round; stroke-dasharray: 200; stroke-dashoffset: 60;\" viewbox=\"0 0 100 100\">
                        <path d=\"M 10 90 C 20 60, 40 40, 50 50 S 80 40, 90 10\"></path>
                    </svg>
                    <div class=\"z-10 bg-white shadow-xl shadow-secondary/10 p-5 rounded-2xl text-center border border-secondary/20 min-w-[100px]\">
                        <p class=\"text-3xl font-black text-secondary\">72%</p>
                        <p class=\"text-[9px] font-bold uppercase tracking-widest opacity-60 mt-1\">Goal Reached</p>
                    </div>
                </div>
                <p class=\"text-xs text-center text-on-surface-variant mt-6 italic font-medium\">
                    \"The journey of recovery is organic, not clinical.\"
                </p>
            </div>
        </aside>
    </div>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "pages/dashboard/therapist.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  407 => 175,  397 => 169,  390 => 166,  387 => 165,  379 => 163,  377 => 162,  364 => 151,  354 => 146,  352 => 145,  346 => 143,  340 => 141,  334 => 139,  332 => 138,  326 => 134,  322 => 132,  316 => 130,  314 => 129,  309 => 127,  303 => 123,  296 => 121,  288 => 119,  286 => 118,  278 => 114,  275 => 113,  272 => 112,  267 => 111,  255 => 101,  241 => 92,  239 => 91,  229 => 86,  223 => 83,  218 => 81,  213 => 79,  207 => 76,  202 => 74,  199 => 73,  192 => 71,  184 => 69,  182 => 68,  176 => 64,  171 => 63,  139 => 34,  128 => 26,  117 => 18,  105 => 9,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block title %}Therapist Portal - InnerTrack{% endblock %}

{% block content %}
<div class=\"space-y-12\">
    <!-- Hero Welcome -->
    <section class=\"space-y-2\">
        <h2 class=\"font-headline text-4xl lg:text-5xl text-on-surface font-extrabold tracking-tight\">Welcome back, Dr. {{ app.user.lastName|default(app.user.firstName) }} 👩‍⚕️</h2>
        <p class=\"text-on-surface-variant text-lg\">Your sanctuary for patient care and therapeutic management.</p>
    </section>

    <!-- Stats Grid -->
    <section class=\"grid grid-cols-1 md:grid-cols-3 gap-8\">
        <div class=\"sanctuary-gradient bg-gradient-to-br from-primary to-indigo-800 p-8 rounded-xl shadow-xl shadow-primary/10 flex justify-between items-center text-white overflow-hidden relative group\">
            <div class=\"relative z-10\">
                <p class=\"text-sm font-medium opacity-80 uppercase tracking-widest\">Active Patients</p>
                <h3 class=\"text-5xl font-extrabold mt-1\">{{ activePatients|length }}</h3>
            </div>
            <span class=\"material-symbols-outlined text-7xl opacity-20 group-hover:scale-110 transition-transform duration-500\" data-icon=\"group\">group</span>
        </div>
        
        <div class=\"bg-surface-container-low p-8 rounded-xl flex justify-between items-center text-on-surface border-l-4 border-secondary overflow-hidden relative group shadow-sm\">
            <div class=\"relative z-10\">
                <p class=\"text-sm font-medium text-on-surface-variant uppercase tracking-widest\">Pending Requests</p>
                <h3 class=\"text-5xl font-extrabold mt-1 text-secondary\">{{ pendingRequests|length }}</h3>
            </div>
            <span class=\"material-symbols-outlined text-7xl text-secondary opacity-10 group-hover:scale-110 transition-transform duration-500\" data-icon=\"person_add\">person_add</span>
        </div>
        
        <div class=\"bg-surface-container-lowest p-8 rounded-xl shadow-sm flex justify-between items-center text-on-surface border border-outline-variant/10 overflow-hidden relative group\">
            <div class=\"relative z-10\">
                <p class=\"text-sm font-medium text-on-surface-variant uppercase tracking-widest\">Unread Notifications</p>
                <h3 class=\"text-5xl font-extrabold mt-1 text-primary\">{{ unreadNotifs }}</h3>
            </div>
            <span class=\"material-symbols-outlined text-7xl text-primary opacity-10 group-hover:scale-110 transition-transform duration-500\" data-icon=\"notifications\">notifications</span>
        </div>
    </section>

    <!-- Main Workspace Layout -->
    <div class=\"grid grid-cols-1 lg:grid-cols-12 gap-12\">
        <!-- Left: Transactions & Feeds -->
        <div class=\"lg:col-span-8 space-y-12\">
            <!-- Pending Requests Table -->
            <section>
                <div class=\"flex items-center justify-between mb-6\">
                    <h3 class=\"font-headline text-2xl font-bold\">Pending Contact Requests</h3>
                    <a href=\"#\" class=\"text-primary font-semibold text-sm hover:underline\">View all</a>
                </div>
                
                <div class=\"bg-surface-container-lowest border border-outline-variant/20 rounded-xl overflow-hidden shadow-sm\">
                    <div class=\"overflow-x-auto\">
                        <table class=\"w-full text-left border-collapse\">
                            <thead>
                                <tr class=\"bg-surface-container-low text-on-surface-variant text-xs uppercase tracking-widest\">
                                    <th class=\"px-6 py-4 font-semibold\">Patient Name</th>
                                    <th class=\"px-6 py-4 font-semibold\">Message</th>
                                    <th class=\"px-6 py-4 font-semibold\">Date</th>
                                    <th class=\"px-6 py-4 font-semibold text-right\">Actions</th>
                                </tr>
                            </thead>
                            <tbody class=\"divide-y divide-outline-variant/10\">
                            {% for req in pendingRequests|slice(0, 3) %}
                                <tr class=\"hover:bg-surface-container transition-colors\">
                                    <td class=\"px-6 py-5\">
                                        <div class=\"flex items-center gap-3\">
                                            <div class=\"w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container font-bold text-xs uppercase overflow-hidden\">
                                                {% if req.client.profilePictureUrl %}
                                                    <img src=\"{{ req.client.profilePictureUrl }}\" alt=\"{{ req.client.firstName }}\" class=\"w-full h-full object-cover\">
                                                {% else %}
                                                    {{ req.client.firstName|first }}{{ req.client.lastName|first }}
                                                {% endif %}
                                            </div>
                                            <span class=\"font-semibold text-sm\">{{ req.client.fullName }}</span>
                                        </div>
                                        <span class=\"text-xs test-on-surface-variant\">{{ req.client.email }}</span>
                                    </td>
                                    <td class=\"px-6 py-5 text-sm text-on-surface-variant max-w-xs truncate\">
                                        {{ req.message|default('No specific message provided...') }}
                                    </td>
                                    <td class=\"px-6 py-5 text-sm\">{{ req.createdAt|date('M d, Y') }}</td>
                                    <td class=\"px-6 py-5 text-right space-x-2\">
                                        <form method=\"post\" action=\"{{ path('contact_request_accept', {'id': req.id}) }}\" class=\"inline\">
                                            <button class=\"bg-secondary text-white px-4 py-1.5 rounded-xl shadow-sm text-xs font-bold hover:shadow-md transition-shadow\">Accept</button>
                                        </form>
                                        <form method=\"post\" action=\"{{ path('contact_request_reject', {'id': req.id}) }}\" class=\"inline\">
                                            <button class=\"border border-red-500 text-red-600 px-4 py-1.5 rounded-xl text-xs font-bold hover:bg-red-50 transition-colors\">Decline</button>
                                        </form>
                                    </td>
                                </tr>
                            {% else %}
                                <tr>
                                    <td colspan=\"4\" class=\"px-6 py-12 text-center text-on-surface-variant text-sm bg-white\">
                                        <div class=\"flex flex-col items-center justify-center opacity-60\">
                                            <span class=\"material-symbols-outlined text-4xl mb-2\" data-icon=\"inbox\">inbox</span>
                                            <p>No pending contact requests. You're all caught up!</p>
                                        </div>
                                    </td>
                                </tr>
                            {% endfor %}
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Recent Conversations -->
            <section>
                <h3 class=\"font-headline text-2xl font-bold mb-6\">Recent Conversations</h3>
                <div class=\"space-y-4\">
                    {% for conversation in activePatients|slice(0, 3) %}
                        {% set otherUser = conversation.client %}
                        {% set lastMsg = conversation.messages|last %}
                        <a href=\"{{ path('app_messages_show', {'id': conversation.id}) }}\" class=\"block bg-surface-container-lowest border border-outline-variant/10 p-6 rounded-2xl flex items-center justify-between group cursor-pointer hover:shadow-xl hover:shadow-primary/5 hover:-translate-y-1 transition-all\">
                            <div class=\"flex items-center gap-5\">
                                <div class=\"relative\">
                                    <div class=\"w-12 h-12 rounded-full bg-primary-container text-primary flex items-center justify-center font-extrabold text-lg overflow-hidden\">
                                        {% if otherUser.profilePictureUrl %}
                                            <img src=\"{{ otherUser.profilePictureUrl }}\" alt=\"{{ otherUser.firstName }}\" class=\"w-full h-full object-cover\">
                                        {% else %}
                                            {{ otherUser.firstName|first }}{{ otherUser.lastName|first }}
                                        {% endif %}
                                    </div>
                                    <div class=\"absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-500 rounded-full border-2 border-white\"></div>
                                </div>
                                <div>
                                    <h4 class=\"font-bold text-sm text-on-surface\">{{ otherUser.fullName }}</h4>
                                    <p class=\"text-sm text-on-surface-variant truncate max-w-[200px] sm:max-w-xs mt-0.5\">
                                        {% if lastMsg %}
                                            \"{{ lastMsg.content }}\"
                                        {% else %}
                                            <i>Started a new conversation</i>
                                        {% endif %}
                                    </p>
                                </div>
                            </div>
                            <span class=\"text-xs text-slate-400 font-bold tracking-wide whitespace-nowrap bg-gray-50 px-3 py-1 rounded-md\">
                                {% if lastMsg %}
                                    {{ lastMsg.sentAt|date('M d') }}
                                {% else %}
                                    {{ conversation.createdAt|date('M d') }}
                                {% endif %}
                            </span>
                        </a>
                    {% else %}
                        <div class=\"bg-surface-container-lowest border border-outline-variant/10 p-10 rounded-2xl text-center text-on-surface-variant flex flex-col items-center gap-3\">
                            <span class=\"material-symbols-outlined text-4xl opacity-50\" data-icon=\"chat_bubble_outline\">chat_bubble_outline</span>
                            <p class=\"font-medium\">You have no active conversations yet.</p>
                        </div>
                    {% endfor %}
                </div>
            </section>
        </div>

        <!-- Right Sidebar: Profile & Quick Info -->
        <aside class=\"lg:col-span-4 space-y-8\">
            <div class=\"bg-surface-container-highest p-8 rounded-[2rem] relative overflow-hidden flex flex-col justify-center\">
                <!-- Abstract Background Decoration -->
                <div class=\"absolute -top-12 -right-12 w-40 h-40 bg-secondary opacity-10 rounded-full blur-3xl\"></div>
                <div class=\"absolute -bottom-12 -left-12 w-40 h-40 bg-primary opacity-10 rounded-full blur-3xl\"></div>
                <div class=\"relative z-10 flex flex-col items-center text-center\">
                    {% if app.user.profilePictureUrl %}
                        <img alt=\"Dr. {{ app.user.lastName|default(app.user.firstName) }}\" class=\"w-24 h-24 rounded-full object-cover border-4 border-white shadow-xl mb-6\" loading=\"lazy\" src=\"{{ app.user.profilePictureUrl }}\"/>
                    {% else %}
                        <div class=\"w-24 h-24 rounded-full bg-primary-container text-primary flex items-center justify-center font-extrabold text-3xl border-4 border-white shadow-xl mb-6\">
                            {{ app.user.firstName|first }}{{ app.user.lastName|first }}
                        </div>
                    {% endif %}
                    <h4 class=\"font-headline text-2xl font-bold text-on-surface\">Dr. {{ app.user.lastName|default(app.user.firstName) }}</h4>
                    <p class=\"text-xs text-primary font-bold uppercase tracking-widest mb-8 mt-1\">Clinical Psychologist</p>
                    
                    <div class=\"w-full space-y-3 text-left\">
                    </div>
                    
                    <a href=\"{{ path('app_profile') }}\" class=\"mt-8 text-primary font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all group px-6 py-2 bg-white rounded-full shadow-sm hover:shadow-md border border-outline/10\">
                        Edit Profile Details
                        <span class=\"material-symbols-outlined text-sm\" data-icon=\"edit\">edit</span>
                    </a>
                </div>
            </div>

            <!-- Journey Path Bespoke Component -->
            <div class=\"bg-surface-container-low p-8 rounded-[2rem] border border-outline/20\">
                <h5 class=\"font-extrabold text-xs mb-8 uppercase tracking-[0.2em] text-on-surface-variant flex items-center justify-between\">
                    Global Patient Progress
                    <span class=\"material-symbols-outlined text-[18px]\">trending_up</span>
                </h5>
                <div class=\"relative flex flex-col gap-8 h-48 items-center justify-center\">
                    <!-- Soft Curved Progress Mockup -->
                    <svg class=\"absolute inset-0 w-full h-full text-secondary/10 fill-none stroke-current\" style=\"stroke-width: 4; stroke-linecap: round;\" viewbox=\"0 0 100 100\">
                        <path d=\"M 10 90 C 20 60, 40 40, 50 50 S 80 40, 90 10\"></path>
                    </svg>
                    <svg class=\"absolute inset-0 w-full h-full text-secondary fill-none stroke-current\" style=\"stroke-width: 4; stroke-linecap: round; stroke-dasharray: 200; stroke-dashoffset: 60;\" viewbox=\"0 0 100 100\">
                        <path d=\"M 10 90 C 20 60, 40 40, 50 50 S 80 40, 90 10\"></path>
                    </svg>
                    <div class=\"z-10 bg-white shadow-xl shadow-secondary/10 p-5 rounded-2xl text-center border border-secondary/20 min-w-[100px]\">
                        <p class=\"text-3xl font-black text-secondary\">72%</p>
                        <p class=\"text-[9px] font-bold uppercase tracking-widest opacity-60 mt-1\">Goal Reached</p>
                    </div>
                </div>
                <p class=\"text-xs text-center text-on-surface-variant mt-6 italic font-medium\">
                    \"The journey of recovery is organic, not clinical.\"
                </p>
            </div>
        </aside>
    </div>
</div>
{% endblock %}
", "pages/dashboard/therapist.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\dashboard\\therapist.html.twig");
    }
}
