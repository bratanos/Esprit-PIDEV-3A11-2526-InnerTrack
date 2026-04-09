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

/* pages/verifyEmail.html.twig */
class __TwigTemplate_0e7a956d4407e0353b5e1fda16012baf extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/verifyEmail.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/verifyEmail.html.twig"));

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
                
                <div class=\"relative w-48 h-48 mb-10 group\">
                    <div class=\"absolute inset-0 sanctuary-gradient opacity-10 blur-3xl rounded-full scale-125 transition-transform duration-700\"></div>
                    <div class=\"relative flex items-center justify-center w-full h-full rounded-full bg-surface-container-low overflow-hidden\">
                        <img alt=\"Serene morning sun shining through soft clouds\" class=\"w-full h-full object-cover mix-blend-multiply opacity-80\" src=\"https://lh3.googleusercontent.com/aida-public/AB6AXuCzyd3U7IcCLR2Me5DwR0nDaXcDm77YlUam3A7G3_6oIyHMxJZW6d6GPLlW7cyfX5Isg7a4Sm5dxwjO1MzXWyySx6ZVcP-uVOyV9R5dHHdN-gjPhRNcWHYozE7xN0ALcfxBl_v2XkPMJ6Uw1IAKklG3IfvwLZvRhICCPk2ua5G-EdF58co0NZNQKkkUbOr2mM2Vf0Xj6HKeOJq70l5ud5R_GsmzlrnRLpRp4I7sPQpHKJoJiljqNwSsDB0Qu8NQWD3XA2ZRzILw4g\"/>
                        <div class=\"absolute inset-0 flex items-center justify-center\">
                            <span class=\"material-symbols-outlined text-7xl text-primary\" data-icon=\"wb_sunny\" style=\"font-variation-settings: 'FILL' 1;\">wb_sunny</span>
                        </div>
                    </div>
                </div>

                <h1 class=\"font-headline text-3xl md:text-4xl font-extrabold text-on-surface tracking-tight mb-4\">
                    Check your inbox
                </h1>
                <p class=\"text-on-surface-variant text-lg leading-relaxed max-w-sm mb-10\">
                    We've sent a 6-digit verification code to <br><strong class=\"text-on-surface\">";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["email"]) || array_key_exists("email", $context) ? $context["email"] : (function () { throw new RuntimeError('Variable "email" does not exist.', 25, $this->source); })()), "html", null, true);
        yield "</strong>.
                </p>

                ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 28, $this->source); })()), "flashes", ["error"], "method", false, false, false, 28));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 29
            yield "                    <div class=\"mb-8 w-full p-4 rounded-xl bg-error-container text-on-error-container text-sm font-medium flex items-center justify-center gap-3\">
                        <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"error\">error</span>
                        ";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        yield "                ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 34, $this->source); })()), "flashes", ["success"], "method", false, false, false, 34));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 35
            yield "                    <div class=\"mb-8 w-full p-4 rounded-xl bg-secondary-container text-on-secondary-container text-sm font-medium flex items-center justify-center gap-3\">
                        <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"check_circle\">check_circle</span>
                        ";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        yield "
                <form class=\"w-full space-y-6\" method=\"post\" action=\"";
        // line 41
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_verify_email");
        yield "\">
                    <input type=\"hidden\" name=\"email\" value=\"";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["email"]) || array_key_exists("email", $context) ? $context["email"] : (function () { throw new RuntimeError('Variable "email" does not exist.', 42, $this->source); })()), "html", null, true);
        yield "\">
                    
                    <div class=\"space-y-2\">
                        <input type=\"text\" name=\"code\" id=\"code\" required autofocus placeholder=\"000000\" maxlength=\"6\"
                               class=\"w-full h-14 bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 rounded-xl px-4 text-center text-3xl tracking-[0.5em] font-mono text-on-surface placeholder:text-outline transition-all duration-300 outline-none\">
                    </div>

                    <button type=\"submit\" class=\"w-full sanctuary-gradient text-on-primary font-semibold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all active:scale-95 duration-200\">
                        Verify Account
                    </button>
                </form>

                <form class=\"mt-6 flex flex-col items-center gap-3\" method=\"post\" action=\"";
        // line 54
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_verify_resend");
        yield "\">
                    <input type=\"hidden\" name=\"email\" value=\"";
        // line 55
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["email"]) || array_key_exists("email", $context) ? $context["email"] : (function () { throw new RuntimeError('Variable "email" does not exist.', 55, $this->source); })()), "html", null, true);
        yield "\">
                    <button type=\"submit\" class=\"text-primary font-medium hover:text-on-primary-fixed-variant transition-colors inline-flex items-center justify-center gap-2 outline-none\">
                        <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"refresh\">refresh</span>
                        Resend Code
                    </button>
                    <p class=\"text-xs text-on-surface-variant/60 font-medium\">
                        Didn't receive anything? Check your spam folder.
                    </p>
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
        return "pages/verifyEmail.html.twig";
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
        return array (  188 => 55,  184 => 54,  169 => 42,  165 => 41,  162 => 40,  153 => 37,  149 => 35,  144 => 34,  135 => 31,  131 => 29,  127 => 28,  121 => 25,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
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
                
                <div class=\"relative w-48 h-48 mb-10 group\">
                    <div class=\"absolute inset-0 sanctuary-gradient opacity-10 blur-3xl rounded-full scale-125 transition-transform duration-700\"></div>
                    <div class=\"relative flex items-center justify-center w-full h-full rounded-full bg-surface-container-low overflow-hidden\">
                        <img alt=\"Serene morning sun shining through soft clouds\" class=\"w-full h-full object-cover mix-blend-multiply opacity-80\" src=\"https://lh3.googleusercontent.com/aida-public/AB6AXuCzyd3U7IcCLR2Me5DwR0nDaXcDm77YlUam3A7G3_6oIyHMxJZW6d6GPLlW7cyfX5Isg7a4Sm5dxwjO1MzXWyySx6ZVcP-uVOyV9R5dHHdN-gjPhRNcWHYozE7xN0ALcfxBl_v2XkPMJ6Uw1IAKklG3IfvwLZvRhICCPk2ua5G-EdF58co0NZNQKkkUbOr2mM2Vf0Xj6HKeOJq70l5ud5R_GsmzlrnRLpRp4I7sPQpHKJoJiljqNwSsDB0Qu8NQWD3XA2ZRzILw4g\"/>
                        <div class=\"absolute inset-0 flex items-center justify-center\">
                            <span class=\"material-symbols-outlined text-7xl text-primary\" data-icon=\"wb_sunny\" style=\"font-variation-settings: 'FILL' 1;\">wb_sunny</span>
                        </div>
                    </div>
                </div>

                <h1 class=\"font-headline text-3xl md:text-4xl font-extrabold text-on-surface tracking-tight mb-4\">
                    Check your inbox
                </h1>
                <p class=\"text-on-surface-variant text-lg leading-relaxed max-w-sm mb-10\">
                    We've sent a 6-digit verification code to <br><strong class=\"text-on-surface\">{{ email }}</strong>.
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

                <form class=\"w-full space-y-6\" method=\"post\" action=\"{{ path('app_verify_email') }}\">
                    <input type=\"hidden\" name=\"email\" value=\"{{ email }}\">
                    
                    <div class=\"space-y-2\">
                        <input type=\"text\" name=\"code\" id=\"code\" required autofocus placeholder=\"000000\" maxlength=\"6\"
                               class=\"w-full h-14 bg-surface-container-highest border-none focus:ring-2 focus:ring-primary/20 rounded-xl px-4 text-center text-3xl tracking-[0.5em] font-mono text-on-surface placeholder:text-outline transition-all duration-300 outline-none\">
                    </div>

                    <button type=\"submit\" class=\"w-full sanctuary-gradient text-on-primary font-semibold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transition-all active:scale-95 duration-200\">
                        Verify Account
                    </button>
                </form>

                <form class=\"mt-6 flex flex-col items-center gap-3\" method=\"post\" action=\"{{ path('app_verify_resend') }}\">
                    <input type=\"hidden\" name=\"email\" value=\"{{ email }}\">
                    <button type=\"submit\" class=\"text-primary font-medium hover:text-on-primary-fixed-variant transition-colors inline-flex items-center justify-center gap-2 outline-none\">
                        <span class=\"material-symbols-outlined text-[20px]\" data-icon=\"refresh\">refresh</span>
                        Resend Code
                    </button>
                    <p class=\"text-xs text-on-surface-variant/60 font-medium\">
                        Didn't receive anything? Check your spam folder.
                    </p>
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
", "pages/verifyEmail.html.twig", "C:\\Users\\user\\Documents\\fuck2\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\verifyEmail.html.twig");
    }
}
