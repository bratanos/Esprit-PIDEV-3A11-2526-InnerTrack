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

/* Journal/habitude/voir.html.twig */
class __TwigTemplate_5d76f3371c1a81a489efa08c5df900cc extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "Journal/habitude/voir.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "Journal/habitude/voir.html.twig"));

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
         style=\"background: linear-gradient(to right, #5a3ea1, #7c5cbf)\">
        <div class=\"px-8 py-6\">
            <h1 class=\"text-2xl font-bold text-white\">🌿 ";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 10, $this->source); })()), "nomHabitude", [], "any", false, false, false, 10), "html", null, true);
        yield "</h1>
            <p class=\"text-[#d8ccf5] text-sm mt-1\">
                📅 ";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 12, $this->source); })()), "dateCreation", [], "any", false, false, false, 12), "d/m/Y"), "html", null, true);
        yield "
                &nbsp;•&nbsp;
                ";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 14, $this->source); })()), "emotionDominantes", [], "any", false, false, false, 14), "html", null, true);
        yield "
            </p>
        </div>
    </div>

    ";
        // line 20
        yield "    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-4\">
        <h2 class=\"text-sm font-bold text-gray-500 mb-4\">📊 Niveaux du jour</h2>
        <div class=\"space-y-3\">

            ";
        // line 25
        yield "            <div class=\"flex items-center gap-4\">
                <span class=\"text-xs text-gray-400 w-24\">⚡ Énergie</span>
                <span class=\"inline-flex items-center gap-1 px-4 py-1.5 rounded-full text-xs font-bold\"
                      style=\"background-color: ";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 28, $this->source); })()), "couleurEnergie", [], "any", false, false, false, 28), "html", null, true);
        yield "22; color: ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 28, $this->source); })()), "couleurEnergie", [], "any", false, false, false, 28), "html", null, true);
        yield "\">
                    ";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 29, $this->source); })()), "emojiEnergie", [], "any", false, false, false, 29), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 29, $this->source); })()), "niveauEnergie", [], "any", false, false, false, 29), "html", null, true);
        yield "/10 — ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 29, $this->source); })()), "labelEnergie", [], "any", false, false, false, 29), "html", null, true);
        yield "
                </span>
            </div>

            ";
        // line 34
        yield "            <div class=\"flex items-center gap-4\">
                <span class=\"text-xs text-gray-400 w-24\">😰 Stress</span>
                <span class=\"inline-flex items-center gap-1 px-4 py-1.5 rounded-full text-xs font-bold\"
                      style=\"background-color: ";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 37, $this->source); })()), "couleurStress", [], "any", false, false, false, 37), "html", null, true);
        yield "22; color: ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 37, $this->source); })()), "couleurStress", [], "any", false, false, false, 37), "html", null, true);
        yield "\">
                    ";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 38, $this->source); })()), "emojiStress", [], "any", false, false, false, 38), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 38, $this->source); })()), "niveauStress", [], "any", false, false, false, 38), "html", null, true);
        yield "/10 — ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 38, $this->source); })()), "labelStress", [], "any", false, false, false, 38), "html", null, true);
        yield "
                </span>
            </div>

            ";
        // line 43
        yield "            <div class=\"flex items-center gap-4\">
                <span class=\"text-xs text-gray-400 w-24\">😴 Sommeil</span>
                <span class=\"inline-flex items-center gap-1 px-4 py-1.5 rounded-full text-xs font-bold\"
                      style=\"background-color: ";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 46, $this->source); })()), "couleurSommeil", [], "any", false, false, false, 46), "html", null, true);
        yield "22; color: ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 46, $this->source); })()), "couleurSommeil", [], "any", false, false, false, 46), "html", null, true);
        yield "\">
                    ";
        // line 47
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 47, $this->source); })()), "emojiSommeil", [], "any", false, false, false, 47), "html", null, true);
        yield " ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 47, $this->source); })()), "qualiteSommeil", [], "any", false, false, false, 47), "html", null, true);
        yield "/10 — ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 47, $this->source); })()), "labelSommeil", [], "any", false, false, false, 47), "html", null, true);
        yield "
                </span>
            </div>

        </div>
    </div>

    ";
        // line 55
        yield "    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6\">
        <h2 class=\"text-sm font-bold text-gray-500 mb-3\">📝 Note personnelle</h2>
        <p class=\"text-sm text-gray-700 bg-gray-50 rounded-xl p-4 leading-relaxed\">
            ";
        // line 58
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 58, $this->source); })()), "noteTextuelle", [], "any", false, false, false, 58)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 58, $this->source); })()), "noteTextuelle", [], "any", false, false, false, 58), "html", null, true)) : ("Aucune note."));
        yield "
        </p>
    </div>

    ";
        // line 63
        yield "    <div class=\"flex gap-3\">
        <a href=\"";
        // line 64
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("habitude_index");
        yield "\"
           class=\"flex-1 text-center bg-gray-100 text-gray-600 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-200 transition\">
            ← Retour
        </a>
        <a href=\"";
        // line 68
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("habitude_modifier", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["habitude"]) || array_key_exists("habitude", $context) ? $context["habitude"] : (function () { throw new RuntimeError('Variable "habitude" does not exist.', 68, $this->source); })()), "idHabit", [], "any", false, false, false, 68)]), "html", null, true);
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
        return "Journal/habitude/voir.html.twig";
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
        return array (  200 => 68,  193 => 64,  190 => 63,  183 => 58,  178 => 55,  164 => 47,  158 => 46,  153 => 43,  142 => 38,  136 => 37,  131 => 34,  120 => 29,  114 => 28,  109 => 25,  103 => 20,  95 => 14,  90 => 12,  85 => 10,  80 => 7,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}
<div class=\"max-w-xl mx-auto\">

    {# EN-TÊTE #}
    <div class=\"rounded-2xl overflow-hidden mb-6\"
         style=\"background: linear-gradient(to right, #5a3ea1, #7c5cbf)\">
        <div class=\"px-8 py-6\">
            <h1 class=\"text-2xl font-bold text-white\">🌿 {{ habitude.nomHabitude }}</h1>
            <p class=\"text-[#d8ccf5] text-sm mt-1\">
                📅 {{ habitude.dateCreation|date('d/m/Y') }}
                &nbsp;•&nbsp;
                {{ habitude.emotionDominantes }}
            </p>
        </div>
    </div>

    {# INDICATEURS #}
    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-4\">
        <h2 class=\"text-sm font-bold text-gray-500 mb-4\">📊 Niveaux du jour</h2>
        <div class=\"space-y-3\">

            {# Énergie #}
            <div class=\"flex items-center gap-4\">
                <span class=\"text-xs text-gray-400 w-24\">⚡ Énergie</span>
                <span class=\"inline-flex items-center gap-1 px-4 py-1.5 rounded-full text-xs font-bold\"
                      style=\"background-color: {{ habitude.couleurEnergie }}22; color: {{ habitude.couleurEnergie }}\">
                    {{ habitude.emojiEnergie }} {{ habitude.niveauEnergie }}/10 — {{ habitude.labelEnergie }}
                </span>
            </div>

            {# Stress #}
            <div class=\"flex items-center gap-4\">
                <span class=\"text-xs text-gray-400 w-24\">😰 Stress</span>
                <span class=\"inline-flex items-center gap-1 px-4 py-1.5 rounded-full text-xs font-bold\"
                      style=\"background-color: {{ habitude.couleurStress }}22; color: {{ habitude.couleurStress }}\">
                    {{ habitude.emojiStress }} {{ habitude.niveauStress }}/10 — {{ habitude.labelStress }}
                </span>
            </div>

            {# Sommeil #}
            <div class=\"flex items-center gap-4\">
                <span class=\"text-xs text-gray-400 w-24\">😴 Sommeil</span>
                <span class=\"inline-flex items-center gap-1 px-4 py-1.5 rounded-full text-xs font-bold\"
                      style=\"background-color: {{ habitude.couleurSommeil }}22; color: {{ habitude.couleurSommeil }}\">
                    {{ habitude.emojiSommeil }} {{ habitude.qualiteSommeil }}/10 — {{ habitude.labelSommeil }}
                </span>
            </div>

        </div>
    </div>

    {# NOTE #}
    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6\">
        <h2 class=\"text-sm font-bold text-gray-500 mb-3\">📝 Note personnelle</h2>
        <p class=\"text-sm text-gray-700 bg-gray-50 rounded-xl p-4 leading-relaxed\">
            {{ habitude.noteTextuelle ?: 'Aucune note.' }}
        </p>
    </div>

    {# ACTIONS #}
    <div class=\"flex gap-3\">
        <a href=\"{{ path('habitude_index') }}\"
           class=\"flex-1 text-center bg-gray-100 text-gray-600 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-200 transition\">
            ← Retour
        </a>
        <a href=\"{{ path('habitude_modifier', {id: habitude.idHabit}) }}\"
           class=\"flex-1 text-center bg-[#006876] text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-[#005562] transition\">
            ✏️ Modifier
        </a>
    </div>

</div>
{% endblock %}", "Journal/habitude/voir.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\Journal\\habitude\\voir.html.twig");
    }
}
