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

/* layouts/dashboard.html.twig */
class __TwigTemplate_549516a77ca38c953e11270bacffa3b2 extends Template
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
            'head' => [$this, 'block_head'],
            'body_class' => [$this, 'block_body_class'],
            'layout' => [$this, 'block_layout'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "layouts/dashboard.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "layouts/dashboard.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "head"));

        // line 4
        yield "\t";
        yield from $this->yieldParentBlock("head", $context, $blocks);
        yield "
\t<!-- Stitch AI Dashboard Config & Fonts -->
\t<link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@600;700;800&display=swap\" rel=\"stylesheet\"/>
\t<link href=\"https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200\" rel=\"stylesheet\"/>

\t<style>:root
\t{
\t\t--primary: #4f46e5;
\t\t--secondary: #0d9488;
\t\t--surface: #fcfcfd;
\t\t--on-surface: #0f172a;
\t\t--on-surface-variant: #64748b;
\t\t--outline: #e2e8f0;
\t\t--card: #ffffff;
\t\t--sidebar: #ffffff;
\t}

\tbody.dark {
\t\t--surface: #0a0f1b;
\t\t--on-surface: #f1f5f9;
\t\t--on-surface-variant: #94a3b8;
\t\t--outline: #1e293b;
\t\t--card: #111827;
\t\t--sidebar: #0e1421;
\t\t--primary: #2563eb;
\t}

\tbody {
\t\tfont-family: 'Inter', sans-serif;
\t\tbackground-color: var(--surface);
\t\tcolor: var(--on-surface);
\t\ttransition: background-color 0.3s, color 0.3s;
\t}

\t/* Dark Mode Core Overrides */
\t.dark .bg-white {
\t\tbackground-color: var(--card) !important;
\t}
\t.dark .bg-surface {
\t\tbackground-color: var(--surface) !important;
\t}
\t.dark aside {
\t\tbackground-color: var(--sidebar) !important;
\t\tborder-right-color: var(--outline) !important;
\t}
\t.dark header {
\t\tbackground-color: var(--sidebar) !important;
\t\tborder-bottom-color: var(--outline) !important;
\t}
\t.dark footer {
\t\tbackground-color: var(--sidebar) !important;
\t\tborder-top-color: var(--outline) !important;
\t}

\t.dark .text-on-surface {
\t\tcolor: var(--on-surface) !important;
\t}
\t.dark .text-on-surface-variant {
\t\tcolor: var(--on-surface-variant) !important;
\t}
\t.dark .border-outline {
\t\tborder-color: var(--outline) !important;
\t}

\t/* Brand Color Text Overrides (Lifting dark text to light) */
\t.dark .text-[#0e1e1e],
\t.dark .text-[#3c494c],
\t.dark .text-[#006876],
\t.dark .text-slate-900,
\t.dark .text-slate-800,
\t.dark .text-slate-700 {
\t\tcolor: #f1f5f9 !important;
\t}

\t/* Secondary Text Overrides */
\t.dark .text-slate-600,
\t.dark .text-slate-500,
\t.dark .text-slate-400 {
\t\tcolor: #94a3b8 !important;
\t}

\t/* Background & Border Remapping */
\t.dark .bg-slate-50,
\t.dark .bg-gray-100,
\t.dark .bg-gray-50,
\t.dark .bg-cyan-50,
\t.dark .bg-emerald-50 {
\t\tbackground-color: rgba(30, 41, 59, 0.5) !important;
\t}
\t.dark .border-slate-100,
\t.dark .border-[#e5f7f6],
\t.dark .border-slate-200,
\t.dark .border-gray-100 {
\t\tborder-color: #1e293b !important;
\t}

\t/* Sidebar & Navigation */
\t.dark .bg-primary {
\t\tbackground-color: var(--primary) !important;
\t\tcolor: white !important;
\t}

\t/* Components */
\t.dark input,
\t.dark select,
\t.dark textarea {
\t\tbackground-color: #0f172a !important;
\t\tborder-color: #334155 !important;
\t\tcolor: #f1f5f9 !important;
\t}

\t.dark .peer-checked\\:bg-cyan-50,
\t.dark .peer-checked\\:bg-emerald-50 {
\t\tbackground-color: rgba(37, 99, 235, 0.1) !important;
\t}

\t/* Map & Interaction */
\t.dark #map {
\t\tborder-color: var(--sidebar) !important; filter: brightness(0.8) contrast(1.1);
\t}

\t.serene-gradient {
\t\tbackground: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
\t}
\t.soft-elevation {
\t\tbox-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05), 0 2px 10px -2px rgba(0, 0, 0, 0.03);
\t}
</style>";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 131
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body_class(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body_class"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body_class"));

        // line 132
        if (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 132, $this->source); })()), "user", [], "any", false, false, false, 132) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 132, $this->source); })()), "user", [], "any", false, false, false, 132), "settings", [], "any", false, false, false, 132)) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 132, $this->source); })()), "user", [], "any", false, false, false, 132), "settings", [], "any", false, false, false, 132), "isDarkMode", [], "any", false, false, false, 132))) {
            yield "dark
";
        }
        // line 134
        yield "min-h-screen flex flex-col pointer-events-auto";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_layout(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "layout"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "layout"));

        // line 135
        yield "<div
\tclass=\"bg-surface font-body text-on-surface antialiased flex w-full h-screen overflow-hidden\">
\t<!-- Navigation Sidebar -->
\t<aside class=\"w-72 hidden md:flex flex-shrink-0 flex-col py-10 px-6 border-r border-outline bg-white z-50 h-full overflow-y-auto\">
\t\t<div class=\"mb-14 px-2\">
\t\t\t<h1 class=\"text-2xl font-extrabold text-primary tracking-tight font-headline\">InnerTrack</h1>
\t\t\t<p class=\"text-[10px] text-on-surface-variant font-bold tracking-[0.2em] uppercase mt-1\">Digital Sanctuary</p>
\t\t</div>

\t\t<nav class=\"flex-1 space-y-2\">
\t\t\t";
        // line 145
        if (CoreExtension::inFilter("ROLE_ADMIN", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 145, $this->source); })()), "user", [], "any", false, false, false, 145), "roles", [], "any", false, false, false, 145))) {
            // line 146
            yield "\t\t\t\t";
            yield $this->getTemplateForMacro("macro_nav_link", $context, 146, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dashboard"), "Console Admin", "admin_panel_settings", (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 146, $this->source); })()), "request", [], "any", false, false, false, 146), "get", ["_route"], "method", false, false, false, 146) == "app_dashboard")]);
            yield "
\t\t\t";
        } else {
            // line 148
            yield "\t\t\t\t";
            yield $this->getTemplateForMacro("macro_nav_link", $context, 148, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dashboard"), $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("nav.dashboard"), "dashboard", (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 148, $this->source); })()), "request", [], "any", false, false, false, 148), "get", ["_route"], "method", false, false, false, 148) == "app_dashboard")]);
            yield "
\t\t\t\t";
            // line 149
            yield $this->getTemplateForMacro("macro_nav_link", $context, 149, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("habitude_index"), "Mes Habitudes", "fitness_center", (is_string($_v0 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 149, $this->source); })()), "request", [], "any", false, false, false, 149), "get", ["_route"], "method", false, false, false, 149)) && is_string($_v1 = "habitude") && str_starts_with($_v0, $_v1))]);
            yield "
\t\t\t\t";
            // line 150
            yield $this->getTemplateForMacro("macro_nav_link", $context, 150, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("entree_index"), "Mon Journal", "book_2", (is_string($_v2 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 150, $this->source); })()), "request", [], "any", false, false, false, 150), "get", ["_route"], "method", false, false, false, 150)) && is_string($_v3 = "entree") && str_starts_with($_v2, $_v3))]);
            yield "
\t\t\t\t";
            // line 151
            yield $this->getTemplateForMacro("macro_nav_link", $context, 151, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_map"), $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("nav.map"), "psychology", (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 151, $this->source); })()), "request", [], "any", false, false, false, 151), "get", ["_route"], "method", false, false, false, 151) == "app_map")]);
            yield "
\t\t\t\t";
            // line 152
            yield $this->getTemplateForMacro("macro_nav_link", $context, 152, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_messages"), $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("nav.messages"), "chat_bubble", (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 152, $this->source); })()), "request", [], "any", false, false, false, 152), "get", ["_route"], "method", false, false, false, 152) == "app_messages"), (isset($context["unread_messages_count"]) || array_key_exists("unread_messages_count", $context) ? $context["unread_messages_count"] : (function () { throw new RuntimeError('Variable "unread_messages_count" does not exist.', 152, $this->source); })())]);
            yield "
\t\t\t\t";
            // line 153
            yield $this->getTemplateForMacro("macro_nav_link", $context, 153, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_index"), "Tests Psy", "self_improvement", (is_string($_v4 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 153, $this->source); })()), "request", [], "any", false, false, false, 153), "get", ["_route"], "method", false, false, false, 153)) && is_string($_v5 = "testpsy") && str_starts_with($_v4, $_v5))]);
            yield "
\t\t\t\t";
            // line 154
            yield $this->getTemplateForMacro("macro_nav_link", $context, 154, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_event_index"), "Événements", "event", (is_string($_v6 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 154, $this->source); })()), "request", [], "any", false, false, false, 154), "get", ["_route"], "method", false, false, false, 154)) && is_string($_v7 = "app_event") && str_starts_with($_v6, $_v7))]);
            yield "
\t\t\t\t";
            // line 155
            yield $this->getTemplateForMacro("macro_nav_link", $context, 155, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index"), $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("Articles"), "article", (is_string($_v8 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 155, $this->source); })()), "request", [], "any", false, false, false, 155), "get", ["_route"], "method", false, false, false, 155)) && is_string($_v9 = "app_article") && str_starts_with($_v8, $_v9))]);
            yield "
\t\t\t";
        }
        // line 157
        yield "\t\t\t";
        yield $this->getTemplateForMacro("macro_nav_link", $context, 157, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_community_index"), $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("community"), "forum", (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 157, $this->source); })()), "request", [], "any", false, false, false, 157), "get", ["_route"], "method", false, false, false, 157) == "app_community_index")]);
        yield "\t\t\t
\t\t\t";
        // line 158
        yield $this->getTemplateForMacro("macro_nav_link", $context, 158, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_notifications"), $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("nav.notifications"), "notifications", (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 158, $this->source); })()), "request", [], "any", false, false, false, 158), "get", ["_route"], "method", false, false, false, 158) == "app_notifications"), (isset($context["unread_notifications_count"]) || array_key_exists("unread_notifications_count", $context) ? $context["unread_notifications_count"] : (function () { throw new RuntimeError('Variable "unread_notifications_count" does not exist.', 158, $this->source); })())]);
        yield "
\t\t\t";
        // line 159
        yield $this->getTemplateForMacro("macro_nav_link", $context, 159, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile"), $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("nav.profile"), "person", (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 159, $this->source); })()), "request", [], "any", false, false, false, 159), "get", ["_route"], "method", false, false, false, 159) == "app_profile")]);
        yield "
\t\t\t";
        // line 160
        yield $this->getTemplateForMacro("macro_nav_link", $context, 160, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_settings"), $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("nav.settings"), "settings", (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 160, $this->source); })()), "request", [], "any", false, false, false, 160), "get", ["_route"], "method", false, false, false, 160) == "app_settings")]);
        yield "

\t\t\t";
        // line 162
        if ((CoreExtension::inFilter("ROLE_ADMIN", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 162, $this->source); })()), "user", [], "any", false, false, false, 162), "roles", [], "any", false, false, false, 162)) || CoreExtension::inFilter("ROLE_PSYCHOLOGUE", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 162, $this->source); })()), "user", [], "any", false, false, false, 162), "roles", [], "any", false, false, false, 162)))) {
            // line 163
            yield "\t\t\t\t<div class=\"pt-4 pb-1 px-2\">
\t\t\t\t\t<p class=\"text-[9px] font-bold tracking-[0.18em] uppercase text-on-surface-variant opacity-50 select-none\">
\t\t\t\t\t\tGestion
\t\t\t\t\t</p>
\t\t\t\t</div>
\t\t\t\t";
            // line 168
            yield $this->getTemplateForMacro("macro_nav_link", $context, 168, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_event_index"), "Événements", "event", (is_string($_v10 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 172
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 172, $this->source); })()), "request", [], "any", false, false, false, 172), "get", ["_route"], "method", false, false, false, 172)) && is_string($_v11 = "admin_event") && str_starts_with($_v10, $_v11))]);
            // line 173
            yield "
\t\t\t\t";
            // line 174
            yield $this->getTemplateForMacro("macro_nav_link", $context, 174, $this->getSourceContext())->macro_nav_link(...[$this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_inscription_index"), "Inscriptions", "how_to_reg", (is_string($_v12 = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 178
(isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 178, $this->source); })()), "request", [], "any", false, false, false, 178), "get", ["_route"], "method", false, false, false, 178)) && is_string($_v13 = "admin_inscription") && str_starts_with($_v12, $_v13))]);
            // line 179
            yield "
\t\t\t";
        }
        // line 181
        yield "
\t\t</nav>

\t\t<div class=\"mt-8 space-y-4\">
\t\t\t<a href=\"";
        // line 185
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\" class=\"w-full text-on-surface-variant hover:bg-red-50 hover:text-red-500 py-3 rounded-xl font-bold text-sm tracking-wide transition-all flex items-center gap-3 justify-center\">
\t\t\t\t<span class=\"material-symbols-outlined text-[20px]\" data-icon=\"logout\">logout</span>
\t\t\t\tLog Out
\t\t\t</a>
\t\t</div>
\t</aside>

\t<!-- Main Content Canvas -->
\t<div
\t\tclass=\"flex-1 flex flex-col relative w-full h-full bg-surface\">
\t\t<!-- Top Navigation Bar -->
\t\t<header class=\"flex-shrink-0 flex justify-between items-center h-20 px-6 lg:px-12 bg-white/80 backdrop-blur-md border-b border-outline/50 z-40\">
\t\t\t<div class=\"flex items-center gap-4 bg-gray-100/80 px-4 lg:px-6 py-2.5 rounded-full w-full max-w-[440px] border border-transparent focus-within:border-primary/20 transition-all\">
\t\t\t\t<span class=\"material-symbols-outlined text-gray-400 text-xl\" data-icon=\"search\">search</span>
\t\t\t\t<input type=\"text\" placeholder=\"Search resources...\" class=\"bg-transparent border-none focus:ring-0 text-sm w-full placeholder:text-gray-500 font-medium outline-none\"/>
\t\t\t</div>

\t\t\t<div class=\"flex items-center gap-4 lg:gap-8 ml-4\">
\t\t\t\t<div class=\"hidden lg:flex gap-4\">
\t\t\t\t\t<div class=\"flex items-center bg-gray-100 rounded-full px-2 overflow-hidden border border-outline\">
\t\t\t\t\t\t<a href=\"";
        // line 205
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_change_locale", ["locale" => "en"]);
        yield "\" class=\"p-1.5 hover:bg-white rounded-full transition-all ";
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 205, $this->source); })()), "request", [], "any", false, false, false, 205), "locale", [], "any", false, false, false, 205) == "en")) ? ("bg-white shadow-sm") : (""));
        yield "\">
\t\t\t\t\t\t\t<img src=\"https://flagcdn.com/w20/gb.png\" class=\"w-4\" alt=\"EN\">
\t\t\t\t\t\t</a>
\t\t\t\t\t\t<a href=\"";
        // line 208
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_change_locale", ["locale" => "fr"]);
        yield "\" class=\"p-1.5 hover:bg-white rounded-full transition-all ";
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 208, $this->source); })()), "request", [], "any", false, false, false, 208), "locale", [], "any", false, false, false, 208) == "fr")) ? ("bg-white shadow-sm") : (""));
        yield "\">
\t\t\t\t\t\t\t<img src=\"https://flagcdn.com/w20/fr.png\" class=\"w-4\" alt=\"FR\">
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t\t<button class=\"p-2 rounded-full text-on-surface-variant hover:bg-gray-100 transition-colors\">
\t\t\t\t\t\t<span class=\"material-symbols-outlined\" data-icon=\"help\">help</span>
\t\t\t\t\t</button>
\t\t\t\t\t<button id=\"theme-toggle\" class=\"p-2 rounded-full text-on-surface-variant hover:bg-gray-100 transition-colors\">
\t\t\t\t\t\t<span class=\"material-symbols-outlined\" data-icon=\"dark_mode\">dark_mode</span>
\t\t\t\t\t</button>
\t\t\t\t</div>
\t\t\t\t<div class=\"hidden lg:block h-8 w-px bg-outline\"></div>

\t\t\t\t<a href=\"";
        // line 221
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile");
        yield "\" class=\"flex items-center gap-4 group cursor-pointer\">
\t\t\t\t\t<div class=\"text-right hidden sm:block\">
\t\t\t\t\t\t<p class=\"text-sm font-bold text-on-surface leading-none\">";
        // line 223
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 223, $this->source); })()), "user", [], "any", false, false, false, 223), "fullName", [], "any", false, false, false, 223), "html", null, true);
        yield "</p>
\t\t\t\t\t\t";
        // line 224
        $context["role_label"] = ("dashboard." . Twig\Extension\CoreExtension::lower($this->env->getCharset(), Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 224, $this->source); })()), "user", [], "any", false, false, false, 224), "primaryRole", [], "any", false, false, false, 224), ["ROLE_" => ""])));
        // line 225
        yield "\t\t\t\t\t\t<p class=\"text-[10px] text-secondary font-bold uppercase tracking-wider mt-1\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans((isset($context["role_label"]) || array_key_exists("role_label", $context) ? $context["role_label"] : (function () { throw new RuntimeError('Variable "role_label" does not exist.', 225, $this->source); })())), "html", null, true);
        yield "</p>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"w-10 h-10 lg:w-12 lg:h-12 rounded-2xl bg-primary text-white flex items-center justify-center font-bold text-lg ring-2 ring-offset-2 ring-transparent group-hover:ring-primary/20 transition-all overflow-hidden\">
\t\t\t\t\t\t";
        // line 228
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 228, $this->source); })()), "user", [], "any", false, false, false, 228), "profilePictureUrl", [], "any", false, false, false, 228)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 229
            yield "\t\t\t\t\t\t\t<img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 229, $this->source); })()), "user", [], "any", false, false, false, 229), "profilePictureUrl", [], "any", false, false, false, 229), "html", null, true);
            yield "\" alt=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 229, $this->source); })()), "user", [], "any", false, false, false, 229), "firstName", [], "any", false, false, false, 229), "html", null, true);
            yield "\" class=\"w-full h-full object-cover\">
\t\t\t\t\t\t";
        } else {
            // line 231
            yield "\t\t\t\t\t\t\t";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::default(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 231, $this->source); })()), "user", [], "any", false, false, false, 231), "firstName", [], "any", false, false, false, 231)), "U")), "html", null, true);
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::default(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 231, $this->source); })()), "user", [], "any", false, false, false, 231), "lastName", [], "any", false, false, false, 231)), "")), "html", null, true);
            yield "
\t\t\t\t\t\t";
        }
        // line 233
        yield "\t\t\t\t\t</div>
\t\t\t\t</a>
\t\t\t</div>
\t\t</header>

\t\t<!-- Main Workspace (scrollable) -->
\t\t<div class=\"flex-1 overflow-y-auto\">
\t\t\t<div class=\"p-6 lg:p-12 max-w-7xl mx-auto w-full relative\">
\t\t\t\t";
        // line 241
        yield from $this->load("components/_flash_messages.html.twig", 241)->unwrap()->yield($context);
        // line 242
        yield "\t\t\t\t";
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 243
        yield "\t\t\t</div>

\t\t\t<!-- Footer -->
\t\t\t<footer class=\"px-8 lg:px-12 py-8 border-t border-outline flex flex-col md:flex-row justify-between items-center gap-6 bg-white shrink-0\">

\t\t\t\t<div class=\"flex items-center gap-6\">
\t\t\t\t\t<a href=\"#\" class=\"text-xs font-bold text-gray-400 hover:text-primary transition-colors\">Privacy</a>
\t\t\t\t\t<a href=\"#\" class=\"text-xs font-bold text-gray-400 hover:text-primary transition-colors\">Support</a>
\t\t\t\t\t<span class=\"text-xs font-medium text-gray-300\">© 2026 InnerTrack</span>
\t\t\t\t</div>
\t\t\t</footer>
\t\t</div>
\t</div>
</div>

<script>
\t(function () {
const toggle = document.getElementById('theme-toggle');
const body = document.body;

// Local preference overrides DB (for guest or multi-device)
const localTheme = localStorage.getItem('theme');
if (localTheme) {
if (localTheme === 'dark') 
body.classList.add('dark');
 else 
body.classList.remove('dark');



}

if (toggle) {
toggle.addEventListener('click', () => {
body.classList.toggle('dark');
const theme = body.classList.contains('dark') ? 'DARK' : 'LIGHT';
localStorage.setItem('theme', theme.toLowerCase());

// Persistence to DB
fetch('/_internal/settings/theme', {
method: 'POST',
headers: {
'Content-Type': 'application/json'
},
body: JSON.stringify(
{theme: theme}
)
});
});
}
})();
</script>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 242
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

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 296
    public function macro_nav_link($url = null, $text = null, $icon = null, $active = null, $badge_count = 0, ...$varargs): string|Markup
    {
        $macros = $this->macros;
        $context = [
            "url" => $url,
            "text" => $text,
            "icon" => $icon,
            "active" => $active,
            "badge_count" => $badge_count,
            "varargs" => $varargs,
        ] + $this->env->getGlobals();

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
            $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "nav_link"));

            $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "macro", "nav_link"));

            // line 297
            yield "\t<a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["url"]) || array_key_exists("url", $context) ? $context["url"] : (function () { throw new RuntimeError('Variable "url" does not exist.', 297, $this->source); })()), "html", null, true);
            yield "\" class=\"flex items-center gap-4 px-4 lg:px-5 py-3 rounded-xl transition-all font-medium ";
            yield (((($tmp = (isset($context["active"]) || array_key_exists("active", $context) ? $context["active"] : (function () { throw new RuntimeError('Variable "active" does not exist.', 297, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-primary text-white font-semibold shadow-md shadow-primary/20") : ("text-on-surface-variant hover:bg-gray-50 hover:text-primary"));
            yield " relative\">
\t\t<span class=\"material-symbols-outlined text-xl\" data-icon=\"";
            // line 298
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["icon"]) || array_key_exists("icon", $context) ? $context["icon"] : (function () { throw new RuntimeError('Variable "icon" does not exist.', 298, $this->source); })()), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["icon"]) || array_key_exists("icon", $context) ? $context["icon"] : (function () { throw new RuntimeError('Variable "icon" does not exist.', 298, $this->source); })()), "html", null, true);
            yield "</span>
\t\t<span class=\"text-sm flex-1\">";
            // line 299
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["text"]) || array_key_exists("text", $context) ? $context["text"] : (function () { throw new RuntimeError('Variable "text" does not exist.', 299, $this->source); })()), "html", null, true);
            yield "</span>
\t\t";
            // line 300
            if (((isset($context["badge_count"]) || array_key_exists("badge_count", $context) ? $context["badge_count"] : (function () { throw new RuntimeError('Variable "badge_count" does not exist.', 300, $this->source); })()) > 0)) {
                // line 301
                yield "\t\t\t<span class=\"absolute right-3 top-3 w-4 h-4 bg-red-500 text-[10px] text-white flex items-center justify-center rounded-full animate-pulse border-2 border-white\">
\t\t\t\t";
                // line 302
                yield ((((isset($context["badge_count"]) || array_key_exists("badge_count", $context) ? $context["badge_count"] : (function () { throw new RuntimeError('Variable "badge_count" does not exist.', 302, $this->source); })()) > 9)) ? ("9+") : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["badge_count"]) || array_key_exists("badge_count", $context) ? $context["badge_count"] : (function () { throw new RuntimeError('Variable "badge_count" does not exist.', 302, $this->source); })()), "html", null, true)));
                yield "
\t\t\t</span>
\t\t";
            }
            // line 305
            yield "\t</a>
";
            
            $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

            
            $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

            yield from [];
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "layouts/dashboard.html.twig";
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
        return array (  595 => 305,  589 => 302,  586 => 301,  584 => 300,  580 => 299,  574 => 298,  567 => 297,  545 => 296,  523 => 242,  459 => 243,  456 => 242,  454 => 241,  444 => 233,  437 => 231,  429 => 229,  427 => 228,  420 => 225,  418 => 224,  414 => 223,  409 => 221,  391 => 208,  383 => 205,  360 => 185,  354 => 181,  350 => 179,  348 => 178,  347 => 174,  344 => 173,  342 => 172,  341 => 168,  334 => 163,  332 => 162,  327 => 160,  323 => 159,  319 => 158,  314 => 157,  309 => 155,  305 => 154,  301 => 153,  297 => 152,  293 => 151,  289 => 150,  285 => 149,  280 => 148,  274 => 146,  272 => 145,  260 => 135,  237 => 134,  232 => 132,  219 => 131,  79 => 4,  66 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block head %}
\t{{ parent() }}
\t<!-- Stitch AI Dashboard Config & Fonts -->
\t<link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@600;700;800&display=swap\" rel=\"stylesheet\"/>
\t<link href=\"https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200\" rel=\"stylesheet\"/>

\t<style>:root
\t{
\t\t--primary: #4f46e5;
\t\t--secondary: #0d9488;
\t\t--surface: #fcfcfd;
\t\t--on-surface: #0f172a;
\t\t--on-surface-variant: #64748b;
\t\t--outline: #e2e8f0;
\t\t--card: #ffffff;
\t\t--sidebar: #ffffff;
\t}

\tbody.dark {
\t\t--surface: #0a0f1b;
\t\t--on-surface: #f1f5f9;
\t\t--on-surface-variant: #94a3b8;
\t\t--outline: #1e293b;
\t\t--card: #111827;
\t\t--sidebar: #0e1421;
\t\t--primary: #2563eb;
\t}

\tbody {
\t\tfont-family: 'Inter', sans-serif;
\t\tbackground-color: var(--surface);
\t\tcolor: var(--on-surface);
\t\ttransition: background-color 0.3s, color 0.3s;
\t}

\t/* Dark Mode Core Overrides */
\t.dark .bg-white {
\t\tbackground-color: var(--card) !important;
\t}
\t.dark .bg-surface {
\t\tbackground-color: var(--surface) !important;
\t}
\t.dark aside {
\t\tbackground-color: var(--sidebar) !important;
\t\tborder-right-color: var(--outline) !important;
\t}
\t.dark header {
\t\tbackground-color: var(--sidebar) !important;
\t\tborder-bottom-color: var(--outline) !important;
\t}
\t.dark footer {
\t\tbackground-color: var(--sidebar) !important;
\t\tborder-top-color: var(--outline) !important;
\t}

\t.dark .text-on-surface {
\t\tcolor: var(--on-surface) !important;
\t}
\t.dark .text-on-surface-variant {
\t\tcolor: var(--on-surface-variant) !important;
\t}
\t.dark .border-outline {
\t\tborder-color: var(--outline) !important;
\t}

\t/* Brand Color Text Overrides (Lifting dark text to light) */
\t.dark .text-[#0e1e1e],
\t.dark .text-[#3c494c],
\t.dark .text-[#006876],
\t.dark .text-slate-900,
\t.dark .text-slate-800,
\t.dark .text-slate-700 {
\t\tcolor: #f1f5f9 !important;
\t}

\t/* Secondary Text Overrides */
\t.dark .text-slate-600,
\t.dark .text-slate-500,
\t.dark .text-slate-400 {
\t\tcolor: #94a3b8 !important;
\t}

\t/* Background & Border Remapping */
\t.dark .bg-slate-50,
\t.dark .bg-gray-100,
\t.dark .bg-gray-50,
\t.dark .bg-cyan-50,
\t.dark .bg-emerald-50 {
\t\tbackground-color: rgba(30, 41, 59, 0.5) !important;
\t}
\t.dark .border-slate-100,
\t.dark .border-[#e5f7f6],
\t.dark .border-slate-200,
\t.dark .border-gray-100 {
\t\tborder-color: #1e293b !important;
\t}

\t/* Sidebar & Navigation */
\t.dark .bg-primary {
\t\tbackground-color: var(--primary) !important;
\t\tcolor: white !important;
\t}

\t/* Components */
\t.dark input,
\t.dark select,
\t.dark textarea {
\t\tbackground-color: #0f172a !important;
\t\tborder-color: #334155 !important;
\t\tcolor: #f1f5f9 !important;
\t}

\t.dark .peer-checked\\:bg-cyan-50,
\t.dark .peer-checked\\:bg-emerald-50 {
\t\tbackground-color: rgba(37, 99, 235, 0.1) !important;
\t}

\t/* Map & Interaction */
\t.dark #map {
\t\tborder-color: var(--sidebar) !important; filter: brightness(0.8) contrast(1.1);
\t}

\t.serene-gradient {
\t\tbackground: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
\t}
\t.soft-elevation {
\t\tbox-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05), 0 2px 10px -2px rgba(0, 0, 0, 0.03);
\t}
</style>{% endblock %}{% block body_class %}
{% if app.user and app.user.settings and app.user.settings.isDarkMode %}dark
{% endif %}
min-h-screen flex flex-col pointer-events-auto{% endblock %}{% block layout %}
<div
\tclass=\"bg-surface font-body text-on-surface antialiased flex w-full h-screen overflow-hidden\">
\t<!-- Navigation Sidebar -->
\t<aside class=\"w-72 hidden md:flex flex-shrink-0 flex-col py-10 px-6 border-r border-outline bg-white z-50 h-full overflow-y-auto\">
\t\t<div class=\"mb-14 px-2\">
\t\t\t<h1 class=\"text-2xl font-extrabold text-primary tracking-tight font-headline\">InnerTrack</h1>
\t\t\t<p class=\"text-[10px] text-on-surface-variant font-bold tracking-[0.2em] uppercase mt-1\">Digital Sanctuary</p>
\t\t</div>

\t\t<nav class=\"flex-1 space-y-2\">
\t\t\t{% if 'ROLE_ADMIN' in app.user.roles %}
\t\t\t\t{{ _self.nav_link(path('app_dashboard'), 'Console Admin', 'admin_panel_settings', app.request.get('_route') == 'app_dashboard') }}
\t\t\t{% else %}
\t\t\t\t{{ _self.nav_link(path('app_dashboard'), 'nav.dashboard'|trans, 'dashboard', app.request.get('_route') == 'app_dashboard') }}
\t\t\t\t{{ _self.nav_link(path('habitude_index'), 'Mes Habitudes', 'fitness_center', app.request.get('_route') starts with 'habitude') }}
\t\t\t\t{{ _self.nav_link(path('entree_index'), 'Mon Journal', 'book_2', app.request.get('_route') starts with 'entree') }}
\t\t\t\t{{ _self.nav_link(path('app_map'), 'nav.map'|trans, 'psychology', app.request.get('_route') == 'app_map') }}
\t\t\t\t{{ _self.nav_link(path('app_messages'), 'nav.messages'|trans, 'chat_bubble', app.request.get('_route') == 'app_messages', unread_messages_count) }}
\t\t\t\t{{ _self.nav_link(path('testpsy_index'), 'Tests Psy', 'self_improvement', app.request.get('_route') starts with 'testpsy') }}
\t\t\t\t{{ _self.nav_link(path('app_event_index'), 'Événements', 'event', app.request.get('_route') starts with 'app_event') }}
\t\t\t\t{{ _self.nav_link(path('app_article_index'), 'Articles'|trans, 'article', app.request.get('_route') starts with 'app_article') }}
\t\t\t{% endif %}
\t\t\t{{ _self.nav_link(path('app_community_index'), 'community'|trans, 'forum', app.request.get('_route') == 'app_community_index') }}\t\t\t
\t\t\t{{ _self.nav_link(path('app_notifications'), 'nav.notifications'|trans, 'notifications', app.request.get('_route') == 'app_notifications', unread_notifications_count) }}
\t\t\t{{ _self.nav_link(path('app_profile'), 'nav.profile'|trans, 'person', app.request.get('_route') == 'app_profile') }}
\t\t\t{{ _self.nav_link(path('app_settings'), 'nav.settings'|trans, 'settings', app.request.get('_route') == 'app_settings') }}

\t\t\t{% if 'ROLE_ADMIN' in app.user.roles or 'ROLE_PSYCHOLOGUE' in app.user.roles %}
\t\t\t\t<div class=\"pt-4 pb-1 px-2\">
\t\t\t\t\t<p class=\"text-[9px] font-bold tracking-[0.18em] uppercase text-on-surface-variant opacity-50 select-none\">
\t\t\t\t\t\tGestion
\t\t\t\t\t</p>
\t\t\t\t</div>
\t\t\t\t{{ _self.nav_link(
\t\t\t\t\tpath('admin_event_index'),
\t\t\t\t\t'Événements',
\t\t\t\t\t'event',
\t\t\t\t\tapp.request.get('_route') starts with 'admin_event'
\t\t\t\t) }}
\t\t\t\t{{ _self.nav_link(
\t\t\t\t\tpath('admin_inscription_index'),
\t\t\t\t\t'Inscriptions',
\t\t\t\t\t'how_to_reg',
\t\t\t\t\tapp.request.get('_route') starts with 'admin_inscription'
\t\t\t\t) }}
\t\t\t{% endif %}

\t\t</nav>

\t\t<div class=\"mt-8 space-y-4\">
\t\t\t<a href=\"{{ path('app_logout') }}\" class=\"w-full text-on-surface-variant hover:bg-red-50 hover:text-red-500 py-3 rounded-xl font-bold text-sm tracking-wide transition-all flex items-center gap-3 justify-center\">
\t\t\t\t<span class=\"material-symbols-outlined text-[20px]\" data-icon=\"logout\">logout</span>
\t\t\t\tLog Out
\t\t\t</a>
\t\t</div>
\t</aside>

\t<!-- Main Content Canvas -->
\t<div
\t\tclass=\"flex-1 flex flex-col relative w-full h-full bg-surface\">
\t\t<!-- Top Navigation Bar -->
\t\t<header class=\"flex-shrink-0 flex justify-between items-center h-20 px-6 lg:px-12 bg-white/80 backdrop-blur-md border-b border-outline/50 z-40\">
\t\t\t<div class=\"flex items-center gap-4 bg-gray-100/80 px-4 lg:px-6 py-2.5 rounded-full w-full max-w-[440px] border border-transparent focus-within:border-primary/20 transition-all\">
\t\t\t\t<span class=\"material-symbols-outlined text-gray-400 text-xl\" data-icon=\"search\">search</span>
\t\t\t\t<input type=\"text\" placeholder=\"Search resources...\" class=\"bg-transparent border-none focus:ring-0 text-sm w-full placeholder:text-gray-500 font-medium outline-none\"/>
\t\t\t</div>

\t\t\t<div class=\"flex items-center gap-4 lg:gap-8 ml-4\">
\t\t\t\t<div class=\"hidden lg:flex gap-4\">
\t\t\t\t\t<div class=\"flex items-center bg-gray-100 rounded-full px-2 overflow-hidden border border-outline\">
\t\t\t\t\t\t<a href=\"{{ path('app_change_locale', {'locale': 'en'}) }}\" class=\"p-1.5 hover:bg-white rounded-full transition-all {{ app.request.locale == 'en' ? 'bg-white shadow-sm' : '' }}\">
\t\t\t\t\t\t\t<img src=\"https://flagcdn.com/w20/gb.png\" class=\"w-4\" alt=\"EN\">
\t\t\t\t\t\t</a>
\t\t\t\t\t\t<a href=\"{{ path('app_change_locale', {'locale': 'fr'}) }}\" class=\"p-1.5 hover:bg-white rounded-full transition-all {{ app.request.locale == 'fr' ? 'bg-white shadow-sm' : '' }}\">
\t\t\t\t\t\t\t<img src=\"https://flagcdn.com/w20/fr.png\" class=\"w-4\" alt=\"FR\">
\t\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t\t<button class=\"p-2 rounded-full text-on-surface-variant hover:bg-gray-100 transition-colors\">
\t\t\t\t\t\t<span class=\"material-symbols-outlined\" data-icon=\"help\">help</span>
\t\t\t\t\t</button>
\t\t\t\t\t<button id=\"theme-toggle\" class=\"p-2 rounded-full text-on-surface-variant hover:bg-gray-100 transition-colors\">
\t\t\t\t\t\t<span class=\"material-symbols-outlined\" data-icon=\"dark_mode\">dark_mode</span>
\t\t\t\t\t</button>
\t\t\t\t</div>
\t\t\t\t<div class=\"hidden lg:block h-8 w-px bg-outline\"></div>

\t\t\t\t<a href=\"{{ path('app_profile') }}\" class=\"flex items-center gap-4 group cursor-pointer\">
\t\t\t\t\t<div class=\"text-right hidden sm:block\">
\t\t\t\t\t\t<p class=\"text-sm font-bold text-on-surface leading-none\">{{ app.user.fullName }}</p>
\t\t\t\t\t\t{% set role_label = 'dashboard.' ~ app.user.primaryRole|replace({'ROLE_': ''})|lower %}
\t\t\t\t\t\t<p class=\"text-[10px] text-secondary font-bold uppercase tracking-wider mt-1\">{{ role_label|trans }}</p>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"w-10 h-10 lg:w-12 lg:h-12 rounded-2xl bg-primary text-white flex items-center justify-center font-bold text-lg ring-2 ring-offset-2 ring-transparent group-hover:ring-primary/20 transition-all overflow-hidden\">
\t\t\t\t\t\t{% if app.user.profilePictureUrl %}
\t\t\t\t\t\t\t<img src=\"{{ app.user.profilePictureUrl }}\" alt=\"{{ app.user.firstName }}\" class=\"w-full h-full object-cover\">
\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t{{ app.user.firstName|first|default('U')|upper }}{{ app.user.lastName|first|default('')|upper }}
\t\t\t\t\t\t{% endif %}
\t\t\t\t\t</div>
\t\t\t\t</a>
\t\t\t</div>
\t\t</header>

\t\t<!-- Main Workspace (scrollable) -->
\t\t<div class=\"flex-1 overflow-y-auto\">
\t\t\t<div class=\"p-6 lg:p-12 max-w-7xl mx-auto w-full relative\">
\t\t\t\t{% include 'components/_flash_messages.html.twig' %}
\t\t\t\t{% block content %}{% endblock %}
\t\t\t</div>

\t\t\t<!-- Footer -->
\t\t\t<footer class=\"px-8 lg:px-12 py-8 border-t border-outline flex flex-col md:flex-row justify-between items-center gap-6 bg-white shrink-0\">

\t\t\t\t<div class=\"flex items-center gap-6\">
\t\t\t\t\t<a href=\"#\" class=\"text-xs font-bold text-gray-400 hover:text-primary transition-colors\">Privacy</a>
\t\t\t\t\t<a href=\"#\" class=\"text-xs font-bold text-gray-400 hover:text-primary transition-colors\">Support</a>
\t\t\t\t\t<span class=\"text-xs font-medium text-gray-300\">© 2026 InnerTrack</span>
\t\t\t\t</div>
\t\t\t</footer>
\t\t</div>
\t</div>
</div>

<script>
\t(function () {
const toggle = document.getElementById('theme-toggle');
const body = document.body;

// Local preference overrides DB (for guest or multi-device)
const localTheme = localStorage.getItem('theme');
if (localTheme) {
if (localTheme === 'dark') 
body.classList.add('dark');
 else 
body.classList.remove('dark');



}

if (toggle) {
toggle.addEventListener('click', () => {
body.classList.toggle('dark');
const theme = body.classList.contains('dark') ? 'DARK' : 'LIGHT';
localStorage.setItem('theme', theme.toLowerCase());

// Persistence to DB
fetch('/_internal/settings/theme', {
method: 'POST',
headers: {
'Content-Type': 'application/json'
},
body: JSON.stringify(
{theme: theme}
)
});
});
}
})();
</script>

{% macro nav_link(url, text, icon, active, badge_count = 0) %}
\t<a href=\"{{ url }}\" class=\"flex items-center gap-4 px-4 lg:px-5 py-3 rounded-xl transition-all font-medium {{ active ? 'bg-primary text-white font-semibold shadow-md shadow-primary/20' : 'text-on-surface-variant hover:bg-gray-50 hover:text-primary' }} relative\">
\t\t<span class=\"material-symbols-outlined text-xl\" data-icon=\"{{ icon }}\">{{ icon }}</span>
\t\t<span class=\"text-sm flex-1\">{{ text }}</span>
\t\t{% if badge_count > 0 %}
\t\t\t<span class=\"absolute right-3 top-3 w-4 h-4 bg-red-500 text-[10px] text-white flex items-center justify-center rounded-full animate-pulse border-2 border-white\">
\t\t\t\t{{ badge_count > 9 ? '9+' : badge_count }}
\t\t\t</span>
\t\t{% endif %}
\t</a>
{% endmacro %}{% endblock %}
", "layouts/dashboard.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\layouts\\dashboard.html.twig");
    }
}
