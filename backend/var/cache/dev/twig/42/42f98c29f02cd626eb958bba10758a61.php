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

/* pages/forgotPassword.html.twig */
class __TwigTemplate_a49313dc7a125a071b20904b4a96e079 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/forgotPassword.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/forgotPassword.html.twig"));

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

        yield "Verify Email | InnerTrack";
        
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
        yield "<main class=\"min-h-screen flex items-center justify-center px-6 pt-24 pb-12\">
    <div class=\"w-full max-w-xl\">
        <div class=\"bg-surface-container-low rounded-[2rem] p-1 md:p-2 shadow-[0px_20px_40px_rgba(13,28,46,0.04)]\">
            <div class=\"bg-surface-container-lowest rounded-[1.8rem] p-8 md:p-12 flex flex-col items-center text-center\">
                
                <h1 class=\"font-headline text-3xl md:text-4xl font-extrabold text-on-surface tracking-tight mb-4\">
                    Reset Password
                </h1>
                <p class=\"text-on-surface-variant text-lg leading-relaxed max-w-sm mb-10\">
                    Enter your email address and we'll send you a link to reset your access.
                </p>

                ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 18, $this->source); })()), "flashes", ["error"], "method", false, false, false, 18));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 19
            yield "                    <div class=\"mb-8 w-full p-4 rounded-xl bg-error-container text-on-error-container text-sm font-medium flex items-center justify-center gap-3\">
                        <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"error\">error</span>
                        ";
            // line 21
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        yield "                ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 24, $this->source); })()), "flashes", ["success"], "method", false, false, false, 24));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 25
            yield "                    <div class=\"mb-8 w-full p-4 rounded-xl bg-secondary-container text-on-secondary-container text-sm font-medium flex items-center justify-center gap-3\">
                        <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"check_circle\">check_circle</span>
                        ";
            // line 27
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        yield "
                <form class=\"w-full space-y-6\" method=\"post\" action=\"";
        // line 31
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forgot_password");
        yield "\">
                    <div class=\"space-y-2 text-left\">
                        <label for=\"email\" class=\"block font-label text-sm font-semibold text-on-surface-variant px-1\">Email Address</label>
                        <input type=\"email\" name=\"email\" id=\"email\" required autofocus placeholder=\"name@example.com\"
                               class=\"w-full h-14 bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 rounded-xl px-5 text-on-surface placeholder:text-outline transition-all duration-300\">
                    </div>

                    <button type=\"submit\" class=\"w-full mt-4 sanctuary-gradient text-on-primary font-semibold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all active:scale-95 duration-200\">
                        Send Reset Link
                    </button>
                    <div class=\"flex items-center justify-center gap-2 pt-4 text-sm text-on-surface-variant\">
                        <a class=\"text-primary font-bold hover:underline ml-1 inline-flex items-center gap-2\" href=\"";
        // line 42
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\">
                            <span class=\"material-symbols-outlined text-[16px]\" data-icon=\"arrow_back\">arrow_back</span>
                            Back to Login
                        </a>
                    </div>
                </form>

            </div>
        </div>

        <div class=\"mt-12 text-center\">
            <div class=\"inline-flex items-center gap-2 px-4 py-2 bg-surface-container-low rounded-full\">
                <span class=\"material-symbols-outlined text-secondary text-sm\" data-icon=\"lock\" style=\"font-variation-settings: 'FILL' 1;\">lock</span>
                <span class=\"text-xs font-label text-on-surface-variant font-medium tracking-wide\">SECURE VERIFICATION GATEWAY</span>
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
        return "pages/forgotPassword.html.twig";
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
        return array (  166 => 42,  152 => 31,  149 => 30,  140 => 27,  136 => 25,  131 => 24,  122 => 21,  118 => 19,  114 => 18,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/auth.html.twig' %}

{% block title %}Verify Email | InnerTrack{% endblock %}

{% block body %}
<main class=\"min-h-screen flex items-center justify-center px-6 pt-24 pb-12\">
    <div class=\"w-full max-w-xl\">
        <div class=\"bg-surface-container-low rounded-[2rem] p-1 md:p-2 shadow-[0px_20px_40px_rgba(13,28,46,0.04)]\">
            <div class=\"bg-surface-container-lowest rounded-[1.8rem] p-8 md:p-12 flex flex-col items-center text-center\">
                
                <h1 class=\"font-headline text-3xl md:text-4xl font-extrabold text-on-surface tracking-tight mb-4\">
                    Reset Password
                </h1>
                <p class=\"text-on-surface-variant text-lg leading-relaxed max-w-sm mb-10\">
                    Enter your email address and we'll send you a link to reset your access.
                </p>

                {% for message in app.flashes('error') %}
                    <div class=\"mb-8 w-full p-4 rounded-xl bg-error-container text-on-error-container text-sm font-medium flex items-center justify-center gap-3\">
                        <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"error\">error</span>
                        {{ message }}
                    </div>
                {% endfor %}
                {% for message in app.flashes('success') %}
                    <div class=\"mb-8 w-full p-4 rounded-xl bg-secondary-container text-on-secondary-container text-sm font-medium flex items-center justify-center gap-3\">
                        <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"check_circle\">check_circle</span>
                        {{ message }}
                    </div>
                {% endfor %}

                <form class=\"w-full space-y-6\" method=\"post\" action=\"{{ path('app_forgot_password') }}\">
                    <div class=\"space-y-2 text-left\">
                        <label for=\"email\" class=\"block font-label text-sm font-semibold text-on-surface-variant px-1\">Email Address</label>
                        <input type=\"email\" name=\"email\" id=\"email\" required autofocus placeholder=\"name@example.com\"
                               class=\"w-full h-14 bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 rounded-xl px-5 text-on-surface placeholder:text-outline transition-all duration-300\">
                    </div>

                    <button type=\"submit\" class=\"w-full mt-4 sanctuary-gradient text-on-primary font-semibold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all active:scale-95 duration-200\">
                        Send Reset Link
                    </button>
                    <div class=\"flex items-center justify-center gap-2 pt-4 text-sm text-on-surface-variant\">
                        <a class=\"text-primary font-bold hover:underline ml-1 inline-flex items-center gap-2\" href=\"{{ path('app_login') }}\">
                            <span class=\"material-symbols-outlined text-[16px]\" data-icon=\"arrow_back\">arrow_back</span>
                            Back to Login
                        </a>
                    </div>
                </form>

            </div>
        </div>

        <div class=\"mt-12 text-center\">
            <div class=\"inline-flex items-center gap-2 px-4 py-2 bg-surface-container-low rounded-full\">
                <span class=\"material-symbols-outlined text-secondary text-sm\" data-icon=\"lock\" style=\"font-variation-settings: 'FILL' 1;\">lock</span>
                <span class=\"text-xs font-label text-on-surface-variant font-medium tracking-wide\">SECURE VERIFICATION GATEWAY</span>
            </div>
        </div>
    </div>
</main>
{% endblock %}
", "pages/forgotPassword.html.twig", "C:\\Users\\user\\Documents\\fuck2\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\forgotPassword.html.twig");
    }
}
