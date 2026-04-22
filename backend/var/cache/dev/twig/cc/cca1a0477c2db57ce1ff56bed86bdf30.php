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

/* pages/profile/changePassword.html.twig */
class __TwigTemplate_7a1dc8255d13cb12736a3585e2be503f extends Template
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
            'header_title' => [$this, 'block_header_title'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/profile/changePassword.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/profile/changePassword.html.twig"));

        $this->parent = $this->load("layouts/dashboard.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_header_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_title"));

        yield "Modifier le mot de passe";
        
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
        yield "<div class=\"max-w-2xl mx-auto space-y-8\">
    
    ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 8, $this->source); })()), "flashes", ["error"], "method", false, false, false, 8));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 9
            yield "        <div class=\"p-4 rounded-xl bg-red-50 text-red-600 text-sm font-medium border border-red-100 flex items-center gap-3\">
            <svg class=\"w-5 h-5 shrink-0\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"></path></svg>
            ";
            // line 11
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        yield "
    <div class=\"bg-white rounded-[2rem] p-8 lg:p-10 shadow-sm border border-[#e5f7f6]\">
        <h3 class=\"text-xl font-bold text-[#0e1e1e] mb-6\">Sécurité</h3>
        
        <form method=\"POST\" class=\"space-y-6\">
            <div class=\"space-y-2\">
                <label class=\"block text-sm font-medium text-slate-700 ml-1\">Mot de passe actuel</label>
                <input type=\"password\" name=\"currentPassword\" required
                       class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
            </div>
            
            <div class=\"border-t border-slate-100 pt-6 space-y-6\">
                <div class=\"space-y-2\">
                    <label class=\"block text-sm font-medium text-slate-700 ml-1\">Nouveau mot de passe</label>
                    <input type=\"password\" name=\"newPassword\" required minlength=\"6\"
                           class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                </div>
                
                <div class=\"space-y-2\">
                    <label class=\"block text-sm font-medium text-slate-700 ml-1\">Confirmer</label>
                    <input type=\"password\" name=\"confirmPassword\" required minlength=\"6\"
                           class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                </div>
            </div>

            <div class=\"flex items-center justify-between pt-4\">
                <a href=\"";
        // line 40
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile");
        yield "\" class=\"text-slate-500 hover:text-slate-800 font-medium text-sm transition transition-colors\">← Retour au profil</a>
                <button type=\"submit\" class=\"px-8 py-3 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-semibold shadow-[0_8px_24px_-8px_rgba(0,188,212,0.5)] transition-all\">
                    Changer le mot de passe
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
        return "pages/profile/changePassword.html.twig";
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
        return array (  149 => 40,  121 => 14,  112 => 11,  108 => 9,  104 => 8,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}Modifier le mot de passe{% endblock %}

{% block content %}
<div class=\"max-w-2xl mx-auto space-y-8\">
    
    {% for message in app.flashes('error') %}
        <div class=\"p-4 rounded-xl bg-red-50 text-red-600 text-sm font-medium border border-red-100 flex items-center gap-3\">
            <svg class=\"w-5 h-5 shrink-0\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"></path></svg>
            {{ message }}
        </div>
    {% endfor %}

    <div class=\"bg-white rounded-[2rem] p-8 lg:p-10 shadow-sm border border-[#e5f7f6]\">
        <h3 class=\"text-xl font-bold text-[#0e1e1e] mb-6\">Sécurité</h3>
        
        <form method=\"POST\" class=\"space-y-6\">
            <div class=\"space-y-2\">
                <label class=\"block text-sm font-medium text-slate-700 ml-1\">Mot de passe actuel</label>
                <input type=\"password\" name=\"currentPassword\" required
                       class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
            </div>
            
            <div class=\"border-t border-slate-100 pt-6 space-y-6\">
                <div class=\"space-y-2\">
                    <label class=\"block text-sm font-medium text-slate-700 ml-1\">Nouveau mot de passe</label>
                    <input type=\"password\" name=\"newPassword\" required minlength=\"6\"
                           class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                </div>
                
                <div class=\"space-y-2\">
                    <label class=\"block text-sm font-medium text-slate-700 ml-1\">Confirmer</label>
                    <input type=\"password\" name=\"confirmPassword\" required minlength=\"6\"
                           class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                </div>
            </div>

            <div class=\"flex items-center justify-between pt-4\">
                <a href=\"{{ path('app_profile') }}\" class=\"text-slate-500 hover:text-slate-800 font-medium text-sm transition transition-colors\">← Retour au profil</a>
                <button type=\"submit\" class=\"px-8 py-3 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-semibold shadow-[0_8px_24px_-8px_rgba(0,188,212,0.5)] transition-all\">
                    Changer le mot de passe
                </button>
            </div>
        </form>
    </div>
</div>
{% endblock %}
", "pages/profile/changePassword.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\profile\\changePassword.html.twig");
    }
}
