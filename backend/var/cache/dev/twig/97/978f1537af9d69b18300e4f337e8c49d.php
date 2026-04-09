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

/* journal/entree/voir.html.twig */
class __TwigTemplate_0bdf7cda928a20a01b98eba21825f464 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "journal/entree/voir.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "journal/entree/voir.html.twig"));

        $this->parent = $this->load("layouts/dashboard.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
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

        // line 4
        yield "<div class=\"max-w-xl mx-auto\">

    ";
        // line 7
        yield "    <div class=\"rounded-2xl overflow-hidden mb-6\"
         style=\"background: linear-gradient(to right, #006876, #008a9a)\">
        <div class=\"px-8 py-6\">
            <h1 class=\"text-2xl font-bold text-white\">
                ";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entree"]) || array_key_exists("entree", $context) ? $context["entree"] : (function () { throw new RuntimeError('Variable "entree" does not exist.', 11, $this->source); })()), "emojiHumeur", [], "any", false, false, false, 11), "html", null, true);
        yield " Journal du ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entree"]) || array_key_exists("entree", $context) ? $context["entree"] : (function () { throw new RuntimeError('Variable "entree" does not exist.', 11, $this->source); })()), "dateSaisie", [], "any", false, false, false, 11), "d/m/Y"), "html", null, true);
        yield "
            </h1>
            <p class=\"text-[#b2e8ed] text-sm mt-1\">Entrée personnelle</p>
        </div>
    </div>

    ";
        // line 18
        yield "    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-4\">
        <h2 class=\"text-sm font-bold text-gray-500 mb-4\">😊 Humeur du jour</h2>
        <div class=\"flex items-center gap-4\">
            <span class=\"text-5xl\">";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entree"]) || array_key_exists("entree", $context) ? $context["entree"] : (function () { throw new RuntimeError('Variable "entree" does not exist.', 21, $this->source); })()), "emojiHumeur", [], "any", false, false, false, 21), "html", null, true);
        yield "</span>
            <div>
                <span class=\"inline-flex items-center px-4 py-2 rounded-full text-sm font-bold\"
                      style=\"background-color: ";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entree"]) || array_key_exists("entree", $context) ? $context["entree"] : (function () { throw new RuntimeError('Variable "entree" does not exist.', 24, $this->source); })()), "couleurHumeur", [], "any", false, false, false, 24), "html", null, true);
        yield "22; color: ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entree"]) || array_key_exists("entree", $context) ? $context["entree"] : (function () { throw new RuntimeError('Variable "entree" does not exist.', 24, $this->source); })()), "couleurHumeur", [], "any", false, false, false, 24), "html", null, true);
        yield "\">
                    ";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entree"]) || array_key_exists("entree", $context) ? $context["entree"] : (function () { throw new RuntimeError('Variable "entree" does not exist.', 25, $this->source); })()), "labelHumeur", [], "any", false, false, false, 25), "html", null, true);
        yield " — ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entree"]) || array_key_exists("entree", $context) ? $context["entree"] : (function () { throw new RuntimeError('Variable "entree" does not exist.', 25, $this->source); })()), "humeur", [], "any", false, false, false, 25), "html", null, true);
        yield "/10
                </span>
            </div>
        </div>

        ";
        // line 31
        yield "        <div class=\"mt-4\">
            <div class=\"w-full bg-gray-100 rounded-full h-2\">
                <div class=\"h-2 rounded-full transition-all\"
                     style=\"width: ";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(((CoreExtension::getAttribute($this->env, $this->source, (isset($context["entree"]) || array_key_exists("entree", $context) ? $context["entree"] : (function () { throw new RuntimeError('Variable "entree" does not exist.', 34, $this->source); })()), "humeur", [], "any", false, false, false, 34) / 10) * 100)), "html", null, true);
        yield "%; background-color: ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entree"]) || array_key_exists("entree", $context) ? $context["entree"] : (function () { throw new RuntimeError('Variable "entree" does not exist.', 34, $this->source); })()), "couleurHumeur", [], "any", false, false, false, 34), "html", null, true);
        yield "\">
                </div>
            </div>
            <div class=\"flex justify-between text-xs text-gray-400 mt-1\">
                <span>0</span><span>10</span>
            </div>
        </div>
    </div>

    ";
        // line 44
        yield "    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6\">
        <h2 class=\"text-sm font-bold text-gray-500 mb-3\">📝 Note du jour</h2>
        <p class=\"text-sm text-gray-700 bg-gray-50 rounded-xl p-4 leading-relaxed whitespace-pre-line\">
            ";
        // line 47
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["entree"]) || array_key_exists("entree", $context) ? $context["entree"] : (function () { throw new RuntimeError('Variable "entree" does not exist.', 47, $this->source); })()), "noteTextuelle", [], "any", false, false, false, 47)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["entree"]) || array_key_exists("entree", $context) ? $context["entree"] : (function () { throw new RuntimeError('Variable "entree" does not exist.', 47, $this->source); })()), "noteTextuelle", [], "any", false, false, false, 47), "html", null, true)) : ("Aucune note."));
        yield "
        </p>
    </div>

    ";
        // line 52
        yield "    <div class=\"flex gap-3\">
        <a href=\"";
        // line 53
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("entree_index");
        yield "\"
           class=\"flex-1 text-center bg-gray-100 text-gray-600 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-200 transition\">
            ← Retour
        </a>
        <a href=\"";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("entree_modifier", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["entree"]) || array_key_exists("entree", $context) ? $context["entree"] : (function () { throw new RuntimeError('Variable "entree" does not exist.', 57, $this->source); })()), "idJournal", [], "any", false, false, false, 57)]), "html", null, true);
        yield "\"
           class=\"flex-1 text-center bg-[#006876] text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-[#005562] transition\">
            ✏️ Modifier
        </a>
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
        return "journal/entree/voir.html.twig";
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
        return array (  165 => 57,  158 => 53,  155 => 52,  148 => 47,  143 => 44,  129 => 34,  124 => 31,  114 => 25,  108 => 24,  102 => 21,  97 => 18,  86 => 11,  80 => 7,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}
<div class=\"max-w-xl mx-auto\">

    {# EN-TÊTE #}
    <div class=\"rounded-2xl overflow-hidden mb-6\"
         style=\"background: linear-gradient(to right, #006876, #008a9a)\">
        <div class=\"px-8 py-6\">
            <h1 class=\"text-2xl font-bold text-white\">
                {{ entree.emojiHumeur }} Journal du {{ entree.dateSaisie|date('d/m/Y') }}
            </h1>
            <p class=\"text-[#b2e8ed] text-sm mt-1\">Entrée personnelle</p>
        </div>
    </div>

    {# HUMEUR #}
    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-4\">
        <h2 class=\"text-sm font-bold text-gray-500 mb-4\">😊 Humeur du jour</h2>
        <div class=\"flex items-center gap-4\">
            <span class=\"text-5xl\">{{ entree.emojiHumeur }}</span>
            <div>
                <span class=\"inline-flex items-center px-4 py-2 rounded-full text-sm font-bold\"
                      style=\"background-color: {{ entree.couleurHumeur }}22; color: {{ entree.couleurHumeur }}\">
                    {{ entree.labelHumeur }} — {{ entree.humeur }}/10
                </span>
            </div>
        </div>

        {# Barre de progression #}
        <div class=\"mt-4\">
            <div class=\"w-full bg-gray-100 rounded-full h-2\">
                <div class=\"h-2 rounded-full transition-all\"
                     style=\"width: {{ (entree.humeur / 10 * 100)|round }}%; background-color: {{ entree.couleurHumeur }}\">
                </div>
            </div>
            <div class=\"flex justify-between text-xs text-gray-400 mt-1\">
                <span>0</span><span>10</span>
            </div>
        </div>
    </div>

    {# NOTE #}
    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6\">
        <h2 class=\"text-sm font-bold text-gray-500 mb-3\">📝 Note du jour</h2>
        <p class=\"text-sm text-gray-700 bg-gray-50 rounded-xl p-4 leading-relaxed whitespace-pre-line\">
            {{ entree.noteTextuelle ?: 'Aucune note.' }}
        </p>
    </div>

    {# ACTIONS #}
    <div class=\"flex gap-3\">
        <a href=\"{{ path('entree_index') }}\"
           class=\"flex-1 text-center bg-gray-100 text-gray-600 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-200 transition\">
            ← Retour
        </a>
        <a href=\"{{ path('entree_modifier', {id: entree.idJournal}) }}\"
           class=\"flex-1 text-center bg-[#006876] text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-[#005562] transition\">
            ✏️ Modifier
        </a>
    </div>

</div>
{% endblock %}", "journal/entree/voir.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\Journal\\entree\\voir.html.twig");
    }
}
