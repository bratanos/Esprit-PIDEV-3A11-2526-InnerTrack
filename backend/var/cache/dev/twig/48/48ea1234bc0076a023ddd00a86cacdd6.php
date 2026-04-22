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

/* pages/signup.html.twig */
class __TwigTemplate_060923141dfec32bfe225c7fe67cf171 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/signup.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/signup.html.twig"));

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

        yield "Join Us | InnerTrack";
        
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
        
        <!-- Visual Brand Side (Editorial) -->
        <div class=\"relative hidden lg:block p-12 overflow-hidden bg-primary-container h-[700px]\">
            <div class=\"absolute inset-0 opacity-40\">
                <img class=\"w-full h-full object-cover\" src=\"https://lh3.googleusercontent.com/aida-public/AB6AXuCA8aRxnn3WUD0sdqvkzjmYGKqoRkraGN-rQbfpvhKn4682NvlDCn8nb0qrt1zJz1geumxgb66oUiVB5CwZ9hDZhOpStKGoTVT4drpB5PgVoI8ZJ2mS36chQ5ow_toF1lpn0esr42HoMW6ko16NceBuTtD85E3Oh_QmrYKI7_kp1Dopq-wRIOX8CAm3jWeQmUokboxbH3-KZ2jPjGL7UAvwNIsD8I20Q82kfKUZxf1axZMZ124LVW_GysM8OoRCDAuUGGVO3ecosg\"/>
            </div>
            <div class=\"relative h-full flex flex-col justify-between z-10\">
                <div>
                    <h1 class=\"text-white font-headline text-5xl font-extrabold leading-tight tracking-tight\">
                        Begin your<br/>journey to<br/>inner peace.
                    </h1>
                    <p class=\"mt-6 text-on-primary-container text-xl font-body leading-relaxed max-w-sm\">
                        Join our community of mindful individuals finding clarity in the digital age.
                    </p>
                </div>
                <div class=\"bg-surface/10 backdrop-blur-md p-6 rounded-xl border border-white/10\">
                    <p class=\"text-white italic text-lg leading-relaxed\">
                        \"The first step towards mindfulness is simply deciding to show up for yourself.\"
                    </p>
                    <div class=\"mt-4 flex items-center gap-3\">
                        <div class=\"h-10 w-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container\">
                            <span class=\"material-symbols-outlined\" data-icon=\"spa\" style=\"font-variation-settings: 'FILL' 1;\">spa</span>
                        </div>
                        <span class=\"text-white font-semibold\">Sanctuary Guide</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class=\"p-8 md:p-12 lg:p-16 flex flex-col justify-center bg-surface-container-lowest\">
            <div class=\"max-w-md mx-auto w-full\">
                <div class=\"mb-10\">
                    <h2 class=\"font-headline text-3xl font-bold text-on-surface\">Create Account</h2>
                    <p class=\"text-on-surface-variant mt-2\">Start your sanctuary experience.</p>
                </div>

                ";
        // line 45
        if ((array_key_exists("errors", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 45, $this->source); })())) > 0))) {
            // line 46
            yield "                    <div class=\"mb-6 p-4 rounded-xl bg-error-container text-on-error-container text-sm font-medium flex flex-col gap-1\">
                        ";
            // line 47
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 47, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 48
                yield "                            <p class=\"flex items-center gap-2\">
                                <span class=\"material-symbols-outlined text-[16px]\" data-icon=\"error\">error</span>
                                ";
                // line 50
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["error"], "html", null, true);
                yield "
                            </p>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 53
            yield "                    </div>
                ";
        }
        // line 55
        yield "
                <form class=\"space-y-5\" method=\"post\" action=\"";
        // line 56
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_register");
        yield "\">
                    <div class=\"grid grid-cols-2 gap-4\">
                        <div class=\"space-y-2\">
                            <label for=\"first_name\" class=\"block text-sm font-label font-medium text-on-surface-variant ml-1\">First Name</label>
                            <input class=\"w-full h-12 px-4 rounded-xl bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-outline-variant\" placeholder=\"Alex\" name=\"first_name\" id=\"first_name\" required value=\"";
        // line 60
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("first_name", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["first_name"]) || array_key_exists("first_name", $context) ? $context["first_name"] : (function () { throw new RuntimeError('Variable "first_name" does not exist.', 60, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\" type=\"text\"/>
                        </div>
                        <div class=\"space-y-2\">
                            <label for=\"last_name\" class=\"block text-sm font-label font-medium text-on-surface-variant ml-1\">Last Name</label>
                            <input class=\"w-full h-12 px-4 rounded-xl bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-outline-variant\" placeholder=\"Rivers\" name=\"last_name\" id=\"last_name\" required value=\"";
        // line 64
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("last_name", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_name"]) || array_key_exists("last_name", $context) ? $context["last_name"] : (function () { throw new RuntimeError('Variable "last_name" does not exist.', 64, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\" type=\"text\"/>
                        </div>
                    </div>

                    <div class=\"space-y-2\">
                        <label for=\"email\" class=\"block text-sm font-label font-medium text-on-surface-variant ml-1\">Email Address</label>
                        <input class=\"w-full h-12 px-4 rounded-xl bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-outline-variant\" placeholder=\"alex@sanctuary.com\" name=\"email\" id=\"email\" required value=\"";
        // line 70
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("email", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["email"]) || array_key_exists("email", $context) ? $context["email"] : (function () { throw new RuntimeError('Variable "email" does not exist.', 70, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\" type=\"email\"/>
                    </div>

                    <div class=\"grid grid-cols-2 gap-4\">
                        <div class=\"space-y-2\">
                            <label for=\"password\" class=\"block text-sm font-label font-medium text-on-surface-variant ml-1\">Password</label>
                            <input class=\"w-full h-12 px-4 rounded-xl bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-outline-variant\" placeholder=\"••••••••\" name=\"password\" id=\"password\" required type=\"password\"/>
                        </div>
                        <div class=\"space-y-2\">
                            <label for=\"confirm_password\" class=\"block text-sm font-label font-medium text-on-surface-variant ml-1\">Confirm</label>
                            <input class=\"w-full h-12 px-4 rounded-xl bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-outline-variant\" placeholder=\"••••••••\" name=\"confirm_password\" id=\"confirm_password\" required type=\"password\"/>
                        </div>
                    </div>

                    <div class=\"pt-2\">
                        <label class=\"block text-sm font-label font-medium text-on-surface-variant ml-1 mb-2\">Account Type</label>
                        <div class=\"grid grid-cols-2 gap-3\">
                            <label class=\"relative flex items-center p-3 cursor-pointer rounded-xl bg-surface-container-highest transition-colors hover:bg-surface-variant has-[:checked]:bg-primary-container has-[:checked]:text-on-primary-container group\">
                                <input type=\"radio\" name=\"role\" value=\"ROLE_USER\" class=\"peer sr-only\" ";
        // line 88
        if ((((array_key_exists("role", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["role"]) || array_key_exists("role", $context) ? $context["role"] : (function () { throw new RuntimeError('Variable "role" does not exist.', 88, $this->source); })()), "ROLE_USER")) : ("ROLE_USER")) == "ROLE_USER")) {
            yield "checked";
        }
        yield ">
                                <div class=\"font-medium text-[13px] w-full text-center group-has-[:checked]:text-white\">User</div>
                            </label>
                            <label class=\"relative flex items-center p-3 cursor-pointer rounded-xl bg-surface-container-highest transition-colors hover:bg-surface-variant has-[:checked]:bg-secondary-container has-[:checked]:text-on-secondary-container group\">
                                <input type=\"radio\" name=\"role\" value=\"ROLE_PSYCHOLOGUE\" class=\"peer sr-only\" ";
        // line 92
        if ((((array_key_exists("role", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["role"]) || array_key_exists("role", $context) ? $context["role"] : (function () { throw new RuntimeError('Variable "role" does not exist.', 92, $this->source); })()), "")) : ("")) == "ROLE_PSYCHOLOGUE")) {
            yield "checked";
        }
        yield ">
                                <div class=\"font-medium text-[13px] w-full text-center group-has-[:checked]:text-on-secondary-fixed-variant\">Psychologist</div>
                            </label>
                        </div>
                    </div>

                    <div class=\"pt-4 space-y-6\">
                        <button class=\"w-full py-4 sanctuary-gradient text-white font-bold rounded-xl shadow-[0px_10px_20px_rgba(79,70,229,0.2)] hover:opacity-95 active:scale-[0.98] transition-all flex items-center justify-center gap-2\" type=\"submit\">
                            Sign Up
                            <span class=\"material-symbols-outlined text-[1.2rem]\" data-icon=\"arrow_forward\">arrow_forward</span>
                        </button>
                        <div class=\"flex items-center justify-center gap-2 text-sm text-on-surface-variant\">
                            Already have an account?
                            <a class=\"text-primary font-bold hover:underline\" href=\"";
        // line 105
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\">Back to Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
        return "pages/signup.html.twig";
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
        return array (  241 => 105,  223 => 92,  214 => 88,  193 => 70,  184 => 64,  177 => 60,  170 => 56,  167 => 55,  163 => 53,  154 => 50,  150 => 48,  146 => 47,  143 => 46,  141 => 45,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/auth.html.twig' %}

{% block title %}Join Us | InnerTrack{% endblock %}

{% block body %}
<main class=\"min-h-screen pt-24 pb-12 flex items-center justify-center px-4 md:px-8\">
    <div class=\"max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 bg-surface-container-lowest rounded-[2rem] overflow-hidden shadow-[0px_40px_80px_rgba(13,28,46,0.08)]\">
        
        <!-- Visual Brand Side (Editorial) -->
        <div class=\"relative hidden lg:block p-12 overflow-hidden bg-primary-container h-[700px]\">
            <div class=\"absolute inset-0 opacity-40\">
                <img class=\"w-full h-full object-cover\" src=\"https://lh3.googleusercontent.com/aida-public/AB6AXuCA8aRxnn3WUD0sdqvkzjmYGKqoRkraGN-rQbfpvhKn4682NvlDCn8nb0qrt1zJz1geumxgb66oUiVB5CwZ9hDZhOpStKGoTVT4drpB5PgVoI8ZJ2mS36chQ5ow_toF1lpn0esr42HoMW6ko16NceBuTtD85E3Oh_QmrYKI7_kp1Dopq-wRIOX8CAm3jWeQmUokboxbH3-KZ2jPjGL7UAvwNIsD8I20Q82kfKUZxf1axZMZ124LVW_GysM8OoRCDAuUGGVO3ecosg\"/>
            </div>
            <div class=\"relative h-full flex flex-col justify-between z-10\">
                <div>
                    <h1 class=\"text-white font-headline text-5xl font-extrabold leading-tight tracking-tight\">
                        Begin your<br/>journey to<br/>inner peace.
                    </h1>
                    <p class=\"mt-6 text-on-primary-container text-xl font-body leading-relaxed max-w-sm\">
                        Join our community of mindful individuals finding clarity in the digital age.
                    </p>
                </div>
                <div class=\"bg-surface/10 backdrop-blur-md p-6 rounded-xl border border-white/10\">
                    <p class=\"text-white italic text-lg leading-relaxed\">
                        \"The first step towards mindfulness is simply deciding to show up for yourself.\"
                    </p>
                    <div class=\"mt-4 flex items-center gap-3\">
                        <div class=\"h-10 w-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container\">
                            <span class=\"material-symbols-outlined\" data-icon=\"spa\" style=\"font-variation-settings: 'FILL' 1;\">spa</span>
                        </div>
                        <span class=\"text-white font-semibold\">Sanctuary Guide</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class=\"p-8 md:p-12 lg:p-16 flex flex-col justify-center bg-surface-container-lowest\">
            <div class=\"max-w-md mx-auto w-full\">
                <div class=\"mb-10\">
                    <h2 class=\"font-headline text-3xl font-bold text-on-surface\">Create Account</h2>
                    <p class=\"text-on-surface-variant mt-2\">Start your sanctuary experience.</p>
                </div>

                {% if errors is defined and errors|length > 0 %}
                    <div class=\"mb-6 p-4 rounded-xl bg-error-container text-on-error-container text-sm font-medium flex flex-col gap-1\">
                        {% for error in errors %}
                            <p class=\"flex items-center gap-2\">
                                <span class=\"material-symbols-outlined text-[16px]\" data-icon=\"error\">error</span>
                                {{ error }}
                            </p>
                        {% endfor %}
                    </div>
                {% endif %}

                <form class=\"space-y-5\" method=\"post\" action=\"{{ path('app_register') }}\">
                    <div class=\"grid grid-cols-2 gap-4\">
                        <div class=\"space-y-2\">
                            <label for=\"first_name\" class=\"block text-sm font-label font-medium text-on-surface-variant ml-1\">First Name</label>
                            <input class=\"w-full h-12 px-4 rounded-xl bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-outline-variant\" placeholder=\"Alex\" name=\"first_name\" id=\"first_name\" required value=\"{{ first_name|default('') }}\" type=\"text\"/>
                        </div>
                        <div class=\"space-y-2\">
                            <label for=\"last_name\" class=\"block text-sm font-label font-medium text-on-surface-variant ml-1\">Last Name</label>
                            <input class=\"w-full h-12 px-4 rounded-xl bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-outline-variant\" placeholder=\"Rivers\" name=\"last_name\" id=\"last_name\" required value=\"{{ last_name|default('') }}\" type=\"text\"/>
                        </div>
                    </div>

                    <div class=\"space-y-2\">
                        <label for=\"email\" class=\"block text-sm font-label font-medium text-on-surface-variant ml-1\">Email Address</label>
                        <input class=\"w-full h-12 px-4 rounded-xl bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-outline-variant\" placeholder=\"alex@sanctuary.com\" name=\"email\" id=\"email\" required value=\"{{ email|default('') }}\" type=\"email\"/>
                    </div>

                    <div class=\"grid grid-cols-2 gap-4\">
                        <div class=\"space-y-2\">
                            <label for=\"password\" class=\"block text-sm font-label font-medium text-on-surface-variant ml-1\">Password</label>
                            <input class=\"w-full h-12 px-4 rounded-xl bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-outline-variant\" placeholder=\"••••••••\" name=\"password\" id=\"password\" required type=\"password\"/>
                        </div>
                        <div class=\"space-y-2\">
                            <label for=\"confirm_password\" class=\"block text-sm font-label font-medium text-on-surface-variant ml-1\">Confirm</label>
                            <input class=\"w-full h-12 px-4 rounded-xl bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 transition-all placeholder:text-outline-variant\" placeholder=\"••••••••\" name=\"confirm_password\" id=\"confirm_password\" required type=\"password\"/>
                        </div>
                    </div>

                    <div class=\"pt-2\">
                        <label class=\"block text-sm font-label font-medium text-on-surface-variant ml-1 mb-2\">Account Type</label>
                        <div class=\"grid grid-cols-2 gap-3\">
                            <label class=\"relative flex items-center p-3 cursor-pointer rounded-xl bg-surface-container-highest transition-colors hover:bg-surface-variant has-[:checked]:bg-primary-container has-[:checked]:text-on-primary-container group\">
                                <input type=\"radio\" name=\"role\" value=\"ROLE_USER\" class=\"peer sr-only\" {% if (role|default('ROLE_USER')) == 'ROLE_USER' %}checked{% endif %}>
                                <div class=\"font-medium text-[13px] w-full text-center group-has-[:checked]:text-white\">User</div>
                            </label>
                            <label class=\"relative flex items-center p-3 cursor-pointer rounded-xl bg-surface-container-highest transition-colors hover:bg-surface-variant has-[:checked]:bg-secondary-container has-[:checked]:text-on-secondary-container group\">
                                <input type=\"radio\" name=\"role\" value=\"ROLE_PSYCHOLOGUE\" class=\"peer sr-only\" {% if (role|default('')) == 'ROLE_PSYCHOLOGUE' %}checked{% endif %}>
                                <div class=\"font-medium text-[13px] w-full text-center group-has-[:checked]:text-on-secondary-fixed-variant\">Psychologist</div>
                            </label>
                        </div>
                    </div>

                    <div class=\"pt-4 space-y-6\">
                        <button class=\"w-full py-4 sanctuary-gradient text-white font-bold rounded-xl shadow-[0px_10px_20px_rgba(79,70,229,0.2)] hover:opacity-95 active:scale-[0.98] transition-all flex items-center justify-center gap-2\" type=\"submit\">
                            Sign Up
                            <span class=\"material-symbols-outlined text-[1.2rem]\" data-icon=\"arrow_forward\">arrow_forward</span>
                        </button>
                        <div class=\"flex items-center justify-center gap-2 text-sm text-on-surface-variant\">
                            Already have an account?
                            <a class=\"text-primary font-bold hover:underline\" href=\"{{ path('app_login') }}\">Back to Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
{% endblock %}", "pages/signup.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\signup.html.twig");
    }
}
