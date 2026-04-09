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

/* pages/resetPassword.html.twig */
class __TwigTemplate_8dac08a4db5395a9115147d6057f5b8a extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/resetPassword.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/resetPassword.html.twig"));

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

        yield "Nouveau mot de passe - InnerTrack";
        
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
        yield "<div class=\"relative w-full max-w-lg\">
    <div class=\"absolute inset-0 bg-gradient-to-tr from-cyan-400/20 to-emerald-400/20 blur-3xl opacity-50 rounded-[3rem]\"></div>
    
    <div class=\"relative bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-[0_32px_64px_-16px_rgba(0,104,118,0.08)] p-10 lg:p-14 border border-white/50 text-center\">
        
        <h1 class=\"text-3xl font-semibold text-slate-800 tracking-tight mb-3 font-['Inter']\">Créer un nouveau mot de passe</h1>
        <p class=\"text-slate-500 text-sm font-medium mb-8\">Entrez le code reçu par email (<strong>";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["email"]) || array_key_exists("email", $context) ? $context["email"] : (function () { throw new RuntimeError('Variable "email" does not exist.', 12, $this->source); })()), "html", null, true);
        yield "</strong>) et votre nouveau mot de passe.</p>

        ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 14, $this->source); })()), "flashes", ["error"], "method", false, false, false, 14));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 15
            yield "            <div class=\"mb-6 p-4 rounded-2xl bg-red-50 text-red-600 text-sm font-medium border border-red-100 flex items-center gap-3\">
                <svg class=\"w-5 h-5 shrink-0\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"></path></svg>
                ";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        yield "
        <form method=\"post\" action=\"";
        // line 21
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_reset_password");
        yield "\" class=\"space-y-5 text-left\">
            <input type=\"hidden\" name=\"email\" value=\"";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["email"]) || array_key_exists("email", $context) ? $context["email"] : (function () { throw new RuntimeError('Variable "email" does not exist.', 22, $this->source); })()), "html", null, true);
        yield "\">
            
            <div class=\"space-y-2\">
                <label for=\"code\" class=\"block text-sm font-medium text-slate-700 ml-1\">Code de réinitialisation</label>
                <div class=\"relative group\">
                    <input type=\"text\" name=\"code\" id=\"code\" required autofocus placeholder=\"6 chiffres\" maxlength=\"6\"
                           class=\"w-full h-14 z-10 bg-slate-50 border-0 rounded-2xl px-5 text-slate-800 tracking-widest font-semibold placeholder-slate-400 focus:ring-0 focus:bg-white transition-all duration-300 peer\"
                           style=\"outline: none;\">
                    <div class=\"absolute inset-0 rounded-2xl border border-slate-200 pointer-events-none peer-focus:border-cyan-400 transition-colors duration-300\"></div>
                </div>
            </div>

            <div class=\"space-y-2\">
                <label for=\"password\" class=\"block text-sm font-medium text-slate-700 ml-1\">Nouveau mot de passe</label>
                <div class=\"relative group\">
                    <input type=\"password\" name=\"password\" id=\"password\" required
                           class=\"w-full h-14 bg-slate-50 border-0 rounded-2xl px-5 text-slate-800 placeholder-slate-400 focus:ring-0 focus:bg-white transition-all duration-300 peer\"
                           style=\"outline: none;\">
                    <div class=\"absolute inset-0 rounded-2xl border border-slate-200 pointer-events-none peer-focus:border-cyan-400 transition-colors duration-300\"></div>
                </div>
            </div>

            <div class=\"space-y-2\">
                <label for=\"confirm_password\" class=\"block text-sm font-medium text-slate-700 ml-1\">Confirmer le mot de passe</label>
                <div class=\"relative group\">
                    <input type=\"password\" name=\"confirm_password\" id=\"confirm_password\" required
                           class=\"w-full h-14 bg-slate-50 border-0 rounded-2xl px-5 text-slate-800 placeholder-slate-400 focus:ring-0 focus:bg-white transition-all duration-300 peer\"
                           style=\"outline: none;\">
                    <div class=\"absolute inset-0 rounded-2xl border border-slate-200 pointer-events-none peer-focus:border-cyan-400 transition-colors duration-300\"></div>
                </div>
            </div>

            <div class=\"pt-4\">
                <button type=\"submit\" class=\"w-full h-14 rounded-2xl bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-lg hover:shadow-[0_8px_24px_-8px_rgba(0,188,212,0.5)] transition-all duration-300\">
                    Réinitialiser
                </button>
            </div>
        </form>
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
        return "pages/resetPassword.html.twig";
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
        return array (  137 => 22,  133 => 21,  130 => 20,  121 => 17,  117 => 15,  113 => 14,  108 => 12,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/auth.html.twig' %}

{% block title %}Nouveau mot de passe - InnerTrack{% endblock %}

{% block body %}
<div class=\"relative w-full max-w-lg\">
    <div class=\"absolute inset-0 bg-gradient-to-tr from-cyan-400/20 to-emerald-400/20 blur-3xl opacity-50 rounded-[3rem]\"></div>
    
    <div class=\"relative bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-[0_32px_64px_-16px_rgba(0,104,118,0.08)] p-10 lg:p-14 border border-white/50 text-center\">
        
        <h1 class=\"text-3xl font-semibold text-slate-800 tracking-tight mb-3 font-['Inter']\">Créer un nouveau mot de passe</h1>
        <p class=\"text-slate-500 text-sm font-medium mb-8\">Entrez le code reçu par email (<strong>{{ email }}</strong>) et votre nouveau mot de passe.</p>

        {% for message in app.flashes('error') %}
            <div class=\"mb-6 p-4 rounded-2xl bg-red-50 text-red-600 text-sm font-medium border border-red-100 flex items-center gap-3\">
                <svg class=\"w-5 h-5 shrink-0\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"></path></svg>
                {{ message }}
            </div>
        {% endfor %}

        <form method=\"post\" action=\"{{ path('app_reset_password') }}\" class=\"space-y-5 text-left\">
            <input type=\"hidden\" name=\"email\" value=\"{{ email }}\">
            
            <div class=\"space-y-2\">
                <label for=\"code\" class=\"block text-sm font-medium text-slate-700 ml-1\">Code de réinitialisation</label>
                <div class=\"relative group\">
                    <input type=\"text\" name=\"code\" id=\"code\" required autofocus placeholder=\"6 chiffres\" maxlength=\"6\"
                           class=\"w-full h-14 z-10 bg-slate-50 border-0 rounded-2xl px-5 text-slate-800 tracking-widest font-semibold placeholder-slate-400 focus:ring-0 focus:bg-white transition-all duration-300 peer\"
                           style=\"outline: none;\">
                    <div class=\"absolute inset-0 rounded-2xl border border-slate-200 pointer-events-none peer-focus:border-cyan-400 transition-colors duration-300\"></div>
                </div>
            </div>

            <div class=\"space-y-2\">
                <label for=\"password\" class=\"block text-sm font-medium text-slate-700 ml-1\">Nouveau mot de passe</label>
                <div class=\"relative group\">
                    <input type=\"password\" name=\"password\" id=\"password\" required
                           class=\"w-full h-14 bg-slate-50 border-0 rounded-2xl px-5 text-slate-800 placeholder-slate-400 focus:ring-0 focus:bg-white transition-all duration-300 peer\"
                           style=\"outline: none;\">
                    <div class=\"absolute inset-0 rounded-2xl border border-slate-200 pointer-events-none peer-focus:border-cyan-400 transition-colors duration-300\"></div>
                </div>
            </div>

            <div class=\"space-y-2\">
                <label for=\"confirm_password\" class=\"block text-sm font-medium text-slate-700 ml-1\">Confirmer le mot de passe</label>
                <div class=\"relative group\">
                    <input type=\"password\" name=\"confirm_password\" id=\"confirm_password\" required
                           class=\"w-full h-14 bg-slate-50 border-0 rounded-2xl px-5 text-slate-800 placeholder-slate-400 focus:ring-0 focus:bg-white transition-all duration-300 peer\"
                           style=\"outline: none;\">
                    <div class=\"absolute inset-0 rounded-2xl border border-slate-200 pointer-events-none peer-focus:border-cyan-400 transition-colors duration-300\"></div>
                </div>
            </div>

            <div class=\"pt-4\">
                <button type=\"submit\" class=\"w-full h-14 rounded-2xl bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-lg hover:shadow-[0_8px_24px_-8px_rgba(0,188,212,0.5)] transition-all duration-300\">
                    Réinitialiser
                </button>
            </div>
        </form>
    </div>
</div>
{% endblock %}
", "pages/resetPassword.html.twig", "C:\\Users\\user\\Documents\\fuck2\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\resetPassword.html.twig");
    }
}
