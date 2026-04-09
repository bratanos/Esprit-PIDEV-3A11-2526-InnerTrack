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

/* journal/entree/index.html.twig */
class __TwigTemplate_c33c2ef89d7d74dc5125beff51b35763 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "journal/entree/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "journal/entree/index.html.twig"));

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
        <h1 class=\"text-2xl font-bold text-[#006876]\">📓 Mon Journal</h1>
        <p class=\"text-sm text-gray-500 mt-1\">Vos entrées quotidiennes</p>
    </div>

    ";
        // line 13
        yield "    <div class=\"flex items-center gap-4\">
        ";
        // line 15
        yield "        <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("entree_export_pdf");
        yield "\"
           target=\"_blank\"
           class=\"inline-flex items-center gap-2 bg-[#006876] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#005562] transition shadow-sm\">
            <span>📝</span> Exporter PDF
        </a>

        ";
        // line 22
        yield "        <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("entree_ajouter");
        yield "\"
           class=\"inline-flex items-center gap-2 bg-[#006876] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#005562] transition shadow-sm\">
            <span>＋</span> Nouvelle entrée
        </a>
    </div>
</div>

";
        // line 30
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 30, $this->source); })()), "total", [], "any", false, false, false, 30) > 0)) {
            // line 31
            yield "<div class=\"grid grid-cols-2 gap-4 mb-8\">
    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-4 text-center\">
        <div class=\"text-2xl mb-1\">📋</div>
        <div class=\"text-xl font-bold text-[#006876]\">";
            // line 34
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 34, $this->source); })()), "total", [], "any", false, false, false, 34), "html", null, true);
            yield "</div>
        <div class=\"text-xs text-gray-400 mt-1\">Total entrées</div>
    </div>
    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-4 text-center\">
        <div class=\"text-2xl mb-1\">😊</div>
        <div class=\"text-xl font-bold text-[#48bb78]\">";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 39, $this->source); })()), "avgHumeur", [], "any", false, false, false, 39), 1), "html", null, true);
            yield "</div>
        <div class=\"text-xs text-gray-400 mt-1\">Humeur moyenne</div>
    </div>
</div>
";
        }
        // line 44
        yield "
";
        // line 46
        yield "<form method=\"GET\" class=\"mb-6 flex gap-3\">
    <input type=\"text\" name=\"q\" value=\"";
        // line 47
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["keyword"]) || array_key_exists("keyword", $context) ? $context["keyword"] : (function () { throw new RuntimeError('Variable "keyword" does not exist.', 47, $this->source); })()), "html", null, true);
        yield "\"
           placeholder=\"🔍 Rechercher dans vos notes...\"
           class=\"flex-1 rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#006876]\">
    <button type=\"submit\"
            class=\"bg-[#006876] text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-[#005562] transition\">
        Rechercher
    </button>
    ";
        // line 54
        if ((($tmp = (isset($context["keyword"]) || array_key_exists("keyword", $context) ? $context["keyword"] : (function () { throw new RuntimeError('Variable "keyword" does not exist.', 54, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 55
            yield "    <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("entree_index");
            yield "\"
       class=\"bg-gray-100 text-gray-600 px-4 py-2.5 rounded-xl text-sm hover:bg-gray-200 transition\">
        ✕ Effacer
    </a>
    ";
        }
        // line 60
        yield "</form>

";
        // line 63
        yield "<div class=\"flex items-center justify-end mb-6 px-2 relative z-50\">
    <div class=\"flex items-center gap-5 bg-white px-4 py-2 rounded-xl border border-gray-200 shadow-sm\">
        <span class=\"text-[10px] font-bold uppercase tracking-widest text-gray-400\">Trier par :</span>

        ";
        // line 68
        yield "        <a href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("entree_index", ["sort" => "dateSaisie", "direction" => (((((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 68, $this->source); })()) == "dateSaisie") && ((isset($context["currentDirection"]) || array_key_exists("currentDirection", $context) ? $context["currentDirection"] : (function () { throw new RuntimeError('Variable "currentDirection" does not exist.', 68, $this->source); })()) == "DESC"))) ? ("ASC") : ("DESC")), "q" => (isset($context["keyword"]) || array_key_exists("keyword", $context) ? $context["keyword"] : (function () { throw new RuntimeError('Variable "keyword" does not exist.', 68, $this->source); })())]), "html", null, true);
        yield "\" 
           class=\"inline-flex items-center gap-1.5 text-xs font-bold transition-colors hover:opacity-70 ";
        // line 69
        yield ((((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 69, $this->source); })()) == "dateSaisie")) ? ("text-[#006876]") : ("text-gray-500"));
        yield "\">
            📅 Date
            ";
        // line 71
        if (((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 71, $this->source); })()) == "dateSaisie")) {
            // line 72
            yield "                <span class=\"text-[10px] font-black\">";
            yield ((((isset($context["currentDirection"]) || array_key_exists("currentDirection", $context) ? $context["currentDirection"] : (function () { throw new RuntimeError('Variable "currentDirection" does not exist.', 72, $this->source); })()) == "DESC")) ? ("▼") : ("▲"));
            yield "</span>
            ";
        }
        // line 74
        yield "        </a>

        ";
        // line 77
        yield "        <a href=\"";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("entree_index", ["sort" => "humeur", "direction" => (((((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 77, $this->source); })()) == "humeur") && ((isset($context["currentDirection"]) || array_key_exists("currentDirection", $context) ? $context["currentDirection"] : (function () { throw new RuntimeError('Variable "currentDirection" does not exist.', 77, $this->source); })()) == "DESC"))) ? ("ASC") : ("DESC")), "q" => (isset($context["keyword"]) || array_key_exists("keyword", $context) ? $context["keyword"] : (function () { throw new RuntimeError('Variable "keyword" does not exist.', 77, $this->source); })())]), "html", null, true);
        yield "\" 
           class=\"inline-flex items-center gap-1.5 text-xs font-bold transition-colors hover:opacity-70 ";
        // line 78
        yield ((((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 78, $this->source); })()) == "humeur")) ? ("text-[#006876]") : ("text-gray-500"));
        yield "\">
            📊 Humeur
            ";
        // line 80
        if (((isset($context["currentSort"]) || array_key_exists("currentSort", $context) ? $context["currentSort"] : (function () { throw new RuntimeError('Variable "currentSort" does not exist.', 80, $this->source); })()) == "humeur")) {
            // line 81
            yield "                <span class=\"text-[10px] font-black\">";
            yield ((((isset($context["currentDirection"]) || array_key_exists("currentDirection", $context) ? $context["currentDirection"] : (function () { throw new RuntimeError('Variable "currentDirection" does not exist.', 81, $this->source); })()) == "DESC")) ? ("▼") : ("▲"));
            yield "</span>
            ";
        }
        // line 83
        yield "        </a>
    </div>
</div>

";
        // line 88
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["entrees"]) || array_key_exists("entrees", $context) ? $context["entrees"] : (function () { throw new RuntimeError('Variable "entrees" does not exist.', 88, $this->source); })()))) {
            // line 89
            yield "<div class=\"text-center py-16 text-gray-400\">
    <div class=\"text-5xl mb-4\">📭</div>
    <p class=\"text-lg font-medium\">Aucune entrée trouvée</p>
    <p class=\"text-sm mt-1\">Commencez à écrire votre journal !</p>
</div>
";
        } else {
            // line 95
            yield "<div class=\"space-y-4\">
    ";
            // line 96
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["entrees"]) || array_key_exists("entrees", $context) ? $context["entrees"] : (function () { throw new RuntimeError('Variable "entrees" does not exist.', 96, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["e"]) {
                // line 97
                yield "    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition\">
        <div class=\"flex items-start justify-between gap-4\">

            ";
                // line 101
                yield "            <div class=\"flex items-center gap-3 flex-1\">
                <span class=\"text-3xl\">";
                // line 102
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["e"], "emojiHumeur", [], "any", false, false, false, 102), "html", null, true);
                yield "</span>
                <div class=\"flex-1\">
                    <div class=\"flex items-center gap-2 mb-1\">
                        <span class=\"inline-flex items-center px-3 py-1 rounded-full text-xs font-bold\"
                              style=\"background-color: ";
                // line 106
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["e"], "couleurHumeur", [], "any", false, false, false, 106), "html", null, true);
                yield "22; color: ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["e"], "couleurHumeur", [], "any", false, false, false, 106), "html", null, true);
                yield "\">
                            ";
                // line 107
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["e"], "labelHumeur", [], "any", false, false, false, 107), "html", null, true);
                yield " — ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["e"], "humeur", [], "any", false, false, false, 107), "html", null, true);
                yield "/10
                        </span>
                        <span class=\"text-xs text-gray-400\">
                            📅 ";
                // line 110
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["e"], "dateSaisie", [], "any", false, false, false, 110), "d/m/Y"), "html", null, true);
                yield "
                        </span>
                    </div>
                    <p class=\"text-sm text-gray-600 line-clamp-2\">
                        ";
                // line 114
                yield ((CoreExtension::getAttribute($this->env, $this->source, $context["e"], "noteTextuelle", [], "any", false, false, false, 114)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["e"], "noteTextuelle", [], "any", false, false, false, 114), "html", null, true)) : ("Aucune note."));
                yield "
                    </p>
                </div>
            </div>

            ";
                // line 120
                yield "            <div class=\"flex items-center gap-2 shrink-0\">
                <a href=\"";
                // line 121
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("entree_voir", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["e"], "idJournal", [], "any", false, false, false, 121)]), "html", null, true);
                yield "\"
                   class=\"bg-[#006876] text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-[#005562] transition\">
                    👁 Voir
                </a>
                <a href=\"";
                // line 125
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("entree_modifier", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["e"], "idJournal", [], "any", false, false, false, 125)]), "html", null, true);
                yield "\"
                   class=\"bg-amber-400 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-amber-500 transition\">
                    ✏️
                </a>
                <form method=\"POST\"
                      action=\"";
                // line 130
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("entree_supprimer", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["e"], "idJournal", [], "any", false, false, false, 130)]), "html", null, true);
                yield "\"
                      onsubmit=\"return confirm('Supprimer cette entrée ?')\">
                    <input type=\"hidden\" name=\"_token\"
                           value=\"";
                // line 133
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete-entree-" . CoreExtension::getAttribute($this->env, $this->source, $context["e"], "idJournal", [], "any", false, false, false, 133))), "html", null, true);
                yield "\">
                    <button type=\"submit\"
                            class=\"bg-red-400 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-500 transition\">
                        🗑
                    </button>
                </form>
            </div>
        </div>
    </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['e'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 143
            yield "</div>
";
        }
        // line 145
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
        return "journal/entree/index.html.twig";
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
        return array (  322 => 145,  318 => 143,  302 => 133,  296 => 130,  288 => 125,  281 => 121,  278 => 120,  270 => 114,  263 => 110,  255 => 107,  249 => 106,  242 => 102,  239 => 101,  234 => 97,  230 => 96,  227 => 95,  219 => 89,  217 => 88,  211 => 83,  205 => 81,  203 => 80,  198 => 78,  193 => 77,  189 => 74,  183 => 72,  181 => 71,  176 => 69,  171 => 68,  165 => 63,  161 => 60,  152 => 55,  150 => 54,  140 => 47,  137 => 46,  134 => 44,  126 => 39,  118 => 34,  113 => 31,  111 => 30,  100 => 22,  90 => 15,  87 => 13,  79 => 6,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}

{# ── EN-TÊTE ── #}
<div class=\"flex items-center justify-between mb-8\">
    <div>
        <h1 class=\"text-2xl font-bold text-[#006876]\">📓 Mon Journal</h1>
        <p class=\"text-sm text-gray-500 mt-1\">Vos entrées quotidiennes</p>
    </div>

    {# Gap ajusté à 4 pour un équilibre parfait entre proximité et clarté #}
    <div class=\"flex items-center gap-4\">
        {# Bouton PDF #}
        <a href=\"{{ path('entree_export_pdf') }}\"
           target=\"_blank\"
           class=\"inline-flex items-center gap-2 bg-[#006876] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#005562] transition shadow-sm\">
            <span>📝</span> Exporter PDF
        </a>

        {# Bouton Nouveau #}
        <a href=\"{{ path('entree_ajouter') }}\"
           class=\"inline-flex items-center gap-2 bg-[#006876] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#005562] transition shadow-sm\">
            <span>＋</span> Nouvelle entrée
        </a>
    </div>
</div>

{# ── STATS ── #}
{% if stats.total > 0 %}
<div class=\"grid grid-cols-2 gap-4 mb-8\">
    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-4 text-center\">
        <div class=\"text-2xl mb-1\">📋</div>
        <div class=\"text-xl font-bold text-[#006876]\">{{ stats.total }}</div>
        <div class=\"text-xs text-gray-400 mt-1\">Total entrées</div>
    </div>
    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-4 text-center\">
        <div class=\"text-2xl mb-1\">😊</div>
        <div class=\"text-xl font-bold text-[#48bb78]\">{{ stats.avgHumeur|number_format(1) }}</div>
        <div class=\"text-xs text-gray-400 mt-1\">Humeur moyenne</div>
    </div>
</div>
{% endif %}

{# ── RECHERCHE ── #}
<form method=\"GET\" class=\"mb-6 flex gap-3\">
    <input type=\"text\" name=\"q\" value=\"{{ keyword }}\"
           placeholder=\"🔍 Rechercher dans vos notes...\"
           class=\"flex-1 rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#006876]\">
    <button type=\"submit\"
            class=\"bg-[#006876] text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-[#005562] transition\">
        Rechercher
    </button>
    {% if keyword %}
    <a href=\"{{ path('entree_index') }}\"
       class=\"bg-gray-100 text-gray-600 px-4 py-2.5 rounded-xl text-sm hover:bg-gray-200 transition\">
        ✕ Effacer
    </a>
    {% endif %}
</form>

{# ── OPTIONS DE TRI ── #}
<div class=\"flex items-center justify-end mb-6 px-2 relative z-50\">
    <div class=\"flex items-center gap-5 bg-white px-4 py-2 rounded-xl border border-gray-200 shadow-sm\">
        <span class=\"text-[10px] font-bold uppercase tracking-widest text-gray-400\">Trier par :</span>

        {# Tri Date #}
        <a href=\"{{ path('entree_index', { 'sort': 'dateSaisie', 'direction': (currentSort == 'dateSaisie' and currentDirection == 'DESC') ? 'ASC' : 'DESC', 'q': keyword }) }}\" 
           class=\"inline-flex items-center gap-1.5 text-xs font-bold transition-colors hover:opacity-70 {{ currentSort == 'dateSaisie' ? 'text-[#006876]' : 'text-gray-500' }}\">
            📅 Date
            {% if currentSort == 'dateSaisie' %}
                <span class=\"text-[10px] font-black\">{{ currentDirection == 'DESC' ? '▼' : '▲' }}</span>
            {% endif %}
        </a>

        {# Tri Humeur #}
        <a href=\"{{ path('entree_index', { 'sort': 'humeur', 'direction': (currentSort == 'humeur' and currentDirection == 'DESC') ? 'ASC' : 'DESC', 'q': keyword }) }}\" 
           class=\"inline-flex items-center gap-1.5 text-xs font-bold transition-colors hover:opacity-70 {{ currentSort == 'humeur' ? 'text-[#006876]' : 'text-gray-500' }}\">
            📊 Humeur
            {% if currentSort == 'humeur' %}
                <span class=\"text-[10px] font-black\">{{ currentDirection == 'DESC' ? '▼' : '▲' }}</span>
            {% endif %}
        </a>
    </div>
</div>

{# ── LISTE DES ENTRÉES ── #}
{% if entrees is empty %}
<div class=\"text-center py-16 text-gray-400\">
    <div class=\"text-5xl mb-4\">📭</div>
    <p class=\"text-lg font-medium\">Aucune entrée trouvée</p>
    <p class=\"text-sm mt-1\">Commencez à écrire votre journal !</p>
</div>
{% else %}
<div class=\"space-y-4\">
    {% for e in entrees %}
    <div class=\"bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition\">
        <div class=\"flex items-start justify-between gap-4\">

            {# Humeur badge #}
            <div class=\"flex items-center gap-3 flex-1\">
                <span class=\"text-3xl\">{{ e.emojiHumeur }}</span>
                <div class=\"flex-1\">
                    <div class=\"flex items-center gap-2 mb-1\">
                        <span class=\"inline-flex items-center px-3 py-1 rounded-full text-xs font-bold\"
                              style=\"background-color: {{ e.couleurHumeur }}22; color: {{ e.couleurHumeur }}\">
                            {{ e.labelHumeur }} — {{ e.humeur }}/10
                        </span>
                        <span class=\"text-xs text-gray-400\">
                            📅 {{ e.dateSaisie|date('d/m/Y') }}
                        </span>
                    </div>
                    <p class=\"text-sm text-gray-600 line-clamp-2\">
                        {{ e.noteTextuelle ?: 'Aucune note.' }}
                    </p>
                </div>
            </div>

            {# Actions #}
            <div class=\"flex items-center gap-2 shrink-0\">
                <a href=\"{{ path('entree_voir', {id: e.idJournal}) }}\"
                   class=\"bg-[#006876] text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-[#005562] transition\">
                    👁 Voir
                </a>
                <a href=\"{{ path('entree_modifier', {id: e.idJournal}) }}\"
                   class=\"bg-amber-400 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-amber-500 transition\">
                    ✏️
                </a>
                <form method=\"POST\"
                      action=\"{{ path('entree_supprimer', {id: e.idJournal}) }}\"
                      onsubmit=\"return confirm('Supprimer cette entrée ?')\">
                    <input type=\"hidden\" name=\"_token\"
                           value=\"{{ csrf_token('delete-entree-' ~ e.idJournal) }}\">
                    <button type=\"submit\"
                            class=\"bg-red-400 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-red-500 transition\">
                        🗑
                    </button>
                </form>
            </div>
        </div>
    </div>
    {% endfor %}
</div>
{% endif %}

{% endblock %}", "journal/entree/index.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\Journal\\entree\\index.html.twig");
    }
}
