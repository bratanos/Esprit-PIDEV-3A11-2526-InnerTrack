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

/* journal/habitude/index.html.twig */
class __TwigTemplate_1337be19899e77b1ad123412ce570b7a extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "journal/habitude/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "journal/habitude/index.html.twig"));

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
        yield "
";
        // line 6
        yield "<div class=\"flex items-center justify-between mb-8\">
    <div>
        <h1 class=\"text-2xl font-bold text-[#006876]\">🌿 Mes Habitudes</h1>
        <p class=\"text-sm text-gray-500 mt-1\">Suivez vos habitudes quotidiennes</p>
    </div>
    <a href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("habitude_ajouter");
        yield "\"
       class=\"inline-flex items-center gap-2 bg-[#006876] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#005562] transition\">
        ＋ Ajouter une habitude
    </a>
</div>

";
        // line 18
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 18, $this->source); })()), "total", [], "any", false, false, false, 18) > 0)) {
            // line 19
            yield "<div class=\"grid grid-cols-2 md:grid-cols-4 gap-4 mb-8\">
    ";
            // line 20
            $context["statCards"] = [["label" => "Total", "value" => CoreExtension::getAttribute($this->env, $this->source,             // line 21
(isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 21, $this->source); })()), "total", [], "any", false, false, false, 21), "emoji" => "📋", "color" => "#006876"], ["label" => "Énergie moy.", "value" => $this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source,             // line 22
(isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 22, $this->source); })()), "avgEnergie", [], "any", false, false, false, 22), 1), "emoji" => "⚡", "color" => "#48bb78"], ["label" => "Stress moy.", "value" => $this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source,             // line 23
(isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 23, $this->source); })()), "avgStress", [], "any", false, false, false, 23), 1), "emoji" => "😰", "color" => "#f6ad55"], ["label" => "Sommeil moy.", "value" => $this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source,             // line 24
(isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 24, $this->source); })()), "avgSommeil", [], "any", false, false, false, 24), 1), "emoji" => "😴", "color" => "#b794f4"]];
            // line 26
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["statCards"]) || array_key_exists("statCards", $context) ? $context["statCards"] : (function () { throw new RuntimeError('Variable "statCards" does not exist.', 26, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["card"]) {
                // line 27
                yield "    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-4 text-center\">
        <div class=\"text-2xl mb-1\">";
                // line 28
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["card"], "emoji", [], "any", false, false, false, 28), "html", null, true);
                yield "</div>
        <div class=\"text-xl font-bold\" style=\"color: ";
                // line 29
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["card"], "color", [], "any", false, false, false, 29), "html", null, true);
                yield "\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["card"], "value", [], "any", false, false, false, 29), "html", null, true);
                yield "</div>
        <div class=\"text-xs text-gray-400 mt-1\">";
                // line 30
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["card"], "label", [], "any", false, false, false, 30), "html", null, true);
                yield "</div>
    </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['card'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 33
            yield "</div>
";
        }
        // line 35
        yield "
";
        // line 37
        yield "<form method=\"GET\" class=\"mb-6 flex gap-3\">
    <input type=\"text\" name=\"q\" value=\"";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["keyword"]) || array_key_exists("keyword", $context) ? $context["keyword"] : (function () { throw new RuntimeError('Variable "keyword" does not exist.', 38, $this->source); })()), "html", null, true);
        yield "\"
           placeholder=\"🔍 Rechercher par nom ou émotion...\"
           class=\"flex-1 rounded-xl border border-gray-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#006876]\">
    <button type=\"submit\"
            class=\"bg-[#006876] text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-[#005562] transition\">
        Rechercher
    </button>
    ";
        // line 45
        if ((($tmp = (isset($context["keyword"]) || array_key_exists("keyword", $context) ? $context["keyword"] : (function () { throw new RuntimeError('Variable "keyword" does not exist.', 45, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 46
            yield "    <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("habitude_index");
            yield "\"
       class=\"bg-gray-100 text-gray-600 px-4 py-2 rounded-xl text-sm hover:bg-gray-200 transition\">
        ✕ Effacer
    </a>
    ";
        }
        // line 51
        yield "</form>

";
        // line 54
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["habitudes"]) || array_key_exists("habitudes", $context) ? $context["habitudes"] : (function () { throw new RuntimeError('Variable "habitudes" does not exist.', 54, $this->source); })()))) {
            // line 55
            yield "<div class=\"text-center py-16 text-gray-400\">
    <div class=\"text-5xl mb-4\">🌱</div>
    <p class=\"text-lg font-medium\">Aucune habitude trouvée</p>
    <p class=\"text-sm mt-1\">Commencez par en ajouter une !</p>
</div>
";
        } else {
            // line 61
            yield "<div class=\"overflow-x-auto rounded-2xl border border-gray-100 shadow-sm\">
    <table class=\"w-full text-sm\">
        <thead class=\"bg-gradient-to-r from-[#006876] to-[#008a9a] text-white\">
            <tr>
                <th class=\"px-4 py-3 text-left font-semibold\">🌿 Habitude</th>
                <th class=\"px-4 py-3 text-left font-semibold\">💭 Émotion</th>
                <th class=\"px-4 py-3 text-center font-semibold\">⚡ Énergie</th>
                <th class=\"px-4 py-3 text-center font-semibold\">😰 Stress</th>
                <th class=\"px-4 py-3 text-center font-semibold\">😴 Sommeil</th>
                <th class=\"px-4 py-3 text-center font-semibold\">📅 Date</th>
                <th class=\"px-4 py-3 text-center font-semibold\">Actions</th>
            </tr>
        </thead>
        <tbody class=\"divide-y divide-gray-50 bg-white\">
            ";
            // line 75
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["habitudes"]) || array_key_exists("habitudes", $context) ? $context["habitudes"] : (function () { throw new RuntimeError('Variable "habitudes" does not exist.', 75, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["h"]) {
                // line 76
                yield "            <tr class=\"hover:bg-[#f0fdfd] transition\">

                <td class=\"px-4 py-3 font-medium text-gray-800\">
                    ";
                // line 79
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "nomHabitude", [], "any", false, false, false, 79), "html", null, true);
                yield "
                </td>

                <td class=\"px-4 py-3 text-gray-500 text-xs\">
                    ";
                // line 83
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "emotionDominantes", [], "any", false, false, false, 83), "html", null, true);
                yield "
                </td>

                ";
                // line 87
                yield "                <td class=\"px-4 py-3 text-center\">
                    <span class=\"inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold\"
                          style=\"background-color: ";
                // line 89
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "couleurEnergie", [], "any", false, false, false, 89), "html", null, true);
                yield "22; color: ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "couleurEnergie", [], "any", false, false, false, 89), "html", null, true);
                yield "\">
                        ";
                // line 90
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "emojiEnergie", [], "any", false, false, false, 90), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "niveauEnergie", [], "any", false, false, false, 90), "html", null, true);
                yield " — ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "labelEnergie", [], "any", false, false, false, 90), "html", null, true);
                yield "
                    </span>
                </td>

                ";
                // line 95
                yield "                <td class=\"px-4 py-3 text-center\">
                    <span class=\"inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold\"
                          style=\"background-color: ";
                // line 97
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "couleurStress", [], "any", false, false, false, 97), "html", null, true);
                yield "22; color: ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "couleurStress", [], "any", false, false, false, 97), "html", null, true);
                yield "\">
                        ";
                // line 98
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "emojiStress", [], "any", false, false, false, 98), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "niveauStress", [], "any", false, false, false, 98), "html", null, true);
                yield " — ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "labelStress", [], "any", false, false, false, 98), "html", null, true);
                yield "
                    </span>
                </td>

                ";
                // line 103
                yield "                <td class=\"px-4 py-3 text-center\">
                    <span class=\"inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold\"
                          style=\"background-color: ";
                // line 105
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "couleurSommeil", [], "any", false, false, false, 105), "html", null, true);
                yield "22; color: ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "couleurSommeil", [], "any", false, false, false, 105), "html", null, true);
                yield "\">
                        ";
                // line 106
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "emojiSommeil", [], "any", false, false, false, 106), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "qualiteSommeil", [], "any", false, false, false, 106), "html", null, true);
                yield " — ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "labelSommeil", [], "any", false, false, false, 106), "html", null, true);
                yield "
                    </span>
                </td>

                <td class=\"px-4 py-3 text-center text-gray-400 text-xs\">
                    ";
                // line 111
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "dateCreation", [], "any", false, false, false, 111), "d/m/Y"), "html", null, true);
                yield "
                </td>

                ";
                // line 115
                yield "                <td class=\"px-4 py-3\">
                    <div class=\"flex items-center justify-center gap-2\">
                        <a href=\"";
                // line 117
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("habitude_voir", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idHabit", [], "any", false, false, false, 117)]), "html", null, true);
                yield "\"
                           class=\"bg-[#006876] text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-[#005562] transition\">
                            👁 Voir
                        </a>
                        <a href=\"";
                // line 121
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("habitude_modifier", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idHabit", [], "any", false, false, false, 121)]), "html", null, true);
                yield "\"
                           class=\"bg-amber-400 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-amber-500 transition\">
                            ✏️
                        </a>
                        <form method=\"POST\"
                              action=\"";
                // line 126
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("habitude_supprimer", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idHabit", [], "any", false, false, false, 126)]), "html", null, true);
                yield "\"
                              onsubmit=\"return confirm('Supprimer cette habitude ?')\">
                            <input type=\"hidden\" name=\"_token\"
                                   value=\"";
                // line 129
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete-habitude-" . CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idHabit", [], "any", false, false, false, 129))), "html", null, true);
                yield "\">
                            <button type=\"submit\"
                                    class=\"bg-red-400 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-500 transition\">
                                🗑
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['h'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 140
            yield "        </tbody>
    </table>
</div>
";
        }
        // line 144
        yield "
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
        return "journal/habitude/index.html.twig";
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
        return array (  334 => 144,  328 => 140,  311 => 129,  305 => 126,  297 => 121,  290 => 117,  286 => 115,  280 => 111,  268 => 106,  262 => 105,  258 => 103,  247 => 98,  241 => 97,  237 => 95,  226 => 90,  220 => 89,  216 => 87,  210 => 83,  203 => 79,  198 => 76,  194 => 75,  178 => 61,  170 => 55,  168 => 54,  164 => 51,  155 => 46,  153 => 45,  143 => 38,  140 => 37,  137 => 35,  133 => 33,  124 => 30,  118 => 29,  114 => 28,  111 => 27,  106 => 26,  104 => 24,  103 => 23,  102 => 22,  101 => 21,  100 => 20,  97 => 19,  95 => 18,  86 => 11,  79 => 6,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}

{# ── EN-TÊTE ── #}
<div class=\"flex items-center justify-between mb-8\">
    <div>
        <h1 class=\"text-2xl font-bold text-[#006876]\">🌿 Mes Habitudes</h1>
        <p class=\"text-sm text-gray-500 mt-1\">Suivez vos habitudes quotidiennes</p>
    </div>
    <a href=\"{{ path('habitude_ajouter') }}\"
       class=\"inline-flex items-center gap-2 bg-[#006876] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#005562] transition\">
        ＋ Ajouter une habitude
    </a>
</div>

{# ── STATS ── #}
{% if stats.total > 0 %}
<div class=\"grid grid-cols-2 md:grid-cols-4 gap-4 mb-8\">
    {% set statCards = [
        { label: 'Total',        value: stats.total,                       emoji: '📋', color: '#006876' },
        { label: 'Énergie moy.', value: stats.avgEnergie|number_format(1), emoji: '⚡', color: '#48bb78' },
        { label: 'Stress moy.',  value: stats.avgStress|number_format(1),  emoji: '😰', color: '#f6ad55' },
        { label: 'Sommeil moy.', value: stats.avgSommeil|number_format(1), emoji: '😴', color: '#b794f4' },
    ] %}
    {% for card in statCards %}
    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-4 text-center\">
        <div class=\"text-2xl mb-1\">{{ card.emoji }}</div>
        <div class=\"text-xl font-bold\" style=\"color: {{ card.color }}\">{{ card.value }}</div>
        <div class=\"text-xs text-gray-400 mt-1\">{{ card.label }}</div>
    </div>
    {% endfor %}
</div>
{% endif %}

{# ── RECHERCHE ── #}
<form method=\"GET\" class=\"mb-6 flex gap-3\">
    <input type=\"text\" name=\"q\" value=\"{{ keyword }}\"
           placeholder=\"🔍 Rechercher par nom ou émotion...\"
           class=\"flex-1 rounded-xl border border-gray-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#006876]\">
    <button type=\"submit\"
            class=\"bg-[#006876] text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-[#005562] transition\">
        Rechercher
    </button>
    {% if keyword %}
    <a href=\"{{ path('habitude_index') }}\"
       class=\"bg-gray-100 text-gray-600 px-4 py-2 rounded-xl text-sm hover:bg-gray-200 transition\">
        ✕ Effacer
    </a>
    {% endif %}
</form>

{# ── TABLEAU ── #}
{% if habitudes is empty %}
<div class=\"text-center py-16 text-gray-400\">
    <div class=\"text-5xl mb-4\">🌱</div>
    <p class=\"text-lg font-medium\">Aucune habitude trouvée</p>
    <p class=\"text-sm mt-1\">Commencez par en ajouter une !</p>
</div>
{% else %}
<div class=\"overflow-x-auto rounded-2xl border border-gray-100 shadow-sm\">
    <table class=\"w-full text-sm\">
        <thead class=\"bg-gradient-to-r from-[#006876] to-[#008a9a] text-white\">
            <tr>
                <th class=\"px-4 py-3 text-left font-semibold\">🌿 Habitude</th>
                <th class=\"px-4 py-3 text-left font-semibold\">💭 Émotion</th>
                <th class=\"px-4 py-3 text-center font-semibold\">⚡ Énergie</th>
                <th class=\"px-4 py-3 text-center font-semibold\">😰 Stress</th>
                <th class=\"px-4 py-3 text-center font-semibold\">😴 Sommeil</th>
                <th class=\"px-4 py-3 text-center font-semibold\">📅 Date</th>
                <th class=\"px-4 py-3 text-center font-semibold\">Actions</th>
            </tr>
        </thead>
        <tbody class=\"divide-y divide-gray-50 bg-white\">
            {% for h in habitudes %}
            <tr class=\"hover:bg-[#f0fdfd] transition\">

                <td class=\"px-4 py-3 font-medium text-gray-800\">
                    {{ h.nomHabitude }}
                </td>

                <td class=\"px-4 py-3 text-gray-500 text-xs\">
                    {{ h.emotionDominantes }}
                </td>

                {# Badge Énergie #}
                <td class=\"px-4 py-3 text-center\">
                    <span class=\"inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold\"
                          style=\"background-color: {{ h.couleurEnergie }}22; color: {{ h.couleurEnergie }}\">
                        {{ h.emojiEnergie }} {{ h.niveauEnergie }} — {{ h.labelEnergie }}
                    </span>
                </td>

                {# Badge Stress #}
                <td class=\"px-4 py-3 text-center\">
                    <span class=\"inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold\"
                          style=\"background-color: {{ h.couleurStress }}22; color: {{ h.couleurStress }}\">
                        {{ h.emojiStress }} {{ h.niveauStress }} — {{ h.labelStress }}
                    </span>
                </td>

                {# Badge Sommeil #}
                <td class=\"px-4 py-3 text-center\">
                    <span class=\"inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold\"
                          style=\"background-color: {{ h.couleurSommeil }}22; color: {{ h.couleurSommeil }}\">
                        {{ h.emojiSommeil }} {{ h.qualiteSommeil }} — {{ h.labelSommeil }}
                    </span>
                </td>

                <td class=\"px-4 py-3 text-center text-gray-400 text-xs\">
                    {{ h.dateCreation|date('d/m/Y') }}
                </td>

                {# Actions #}
                <td class=\"px-4 py-3\">
                    <div class=\"flex items-center justify-center gap-2\">
                        <a href=\"{{ path('habitude_voir', {id: h.idHabit}) }}\"
                           class=\"bg-[#006876] text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-[#005562] transition\">
                            👁 Voir
                        </a>
                        <a href=\"{{ path('habitude_modifier', {id: h.idHabit}) }}\"
                           class=\"bg-amber-400 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-amber-500 transition\">
                            ✏️
                        </a>
                        <form method=\"POST\"
                              action=\"{{ path('habitude_supprimer', {id: h.idHabit}) }}\"
                              onsubmit=\"return confirm('Supprimer cette habitude ?')\">
                            <input type=\"hidden\" name=\"_token\"
                                   value=\"{{ csrf_token('delete-habitude-' ~ h.idHabit) }}\">
                            <button type=\"submit\"
                                    class=\"bg-red-400 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-500 transition\">
                                🗑
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
            {% endfor %}
        </tbody>
    </table>
</div>
{% endif %}

{% endblock %}", "journal/habitude/index.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\Journal\\habitude\\index.html.twig");
    }
}
