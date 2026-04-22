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

/* pages/testpsy/historique.html.twig */
class __TwigTemplate_8a24b6c7798340a891768a5c7fb1ce0b extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/historique.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/historique.html.twig"));

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

        yield "Mon Historique";
        
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
        yield "<div class=\"max-w-4xl mx-auto pb-24\">

    <div class=\"flex items-center justify-between mb-8\">
        <div>
            <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface\">Mon Historique</h1>
            <p class=\"text-sm text-on-surface-variant mt-1\">Tous vos tests passés</p>
        </div>
        <div class=\"flex items-center gap-4\">
            ";
        // line 14
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty((isset($context["historiques"]) || array_key_exists("historiques", $context) ? $context["historiques"] : (function () { throw new RuntimeError('Variable "historiques" does not exist.', 14, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 15
            yield "            <form method=\"post\" action=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_historique_reset");
            yield "\" onsubmit=\"return confirm('Êtes-vous sûr de vouloir réinitialiser tout votre historique ? Cette action est irréversible et effacera tous vos résultats.');\">
                <button type=\"submit\" class=\"inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 text-sm font-bold rounded-xl hover:bg-red-100 transition-colors\">
                    <span class=\"material-symbols-outlined text-lg\">delete_sweep</span> Réinitialiser
                </button>
            </form>
            ";
        }
        // line 21
        yield "            <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_index");
        yield "\"
               class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary transition-colors\">
                <span class=\"material-symbols-outlined\">arrow_back</span> Retour
            </a>
        </div>
    </div>

    <!-- Flash messages -->
    ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 29, $this->source); })()), "flashes", ["success"], "method", false, false, false, 29));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 30
            yield "        <div class=\"mb-8 bg-green-50 border border-green-200 text-green-700 text-sm font-bold px-6 py-4 rounded-2xl flex items-center gap-3\">
            <span class=\"material-symbols-outlined\">check_circle</span> ";
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
        yield "
    ";
        // line 35
        if ((array_key_exists("stats", $context) && (CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 35, $this->source); })()), "total", [], "any", false, false, false, 35) > 0))) {
            // line 36
            yield "    <div class=\"grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10\">
        <div class=\"bg-white rounded-[2rem] px-6 py-5 border border-outline/20 shadow-sm flex items-center gap-4\">
            <div class=\"w-12 h-12 rounded-[1rem] bg-primary/10 flex items-center justify-center flex-shrink-0\">
                <span class=\"material-symbols-outlined text-primary text-2xl\">history_edu</span>
            </div>
            <div class=\"min-w-0\">
                <p class=\"text-[11px] font-bold text-on-surface-variant uppercase tracking-wider truncate\">Tests Passés</p>
                <p class=\"text-3xl font-extrabold text-on-surface font-headline leading-tight\">";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 43, $this->source); })()), "total", [], "any", false, false, false, 43), "html", null, true);
            yield "</p>
            </div>
        </div>
        <div class=\"bg-white rounded-[2rem] px-6 py-5 border border-outline/20 shadow-sm flex items-center gap-4\">
            <div class=\"w-12 h-12 rounded-[1rem] bg-amber-50 flex items-center justify-center flex-shrink-0\">
                <span class=\"material-symbols-outlined text-amber-500 text-2xl\">troubleshoot</span>
            </div>
            <div class=\"min-w-0\">
                <p class=\"text-[11px] font-bold text-on-surface-variant uppercase tracking-wider truncate\">Score Moyen</p>
                <p class=\"text-3xl font-extrabold text-on-surface font-headline leading-tight\">";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 52, $this->source); })()), "moyenne", [], "any", false, false, false, 52), "html", null, true);
            yield "%</p>
            </div>
        </div>
        <div class=\"bg-white rounded-[2rem] px-6 py-5 border border-outline/20 shadow-sm flex items-center gap-4\">
            <div class=\"w-12 h-12 rounded-[1rem] bg-green-50 flex items-center justify-center flex-shrink-0\">
                <span class=\"material-symbols-outlined text-green-500 text-2xl\">trending_up</span>
            </div>
            <div class=\"min-w-0\">
                <p class=\"text-[11px] font-bold text-on-surface-variant uppercase tracking-wider truncate\">Niveau Fréquent</p>
                <p class=\"text-2xl font-extrabold text-on-surface font-headline leading-tight capitalize\">";
            // line 61
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["stats"]) || array_key_exists("stats", $context) ? $context["stats"] : (function () { throw new RuntimeError('Variable "stats" does not exist.', 61, $this->source); })()), "niveau_frequent", [], "any", false, false, false, 61), "html", null, true);
            yield "</p>
            </div>
        </div>
    </div>
    ";
        }
        // line 66
        yield "
    <!-- Charts d'évolution -->
    ";
        // line 68
        if ((array_key_exists("historiques_asc", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["historiques_asc"]) || array_key_exists("historiques_asc", $context) ? $context["historiques_asc"] : (function () { throw new RuntimeError('Variable "historiques_asc" does not exist.', 68, $this->source); })())) > 0))) {
            // line 69
            yield "    <div class=\"mb-10 p-8 bg-white rounded-[3rem] border border-outline/20 shadow-sm\">
        <h3 class=\"text-xl font-extrabold font-headline mb-6 flex items-center gap-2\">
            <span class=\"material-symbols-outlined text-primary\">timeline</span> 
            Évolution de vos scores
        </h3>
        
        <div class=\"mb-4\">
            <label for=\"evolution-select\" class=\"block text-[11px] font-bold text-on-surface-variant uppercase tracking-wider mb-2\">Choisir un test à analyser</label>
            <select id=\"evolution-select\" class=\"w-full md:w-1/2 p-3 bg-gray-50 border border-outline/30 rounded-xl text-sm font-bold text-on-surface focus:ring-2 focus:ring-primary focus:border-primary transition-all\">
                ";
            // line 78
            $context["tests_present"] = [];
            // line 79
            yield "                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["historiques_asc"]) || array_key_exists("historiques_asc", $context) ? $context["historiques_asc"] : (function () { throw new RuntimeError('Variable "historiques_asc" does not exist.', 79, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["h"]) {
                // line 80
                yield "                    ";
                if (!CoreExtension::inFilter(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 80), (isset($context["tests_present"]) || array_key_exists("tests_present", $context) ? $context["tests_present"] : (function () { throw new RuntimeError('Variable "tests_present" does not exist.', 80, $this->source); })()))) {
                    // line 81
                    yield "                        ";
                    $context["tests_present"] = Twig\Extension\CoreExtension::merge((isset($context["tests_present"]) || array_key_exists("tests_present", $context) ? $context["tests_present"] : (function () { throw new RuntimeError('Variable "tests_present" does not exist.', 81, $this->source); })()), [CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 81)]);
                    // line 82
                    yield "                        <option value=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 82), "html", null, true);
                    yield "\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((((CoreExtension::getAttribute($this->env, $this->source, ($context["tests_map"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 82), [], "array", true, true, false, 82) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tests_map"]) || array_key_exists("tests_map", $context) ? $context["tests_map"] : (function () { throw new RuntimeError('Variable "tests_map" does not exist.', 82, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 82), [], "array", false, false, false, 82)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["tests_map"]) || array_key_exists("tests_map", $context) ? $context["tests_map"] : (function () { throw new RuntimeError('Variable "tests_map" does not exist.', 82, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 82), [], "array", false, false, false, 82)) : ("Test #")) . CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 82)), "html", null, true);
                    yield "</option>
                    ";
                }
                // line 84
                yield "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['h'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 85
            yield "            </select>
            <p class=\"text-[10px] text-gray-400 mt-2\">Passez un test plusieurs fois pour voir votre courbe d'évolution.</p>
        </div>

        <div class=\"relative w-full h-72 lg:h-80 mt-6\">
            <canvas id=\"evolutionChart\"></canvas>
        </div>
    </div>
    ";
        }
        // line 94
        yield "
    ";
        // line 95
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["historiques"]) || array_key_exists("historiques", $context) ? $context["historiques"] : (function () { throw new RuntimeError('Variable "historiques" does not exist.', 95, $this->source); })()))) {
            // line 96
            yield "        <div class=\"py-20 bg-gray-50/30 rounded-[3rem] border-2 border-dashed border-outline/40 flex flex-col items-center justify-center text-center\">
            <span class=\"material-symbols-outlined text-6xl text-gray-200 mb-4\">history</span>
            <h3 class=\"font-headline font-extrabold text-xl text-gray-400\">Aucun test passé</h3>
            <p class=\"text-xs text-gray-400 mt-2 uppercase tracking-widest\">Passez votre premier test pour voir votre historique</p>
            <a href=\"";
            // line 100
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_index");
            yield "\"
               class=\"mt-8 px-8 py-3 bg-primary text-white text-sm font-bold rounded-2xl shadow-md shadow-primary/20 hover:bg-primary/90 transition-all\">
                Voir les tests
            </a>
        </div>
    ";
        } else {
            // line 106
            yield "        <div class=\"bg-white rounded-[3rem] p-2 shadow-sm border border-outline/20\">
            <div class=\"space-y-1 p-2\">
                ";
            // line 108
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["historiques"]) || array_key_exists("historiques", $context) ? $context["historiques"] : (function () { throw new RuntimeError('Variable "historiques" does not exist.', 108, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["h"]) {
                // line 109
                yield "                <div class=\"flex items-center gap-6 p-6 rounded-[2rem] hover:bg-gray-50 transition-all border border-transparent hover:border-outline/30\">

                    <!-- Icon -->
                    <div class=\"w-12 h-12 rounded-[1rem] flex items-center justify-center flex-shrink-0
                        ";
                // line 113
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["h"], "niveau", [], "any", false, false, false, 113) == "faible")) {
                    yield " bg-green-50 text-green-500
                        ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 114
$context["h"], "niveau", [], "any", false, false, false, 114) == "modere")) {
                    yield " bg-amber-50 text-amber-500
                        ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 115
$context["h"], "niveau", [], "any", false, false, false, 115) == "eleve")) {
                    yield " bg-orange-50 text-orange-500
                        ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 116
$context["h"], "niveau", [], "any", false, false, false, 116) == "critique")) {
                    yield " bg-red-50 text-red-500
                        ";
                } else {
                    // line 117
                    yield " bg-primary/10 text-primary
                        ";
                }
                // line 118
                yield "\">
                        <span class=\"material-symbols-outlined\">
                            ";
                // line 120
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["h"], "niveau", [], "any", false, false, false, 120) == "faible")) {
                    yield "sentiment_satisfied
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 121
$context["h"], "niveau", [], "any", false, false, false, 121) == "modere")) {
                    yield "sentiment_neutral
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 122
$context["h"], "niveau", [], "any", false, false, false, 122) == "eleve")) {
                    yield "sentiment_dissatisfied
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 123
$context["h"], "niveau", [], "any", false, false, false, 123) == "critique")) {
                    yield "crisis_alert
                            ";
                } else {
                    // line 124
                    yield "psychology_alt
                            ";
                }
                // line 126
                yield "                        </span>
                    </div>

                    <!-- Info -->
                    <div class=\"flex-1 min-w-0\">
                        <div class=\"text-sm font-extrabold text-on-surface\">";
                // line 131
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((((CoreExtension::getAttribute($this->env, $this->source, ($context["tests_map"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 131), [], "array", true, true, false, 131) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tests_map"]) || array_key_exists("tests_map", $context) ? $context["tests_map"] : (function () { throw new RuntimeError('Variable "tests_map" does not exist.', 131, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 131), [], "array", false, false, false, 131)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["tests_map"]) || array_key_exists("tests_map", $context) ? $context["tests_map"] : (function () { throw new RuntimeError('Variable "tests_map" does not exist.', 131, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 131), [], "array", false, false, false, 131)) : ("Test #")) . CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 131)), "html", null, true);
                yield "</div>
                        <div class=\"text-xs text-on-surface-variant mt-0.5\">
                            ";
                // line 133
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["h"], "datePassage", [], "any", false, false, false, 133)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 134
                    yield "                                ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "datePassage", [], "any", false, false, false, 134), "d/m/Y à H:i"), "html", null, true);
                    yield "
                            ";
                } else {
                    // line 136
                    yield "                                Date inconnue
                            ";
                }
                // line 138
                yield "                        </div>
                    </div>

                    <!-- Score -->
                    <div class=\"text-center flex-shrink-0\">
                        <div class=\"text-xl font-extrabold text-on-surface font-headline\">";
                // line 143
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["h"], "score", [], "any", true, true, false, 143) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["h"], "score", [], "any", false, false, false, 143)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "score", [], "any", false, false, false, 143), "html", null, true)) : ("—"));
                yield "</div>
                        <div class=\"text-[9px] font-bold text-on-surface-variant uppercase tracking-widest\">Score</div>
                    </div>

                    <!-- Percentage -->
                    <div class=\"text-center flex-shrink-0\">
                        <div class=\"text-xl font-extrabold text-primary font-headline\">
                            ";
                // line 150
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["h"], "pourcentage", [], "any", false, false, false, 150)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::round(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "pourcentage", [], "any", false, false, false, 150)) . "%"), "html", null, true)) : ("—"));
                yield "
                        </div>
                        <div class=\"text-[9px] font-bold text-on-surface-variant uppercase tracking-widest\">Résultat</div>
                    </div>

                    <!-- Level badge -->
                    <div class=\"flex-shrink-0\">
                        <span class=\"px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-wider
                            ";
                // line 158
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["h"], "niveau", [], "any", false, false, false, 158) == "faible")) {
                    yield " bg-green-100 text-green-700
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 159
$context["h"], "niveau", [], "any", false, false, false, 159) == "modere")) {
                    yield " bg-amber-100 text-amber-700
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 160
$context["h"], "niveau", [], "any", false, false, false, 160) == "eleve")) {
                    yield " bg-orange-100 text-orange-700
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 161
$context["h"], "niveau", [], "any", false, false, false, 161) == "critique")) {
                    yield " bg-red-100 text-red-700
                            ";
                } else {
                    // line 162
                    yield " bg-gray-100 text-gray-600
                            ";
                }
                // line 163
                yield "\">
                            ";
                // line 164
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["h"], "niveau", [], "any", true, true, false, 164) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["h"], "niveau", [], "any", false, false, false, 164)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "niveau", [], "any", false, false, false, 164), "html", null, true)) : ("N/A"));
                yield "
                        </span>
                    </div>

                </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['h'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 170
            yield "            </div>
        </div>
    ";
        }
        // line 173
        yield "
</div>

";
        // line 176
        if ((array_key_exists("historiques_asc", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["historiques_asc"]) || array_key_exists("historiques_asc", $context) ? $context["historiques_asc"] : (function () { throw new RuntimeError('Variable "historiques_asc" does not exist.', 176, $this->source); })())) > 0))) {
            // line 177
            yield "<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Transformer l'objet Twig en tableau JS
    const rawData = [
        ";
            // line 182
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["historiques_asc"]) || array_key_exists("historiques_asc", $context) ? $context["historiques_asc"] : (function () { throw new RuntimeError('Variable "historiques_asc" does not exist.', 182, $this->source); })()));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["h"]) {
                // line 183
                yield "            {
                idTest: ";
                // line 184
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 184), "html", null, true);
                yield ",
                titre: \"";
                // line 185
                yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["tests_map"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 185), [], "array", true, true, false, 185) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["tests_map"]) || array_key_exists("tests_map", $context) ? $context["tests_map"] : (function () { throw new RuntimeError('Variable "tests_map" does not exist.', 185, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 185), [], "array", false, false, false, 185)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tests_map"]) || array_key_exists("tests_map", $context) ? $context["tests_map"] : (function () { throw new RuntimeError('Variable "tests_map" does not exist.', 185, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["h"], "idTest", [], "any", false, false, false, 185), [], "array", false, false, false, 185), "html", null, true)) : ("Test"));
                yield "\",
                date: \"";
                // line 186
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["h"], "datePassage", [], "any", false, false, false, 186)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "datePassage", [], "any", false, false, false, 186), "d/m/Y"), "html", null, true)) : (""));
                yield "\",
                score: ";
                // line 187
                yield ((CoreExtension::getAttribute($this->env, $this->source, $context["h"], "pourcentage", [], "any", false, false, false, 187)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["h"], "pourcentage", [], "any", false, false, false, 187), "html", null, true)) : (0));
                yield "
            }";
                // line 188
                if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 188)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield ",";
                }
                // line 189
                yield "        ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['h'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 190
            yield "    ];

    const select = document.getElementById('evolution-select');
    const ctx = document.getElementById('evolutionChart');
    if (!ctx || !select) return;

    let chartInstance = null;

    function renderChart(testId) {
        // Filtrer les données pour le test sélectionné
        const dataForTest = rawData.filter(d => d.idTest == testId);
        
        const labels = dataForTest.map(d => d.date);
        const data = dataForTest.map(d => d.score);

        if (chartInstance) {
            chartInstance.destroy();
        }

        chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Score au fil du temps (%)',
                    data: data,
                    borderColor: '#4f46e5', // Indigo 600
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#4f46e5',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: 'start',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: { display: true, text: 'Résultat (%)' }
                    }
                }
            }
        });
    }

    // Afficher le premier test sélectionné
    if (select.options.length > 0) {
        renderChart(select.value);
    }

    // Mettre à jour au changement
    select.addEventListener('change', function() {
        renderChart(this.value);
    });
});
</script>
";
        }
        // line 257
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
        return "pages/testpsy/historique.html.twig";
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
        return array (  561 => 257,  492 => 190,  478 => 189,  474 => 188,  470 => 187,  466 => 186,  462 => 185,  458 => 184,  455 => 183,  438 => 182,  431 => 177,  429 => 176,  424 => 173,  419 => 170,  407 => 164,  404 => 163,  400 => 162,  395 => 161,  391 => 160,  387 => 159,  383 => 158,  372 => 150,  362 => 143,  355 => 138,  351 => 136,  345 => 134,  343 => 133,  338 => 131,  331 => 126,  327 => 124,  322 => 123,  318 => 122,  314 => 121,  310 => 120,  306 => 118,  302 => 117,  297 => 116,  293 => 115,  289 => 114,  285 => 113,  279 => 109,  275 => 108,  271 => 106,  262 => 100,  256 => 96,  254 => 95,  251 => 94,  240 => 85,  234 => 84,  226 => 82,  223 => 81,  220 => 80,  215 => 79,  213 => 78,  202 => 69,  200 => 68,  196 => 66,  188 => 61,  176 => 52,  164 => 43,  155 => 36,  153 => 35,  150 => 34,  141 => 31,  138 => 30,  134 => 29,  122 => 21,  112 => 15,  110 => 14,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}Mon Historique{% endblock %}

{% block content %}
<div class=\"max-w-4xl mx-auto pb-24\">

    <div class=\"flex items-center justify-between mb-8\">
        <div>
            <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface\">Mon Historique</h1>
            <p class=\"text-sm text-on-surface-variant mt-1\">Tous vos tests passés</p>
        </div>
        <div class=\"flex items-center gap-4\">
            {% if historiques is not empty %}
            <form method=\"post\" action=\"{{ path('testpsy_historique_reset') }}\" onsubmit=\"return confirm('Êtes-vous sûr de vouloir réinitialiser tout votre historique ? Cette action est irréversible et effacera tous vos résultats.');\">
                <button type=\"submit\" class=\"inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 text-sm font-bold rounded-xl hover:bg-red-100 transition-colors\">
                    <span class=\"material-symbols-outlined text-lg\">delete_sweep</span> Réinitialiser
                </button>
            </form>
            {% endif %}
            <a href=\"{{ path('testpsy_index') }}\"
               class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary transition-colors\">
                <span class=\"material-symbols-outlined\">arrow_back</span> Retour
            </a>
        </div>
    </div>

    <!-- Flash messages -->
    {% for message in app.flashes('success') %}
        <div class=\"mb-8 bg-green-50 border border-green-200 text-green-700 text-sm font-bold px-6 py-4 rounded-2xl flex items-center gap-3\">
            <span class=\"material-symbols-outlined\">check_circle</span> {{ message }}
        </div>
    {% endfor %}

    {% if stats is defined and stats.total > 0 %}
    <div class=\"grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10\">
        <div class=\"bg-white rounded-[2rem] px-6 py-5 border border-outline/20 shadow-sm flex items-center gap-4\">
            <div class=\"w-12 h-12 rounded-[1rem] bg-primary/10 flex items-center justify-center flex-shrink-0\">
                <span class=\"material-symbols-outlined text-primary text-2xl\">history_edu</span>
            </div>
            <div class=\"min-w-0\">
                <p class=\"text-[11px] font-bold text-on-surface-variant uppercase tracking-wider truncate\">Tests Passés</p>
                <p class=\"text-3xl font-extrabold text-on-surface font-headline leading-tight\">{{ stats.total }}</p>
            </div>
        </div>
        <div class=\"bg-white rounded-[2rem] px-6 py-5 border border-outline/20 shadow-sm flex items-center gap-4\">
            <div class=\"w-12 h-12 rounded-[1rem] bg-amber-50 flex items-center justify-center flex-shrink-0\">
                <span class=\"material-symbols-outlined text-amber-500 text-2xl\">troubleshoot</span>
            </div>
            <div class=\"min-w-0\">
                <p class=\"text-[11px] font-bold text-on-surface-variant uppercase tracking-wider truncate\">Score Moyen</p>
                <p class=\"text-3xl font-extrabold text-on-surface font-headline leading-tight\">{{ stats.moyenne }}%</p>
            </div>
        </div>
        <div class=\"bg-white rounded-[2rem] px-6 py-5 border border-outline/20 shadow-sm flex items-center gap-4\">
            <div class=\"w-12 h-12 rounded-[1rem] bg-green-50 flex items-center justify-center flex-shrink-0\">
                <span class=\"material-symbols-outlined text-green-500 text-2xl\">trending_up</span>
            </div>
            <div class=\"min-w-0\">
                <p class=\"text-[11px] font-bold text-on-surface-variant uppercase tracking-wider truncate\">Niveau Fréquent</p>
                <p class=\"text-2xl font-extrabold text-on-surface font-headline leading-tight capitalize\">{{ stats.niveau_frequent }}</p>
            </div>
        </div>
    </div>
    {% endif %}

    <!-- Charts d'évolution -->
    {% if historiques_asc is defined and historiques_asc|length > 0 %}
    <div class=\"mb-10 p-8 bg-white rounded-[3rem] border border-outline/20 shadow-sm\">
        <h3 class=\"text-xl font-extrabold font-headline mb-6 flex items-center gap-2\">
            <span class=\"material-symbols-outlined text-primary\">timeline</span> 
            Évolution de vos scores
        </h3>
        
        <div class=\"mb-4\">
            <label for=\"evolution-select\" class=\"block text-[11px] font-bold text-on-surface-variant uppercase tracking-wider mb-2\">Choisir un test à analyser</label>
            <select id=\"evolution-select\" class=\"w-full md:w-1/2 p-3 bg-gray-50 border border-outline/30 rounded-xl text-sm font-bold text-on-surface focus:ring-2 focus:ring-primary focus:border-primary transition-all\">
                {% set tests_present = [] %}
                {% for h in historiques_asc %}
                    {% if h.idTest not in tests_present %}
                        {% set tests_present = tests_present|merge([h.idTest]) %}
                        <option value=\"{{ h.idTest }}\">{{ tests_map[h.idTest] ?? 'Test #' ~ h.idTest }}</option>
                    {% endif %}
                {% endfor %}
            </select>
            <p class=\"text-[10px] text-gray-400 mt-2\">Passez un test plusieurs fois pour voir votre courbe d'évolution.</p>
        </div>

        <div class=\"relative w-full h-72 lg:h-80 mt-6\">
            <canvas id=\"evolutionChart\"></canvas>
        </div>
    </div>
    {% endif %}

    {% if historiques is empty %}
        <div class=\"py-20 bg-gray-50/30 rounded-[3rem] border-2 border-dashed border-outline/40 flex flex-col items-center justify-center text-center\">
            <span class=\"material-symbols-outlined text-6xl text-gray-200 mb-4\">history</span>
            <h3 class=\"font-headline font-extrabold text-xl text-gray-400\">Aucun test passé</h3>
            <p class=\"text-xs text-gray-400 mt-2 uppercase tracking-widest\">Passez votre premier test pour voir votre historique</p>
            <a href=\"{{ path('testpsy_index') }}\"
               class=\"mt-8 px-8 py-3 bg-primary text-white text-sm font-bold rounded-2xl shadow-md shadow-primary/20 hover:bg-primary/90 transition-all\">
                Voir les tests
            </a>
        </div>
    {% else %}
        <div class=\"bg-white rounded-[3rem] p-2 shadow-sm border border-outline/20\">
            <div class=\"space-y-1 p-2\">
                {% for h in historiques %}
                <div class=\"flex items-center gap-6 p-6 rounded-[2rem] hover:bg-gray-50 transition-all border border-transparent hover:border-outline/30\">

                    <!-- Icon -->
                    <div class=\"w-12 h-12 rounded-[1rem] flex items-center justify-center flex-shrink-0
                        {% if h.niveau == 'faible' %} bg-green-50 text-green-500
                        {% elseif h.niveau == 'modere' %} bg-amber-50 text-amber-500
                        {% elseif h.niveau == 'eleve' %} bg-orange-50 text-orange-500
                        {% elseif h.niveau == 'critique' %} bg-red-50 text-red-500
                        {% else %} bg-primary/10 text-primary
                        {% endif %}\">
                        <span class=\"material-symbols-outlined\">
                            {% if h.niveau == 'faible' %}sentiment_satisfied
                            {% elseif h.niveau == 'modere' %}sentiment_neutral
                            {% elseif h.niveau == 'eleve' %}sentiment_dissatisfied
                            {% elseif h.niveau == 'critique' %}crisis_alert
                            {% else %}psychology_alt
                            {% endif %}
                        </span>
                    </div>

                    <!-- Info -->
                    <div class=\"flex-1 min-w-0\">
                        <div class=\"text-sm font-extrabold text-on-surface\">{{ tests_map[h.idTest] ?? 'Test #' ~ h.idTest }}</div>
                        <div class=\"text-xs text-on-surface-variant mt-0.5\">
                            {% if h.datePassage %}
                                {{ h.datePassage|date('d/m/Y à H:i') }}
                            {% else %}
                                Date inconnue
                            {% endif %}
                        </div>
                    </div>

                    <!-- Score -->
                    <div class=\"text-center flex-shrink-0\">
                        <div class=\"text-xl font-extrabold text-on-surface font-headline\">{{ h.score ?? '—' }}</div>
                        <div class=\"text-[9px] font-bold text-on-surface-variant uppercase tracking-widest\">Score</div>
                    </div>

                    <!-- Percentage -->
                    <div class=\"text-center flex-shrink-0\">
                        <div class=\"text-xl font-extrabold text-primary font-headline\">
                            {{ h.pourcentage ? h.pourcentage|round ~ '%' : '—' }}
                        </div>
                        <div class=\"text-[9px] font-bold text-on-surface-variant uppercase tracking-widest\">Résultat</div>
                    </div>

                    <!-- Level badge -->
                    <div class=\"flex-shrink-0\">
                        <span class=\"px-4 py-2 rounded-full text-[10px] font-bold uppercase tracking-wider
                            {% if h.niveau == 'faible' %} bg-green-100 text-green-700
                            {% elseif h.niveau == 'modere' %} bg-amber-100 text-amber-700
                            {% elseif h.niveau == 'eleve' %} bg-orange-100 text-orange-700
                            {% elseif h.niveau == 'critique' %} bg-red-100 text-red-700
                            {% else %} bg-gray-100 text-gray-600
                            {% endif %}\">
                            {{ h.niveau ?? 'N/A' }}
                        </span>
                    </div>

                </div>
                {% endfor %}
            </div>
        </div>
    {% endif %}

</div>

{% if historiques_asc is defined and historiques_asc|length > 0 %}
<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Transformer l'objet Twig en tableau JS
    const rawData = [
        {% for h in historiques_asc %}
            {
                idTest: {{ h.idTest }},
                titre: \"{{ tests_map[h.idTest] ?? 'Test' }}\",
                date: \"{{ h.datePassage ? h.datePassage|date('d/m/Y') : '' }}\",
                score: {{ h.pourcentage ?: 0 }}
            }{% if not loop.last %},{% endif %}
        {% endfor %}
    ];

    const select = document.getElementById('evolution-select');
    const ctx = document.getElementById('evolutionChart');
    if (!ctx || !select) return;

    let chartInstance = null;

    function renderChart(testId) {
        // Filtrer les données pour le test sélectionné
        const dataForTest = rawData.filter(d => d.idTest == testId);
        
        const labels = dataForTest.map(d => d.date);
        const data = dataForTest.map(d => d.score);

        if (chartInstance) {
            chartInstance.destroy();
        }

        chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Score au fil du temps (%)',
                    data: data,
                    borderColor: '#4f46e5', // Indigo 600
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#4f46e5',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: 'start',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: { display: true, text: 'Résultat (%)' }
                    }
                }
            }
        });
    }

    // Afficher le premier test sélectionné
    if (select.options.length > 0) {
        renderChart(select.value);
    }

    // Mettre à jour au changement
    select.addEventListener('change', function() {
        renderChart(this.value);
    });
});
</script>
{% endif %}

{% endblock %}", "pages/testpsy/historique.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\testpsy\\historique.html.twig");
    }
}
