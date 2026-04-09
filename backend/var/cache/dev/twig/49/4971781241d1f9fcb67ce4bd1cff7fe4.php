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

/* pages/dashboard/user.html.twig */
class __TwigTemplate_8512a08a445902a4e6fb8eb0e00d8ca3 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/dashboard/user.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/dashboard/user.html.twig"));

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

        yield "Dashboard - InnerTrack";
        
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
        yield "<div class=\"space-y-12 lg:space-y-16\">
    <!-- Hero Header Section -->
    <section>
        <div class=\"flex items-baseline gap-3\">
            <h2 class=\"text-4xl md:text-5xl lg:text-7xl font-headline font-extrabold text-on-surface tracking-tight leading-tight\">Good morning, ";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "user", [], "any", false, true, false, 10), "firstName", [], "any", true, true, false, 10)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 10, $this->source); })()), "user", [], "any", false, false, false, 10), "firstName", [], "any", false, false, false, 10), "Guest")) : ("Guest")), "html", null, true);
        yield "</h2>
            <span class=\"text-4xl lg:text-5xl\">👋</span>
        </div>
        <div class=\"mt-6 flex flex-wrap items-center gap-4 lg:gap-6\">
            <p class=\"text-on-surface-variant font-medium flex items-center gap-2.5 px-4 py-2 bg-gray-100 rounded-full text-sm shadow-sm\">
                <span class=\"material-symbols-outlined text-primary text-lg\" data-icon=\"calendar_today\">calendar_today</span>
                ";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "l, F jS, Y"), "html", null, true);
        yield "
            </p>
            <p class=\"text-secondary font-bold text-xs uppercase tracking-widest px-4 py-2 bg-secondary-container text-on-secondary-container rounded-full shadow-sm\">
                Daily goal: 12m Meditation
            </p>
        </div>
    </section>

    <!-- Dashboard Bento Grid -->
    <div class=\"grid grid-cols-12 gap-8 lg:gap-10\">
        <!-- Primary Stats and Activity -->
        <div class=\"col-span-12 lg:col-span-8 space-y-12\">
            <div class=\"grid grid-cols-1 md:grid-cols-2 gap-8\">
                <!-- Active Conversations -->
                <div class=\"serene-gradient p-10 text-white relative overflow-hidden rounded-[2rem] soft-elevation group h-48 lg:h-56 flex flex-col justify-between\">
                    <div class=\"relative z-10\">
                        <p class=\"text-white/70 font-bold uppercase tracking-widest text-[11px] mb-2\">Active Conversations</p>
                        <h3 class=\"text-5xl lg:text-6xl font-headline font-extrabold\">";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::sprintf("%02d", (isset($context["conversationCount"]) || array_key_exists("conversationCount", $context) ? $context["conversationCount"] : (function () { throw new RuntimeError('Variable "conversationCount" does not exist.', 33, $this->source); })())), "html", null, true);
        yield "</h3>
                    </div>
                    <a href=\"";
        // line 35
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_messages");
        yield "\" class=\"relative z-10 flex items-center text-sm font-bold opacity-90 hover:opacity-100 group-hover:translate-x-1 transition-all\">
                        View all messages <span class=\"material-symbols-outlined ml-2 text-lg\" data-icon=\"arrow_forward\">arrow_forward</span>
                    </a>
                    <div class=\"absolute -right-12 -bottom-12 w-48 h-48 bg-white/10 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-700\"></div>
                </div>
                
                <!-- Unread Notifications -->
                <div class=\"bg-primary/5 border border-primary/10 p-10 rounded-[2rem] text-on-surface relative overflow-hidden h-48 lg:h-56 flex flex-col justify-between group\">
                    <div class=\"relative z-10\">
                        <p class=\"text-primary font-bold uppercase tracking-widest text-[11px] mb-2\">Unread Notifications</p>
                        <h3 class=\"text-5xl lg:text-6xl font-headline font-extrabold text-primary\">";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::sprintf("%02d", (isset($context["unreadNotifs"]) || array_key_exists("unreadNotifs", $context) ? $context["unreadNotifs"] : (function () { throw new RuntimeError('Variable "unreadNotifs" does not exist.', 45, $this->source); })())), "html", null, true);
        yield "</h3>
                    </div>
                    <a href=\"";
        // line 47
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_notifications");
        yield "\" class=\"relative z-10 inline-flex items-center text-sm font-bold text-primary group-hover:translate-x-1 transition-all\">
                        Catch up now <span class=\"material-symbols-outlined ml-2 text-lg\" data-icon=\"bolt\">bolt</span>
                    </a>
                    <div class=\"absolute -right-8 -top-8 w-32 h-32 bg-primary/5 rounded-full blur-2xl\"></div>
                </div>
            </div>
            
            <!-- Therapists Carousel/Grid -->
            <div class=\"space-y-8\">
                <div class=\"flex justify-between items-end border-b border-outline pb-6\">
                    <div>
                        <h4 class=\"text-3xl font-headline font-bold tracking-tight\">Your Care Team</h4>
                        <p class=\"text-on-surface-variant text-sm mt-1\">Direct access to your primary therapists</p>
                    </div>
                    <a href=\"";
        // line 61
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_map");
        yield "\" class=\"text-primary text-sm font-bold hover:underline underline-offset-8 flex items-center gap-1\">
                        Explore new matches <span class=\"material-symbols-outlined text-sm\" data-icon=\"open_in_new\">open_in_new</span>
                    </a>
                </div>
                <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-8\">
                    ";
        // line 66
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["therapists"]) || array_key_exists("therapists", $context) ? $context["therapists"] : (function () { throw new RuntimeError('Variable "therapists" does not exist.', 66, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["therapist"]) {
            // line 67
            yield "                        <div class=\"bg-white border border-outline p-8 rounded-[2rem] hover:border-primary/30 hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center space-y-6\">
                            <div class=\"relative\">
                                <div class=\"w-24 h-24 rounded-[2rem] bg-primary text-white flex items-center justify-center font-bold text-3xl overflow-hidden shadow-lg\">
                                    ";
            // line 70
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["therapist"], "profilePictureUrl", [], "any", false, false, false, 70)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 71
                yield "                                        <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["therapist"], "profilePictureUrl", [], "any", false, false, false, 71), "html", null, true);
                yield "\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["therapist"], "fullName", [], "any", false, false, false, 71), "html", null, true);
                yield "\" class=\"w-full h-full object-cover\">
                                    ";
            } else {
                // line 73
                yield "                                        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["therapist"], "firstName", [], "any", false, false, false, 73)), "html", null, true);
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["therapist"], "lastName", [], "any", false, false, false, 73)), "html", null, true);
                yield "
                                    ";
            }
            // line 75
            yield "                                </div>
                                <div class=\"absolute -bottom-1 -right-1 w-6 h-6 ";
            // line 76
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["therapist"], "status", [], "any", false, false, false, 76) == "ACTIVE")) ? ("bg-green-500") : ("bg-gray-300"));
            yield " border-4 border-white rounded-full\"></div>
                            </div>
                            <div>
                                <h5 class=\"font-headline font-extrabold text-xl text-on-surface\">";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["therapist"], "fullName", [], "any", false, false, false, 79), "html", null, true);
            yield "</h5>
                                <p class=\"text-on-surface-variant text-sm font-medium mt-1\">
                                    ";
            // line 81
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["therapist"], "therapistProfile", [], "any", false, true, false, 81), "specialization", [], "any", true, true, false, 81)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["therapist"], "therapistProfile", [], "any", false, false, false, 81), "specialization", [], "any", false, false, false, 81), "Clinical Psychologist")) : ("Clinical Psychologist")), "html", null, true);
            yield "
                                </p>
                            </div>
                            <button class=\"w-full bg-secondary-container text-secondary py-3.5 rounded-xl font-bold text-sm hover:brightness-105 active:scale-95 transition-all flex items-center justify-center gap-2\">
                                <span class=\"material-symbols-outlined text-lg\" data-icon=\"chat\">chat</span> Send Message
                            </button>
                        </div>
                    ";
            $context['_iterated'] = true;
        }
        // line 88
        if (!$context['_iterated']) {
            // line 89
            yield "                        <div class=\"col-span-full py-16 bg-gray-50/50 rounded-[3rem] border border-dashed border-outline/50 flex flex-col items-center justify-center text-center\">
                            <span class=\"material-symbols-outlined text-5xl text-gray-300 mb-4\" data-icon=\"clinical_notes\">clinical_notes</span>
                            <h5 class=\"font-headline font-bold text-lg text-gray-400\">No active therapists yet</h5>
                            <a href=\"";
            // line 92
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_map");
            yield "\" class=\"mt-4 text-primary font-bold text-sm hover:underline\">Find a therapist on the map</a>
                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['therapist'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 95
        yield "                </div>
            </div>
        </div>

        <!-- Sidebar Activity Feed -->
        <aside class=\"col-span-12 lg:col-span-4 space-y-10\">
            <div class=\"bg-white border border-outline p-8 lg:p-10 rounded-[2.5rem] soft-elevation lg:sticky lg:top-8\">
                <div class=\"flex items-center justify-between mb-10\">
                    <h4 class=\"text-xl font-headline font-extrabold tracking-tight\">Recent Activity</h4>
                    <span class=\"bg-gray-100 text-on-surface-variant text-[10px] font-bold px-2 py-1 rounded-md\">TODAY</span>
                </div>
                <div class=\"space-y-10\">
                    <div class=\"flex gap-5 group cursor-pointer\">
                        <div class=\"flex-shrink-0 w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300\">
                            <span class=\"material-symbols-outlined text-2xl\" data-icon=\"history_edu\">history_edu</span>
                        </div>
                        <div class=\"space-y-1.5 pt-1\">
                            <p class=\"text-sm font-bold text-on-surface group-hover:text-primary transition-colors\">Therapy Plan Update</p>
                            <p class=\"text-xs text-on-surface-variant leading-relaxed\">Dr. Rossi added the \"Morning Reflection\" module to your pathway.</p>
                            <p class=\"text-[10px] text-gray-400 font-bold uppercase tracking-wider\">2 hours ago</p>
                        </div>
                    </div>

                    <div class=\"flex gap-5 group cursor-pointer\">
                        <div class=\"flex-shrink-0 w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300\">
                            <span class=\"material-symbols-outlined text-2xl\" data-icon=\"emoji_events\">emoji_events</span>
                        </div>
                        <div class=\"space-y-1.5 pt-1\">
                            <p class=\"text-sm font-bold text-on-surface group-hover:text-amber-700 transition-colors\">New Milestone!</p>
                            <p class=\"text-xs text-on-surface-variant leading-relaxed\">You've completed your daily check-in for 7 consecutive days.</p>
                            <p class=\"text-[10px] text-gray-400 font-bold uppercase tracking-wider\">Yesterday</p>
                        </div>
                    </div>
                </div>
                <button class=\"w-full mt-12 py-3 text-center border border-outline rounded-xl text-xs font-bold text-on-surface-variant hover:bg-gray-50 transition-all\">
                    View Activity History
                </button>
            </div>
        </aside>
    </div>

    <!-- Featured Editorial Card -->
    <section class=\"max-w-none pt-4\">
        <div class=\"bg-gray-900 rounded-[3rem] p-12 lg:p-16 text-white flex flex-col lg:flex-row items-center gap-12 lg:gap-16 relative overflow-hidden shadow-2xl\">
            <div class=\"relative z-10 flex-1 space-y-8\">
                <div>
                    <span class=\"bg-primary/20 text-indigo-300 border border-primary/30 px-4 py-1.5 rounded-full text-xs font-bold tracking-[0.15em] uppercase\">Weekly Focus</span>
                </div>
                <h3 class=\"text-5xl lg:text-5xl xl:text-6xl font-headline font-extrabold leading-tight\">Mastering Emotional <br/>Equilibrium</h3>
                <p class=\"text-gray-400 leading-relaxed text-lg max-w-xl\">Dive into this week's curated exercise designed by our top neuroscientists to help you navigate stressful transitions with ease and intentionality.</p>
                <div class=\"pt-4\">
                    <button class=\"bg-white text-gray-900 px-10 py-4 rounded-2xl font-extrabold hover:bg-primary hover:text-white hover:scale-[1.02] transition-all duration-300\">
                        Start Your Journey
                    </button>
                </div>
            </div>
            <div class=\"relative z-10 w-full lg:w-[450px] aspect-square rounded-[3rem] overflow-hidden shadow-2xl border border-white/10 -rotate-2 hover:rotate-0 transition-transform duration-700\">
                <img alt=\"Equilibrium Zen\" class=\"w-full h-full object-cover scale-110 hover:scale-100 transition-transform duration-1000\" loading=\"lazy\" src=\"https://lh3.googleusercontent.com/aida-public/AB6AXuDx9UezEqZsQZhDT65ewQJFJTlevUspfJlaDzCW3uRb_pu8f79WZudap2AxaUL8sRysaaoPg1g1lugkpkHvcY6LAaIcUdgJeiBW_h1M3CGiWENMiBrTAYaEwjdr380EJdEwK9eNM8kJ4NLFEVY5uLqoLuzUrhgb4y2H-uV9-q0bO0LwZ0BAAzA428cQ5w4iiztlLz_3UwKdiqCFpKDXKyAonUfGGRYuaOW8U6LPt-NDZTgDvBNHqXNF_6RI6VrpES9xkJWWuYrTHg\"/>
            </div>
            <!-- Ambient Background Effects -->
            <div class=\"absolute -top-24 -right-24 w-96 h-96 bg-primary/20 rounded-full blur-[100px]\"></div>
            <div class=\"absolute bottom-0 left-1/4 w-1/2 h-px bg-gradient-to-r from-transparent via-white/10 to-transparent\"></div>
        </div>
    </section>
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
        return "pages/dashboard/user.html.twig";
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
        return array (  252 => 95,  243 => 92,  238 => 89,  236 => 88,  224 => 81,  219 => 79,  213 => 76,  210 => 75,  203 => 73,  195 => 71,  193 => 70,  188 => 67,  183 => 66,  175 => 61,  158 => 47,  153 => 45,  140 => 35,  135 => 33,  115 => 16,  106 => 10,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block title %}Dashboard - InnerTrack{% endblock %}

{% block content %}
<div class=\"space-y-12 lg:space-y-16\">
    <!-- Hero Header Section -->
    <section>
        <div class=\"flex items-baseline gap-3\">
            <h2 class=\"text-4xl md:text-5xl lg:text-7xl font-headline font-extrabold text-on-surface tracking-tight leading-tight\">Good morning, {{ app.user.firstName|default('Guest') }}</h2>
            <span class=\"text-4xl lg:text-5xl\">👋</span>
        </div>
        <div class=\"mt-6 flex flex-wrap items-center gap-4 lg:gap-6\">
            <p class=\"text-on-surface-variant font-medium flex items-center gap-2.5 px-4 py-2 bg-gray-100 rounded-full text-sm shadow-sm\">
                <span class=\"material-symbols-outlined text-primary text-lg\" data-icon=\"calendar_today\">calendar_today</span>
                {{ 'now'|date('l, F jS, Y') }}
            </p>
            <p class=\"text-secondary font-bold text-xs uppercase tracking-widest px-4 py-2 bg-secondary-container text-on-secondary-container rounded-full shadow-sm\">
                Daily goal: 12m Meditation
            </p>
        </div>
    </section>

    <!-- Dashboard Bento Grid -->
    <div class=\"grid grid-cols-12 gap-8 lg:gap-10\">
        <!-- Primary Stats and Activity -->
        <div class=\"col-span-12 lg:col-span-8 space-y-12\">
            <div class=\"grid grid-cols-1 md:grid-cols-2 gap-8\">
                <!-- Active Conversations -->
                <div class=\"serene-gradient p-10 text-white relative overflow-hidden rounded-[2rem] soft-elevation group h-48 lg:h-56 flex flex-col justify-between\">
                    <div class=\"relative z-10\">
                        <p class=\"text-white/70 font-bold uppercase tracking-widest text-[11px] mb-2\">Active Conversations</p>
                        <h3 class=\"text-5xl lg:text-6xl font-headline font-extrabold\">{{ \"%02d\"|format(conversationCount) }}</h3>
                    </div>
                    <a href=\"{{ path('app_messages') }}\" class=\"relative z-10 flex items-center text-sm font-bold opacity-90 hover:opacity-100 group-hover:translate-x-1 transition-all\">
                        View all messages <span class=\"material-symbols-outlined ml-2 text-lg\" data-icon=\"arrow_forward\">arrow_forward</span>
                    </a>
                    <div class=\"absolute -right-12 -bottom-12 w-48 h-48 bg-white/10 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-700\"></div>
                </div>
                
                <!-- Unread Notifications -->
                <div class=\"bg-primary/5 border border-primary/10 p-10 rounded-[2rem] text-on-surface relative overflow-hidden h-48 lg:h-56 flex flex-col justify-between group\">
                    <div class=\"relative z-10\">
                        <p class=\"text-primary font-bold uppercase tracking-widest text-[11px] mb-2\">Unread Notifications</p>
                        <h3 class=\"text-5xl lg:text-6xl font-headline font-extrabold text-primary\">{{ \"%02d\"|format(unreadNotifs) }}</h3>
                    </div>
                    <a href=\"{{ path('app_notifications') }}\" class=\"relative z-10 inline-flex items-center text-sm font-bold text-primary group-hover:translate-x-1 transition-all\">
                        Catch up now <span class=\"material-symbols-outlined ml-2 text-lg\" data-icon=\"bolt\">bolt</span>
                    </a>
                    <div class=\"absolute -right-8 -top-8 w-32 h-32 bg-primary/5 rounded-full blur-2xl\"></div>
                </div>
            </div>
            
            <!-- Therapists Carousel/Grid -->
            <div class=\"space-y-8\">
                <div class=\"flex justify-between items-end border-b border-outline pb-6\">
                    <div>
                        <h4 class=\"text-3xl font-headline font-bold tracking-tight\">Your Care Team</h4>
                        <p class=\"text-on-surface-variant text-sm mt-1\">Direct access to your primary therapists</p>
                    </div>
                    <a href=\"{{ path('app_map') }}\" class=\"text-primary text-sm font-bold hover:underline underline-offset-8 flex items-center gap-1\">
                        Explore new matches <span class=\"material-symbols-outlined text-sm\" data-icon=\"open_in_new\">open_in_new</span>
                    </a>
                </div>
                <div class=\"grid grid-cols-1 sm:grid-cols-2 gap-8\">
                    {% for therapist in therapists %}
                        <div class=\"bg-white border border-outline p-8 rounded-[2rem] hover:border-primary/30 hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center space-y-6\">
                            <div class=\"relative\">
                                <div class=\"w-24 h-24 rounded-[2rem] bg-primary text-white flex items-center justify-center font-bold text-3xl overflow-hidden shadow-lg\">
                                    {% if therapist.profilePictureUrl %}
                                        <img src=\"{{ therapist.profilePictureUrl }}\" alt=\"{{ therapist.fullName }}\" class=\"w-full h-full object-cover\">
                                    {% else %}
                                        {{ therapist.firstName|first }}{{ therapist.lastName|first }}
                                    {% endif %}
                                </div>
                                <div class=\"absolute -bottom-1 -right-1 w-6 h-6 {{ therapist.status == 'ACTIVE' ? 'bg-green-500' : 'bg-gray-300' }} border-4 border-white rounded-full\"></div>
                            </div>
                            <div>
                                <h5 class=\"font-headline font-extrabold text-xl text-on-surface\">{{ therapist.fullName }}</h5>
                                <p class=\"text-on-surface-variant text-sm font-medium mt-1\">
                                    {{ therapist.therapistProfile.specialization|default('Clinical Psychologist') }}
                                </p>
                            </div>
                            <button class=\"w-full bg-secondary-container text-secondary py-3.5 rounded-xl font-bold text-sm hover:brightness-105 active:scale-95 transition-all flex items-center justify-center gap-2\">
                                <span class=\"material-symbols-outlined text-lg\" data-icon=\"chat\">chat</span> Send Message
                            </button>
                        </div>
                    {% else %}
                        <div class=\"col-span-full py-16 bg-gray-50/50 rounded-[3rem] border border-dashed border-outline/50 flex flex-col items-center justify-center text-center\">
                            <span class=\"material-symbols-outlined text-5xl text-gray-300 mb-4\" data-icon=\"clinical_notes\">clinical_notes</span>
                            <h5 class=\"font-headline font-bold text-lg text-gray-400\">No active therapists yet</h5>
                            <a href=\"{{ path('app_map') }}\" class=\"mt-4 text-primary font-bold text-sm hover:underline\">Find a therapist on the map</a>
                        </div>
                    {% endfor %}
                </div>
            </div>
        </div>

        <!-- Sidebar Activity Feed -->
        <aside class=\"col-span-12 lg:col-span-4 space-y-10\">
            <div class=\"bg-white border border-outline p-8 lg:p-10 rounded-[2.5rem] soft-elevation lg:sticky lg:top-8\">
                <div class=\"flex items-center justify-between mb-10\">
                    <h4 class=\"text-xl font-headline font-extrabold tracking-tight\">Recent Activity</h4>
                    <span class=\"bg-gray-100 text-on-surface-variant text-[10px] font-bold px-2 py-1 rounded-md\">TODAY</span>
                </div>
                <div class=\"space-y-10\">
                    <div class=\"flex gap-5 group cursor-pointer\">
                        <div class=\"flex-shrink-0 w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300\">
                            <span class=\"material-symbols-outlined text-2xl\" data-icon=\"history_edu\">history_edu</span>
                        </div>
                        <div class=\"space-y-1.5 pt-1\">
                            <p class=\"text-sm font-bold text-on-surface group-hover:text-primary transition-colors\">Therapy Plan Update</p>
                            <p class=\"text-xs text-on-surface-variant leading-relaxed\">Dr. Rossi added the \"Morning Reflection\" module to your pathway.</p>
                            <p class=\"text-[10px] text-gray-400 font-bold uppercase tracking-wider\">2 hours ago</p>
                        </div>
                    </div>

                    <div class=\"flex gap-5 group cursor-pointer\">
                        <div class=\"flex-shrink-0 w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300\">
                            <span class=\"material-symbols-outlined text-2xl\" data-icon=\"emoji_events\">emoji_events</span>
                        </div>
                        <div class=\"space-y-1.5 pt-1\">
                            <p class=\"text-sm font-bold text-on-surface group-hover:text-amber-700 transition-colors\">New Milestone!</p>
                            <p class=\"text-xs text-on-surface-variant leading-relaxed\">You've completed your daily check-in for 7 consecutive days.</p>
                            <p class=\"text-[10px] text-gray-400 font-bold uppercase tracking-wider\">Yesterday</p>
                        </div>
                    </div>
                </div>
                <button class=\"w-full mt-12 py-3 text-center border border-outline rounded-xl text-xs font-bold text-on-surface-variant hover:bg-gray-50 transition-all\">
                    View Activity History
                </button>
            </div>
        </aside>
    </div>

    <!-- Featured Editorial Card -->
    <section class=\"max-w-none pt-4\">
        <div class=\"bg-gray-900 rounded-[3rem] p-12 lg:p-16 text-white flex flex-col lg:flex-row items-center gap-12 lg:gap-16 relative overflow-hidden shadow-2xl\">
            <div class=\"relative z-10 flex-1 space-y-8\">
                <div>
                    <span class=\"bg-primary/20 text-indigo-300 border border-primary/30 px-4 py-1.5 rounded-full text-xs font-bold tracking-[0.15em] uppercase\">Weekly Focus</span>
                </div>
                <h3 class=\"text-5xl lg:text-5xl xl:text-6xl font-headline font-extrabold leading-tight\">Mastering Emotional <br/>Equilibrium</h3>
                <p class=\"text-gray-400 leading-relaxed text-lg max-w-xl\">Dive into this week's curated exercise designed by our top neuroscientists to help you navigate stressful transitions with ease and intentionality.</p>
                <div class=\"pt-4\">
                    <button class=\"bg-white text-gray-900 px-10 py-4 rounded-2xl font-extrabold hover:bg-primary hover:text-white hover:scale-[1.02] transition-all duration-300\">
                        Start Your Journey
                    </button>
                </div>
            </div>
            <div class=\"relative z-10 w-full lg:w-[450px] aspect-square rounded-[3rem] overflow-hidden shadow-2xl border border-white/10 -rotate-2 hover:rotate-0 transition-transform duration-700\">
                <img alt=\"Equilibrium Zen\" class=\"w-full h-full object-cover scale-110 hover:scale-100 transition-transform duration-1000\" loading=\"lazy\" src=\"https://lh3.googleusercontent.com/aida-public/AB6AXuDx9UezEqZsQZhDT65ewQJFJTlevUspfJlaDzCW3uRb_pu8f79WZudap2AxaUL8sRysaaoPg1g1lugkpkHvcY6LAaIcUdgJeiBW_h1M3CGiWENMiBrTAYaEwjdr380EJdEwK9eNM8kJ4NLFEVY5uLqoLuzUrhgb4y2H-uV9-q0bO0LwZ0BAAzA428cQ5w4iiztlLz_3UwKdiqCFpKDXKyAonUfGGRYuaOW8U6LPt-NDZTgDvBNHqXNF_6RI6VrpES9xkJWWuYrTHg\"/>
            </div>
            <!-- Ambient Background Effects -->
            <div class=\"absolute -top-24 -right-24 w-96 h-96 bg-primary/20 rounded-full blur-[100px]\"></div>
            <div class=\"absolute bottom-0 left-1/4 w-1/2 h-px bg-gradient-to-r from-transparent via-white/10 to-transparent\"></div>
        </div>
    </section>
</div>
{% endblock %}
", "pages/dashboard/user.html.twig", "C:\\Users\\user\\Documents\\fuck2\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\dashboard\\user.html.twig");
    }
}
