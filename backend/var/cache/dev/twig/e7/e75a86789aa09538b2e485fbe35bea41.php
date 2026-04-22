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

/* pages/login.html.twig */
class __TwigTemplate_e3b525bc1af54f868c67832835d04928 extends Template
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
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "layouts/auth.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/login.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/login.html.twig"));

        $this->parent = $this->load("layouts/auth.html.twig", 1);
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

        yield "Login | InnerTrack";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<main class=\"min-h-screen pt-24 pb-12 flex items-center justify-center px-4 md:px-8\">
    <div class=\"max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 bg-surface-container-lowest rounded-[2rem] overflow-hidden shadow-[0px_40px_80px_rgba(13,28,46,0.08)]\">
        
        <!-- Left Side: Editorial Inspiration -->
        <section class=\"relative hidden lg:block overflow-hidden h-[650px]\">
            <div class=\"absolute inset-0 z-0\">
                <img src=\"https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?auto=format&fit=crop&q=80&w=2000\" 
                     alt=\"Abstract nature\" 
                     class=\"w-full h-full object-cover\">
                <div class=\"absolute inset-0 bg-on-surface/20 backdrop-blur-[2px]\"></div>
                <div class=\"absolute inset-0 bg-gradient-to-t from-on-surface/60 to-transparent\"></div>
            </div>
            
            <div class=\"relative z-10 p-12 h-full flex flex-col justify-end max-w-xl\">
                <h1 class=\"text-surface-bright font-headline text-5xl font-extrabold tracking-tight mb-8 leading-[1.1]\">
                    Find your center, <br>one step at a time.
                </h1>
                <div class=\"flex items-center gap-4\">
                    <div class=\"h-[2px] w-12 bg-secondary\"></div>
                    <p class=\"text-surface-variant font-label uppercase tracking-[0.2em] font-semibold\">InnerTrack Philosophy</p>
                </div>
            </div>
        </section>

        <!-- Right Side: Login Form -->
        <section class=\"flex flex-col p-8 md:p-12 lg:p-16 justify-center\">
            <div class=\"max-w-md w-full mx-auto\">
                <header class=\"mb-10\">
                    <h2 class=\"text-3xl font-headline font-bold text-on-surface mb-2\">Welcome Back</h2>
                    <p class=\"text-on-surface-variant body-lg\">Return to your digital sanctuary.</p>
                </header>

                ";
        // line 38
        if ((($tmp = (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 38, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 39
            yield "                    <div class=\"mb-6 p-4 rounded-xl bg-error-container text-on-error-container text-sm font-medium flex items-center gap-3\">
                        <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"error\">error</span>
                        ";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 41, $this->source); })()), "messageKey", [], "any", false, false, false, 41), CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 41, $this->source); })()), "messageData", [], "any", false, false, false, 41), "security"), "html", null, true);
            yield "
                    </div>
                ";
        }
        // line 44
        yield "
                ";
        // line 45
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 45, $this->source); })()), "flashes", ["success"], "method", false, false, false, 45));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 46
            yield "                    <div class=\"mb-6 p-4 rounded-xl bg-secondary-container text-on-secondary-container text-sm font-medium flex items-center gap-3\">
                        <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"check_circle\">check_circle</span>
                        ";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        yield "
                <form class=\"space-y-6\" method=\"post\" action=\"";
        // line 52
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\">
                    <!-- Email Field -->
                    <div class=\"space-y-2\">
                        <label for=\"email\" class=\"block font-label text-sm font-semibold text-on-surface-variant px-1\">Email Address</label>
                        <div class=\"relative\">
                            <input type=\"email\" id=\"email\" name=\"email\" value=\"";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 57, $this->source); })()), "html", null, true);
        yield "\" placeholder=\"name@example.com\" required autofocus
                                   class=\"w-full h-14 bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 rounded-xl px-5 text-on-surface placeholder:text-outline transition-all duration-300\">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class=\"space-y-2\">
                        <div class=\"flex justify-between items-center px-1\">
                            <label for=\"password\" class=\"block font-label text-sm font-semibold text-on-surface-variant\">Password</label>
                            <a href=\"";
        // line 66
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forgot_password");
        yield "\" class=\"text-sm font-semibold text-primary hover:text-on-primary-fixed-variant transition-colors\">Forgot Password?</a>
                        </div>
                        <div class=\"relative\">
                            <input type=\"password\" id=\"password\" name=\"password\" placeholder=\"••••••••\" required
                                   class=\"w-full h-14 bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 rounded-xl px-5 text-on-surface placeholder:text-outline transition-all duration-300\">
                        </div>
                    </div>

                    <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 74
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        yield "\">

                    <!-- Actions -->
                    <div class=\"pt-4 space-y-6\">
                        <button type=\"submit\" class=\"w-full sanctuary-gradient text-on-primary font-headline font-bold py-4 rounded-xl shadow-[0px_10px_20px_rgba(79,70,229,0.2)] hover:opacity-95 active:scale-[0.98] transition-all flex items-center justify-center gap-2\">
                            Log In
                            <span class=\"material-symbols-outlined text-[1.2rem]\" data-icon=\"arrow_forward\">arrow_forward</span>
                        </button>
                        <div class=\"flex items-center justify-center gap-2 text-sm text-on-surface-variant\">
                            Don't have an account?
                            <a class=\"text-primary font-bold hover:underline ml-1\" href=\"";
        // line 84
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\">Create an Account</a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
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
        return "pages/login.html.twig";
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
        return array (  213 => 84,  200 => 74,  189 => 66,  177 => 57,  169 => 52,  166 => 51,  157 => 48,  153 => 46,  149 => 45,  146 => 44,  140 => 41,  136 => 39,  134 => 38,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/auth.html.twig' %}

{% block title %}Login | InnerTrack{% endblock %}

{% block body %}
<main class=\"min-h-screen pt-24 pb-12 flex items-center justify-center px-4 md:px-8\">
    <div class=\"max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 bg-surface-container-lowest rounded-[2rem] overflow-hidden shadow-[0px_40px_80px_rgba(13,28,46,0.08)]\">
        
        <!-- Left Side: Editorial Inspiration -->
        <section class=\"relative hidden lg:block overflow-hidden h-[650px]\">
            <div class=\"absolute inset-0 z-0\">
                <img src=\"https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?auto=format&fit=crop&q=80&w=2000\" 
                     alt=\"Abstract nature\" 
                     class=\"w-full h-full object-cover\">
                <div class=\"absolute inset-0 bg-on-surface/20 backdrop-blur-[2px]\"></div>
                <div class=\"absolute inset-0 bg-gradient-to-t from-on-surface/60 to-transparent\"></div>
            </div>
            
            <div class=\"relative z-10 p-12 h-full flex flex-col justify-end max-w-xl\">
                <h1 class=\"text-surface-bright font-headline text-5xl font-extrabold tracking-tight mb-8 leading-[1.1]\">
                    Find your center, <br>one step at a time.
                </h1>
                <div class=\"flex items-center gap-4\">
                    <div class=\"h-[2px] w-12 bg-secondary\"></div>
                    <p class=\"text-surface-variant font-label uppercase tracking-[0.2em] font-semibold\">InnerTrack Philosophy</p>
                </div>
            </div>
        </section>

        <!-- Right Side: Login Form -->
        <section class=\"flex flex-col p-8 md:p-12 lg:p-16 justify-center\">
            <div class=\"max-w-md w-full mx-auto\">
                <header class=\"mb-10\">
                    <h2 class=\"text-3xl font-headline font-bold text-on-surface mb-2\">Welcome Back</h2>
                    <p class=\"text-on-surface-variant body-lg\">Return to your digital sanctuary.</p>
                </header>

                {% if error %}
                    <div class=\"mb-6 p-4 rounded-xl bg-error-container text-on-error-container text-sm font-medium flex items-center gap-3\">
                        <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"error\">error</span>
                        {{ error.messageKey|trans(error.messageData, 'security') }}
                    </div>
                {% endif %}

                {% for message in app.flashes('success') %}
                    <div class=\"mb-6 p-4 rounded-xl bg-secondary-container text-on-secondary-container text-sm font-medium flex items-center gap-3\">
                        <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"check_circle\">check_circle</span>
                        {{ message }}
                    </div>
                {% endfor %}

                <form class=\"space-y-6\" method=\"post\" action=\"{{ path('app_login') }}\">
                    <!-- Email Field -->
                    <div class=\"space-y-2\">
                        <label for=\"email\" class=\"block font-label text-sm font-semibold text-on-surface-variant px-1\">Email Address</label>
                        <div class=\"relative\">
                            <input type=\"email\" id=\"email\" name=\"email\" value=\"{{ last_username }}\" placeholder=\"name@example.com\" required autofocus
                                   class=\"w-full h-14 bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 rounded-xl px-5 text-on-surface placeholder:text-outline transition-all duration-300\">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class=\"space-y-2\">
                        <div class=\"flex justify-between items-center px-1\">
                            <label for=\"password\" class=\"block font-label text-sm font-semibold text-on-surface-variant\">Password</label>
                            <a href=\"{{ path('app_forgot_password') }}\" class=\"text-sm font-semibold text-primary hover:text-on-primary-fixed-variant transition-colors\">Forgot Password?</a>
                        </div>
                        <div class=\"relative\">
                            <input type=\"password\" id=\"password\" name=\"password\" placeholder=\"••••••••\" required
                                   class=\"w-full h-14 bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 rounded-xl px-5 text-on-surface placeholder:text-outline transition-all duration-300\">
                        </div>
                    </div>

                    <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('authenticate') }}\">

                    <!-- Actions -->
                    <div class=\"pt-4 space-y-6\">
                        <button type=\"submit\" class=\"w-full sanctuary-gradient text-on-primary font-headline font-bold py-4 rounded-xl shadow-[0px_10px_20px_rgba(79,70,229,0.2)] hover:opacity-95 active:scale-[0.98] transition-all flex items-center justify-center gap-2\">
                            Log In
                            <span class=\"material-symbols-outlined text-[1.2rem]\" data-icon=\"arrow_forward\">arrow_forward</span>
                        </button>
                        <div class=\"flex items-center justify-center gap-2 text-sm text-on-surface-variant\">
                            Don't have an account?
                            <a class=\"text-primary font-bold hover:underline ml-1\" href=\"{{ path('app_register') }}\">Create an Account</a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>
{% endblock %}
", "pages/login.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\login.html.twig");
    }
}
