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

/* pages/testpsy/resultat.html.twig */
class __TwigTemplate_d5ac10e4bf085da9028957db49cea3cf extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/resultat.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/resultat.html.twig"));

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

        yield "Votre Résultat";
        
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
        yield "<div class=\"max-w-2xl mx-auto pb-24\">

    <div class=\"bg-white rounded-[3rem] p-12 shadow-sm border border-outline/20 text-center\">

        <div class=\"w-20 h-20 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto mb-8\">
            <span class=\"material-symbols-outlined text-5xl\">emoji_events</span>
        </div>

        <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface mb-2\">Résultat obtenu</h1>
        <p class=\"text-sm text-on-surface-variant mb-10\">Voici votre analyse complète</p>

        <!-- Score ring -->
        <div class=\"relative w-40 h-40 mx-auto mb-10\">
            <svg class=\"w-full h-full -rotate-90\" viewBox=\"0 0 100 100\">
                <circle cx=\"50\" cy=\"50\" r=\"42\" fill=\"none\" stroke=\"#f3f4f6\" stroke-width=\"10\"/>
                <circle cx=\"50\" cy=\"50\" r=\"42\" fill=\"none\" stroke=\"var(--color-primary, #6366f1)\" stroke-width=\"10\"
                        stroke-dasharray=\"";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(((CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 22, $this->source); })()), "pourcentage", [], "any", false, false, false, 22) / 100) * 263.9)), "html", null, true);
        yield " 263.9\"
                        stroke-linecap=\"round\"/>
            </svg>
            <div class=\"absolute inset-0 flex flex-col items-center justify-center\">
                <span class=\"text-3xl font-extrabold text-on-surface font-headline\">";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 26, $this->source); })()), "pourcentage", [], "any", false, false, false, 26)), "html", null, true);
        yield "%</span>
                <span class=\"text-[10px] font-bold text-on-surface-variant uppercase tracking-widest\">Score</span>
            </div>
        </div>

        <!-- Stats -->
        <div class=\"grid grid-cols-2 gap-4 mb-8\">
            <div class=\"bg-gray-50/50 rounded-[1.5rem] p-6 border border-outline/10\">
                <div class=\"text-[10px] font-bold text-on-surface-variant tracking-[0.2em] uppercase mb-1\">Score total</div>
                <div class=\"text-2xl font-extrabold text-primary font-headline\">
                    ";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 36, $this->source); })()), "scoreTotal", [], "any", false, false, false, 36), "html", null, true);
        yield " <span class=\"text-base text-on-surface-variant font-medium\">/ ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 36, $this->source); })()), "scoreMaxPossible", [], "any", false, false, false, 36), "html", null, true);
        yield "</span>
                </div>
            </div>
            <div class=\"bg-gray-50/50 rounded-[1.5rem] p-6 border border-outline/10\">
                <div class=\"text-[10px] font-bold text-on-surface-variant tracking-[0.2em] uppercase mb-1\">Niveau</div>
                <div class=\"text-2xl font-extrabold text-on-surface font-headline\">";
        // line 41
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["resultat"] ?? null), "resultat", [], "any", true, true, false, 41) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 41, $this->source); })()), "resultat", [], "any", false, false, false, 41)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 41, $this->source); })()), "resultat", [], "any", false, false, false, 41), "html", null, true)) : ("N/A"));
        yield "</div>
            </div>
        </div>

        <!-- Interpretation -->
        ";
        // line 46
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 46, $this->source); })()), "interpretation", [], "any", false, false, false, 46)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 47
            yield "        <div class=\"bg-primary/5 rounded-[2rem] p-8 border border-primary/10 text-left mb-8\">
            <div class=\"flex items-center gap-3 mb-4\">
                <span class=\"material-symbols-outlined text-primary\">lightbulb</span>
                <span class=\"text-xs font-bold text-primary uppercase tracking-widest\">Interprétation</span>
            </div>
            <p class=\"text-sm text-on-surface leading-relaxed\">";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 52, $this->source); })()), "interpretation", [], "any", false, false, false, 52), "html", null, true);
            yield "</p>
        </div>
        ";
        }
        // line 55
        yield "
        <div class=\"flex gap-4\">
            <a href=\"";
        // line 57
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_index");
        yield "\"
               class=\"flex-1 py-4 text-sm font-bold text-on-surface-variant bg-gray-50 border border-outline/30 rounded-2xl hover:bg-white hover:border-outline transition-all active:scale-95 uppercase tracking-wider\">
                Retour aux tests
            </a>
            <a href=\"";
        // line 61
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_historique");
        yield "\"
               class=\"flex-1 py-4 text-sm font-bold text-white bg-primary rounded-2xl hover:bg-primary/90 transition-all active:scale-95 shadow-lg shadow-primary/20 uppercase tracking-wider\">
                Mon historique
            </a>
        </div>

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
        return "pages/testpsy/resultat.html.twig";
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
        return array (  182 => 61,  175 => 57,  171 => 55,  165 => 52,  158 => 47,  156 => 46,  148 => 41,  138 => 36,  125 => 26,  118 => 22,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}Votre Résultat{% endblock %}

{% block content %}
<div class=\"max-w-2xl mx-auto pb-24\">

    <div class=\"bg-white rounded-[3rem] p-12 shadow-sm border border-outline/20 text-center\">

        <div class=\"w-20 h-20 rounded-full bg-primary/10 text-primary flex items-center justify-center mx-auto mb-8\">
            <span class=\"material-symbols-outlined text-5xl\">emoji_events</span>
        </div>

        <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface mb-2\">Résultat obtenu</h1>
        <p class=\"text-sm text-on-surface-variant mb-10\">Voici votre analyse complète</p>

        <!-- Score ring -->
        <div class=\"relative w-40 h-40 mx-auto mb-10\">
            <svg class=\"w-full h-full -rotate-90\" viewBox=\"0 0 100 100\">
                <circle cx=\"50\" cy=\"50\" r=\"42\" fill=\"none\" stroke=\"#f3f4f6\" stroke-width=\"10\"/>
                <circle cx=\"50\" cy=\"50\" r=\"42\" fill=\"none\" stroke=\"var(--color-primary, #6366f1)\" stroke-width=\"10\"
                        stroke-dasharray=\"{{ (resultat.pourcentage / 100 * 263.9)|round }} 263.9\"
                        stroke-linecap=\"round\"/>
            </svg>
            <div class=\"absolute inset-0 flex flex-col items-center justify-center\">
                <span class=\"text-3xl font-extrabold text-on-surface font-headline\">{{ resultat.pourcentage|round }}%</span>
                <span class=\"text-[10px] font-bold text-on-surface-variant uppercase tracking-widest\">Score</span>
            </div>
        </div>

        <!-- Stats -->
        <div class=\"grid grid-cols-2 gap-4 mb-8\">
            <div class=\"bg-gray-50/50 rounded-[1.5rem] p-6 border border-outline/10\">
                <div class=\"text-[10px] font-bold text-on-surface-variant tracking-[0.2em] uppercase mb-1\">Score total</div>
                <div class=\"text-2xl font-extrabold text-primary font-headline\">
                    {{ resultat.scoreTotal }} <span class=\"text-base text-on-surface-variant font-medium\">/ {{ resultat.scoreMaxPossible }}</span>
                </div>
            </div>
            <div class=\"bg-gray-50/50 rounded-[1.5rem] p-6 border border-outline/10\">
                <div class=\"text-[10px] font-bold text-on-surface-variant tracking-[0.2em] uppercase mb-1\">Niveau</div>
                <div class=\"text-2xl font-extrabold text-on-surface font-headline\">{{ resultat.resultat ?? 'N/A' }}</div>
            </div>
        </div>

        <!-- Interpretation -->
        {% if resultat.interpretation %}
        <div class=\"bg-primary/5 rounded-[2rem] p-8 border border-primary/10 text-left mb-8\">
            <div class=\"flex items-center gap-3 mb-4\">
                <span class=\"material-symbols-outlined text-primary\">lightbulb</span>
                <span class=\"text-xs font-bold text-primary uppercase tracking-widest\">Interprétation</span>
            </div>
            <p class=\"text-sm text-on-surface leading-relaxed\">{{ resultat.interpretation }}</p>
        </div>
        {% endif %}

        <div class=\"flex gap-4\">
            <a href=\"{{ path('testpsy_index') }}\"
               class=\"flex-1 py-4 text-sm font-bold text-on-surface-variant bg-gray-50 border border-outline/30 rounded-2xl hover:bg-white hover:border-outline transition-all active:scale-95 uppercase tracking-wider\">
                Retour aux tests
            </a>
            <a href=\"{{ path('testpsy_historique') }}\"
               class=\"flex-1 py-4 text-sm font-bold text-white bg-primary rounded-2xl hover:bg-primary/90 transition-all active:scale-95 shadow-lg shadow-primary/20 uppercase tracking-wider\">
                Mon historique
            </a>
        </div>

    </div>
</div>
{% endblock %}", "pages/testpsy/resultat.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\testpsy\\resultat.html.twig");
    }
}
