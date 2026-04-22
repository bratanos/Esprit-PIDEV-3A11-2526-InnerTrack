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

/* pages/testpsy/index.html.twig */
class __TwigTemplate_6d8327cfce6c7a7aece580d20a9f45f8 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/testpsy/index.html.twig"));

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

        yield "Tests Psychologiques";
        
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
        yield "<div class=\"max-w-7xl mx-auto pb-24\">

    <!-- Header -->
    <div class=\"flex items-center justify-between mb-10\">
        <div>
            <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface\">Tests Psychologiques</h1>
            <p class=\"text-sm text-on-surface-variant mt-1\">Évaluez votre bien-être mental</p>
        </div>
        <div class=\"flex items-center gap-3\">
            <a href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_statistiques");
        yield "\"
               class=\"px-5 py-3 bg-white border border-outline/30 text-on-surface-variant text-sm font-bold rounded-2xl shadow-sm hover:text-primary hover:border-primary/30 hover:bg-gray-50 transition-all flex items-center gap-2\">
                <span class=\"material-symbols-outlined text-xl\">insights</span> Statistiques Globales
            </a>
            ";
        // line 19
        if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 20
            yield "            <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_create");
            yield "\"
               class=\"px-5 py-3 bg-primary text-white text-sm font-bold rounded-2xl shadow-md shadow-primary/20 hover:bg-primary/90 transition-all flex items-center gap-2\">
                <span class=\"material-symbols-outlined text-xl\">add</span> Nouveau test
            </a>
            ";
        }
        // line 25
        yield "        </div>
    </div>

    <!-- Flash messages -->
    ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 29, $this->source); })()), "flashes", ["success"], "method", false, false, false, 29));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 30
            yield "        <div class=\"mb-6 bg-green-50 border border-green-200 text-green-700 text-sm font-bold px-6 py-4 rounded-2xl flex items-center gap-3\">
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
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 34, $this->source); })()), "flashes", ["error"], "method", false, false, false, 34));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 35
            yield "        <div class=\"mb-6 bg-red-50 border border-red-200 text-red-700 text-sm font-bold px-6 py-4 rounded-2xl flex items-center gap-3\">
            <span class=\"material-symbols-outlined\">error</span> ";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        yield "
    <!-- Bien Être Global -->
    ";
        // line 41
        if ((array_key_exists("bien_etre", $context) &&  !(null === (isset($context["bien_etre"]) || array_key_exists("bien_etre", $context) ? $context["bien_etre"] : (function () { throw new RuntimeError('Variable "bien_etre" does not exist.', 41, $this->source); })())))) {
            // line 42
            yield "    <div class=\"mb-10 bg-[#4f46e5] text-white rounded-[2rem] p-8 shadow-lg shadow-indigo-200/50 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden\" style=\"background-color: #4f46e5;\">
        <div class=\"absolute -right-8 -top-8 opacity-10 pointer-events-none\">
            <span class=\"material-symbols-outlined text-[12rem] md:text-[18rem]\" style=\"font-variation-settings: 'FILL' 1;\">favorite</span>
        </div>
        <div class=\"z-10 text-center md:text-left\">
            <div class=\"inline-flex items-center gap-2 px-3 py-1 bg-white/20 rounded-full text-[10px] font-bold uppercase tracking-wider mb-4 border border-white/20\">
                <span class=\"material-symbols-outlined text-[14px]\">psychology</span> Indicateur de Santé Mentale
            </div>
            <h2 class=\"text-3xl lg:text-4xl font-headline font-extrabold mb-2 tracking-tight\">Score Global de Bien-Être</h2>
            <p class=\"text-indigo-100 text-sm max-w-lg leading-relaxed\">
                Calculé automatiquement et intelligemment à partir des résultats de l'ensemble de vos tests psychologiques, en inversant les scores de détresse pour créer une jauge unifiée de votre santé mentale.
            </p>
        </div>
        <div class=\"z-10 flex items-center shrink-0 mt-4 md:mt-0\">
            <div class=\"relative w-28 h-28 rounded-full flex items-center justify-center bg-transparent\">
                <svg class=\"absolute inset-0 w-full h-full -rotate-90\" viewBox=\"0 0 100 100\">
                    <circle cx=\"50\" cy=\"50\" r=\"44\" fill=\"transparent\" stroke=\"rgba(255,255,255,0.2)\" stroke-width=\"8\"></circle>
                    <circle cx=\"50\" cy=\"50\" r=\"44\" fill=\"transparent\" stroke=\"white\" stroke-width=\"8\" stroke-dasharray=\"276.46\" stroke-dashoffset=\"";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((276.46 - ((276.46 * (isset($context["bien_etre"]) || array_key_exists("bien_etre", $context) ? $context["bien_etre"] : (function () { throw new RuntimeError('Variable "bien_etre" does not exist.', 59, $this->source); })())) / 100)), "html", null, true);
            yield "\" stroke-linecap=\"round\" class=\"transition-all duration-[1500ms] ease-out\"></circle>
                </svg>
                <div class=\"absolute inset-2 bg-white/10 rounded-full backdrop-blur-md flex flex-col items-center justify-center shadow-inner border border-white/20\">
                    <span class=\"text-3xl font-extrabold font-headline leading-none\">";
            // line 62
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["bien_etre"]) || array_key_exists("bien_etre", $context) ? $context["bien_etre"] : (function () { throw new RuntimeError('Variable "bien_etre" does not exist.', 62, $this->source); })()), "html", null, true);
            yield "<span class=\"text-base opacity-70\">%</span></span>
                </div>
            </div>
        </div>
    </div>
    ";
        }
        // line 68
        yield "
    <!-- Statistiques par type -->
    ";
        // line 70
        if ((array_key_exists("stats_par_type", $context) &&  !Twig\Extension\CoreExtension::testEmpty((isset($context["stats_par_type"]) || array_key_exists("stats_par_type", $context) ? $context["stats_par_type"] : (function () { throw new RuntimeError('Variable "stats_par_type" does not exist.', 70, $this->source); })())))) {
            // line 71
            yield "    <div class=\"mb-10\">
        <h2 class=\"text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-4\">Répartition par type</h2>
        <div class=\"grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4\">
            ";
            // line 74
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["stats_par_type"]) || array_key_exists("stats_par_type", $context) ? $context["stats_par_type"] : (function () { throw new RuntimeError('Variable "stats_par_type" does not exist.', 74, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["stat"]) {
                // line 75
                yield "            <div class=\"bg-white rounded-[2rem] px-6 py-5 border border-outline/20 shadow-sm flex items-center gap-4 filter-category cursor-pointer hover:border-primary/50 transition-all\" data-filter=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["stat"], "libelle", [], "any", false, false, false, 75)), "html", null, true);
                yield "\">
                <div class=\"w-10 h-10 rounded-[1rem] bg-primary/10 flex items-center justify-center flex-shrink-0\">
                    <span class=\"material-symbols-outlined text-primary text-xl\">category</span>
                </div>
                <div class=\"min-w-0\">
                    <p class=\"text-[11px] font-bold text-on-surface-variant uppercase tracking-wider truncate\">";
                // line 80
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stat"], "libelle", [], "any", false, false, false, 80), "html", null, true);
                yield "</p>
                    <p class=\"text-2xl font-extrabold text-on-surface font-headline leading-tight\">";
                // line 81
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["stat"], "total", [], "any", false, false, false, 81), "html", null, true);
                yield "</p>
                    <p class=\"text-[10px] text-on-surface-variant\">test";
                // line 82
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["stat"], "total", [], "any", false, false, false, 82) > 1)) ? ("s") : (""));
                yield "</p>
                </div>
            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['stat'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 86
            yield "        </div>
    </div>
    ";
        }
        // line 89
        yield "
    <!-- Recherche et Favoris centrés -->
    <div class=\"mb-4 flex justify-center\">
        <div class=\"flex items-center gap-4 bg-white px-6 py-4 rounded-2xl border border-outline/30 shadow-sm w-full max-w-lg\">
            <span class=\"material-symbols-outlined text-on-surface-variant\">search</span>
            <input type=\"text\" id=\"search-input\"
                   placeholder=\"Rechercher un test par nom...\"
                   class=\"flex-1 bg-transparent text-sm font-medium text-on-surface placeholder-on-surface-variant/50 focus:outline-none\">
            <button id=\"search-clear\" class=\"hidden text-on-surface-variant hover:text-primary transition-colors\">
                <span class=\"material-symbols-outlined text-lg\">close</span>
            </button>
        </div>
    </div>
    <div class=\"mb-8 flex justify-center\">
        <button id=\"toggle-favorites-btn\" class=\"px-5 py-2 bg-white text-sm font-bold text-on-surface-variant border border-outline/30 rounded-full shadow-sm hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all flex items-center gap-2\">
            <span class=\"material-symbols-outlined text-[18px]\">favorite</span> <span id=\"fav-btn-text\">Afficher mes favoris</span>
        </button>
    </div>

    ";
        // line 108
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["tests"]) || array_key_exists("tests", $context) ? $context["tests"] : (function () { throw new RuntimeError('Variable "tests" does not exist.', 108, $this->source); })()))) {
            // line 109
            yield "        <div class=\"py-20 bg-gray-50/30 rounded-[3rem] border-2 border-dashed border-outline/40 flex flex-col items-center justify-center text-center\">
            <span class=\"material-symbols-outlined text-6xl text-gray-200 mb-4\">psychology</span>
            <h3 class=\"font-headline font-extrabold text-xl text-gray-400\">Aucun test disponible</h3>
            ";
            // line 112
            if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 113
                yield "            <p class=\"text-xs text-gray-400 mt-2 uppercase tracking-widest\">Créez votre premier test psychologique</p>
            <a href=\"";
                // line 114
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_create");
                yield "\"
               class=\"mt-8 px-8 py-3 bg-primary text-white text-sm font-bold rounded-2xl shadow-md shadow-primary/20 hover:bg-primary/90 transition-all\">
                Créer un test
            </a>
            ";
            }
            // line 119
            yield "        </div>

    ";
        } else {
            // line 122
            yield "        <div id=\"no-results\" class=\"hidden py-16 text-center\">
            <span class=\"material-symbols-outlined text-5xl text-gray-200 mb-3 block\">search_off</span>
            <p class=\"text-sm font-bold text-gray-400\">Aucun test ne correspond à votre recherche.</p>
        </div>

        <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6\" id=\"tests-grid\">
            ";
            // line 128
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["tests"]) || array_key_exists("tests", $context) ? $context["tests"] : (function () { throw new RuntimeError('Variable "tests" does not exist.', 128, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["test"]) {
                // line 129
                yield "
            ";
                // line 130
                $context["resultat"] = ((CoreExtension::getAttribute($this->env, $this->source, ($context["resultats_map"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["test"], "idTest", [], "any", false, false, false, 130), [], "array", true, true, false, 130)) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultats_map"]) || array_key_exists("resultats_map", $context) ? $context["resultats_map"] : (function () { throw new RuntimeError('Variable "resultats_map" does not exist.', 130, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["test"], "idTest", [], "any", false, false, false, 130), [], "array", false, false, false, 130)) : (null));
                // line 131
                yield "            ";
                $context["dejaPasse"] =  !(null === (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 131, $this->source); })()));
                // line 132
                yield "
            <div class=\"test-card relative bg-white rounded-[2.5rem] p-8 shadow-sm border transition-all duration-300 flex flex-col
                        ";
                // line 134
                yield (((($tmp = (isset($context["dejaPasse"]) || array_key_exists("dejaPasse", $context) ? $context["dejaPasse"] : (function () { throw new RuntimeError('Variable "dejaPasse" does not exist.', 134, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("border-green-200 hover:border-green-300") : ("border-outline/20 hover:border-primary/20"));
                yield " hover:shadow-md\"
                 data-titre=\"";
                // line 135
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["test"], "titre", [], "any", false, false, false, 135)), "html", null, true);
                yield "\" data-type=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), ((CoreExtension::getAttribute($this->env, $this->source, ($context["types_map"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["test"], "idType", [], "any", false, false, false, 135), [], "array", true, true, false, 135)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["types_map"]) || array_key_exists("types_map", $context) ? $context["types_map"] : (function () { throw new RuntimeError('Variable "types_map" does not exist.', 135, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["test"], "idType", [], "any", false, false, false, 135), [], "array", false, false, false, 135), "")) : (""))), "html", null, true);
                yield "\" data-testid=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["test"], "idTest", [], "any", false, false, false, 135), "html", null, true);
                yield "\">

                <!-- Icon + badges -->
                <div class=\"flex items-start justify-between mb-6\">
                    <div class=\"w-14 h-14 rounded-[1.25rem] flex items-center justify-center ";
                // line 139
                yield (((($tmp = (isset($context["dejaPasse"]) || array_key_exists("dejaPasse", $context) ? $context["dejaPasse"] : (function () { throw new RuntimeError('Variable "dejaPasse" does not exist.', 139, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-green-100 text-green-600") : ("bg-primary/10 text-primary"));
                yield "\">
                        <span class=\"material-symbols-outlined text-3xl\">";
                // line 140
                yield (((($tmp = (isset($context["dejaPasse"]) || array_key_exists("dejaPasse", $context) ? $context["dejaPasse"] : (function () { throw new RuntimeError('Variable "dejaPasse" does not exist.', 140, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("task_alt") : ("psychology_alt"));
                yield "</span>
                    </div>
                    <div class=\"flex flex-col items-end gap-2\">
                        <div class=\"flex items-center gap-2\">
                            <button class=\"fav-btn flex items-center justify-center w-8 h-8 rounded-full border border-outline/30 text-gray-300 hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all focus:outline-none\" data-id=\"";
                // line 144
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["test"], "idTest", [], "any", false, false, false, 144), "html", null, true);
                yield "\" title=\"Ajouter aux favoris\">
                                <span class=\"material-symbols-outlined text-[16px] fav-icon\">favorite</span>
                            </button>
                            <span class=\"px-3 py-1 bg-gray-100 text-gray-500 text-[10px] font-bold uppercase tracking-widest rounded-full\">
                                #";
                // line 148
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["test"], "idTest", [], "any", false, false, false, 148), "html", null, true);
                yield "
                            </span>
                        </div>
                        ";
                // line 151
                if ((($tmp = (isset($context["dejaPasse"]) || array_key_exists("dejaPasse", $context) ? $context["dejaPasse"] : (function () { throw new RuntimeError('Variable "dejaPasse" does not exist.', 151, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 152
                    yield "                            <span class=\"px-3 py-1 bg-green-100 text-green-600 text-[10px] font-bold uppercase tracking-widest rounded-full flex items-center gap-1\">
                                <span class=\"material-symbols-outlined text-[12px]\">check_circle</span> Déjà passé
                            </span>
                        ";
                }
                // line 156
                yield "                    </div>
                </div>

                <!-- Title & description -->
                <h3 class=\"text-lg font-extrabold text-on-surface font-headline leading-tight mb-2\">
                    ";
                // line 161
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["test"], "titre", [], "any", false, false, false, 161), "html", null, true);
                yield "
                </h3>
                <p class=\"text-sm text-on-surface-variant leading-relaxed flex-1 mb-4\">
                    ";
                // line 164
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["test"], "description", [], "any", false, false, false, 164), 0, 100), "html", null, true);
                if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["test"], "description", [], "any", false, false, false, 164)) > 100)) {
                    yield "…";
                }
                // line 165
                yield "                </p>

                <!-- Dernier résultat si déjà passé -->
                ";
                // line 168
                if ((($tmp = (isset($context["dejaPasse"]) || array_key_exists("dejaPasse", $context) ? $context["dejaPasse"] : (function () { throw new RuntimeError('Variable "dejaPasse" does not exist.', 168, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 169
                    yield "                    ";
                    $context["pct"] = CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 169, $this->source); })()), "pourcentage", [], "any", false, false, false, 169);
                    // line 170
                    yield "                    ";
                    $context["titre_lower"] = Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["test"], "titre", [], "any", false, false, false, 170));
                    // line 171
                    yield "                    
                    ";
                    // line 172
                    $context["raw_res"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["resultat"] ?? null), "resultat", [], "any", true, true, false, 172) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 172, $this->source); })()), "resultat", [], "any", false, false, false, 172)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 172, $this->source); })()), "resultat", [], "any", false, false, false, 172)) : (("Score : " . CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 172, $this->source); })()), "scoreTotal", [], "any", false, false, false, 172))));
                    // line 173
                    yield "                    ";
                    $context["clean_res"] = Twig\Extension\CoreExtension::trim(Twig\Extension\CoreExtension::replace((isset($context["raw_res"]) || array_key_exists("raw_res", $context) ? $context["raw_res"] : (function () { throw new RuntimeError('Variable "raw_res" does not exist.', 173, $this->source); })()), ["0" => "", "1" => "", "2" => "", "3" => "", "4" => "", "5" => "", "6" => "", "7" => "", "8" => "", "9" => ""]));
                    // line 174
                    yield "                    ";
                    $context["res_lower"] = Twig\Extension\CoreExtension::lower($this->env->getCharset(), (isset($context["clean_res"]) || array_key_exists("clean_res", $context) ? $context["clean_res"] : (function () { throw new RuntimeError('Variable "clean_res" does not exist.', 174, $this->source); })()));
                    // line 175
                    yield "
                    ";
                    // line 176
                    $context["isPositive"] = false;
                    // line 177
                    yield "                    ";
                    if (((((CoreExtension::inFilter("estime", (isset($context["titre_lower"]) || array_key_exists("titre_lower", $context) ? $context["titre_lower"] : (function () { throw new RuntimeError('Variable "titre_lower" does not exist.', 177, $this->source); })())) || CoreExtension::inFilter("resilience", (isset($context["titre_lower"]) || array_key_exists("titre_lower", $context) ? $context["titre_lower"] : (function () { throw new RuntimeError('Variable "titre_lower" does not exist.', 177, $this->source); })()))) || CoreExtension::inFilter("résilience", (isset($context["titre_lower"]) || array_key_exists("titre_lower", $context) ? $context["titre_lower"] : (function () { throw new RuntimeError('Variable "titre_lower" does not exist.', 177, $this->source); })()))) || CoreExtension::inFilter("emotionn", (isset($context["titre_lower"]) || array_key_exists("titre_lower", $context) ? $context["titre_lower"] : (function () { throw new RuntimeError('Variable "titre_lower" does not exist.', 177, $this->source); })()))) || CoreExtension::inFilter("émotionn", (isset($context["titre_lower"]) || array_key_exists("titre_lower", $context) ? $context["titre_lower"] : (function () { throw new RuntimeError('Variable "titre_lower" does not exist.', 177, $this->source); })())))) {
                        // line 178
                        yield "                        ";
                        $context["isPositive"] = true;
                        // line 179
                        yield "                    ";
                    }
                    // line 180
                    yield "
                    ";
                    // line 181
                    $context["isMBTI"] = false;
                    // line 182
                    yield "                    ";
                    if ((CoreExtension::inFilter("mbti", (isset($context["titre_lower"]) || array_key_exists("titre_lower", $context) ? $context["titre_lower"] : (function () { throw new RuntimeError('Variable "titre_lower" does not exist.', 182, $this->source); })())) || CoreExtension::inFilter("mbti", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 182, $this->source); })())))) {
                        // line 183
                        yield "                        ";
                        $context["isMBTI"] = true;
                        // line 184
                        yield "                    ";
                    }
                    // line 185
                    yield "
                    ";
                    // line 186
                    if ((($tmp = (isset($context["isMBTI"]) || array_key_exists("isMBTI", $context) ? $context["isMBTI"] : (function () { throw new RuntimeError('Variable "isMBTI" does not exist.', 186, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 187
                        yield "                        ";
                        $context["r_theme"] = "text-indigo-700 bg-indigo-50 border-indigo-200";
                        // line 188
                        yield "                        ";
                        $context["r_icon_bg"] = "bg-indigo-100 text-indigo-600";
                        // line 189
                        yield "                        ";
                        $context["r_bar"] = "bg-indigo-400";
                        // line 190
                        yield "                        ";
                        $context["r_icon"] = "psychology";
                        // line 191
                        yield "                    ";
                    } else {
                        // line 192
                        yield "                        ";
                        // line 193
                        yield "                        ";
                        $context["severity"] = "neutral";
                        // line 194
                        yield "                        ";
                        if ((((CoreExtension::inFilter("faible", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 194, $this->source); })())) || CoreExtension::inFilter("léger", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 194, $this->source); })()))) || CoreExtension::inFilter("leger", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 194, $this->source); })()))) || CoreExtension::inFilter("normal", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 194, $this->source); })())))) {
                            // line 195
                            yield "                            ";
                            $context["severity"] = "low";
                            // line 196
                            yield "                        ";
                        } elseif (((CoreExtension::inFilter("modéré", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 196, $this->source); })())) || CoreExtension::inFilter("moyen", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 196, $this->source); })()))) || CoreExtension::inFilter("modere", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 196, $this->source); })())))) {
                            // line 197
                            yield "                            ";
                            $context["severity"] = "medium";
                            // line 198
                            yield "                        ";
                        } elseif ((((((CoreExtension::inFilter("élevé", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 198, $this->source); })())) || CoreExtension::inFilter("eleve", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 198, $this->source); })()))) || CoreExtension::inFilter("critique", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 198, $this->source); })()))) || CoreExtension::inFilter("sévère", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 198, $this->source); })()))) || CoreExtension::inFilter("severe", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 198, $this->source); })()))) || CoreExtension::inFilter("grave", (isset($context["res_lower"]) || array_key_exists("res_lower", $context) ? $context["res_lower"] : (function () { throw new RuntimeError('Variable "res_lower" does not exist.', 198, $this->source); })())))) {
                            // line 199
                            yield "                            ";
                            $context["severity"] = "high";
                            // line 200
                            yield "                        ";
                        } else {
                            // line 201
                            yield "                            ";
                            // line 202
                            yield "                            ";
                            if (((isset($context["pct"]) || array_key_exists("pct", $context) ? $context["pct"] : (function () { throw new RuntimeError('Variable "pct" does not exist.', 202, $this->source); })()) < 30)) {
                                yield " ";
                                $context["severity"] = "low";
                                // line 203
                                yield "                            ";
                            } elseif (((isset($context["pct"]) || array_key_exists("pct", $context) ? $context["pct"] : (function () { throw new RuntimeError('Variable "pct" does not exist.', 203, $this->source); })()) < 60)) {
                                yield " ";
                                $context["severity"] = "medium";
                                // line 204
                                yield "                            ";
                            } else {
                                yield " ";
                                $context["severity"] = "high";
                                // line 205
                                yield "                            ";
                            }
                            // line 206
                            yield "                        ";
                        }
                        // line 207
                        yield "
                        ";
                        // line 208
                        if (((isset($context["severity"]) || array_key_exists("severity", $context) ? $context["severity"] : (function () { throw new RuntimeError('Variable "severity" does not exist.', 208, $this->source); })()) == "low")) {
                            // line 209
                            yield "                            ";
                            $context["r_theme"] = (((($tmp = (isset($context["isPositive"]) || array_key_exists("isPositive", $context) ? $context["isPositive"] : (function () { throw new RuntimeError('Variable "isPositive" does not exist.', 209, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("text-red-700 bg-red-50 border-red-200") : ("text-green-700 bg-green-50 border-green-200"));
                            // line 210
                            yield "                            ";
                            $context["r_icon_bg"] = (((($tmp = (isset($context["isPositive"]) || array_key_exists("isPositive", $context) ? $context["isPositive"] : (function () { throw new RuntimeError('Variable "isPositive" does not exist.', 210, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-red-100 text-red-600") : ("bg-green-100 text-green-600"));
                            // line 211
                            yield "                            ";
                            $context["r_bar"] = (((($tmp = (isset($context["isPositive"]) || array_key_exists("isPositive", $context) ? $context["isPositive"] : (function () { throw new RuntimeError('Variable "isPositive" does not exist.', 211, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-red-500") : ("bg-green-500"));
                            // line 212
                            yield "                            ";
                            $context["r_icon"] = (((($tmp = (isset($context["isPositive"]) || array_key_exists("isPositive", $context) ? $context["isPositive"] : (function () { throw new RuntimeError('Variable "isPositive" does not exist.', 212, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("sentiment_dissatisfied") : ("sentiment_satisfied"));
                            // line 213
                            yield "                        ";
                        } elseif (((isset($context["severity"]) || array_key_exists("severity", $context) ? $context["severity"] : (function () { throw new RuntimeError('Variable "severity" does not exist.', 213, $this->source); })()) == "medium")) {
                            // line 214
                            yield "                            ";
                            $context["r_theme"] = "text-amber-700 bg-amber-50 border-amber-200";
                            // line 215
                            yield "                            ";
                            $context["r_icon_bg"] = "bg-amber-100 text-amber-600";
                            // line 216
                            yield "                            ";
                            $context["r_bar"] = "bg-amber-500";
                            // line 217
                            yield "                            ";
                            $context["r_icon"] = "sentiment_neutral";
                            // line 218
                            yield "                        ";
                        } else {
                            // line 219
                            yield "                            ";
                            $context["r_theme"] = (((($tmp = (isset($context["isPositive"]) || array_key_exists("isPositive", $context) ? $context["isPositive"] : (function () { throw new RuntimeError('Variable "isPositive" does not exist.', 219, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("text-green-700 bg-green-50 border-green-200") : ("text-red-700 bg-red-50 border-red-200"));
                            // line 220
                            yield "                            ";
                            $context["r_icon_bg"] = (((($tmp = (isset($context["isPositive"]) || array_key_exists("isPositive", $context) ? $context["isPositive"] : (function () { throw new RuntimeError('Variable "isPositive" does not exist.', 220, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-green-100 text-green-600") : ("bg-red-100 text-red-600"));
                            // line 221
                            yield "                            ";
                            $context["r_bar"] = (((($tmp = (isset($context["isPositive"]) || array_key_exists("isPositive", $context) ? $context["isPositive"] : (function () { throw new RuntimeError('Variable "isPositive" does not exist.', 221, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-green-500") : ("bg-red-500"));
                            // line 222
                            yield "                            ";
                            $context["r_icon"] = (((($tmp = (isset($context["isPositive"]) || array_key_exists("isPositive", $context) ? $context["isPositive"] : (function () { throw new RuntimeError('Variable "isPositive" does not exist.', 222, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("celebration") : ("crisis_alert"));
                            // line 223
                            yield "                        ";
                        }
                        // line 224
                        yield "                    ";
                    }
                    // line 225
                    yield "
                    <div class=\"mb-6 rounded-[1.25rem] border ";
                    // line 226
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["r_theme"]) || array_key_exists("r_theme", $context) ? $context["r_theme"] : (function () { throw new RuntimeError('Variable "r_theme" does not exist.', 226, $this->source); })()), "html", null, true);
                    yield " overflow-hidden shadow-sm flex flex-col relative group\">
                        <!-- Progress Background fill (subtle) -->
                        <div class=\"absolute inset-0 ";
                    // line 228
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["r_bar"]) || array_key_exists("r_bar", $context) ? $context["r_bar"] : (function () { throw new RuntimeError('Variable "r_bar" does not exist.', 228, $this->source); })()), "html", null, true);
                    yield " opacity-5\" style=\"width: ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pct"]) || array_key_exists("pct", $context) ? $context["pct"] : (function () { throw new RuntimeError('Variable "pct" does not exist.', 228, $this->source); })()), "html", null, true);
                    yield "%\"></div>
                        
                        <div class=\"px-5 py-4 flex items-center justify-between relative z-10\">
                            <div class=\"flex items-center gap-3\">
                                <div class=\"w-10 h-10 rounded-full ";
                    // line 232
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["r_icon_bg"]) || array_key_exists("r_icon_bg", $context) ? $context["r_icon_bg"] : (function () { throw new RuntimeError('Variable "r_icon_bg" does not exist.', 232, $this->source); })()), "html", null, true);
                    yield " flex items-center justify-center\">
                                    <span class=\"material-symbols-outlined text-lg\">";
                    // line 233
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["r_icon"]) || array_key_exists("r_icon", $context) ? $context["r_icon"] : (function () { throw new RuntimeError('Variable "r_icon" does not exist.', 233, $this->source); })()), "html", null, true);
                    yield "</span>
                                </div>
                                <div class=\"min-w-0\">
                                    <p class=\"text-[9px] font-extrabold uppercase tracking-widest opacity-80 mb-0.5\">Dernier résultat</p>
                                    <p class=\"text-sm font-extrabold truncate\">";
                    // line 237
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["clean_res"]) || array_key_exists("clean_res", $context) ? $context["clean_res"] : (function () { throw new RuntimeError('Variable "clean_res" does not exist.', 237, $this->source); })()), "html", null, true);
                    yield "</p>
                                </div>
                            </div>
                            <div class=\"text-right pl-3\">
                                <span class=\"text-2xl font-extrabold font-headline\">";
                    // line 241
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pct"]) || array_key_exists("pct", $context) ? $context["pct"] : (function () { throw new RuntimeError('Variable "pct" does not exist.', 241, $this->source); })()), "html", null, true);
                    yield "%</span>
                            </div>
                        </div>
                        
                        <!-- Progress bar at bottom -->
                        <div class=\"h-1.5 w-full bg-black/5 relative z-10\">
                            <div class=\"h-full ";
                    // line 247
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["r_bar"]) || array_key_exists("r_bar", $context) ? $context["r_bar"] : (function () { throw new RuntimeError('Variable "r_bar" does not exist.', 247, $this->source); })()), "html", null, true);
                    yield " rounded-r-full transition-all duration-1000 shadow-[0_0_8px_rgba(0,0,0,0.2)]\" style=\"width: ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["pct"]) || array_key_exists("pct", $context) ? $context["pct"] : (function () { throw new RuntimeError('Variable "pct" does not exist.', 247, $this->source); })()), "html", null, true);
                    yield "%; box-shadow: inherit;\"></div>
                        </div>
                    </div>
                ";
                }
                // line 251
                yield "
                <!-- Questions count -->
                <div class=\"flex items-center gap-2 mb-6 py-3 px-4 bg-gray-50/70 rounded-2xl border border-outline/10\">
                    <span class=\"material-symbols-outlined text-sm text-on-surface-variant\">quiz</span>
                    <span class=\"text-xs font-bold text-on-surface-variant\">";
                // line 255
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["test"], "nombreQuestions", [], "any", false, false, false, 255), "html", null, true);
                yield " questions</span>
                </div>

                <!-- Actions -->
                <div class=\"flex gap-2 mt-auto\">

                    ";
                // line 261
                if ((($tmp = (isset($context["dejaPasse"]) || array_key_exists("dejaPasse", $context) ? $context["dejaPasse"] : (function () { throw new RuntimeError('Variable "dejaPasse" does not exist.', 261, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 262
                    yield "                        <!-- Voir résultat -->
                        <a href=\"";
                    // line 263
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_resultat", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 263, $this->source); })()), "idResultat", [], "any", false, false, false, 263)]), "html", null, true);
                    yield "\"
                           class=\"flex-1 py-3 text-center text-sm font-bold text-green-600 bg-green-50 border border-green-200 rounded-2xl hover:bg-green-100 transition-all\">
                            Voir résultat
                        </a>
                        <!-- Supprimer essai + repasser -->
                        <form method=\"post\" action=\"";
                    // line 268
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_supprimer_essai", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["resultat"]) || array_key_exists("resultat", $context) ? $context["resultat"] : (function () { throw new RuntimeError('Variable "resultat" does not exist.', 268, $this->source); })()), "idResultat", [], "any", false, false, false, 268)]), "html", null, true);
                    yield "\"
                              onsubmit=\"return confirm('Supprimer cet essai et repasser le test ?')\">
                            <button type=\"submit\"
                                    class=\"px-3 py-3 rounded-2xl border border-outline/40 text-on-surface-variant hover:bg-amber-50 hover:text-amber-500 hover:border-amber-200 transition-all\"
                                    title=\"Supprimer l\\'essai et repasser\">
                                <span class=\"material-symbols-outlined text-xl\">replay</span>
                            </button>
                        </form>
                    ";
                } else {
                    // line 277
                    yield "                        <!-- Passer -->
                        <a href=\"";
                    // line 278
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_passer", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["test"], "idTest", [], "any", false, false, false, 278)]), "html", null, true);
                    yield "\"
                           class=\"flex-1 py-3 text-center text-sm font-bold text-white bg-primary rounded-2xl hover:bg-primary/90 transition-all active:scale-95 shadow-sm shadow-primary/20\">
                            Passer
                        </a>
                    ";
                }
                // line 283
                yield "
                    <a href=\"";
                // line 284
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["test"], "idTest", [], "any", false, false, false, 284)]), "html", null, true);
                yield "\"
                       class=\"px-3 py-3 rounded-2xl border border-outline/40 text-on-surface-variant hover:bg-gray-50 hover:text-primary transition-all\"
                       title=\"Voir le détail\">
                        <span class=\"material-symbols-outlined text-xl\">info</span>
                    </a>
                    
                    ";
                // line 290
                if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 291
                    yield "                    <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["test"], "idTest", [], "any", false, false, false, 291)]), "html", null, true);
                    yield "\"
                       class=\"px-3 py-3 rounded-2xl border border-outline/40 text-on-surface-variant hover:bg-amber-50 hover:text-amber-500 hover:border-amber-200 transition-all\"
                       title=\"Modifier\">
                        <span class=\"material-symbols-outlined text-xl\">edit</span>
                    </a>
                    <form method=\"post\" action=\"";
                    // line 296
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["test"], "idTest", [], "any", false, false, false, 296)]), "html", null, true);
                    yield "\"
                          onsubmit=\"return confirm('Supprimer « ";
                    // line 297
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["test"], "titre", [], "any", false, false, false, 297), "html", null, true);
                    yield " » ? Cette action est irréversible.')\">
                        <button type=\"submit\"
                                class=\"px-3 py-3 rounded-2xl border border-outline/40 text-on-surface-variant hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-all\"
                                title=\"Supprimer\">
                            <span class=\"material-symbols-outlined text-xl\">delete</span>
                        </button>
                    </form>
                    ";
                }
                // line 305
                yield "                </div>
            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['test'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 308
            yield "        </div>

        <div class=\"mt-12 text-center\">
            <a href=\"";
            // line 311
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("testpsy_historique");
            yield "\"
               class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary transition-colors\">
                <span class=\"material-symbols-outlined\">history</span>
                Voir mon historique de tests
            </a>
        </div>
    ";
        }
        // line 318
        yield "
</div>

<script>
(function() {
    const input = document.getElementById('search-input');
    const clearBtn = document.getElementById('search-clear');
    const cards = document.querySelectorAll('.test-card');
    const noResults = document.getElementById('no-results');
    const categoryBtns = document.querySelectorAll('.filter-category');
    
    // Favoris logic
    const favToggles = document.querySelectorAll('.fav-btn');
    const favFilterBtn = document.getElementById('toggle-favorites-btn');
    const favBtnText = document.getElementById('fav-btn-text');
    let activeFilter = null;
    let showFavOnly = false;
    let favTests = JSON.parse(localStorage.getItem('psyFavTests') || '[]');

    function updateFavUI() {
        favToggles.forEach(btn => {
            const id = parseInt(btn.dataset.id);
            const icon = btn.querySelector('.fav-icon');
            if (favTests.includes(id)) {
                btn.classList.add('text-red-500', 'bg-red-50', 'border-red-200');
                btn.classList.remove('text-gray-300', 'border-outline/30');
                icon.style.fontVariationSettings = \"'FILL' 1\";
            } else {
                btn.classList.remove('text-red-500', 'bg-red-50', 'border-red-200');
                btn.classList.add('text-gray-300', 'border-outline/30');
                icon.style.fontVariationSettings = \"'FILL' 0\";
            }
        });
    }

    if (!input) return;

    function applyFilters() {
        const q = input.value.trim().toLowerCase();
        let visible = 0;
        cards.forEach(card => {
            const id = parseInt(card.dataset.testid);
            const matchTitle = card.dataset.titre.includes(q);
            const matchType = !activeFilter || card.dataset.type === activeFilter;
            const matchFav = !showFavOnly || favTests.includes(id);
            const isVisible = matchTitle && matchType && matchFav;
            
            card.style.display = isVisible ? '' : 'none';
            if (isVisible) visible++;
        });
        if (noResults) noResults.classList.toggle('hidden', visible > 0);
    }

    // Initialize favors UI
    updateFavUI();

    favToggles.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const id = parseInt(this.dataset.id);
            if (favTests.includes(id)) {
                favTests = favTests.filter(tId => tId !== id);
            } else {
                favTests.push(id);
            }
            localStorage.setItem('psyFavTests', JSON.stringify(favTests));
            updateFavUI();
            if (showFavOnly) applyFilters();
        });
    });

    if (favFilterBtn) {
        favFilterBtn.addEventListener('click', function() {
            showFavOnly = !showFavOnly;
            if (showFavOnly) {
                this.classList.add('bg-red-50', 'text-red-600', 'border-red-200');
                this.classList.remove('bg-white', 'text-on-surface-variant', 'border-outline/30');
                favBtnText.textContent = \"Masquer mes favoris\";
            } else {
                this.classList.remove('bg-red-50', 'text-red-600', 'border-red-200');
                this.classList.add('bg-white', 'text-on-surface-variant', 'border-outline/30');
                favBtnText.textContent = \"Afficher mes favoris\";
            }
            applyFilters();
        });
    }

    input.addEventListener('input', function() {
        clearBtn.classList.toggle('hidden', this.value.trim() === '');
        applyFilters();
    });

    clearBtn.addEventListener('click', function() {
        input.value = '';
        input.dispatchEvent(new Event('input'));
        input.focus();
    });

    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;
            if (activeFilter === filter) {
                activeFilter = null;
                this.classList.remove('ring-2', 'ring-primary', 'bg-primary/5');
            } else {
                categoryBtns.forEach(b => b.classList.remove('ring-2', 'ring-primary', 'bg-primary/5'));
                activeFilter = filter;
                this.classList.add('ring-2', 'ring-primary', 'bg-primary/5');
            }
            applyFilters();
        });
    });
})();
</script>
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
        return "pages/testpsy/index.html.twig";
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
        return array (  729 => 318,  719 => 311,  714 => 308,  706 => 305,  695 => 297,  691 => 296,  682 => 291,  680 => 290,  671 => 284,  668 => 283,  660 => 278,  657 => 277,  645 => 268,  637 => 263,  634 => 262,  632 => 261,  623 => 255,  617 => 251,  608 => 247,  599 => 241,  592 => 237,  585 => 233,  581 => 232,  572 => 228,  567 => 226,  564 => 225,  561 => 224,  558 => 223,  555 => 222,  552 => 221,  549 => 220,  546 => 219,  543 => 218,  540 => 217,  537 => 216,  534 => 215,  531 => 214,  528 => 213,  525 => 212,  522 => 211,  519 => 210,  516 => 209,  514 => 208,  511 => 207,  508 => 206,  505 => 205,  500 => 204,  495 => 203,  490 => 202,  488 => 201,  485 => 200,  482 => 199,  479 => 198,  476 => 197,  473 => 196,  470 => 195,  467 => 194,  464 => 193,  462 => 192,  459 => 191,  456 => 190,  453 => 189,  450 => 188,  447 => 187,  445 => 186,  442 => 185,  439 => 184,  436 => 183,  433 => 182,  431 => 181,  428 => 180,  425 => 179,  422 => 178,  419 => 177,  417 => 176,  414 => 175,  411 => 174,  408 => 173,  406 => 172,  403 => 171,  400 => 170,  397 => 169,  395 => 168,  390 => 165,  385 => 164,  379 => 161,  372 => 156,  366 => 152,  364 => 151,  358 => 148,  351 => 144,  344 => 140,  340 => 139,  329 => 135,  325 => 134,  321 => 132,  318 => 131,  316 => 130,  313 => 129,  309 => 128,  301 => 122,  296 => 119,  288 => 114,  285 => 113,  283 => 112,  278 => 109,  276 => 108,  255 => 89,  250 => 86,  240 => 82,  236 => 81,  232 => 80,  223 => 75,  219 => 74,  214 => 71,  212 => 70,  208 => 68,  199 => 62,  193 => 59,  174 => 42,  172 => 41,  168 => 39,  159 => 36,  156 => 35,  151 => 34,  142 => 31,  139 => 30,  135 => 29,  129 => 25,  120 => 20,  118 => 19,  111 => 15,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}Tests Psychologiques{% endblock %}

{% block content %}
<div class=\"max-w-7xl mx-auto pb-24\">

    <!-- Header -->
    <div class=\"flex items-center justify-between mb-10\">
        <div>
            <h1 class=\"text-3xl font-extrabold font-headline tracking-tight text-on-surface\">Tests Psychologiques</h1>
            <p class=\"text-sm text-on-surface-variant mt-1\">Évaluez votre bien-être mental</p>
        </div>
        <div class=\"flex items-center gap-3\">
            <a href=\"{{ path('testpsy_statistiques') }}\"
               class=\"px-5 py-3 bg-white border border-outline/30 text-on-surface-variant text-sm font-bold rounded-2xl shadow-sm hover:text-primary hover:border-primary/30 hover:bg-gray-50 transition-all flex items-center gap-2\">
                <span class=\"material-symbols-outlined text-xl\">insights</span> Statistiques Globales
            </a>
            {% if is_granted('ROLE_PSYCHOLOGUE') %}
            <a href=\"{{ path('testpsy_create') }}\"
               class=\"px-5 py-3 bg-primary text-white text-sm font-bold rounded-2xl shadow-md shadow-primary/20 hover:bg-primary/90 transition-all flex items-center gap-2\">
                <span class=\"material-symbols-outlined text-xl\">add</span> Nouveau test
            </a>
            {% endif %}
        </div>
    </div>

    <!-- Flash messages -->
    {% for message in app.flashes('success') %}
        <div class=\"mb-6 bg-green-50 border border-green-200 text-green-700 text-sm font-bold px-6 py-4 rounded-2xl flex items-center gap-3\">
            <span class=\"material-symbols-outlined\">check_circle</span> {{ message }}
        </div>
    {% endfor %}
    {% for message in app.flashes('error') %}
        <div class=\"mb-6 bg-red-50 border border-red-200 text-red-700 text-sm font-bold px-6 py-4 rounded-2xl flex items-center gap-3\">
            <span class=\"material-symbols-outlined\">error</span> {{ message }}
        </div>
    {% endfor %}

    <!-- Bien Être Global -->
    {% if bien_etre is defined and bien_etre is not null %}
    <div class=\"mb-10 bg-[#4f46e5] text-white rounded-[2rem] p-8 shadow-lg shadow-indigo-200/50 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden\" style=\"background-color: #4f46e5;\">
        <div class=\"absolute -right-8 -top-8 opacity-10 pointer-events-none\">
            <span class=\"material-symbols-outlined text-[12rem] md:text-[18rem]\" style=\"font-variation-settings: 'FILL' 1;\">favorite</span>
        </div>
        <div class=\"z-10 text-center md:text-left\">
            <div class=\"inline-flex items-center gap-2 px-3 py-1 bg-white/20 rounded-full text-[10px] font-bold uppercase tracking-wider mb-4 border border-white/20\">
                <span class=\"material-symbols-outlined text-[14px]\">psychology</span> Indicateur de Santé Mentale
            </div>
            <h2 class=\"text-3xl lg:text-4xl font-headline font-extrabold mb-2 tracking-tight\">Score Global de Bien-Être</h2>
            <p class=\"text-indigo-100 text-sm max-w-lg leading-relaxed\">
                Calculé automatiquement et intelligemment à partir des résultats de l'ensemble de vos tests psychologiques, en inversant les scores de détresse pour créer une jauge unifiée de votre santé mentale.
            </p>
        </div>
        <div class=\"z-10 flex items-center shrink-0 mt-4 md:mt-0\">
            <div class=\"relative w-28 h-28 rounded-full flex items-center justify-center bg-transparent\">
                <svg class=\"absolute inset-0 w-full h-full -rotate-90\" viewBox=\"0 0 100 100\">
                    <circle cx=\"50\" cy=\"50\" r=\"44\" fill=\"transparent\" stroke=\"rgba(255,255,255,0.2)\" stroke-width=\"8\"></circle>
                    <circle cx=\"50\" cy=\"50\" r=\"44\" fill=\"transparent\" stroke=\"white\" stroke-width=\"8\" stroke-dasharray=\"276.46\" stroke-dashoffset=\"{{ 276.46 - (276.46 * bien_etre / 100) }}\" stroke-linecap=\"round\" class=\"transition-all duration-[1500ms] ease-out\"></circle>
                </svg>
                <div class=\"absolute inset-2 bg-white/10 rounded-full backdrop-blur-md flex flex-col items-center justify-center shadow-inner border border-white/20\">
                    <span class=\"text-3xl font-extrabold font-headline leading-none\">{{ bien_etre }}<span class=\"text-base opacity-70\">%</span></span>
                </div>
            </div>
        </div>
    </div>
    {% endif %}

    <!-- Statistiques par type -->
    {% if stats_par_type is defined and stats_par_type is not empty %}
    <div class=\"mb-10\">
        <h2 class=\"text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-4\">Répartition par type</h2>
        <div class=\"grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4\">
            {% for stat in stats_par_type %}
            <div class=\"bg-white rounded-[2rem] px-6 py-5 border border-outline/20 shadow-sm flex items-center gap-4 filter-category cursor-pointer hover:border-primary/50 transition-all\" data-filter=\"{{ stat.libelle|lower }}\">
                <div class=\"w-10 h-10 rounded-[1rem] bg-primary/10 flex items-center justify-center flex-shrink-0\">
                    <span class=\"material-symbols-outlined text-primary text-xl\">category</span>
                </div>
                <div class=\"min-w-0\">
                    <p class=\"text-[11px] font-bold text-on-surface-variant uppercase tracking-wider truncate\">{{ stat.libelle }}</p>
                    <p class=\"text-2xl font-extrabold text-on-surface font-headline leading-tight\">{{ stat.total }}</p>
                    <p class=\"text-[10px] text-on-surface-variant\">test{{ stat.total > 1 ? 's' : '' }}</p>
                </div>
            </div>
            {% endfor %}
        </div>
    </div>
    {% endif %}

    <!-- Recherche et Favoris centrés -->
    <div class=\"mb-4 flex justify-center\">
        <div class=\"flex items-center gap-4 bg-white px-6 py-4 rounded-2xl border border-outline/30 shadow-sm w-full max-w-lg\">
            <span class=\"material-symbols-outlined text-on-surface-variant\">search</span>
            <input type=\"text\" id=\"search-input\"
                   placeholder=\"Rechercher un test par nom...\"
                   class=\"flex-1 bg-transparent text-sm font-medium text-on-surface placeholder-on-surface-variant/50 focus:outline-none\">
            <button id=\"search-clear\" class=\"hidden text-on-surface-variant hover:text-primary transition-colors\">
                <span class=\"material-symbols-outlined text-lg\">close</span>
            </button>
        </div>
    </div>
    <div class=\"mb-8 flex justify-center\">
        <button id=\"toggle-favorites-btn\" class=\"px-5 py-2 bg-white text-sm font-bold text-on-surface-variant border border-outline/30 rounded-full shadow-sm hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all flex items-center gap-2\">
            <span class=\"material-symbols-outlined text-[18px]\">favorite</span> <span id=\"fav-btn-text\">Afficher mes favoris</span>
        </button>
    </div>

    {% if tests is empty %}
        <div class=\"py-20 bg-gray-50/30 rounded-[3rem] border-2 border-dashed border-outline/40 flex flex-col items-center justify-center text-center\">
            <span class=\"material-symbols-outlined text-6xl text-gray-200 mb-4\">psychology</span>
            <h3 class=\"font-headline font-extrabold text-xl text-gray-400\">Aucun test disponible</h3>
            {% if is_granted('ROLE_PSYCHOLOGUE') %}
            <p class=\"text-xs text-gray-400 mt-2 uppercase tracking-widest\">Créez votre premier test psychologique</p>
            <a href=\"{{ path('testpsy_create') }}\"
               class=\"mt-8 px-8 py-3 bg-primary text-white text-sm font-bold rounded-2xl shadow-md shadow-primary/20 hover:bg-primary/90 transition-all\">
                Créer un test
            </a>
            {% endif %}
        </div>

    {% else %}
        <div id=\"no-results\" class=\"hidden py-16 text-center\">
            <span class=\"material-symbols-outlined text-5xl text-gray-200 mb-3 block\">search_off</span>
            <p class=\"text-sm font-bold text-gray-400\">Aucun test ne correspond à votre recherche.</p>
        </div>

        <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6\" id=\"tests-grid\">
            {% for test in tests %}

            {% set resultat = resultats_map[test.idTest] is defined ? resultats_map[test.idTest] : null %}
            {% set dejaPasse = resultat is not null %}

            <div class=\"test-card relative bg-white rounded-[2.5rem] p-8 shadow-sm border transition-all duration-300 flex flex-col
                        {{ dejaPasse ? 'border-green-200 hover:border-green-300' : 'border-outline/20 hover:border-primary/20' }} hover:shadow-md\"
                 data-titre=\"{{ test.titre|lower }}\" data-type=\"{{ types_map[test.idType]|default('')|lower }}\" data-testid=\"{{ test.idTest }}\">

                <!-- Icon + badges -->
                <div class=\"flex items-start justify-between mb-6\">
                    <div class=\"w-14 h-14 rounded-[1.25rem] flex items-center justify-center {{ dejaPasse ? 'bg-green-100 text-green-600' : 'bg-primary/10 text-primary' }}\">
                        <span class=\"material-symbols-outlined text-3xl\">{{ dejaPasse ? 'task_alt' : 'psychology_alt' }}</span>
                    </div>
                    <div class=\"flex flex-col items-end gap-2\">
                        <div class=\"flex items-center gap-2\">
                            <button class=\"fav-btn flex items-center justify-center w-8 h-8 rounded-full border border-outline/30 text-gray-300 hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all focus:outline-none\" data-id=\"{{ test.idTest }}\" title=\"Ajouter aux favoris\">
                                <span class=\"material-symbols-outlined text-[16px] fav-icon\">favorite</span>
                            </button>
                            <span class=\"px-3 py-1 bg-gray-100 text-gray-500 text-[10px] font-bold uppercase tracking-widest rounded-full\">
                                #{{ test.idTest }}
                            </span>
                        </div>
                        {% if dejaPasse %}
                            <span class=\"px-3 py-1 bg-green-100 text-green-600 text-[10px] font-bold uppercase tracking-widest rounded-full flex items-center gap-1\">
                                <span class=\"material-symbols-outlined text-[12px]\">check_circle</span> Déjà passé
                            </span>
                        {% endif %}
                    </div>
                </div>

                <!-- Title & description -->
                <h3 class=\"text-lg font-extrabold text-on-surface font-headline leading-tight mb-2\">
                    {{ test.titre }}
                </h3>
                <p class=\"text-sm text-on-surface-variant leading-relaxed flex-1 mb-4\">
                    {{ test.description|slice(0, 100) }}{% if test.description|length > 100 %}…{% endif %}
                </p>

                <!-- Dernier résultat si déjà passé -->
                {% if dejaPasse %}
                    {% set pct = resultat.pourcentage %}
                    {% set titre_lower = test.titre|lower %}
                    
                    {% set raw_res = resultat.resultat ?? ('Score : ' ~ resultat.scoreTotal) %}
                    {% set clean_res = raw_res|replace({'0':'','1':'','2':'','3':'','4':'','5':'','6':'','7':'','8':'','9':''})|trim %}
                    {% set res_lower = clean_res|lower %}

                    {% set isPositive = false %}
                    {% if 'estime' in titre_lower or 'resilience' in titre_lower or 'résilience' in titre_lower or 'emotionn' in titre_lower or 'émotionn' in titre_lower %}
                        {% set isPositive = true %}
                    {% endif %}

                    {% set isMBTI = false %}
                    {% if 'mbti' in titre_lower or 'mbti' in res_lower %}
                        {% set isMBTI = true %}
                    {% endif %}

                    {% if isMBTI %}
                        {% set r_theme = 'text-indigo-700 bg-indigo-50 border-indigo-200' %}
                        {% set r_icon_bg = 'bg-indigo-100 text-indigo-600' %}
                        {% set r_bar = 'bg-indigo-400' %}
                        {% set r_icon = 'psychology' %}
                    {% else %}
                        {# Fallback using string keywords #}
                        {% set severity = 'neutral' %}
                        {% if 'faible' in res_lower or 'léger' in res_lower or 'leger' in res_lower or 'normal' in res_lower %}
                            {% set severity = 'low' %}
                        {% elseif 'modéré' in res_lower or 'moyen' in res_lower or 'modere' in res_lower %}
                            {% set severity = 'medium' %}
                        {% elseif 'élevé' in res_lower or 'eleve' in res_lower or 'critique' in res_lower or 'sévère' in res_lower or 'severe' in res_lower or 'grave' in res_lower %}
                            {% set severity = 'high' %}
                        {% else %}
                            {# Fallback to pct #}
                            {% if pct < 30 %} {% set severity = 'low' %}
                            {% elseif pct < 60 %} {% set severity = 'medium' %}
                            {% else %} {% set severity = 'high' %}
                            {% endif %}
                        {% endif %}

                        {% if severity == 'low' %}
                            {% set r_theme = isPositive ? 'text-red-700 bg-red-50 border-red-200' : 'text-green-700 bg-green-50 border-green-200' %}
                            {% set r_icon_bg = isPositive ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' %}
                            {% set r_bar = isPositive ? 'bg-red-500' : 'bg-green-500' %}
                            {% set r_icon = isPositive ? 'sentiment_dissatisfied' : 'sentiment_satisfied' %}
                        {% elseif severity == 'medium' %}
                            {% set r_theme = 'text-amber-700 bg-amber-50 border-amber-200' %}
                            {% set r_icon_bg = 'bg-amber-100 text-amber-600' %}
                            {% set r_bar = 'bg-amber-500' %}
                            {% set r_icon = 'sentiment_neutral' %}
                        {% else %}
                            {% set r_theme = isPositive ? 'text-green-700 bg-green-50 border-green-200' : 'text-red-700 bg-red-50 border-red-200' %}
                            {% set r_icon_bg = isPositive ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' %}
                            {% set r_bar = isPositive ? 'bg-green-500' : 'bg-red-500' %}
                            {% set r_icon = isPositive ? 'celebration' : 'crisis_alert' %}
                        {% endif %}
                    {% endif %}

                    <div class=\"mb-6 rounded-[1.25rem] border {{ r_theme }} overflow-hidden shadow-sm flex flex-col relative group\">
                        <!-- Progress Background fill (subtle) -->
                        <div class=\"absolute inset-0 {{ r_bar }} opacity-5\" style=\"width: {{ pct }}%\"></div>
                        
                        <div class=\"px-5 py-4 flex items-center justify-between relative z-10\">
                            <div class=\"flex items-center gap-3\">
                                <div class=\"w-10 h-10 rounded-full {{ r_icon_bg }} flex items-center justify-center\">
                                    <span class=\"material-symbols-outlined text-lg\">{{ r_icon }}</span>
                                </div>
                                <div class=\"min-w-0\">
                                    <p class=\"text-[9px] font-extrabold uppercase tracking-widest opacity-80 mb-0.5\">Dernier résultat</p>
                                    <p class=\"text-sm font-extrabold truncate\">{{ clean_res }}</p>
                                </div>
                            </div>
                            <div class=\"text-right pl-3\">
                                <span class=\"text-2xl font-extrabold font-headline\">{{ pct }}%</span>
                            </div>
                        </div>
                        
                        <!-- Progress bar at bottom -->
                        <div class=\"h-1.5 w-full bg-black/5 relative z-10\">
                            <div class=\"h-full {{ r_bar }} rounded-r-full transition-all duration-1000 shadow-[0_0_8px_rgba(0,0,0,0.2)]\" style=\"width: {{ pct }}%; box-shadow: inherit;\"></div>
                        </div>
                    </div>
                {% endif %}

                <!-- Questions count -->
                <div class=\"flex items-center gap-2 mb-6 py-3 px-4 bg-gray-50/70 rounded-2xl border border-outline/10\">
                    <span class=\"material-symbols-outlined text-sm text-on-surface-variant\">quiz</span>
                    <span class=\"text-xs font-bold text-on-surface-variant\">{{ test.nombreQuestions }} questions</span>
                </div>

                <!-- Actions -->
                <div class=\"flex gap-2 mt-auto\">

                    {% if dejaPasse %}
                        <!-- Voir résultat -->
                        <a href=\"{{ path('testpsy_resultat', {id: resultat.idResultat}) }}\"
                           class=\"flex-1 py-3 text-center text-sm font-bold text-green-600 bg-green-50 border border-green-200 rounded-2xl hover:bg-green-100 transition-all\">
                            Voir résultat
                        </a>
                        <!-- Supprimer essai + repasser -->
                        <form method=\"post\" action=\"{{ path('testpsy_supprimer_essai', {id: resultat.idResultat}) }}\"
                              onsubmit=\"return confirm('Supprimer cet essai et repasser le test ?')\">
                            <button type=\"submit\"
                                    class=\"px-3 py-3 rounded-2xl border border-outline/40 text-on-surface-variant hover:bg-amber-50 hover:text-amber-500 hover:border-amber-200 transition-all\"
                                    title=\"Supprimer l\\'essai et repasser\">
                                <span class=\"material-symbols-outlined text-xl\">replay</span>
                            </button>
                        </form>
                    {% else %}
                        <!-- Passer -->
                        <a href=\"{{ path('testpsy_passer', {id: test.idTest}) }}\"
                           class=\"flex-1 py-3 text-center text-sm font-bold text-white bg-primary rounded-2xl hover:bg-primary/90 transition-all active:scale-95 shadow-sm shadow-primary/20\">
                            Passer
                        </a>
                    {% endif %}

                    <a href=\"{{ path('testpsy_show', {id: test.idTest}) }}\"
                       class=\"px-3 py-3 rounded-2xl border border-outline/40 text-on-surface-variant hover:bg-gray-50 hover:text-primary transition-all\"
                       title=\"Voir le détail\">
                        <span class=\"material-symbols-outlined text-xl\">info</span>
                    </a>
                    
                    {% if is_granted('ROLE_PSYCHOLOGUE') %}
                    <a href=\"{{ path('testpsy_edit', {id: test.idTest}) }}\"
                       class=\"px-3 py-3 rounded-2xl border border-outline/40 text-on-surface-variant hover:bg-amber-50 hover:text-amber-500 hover:border-amber-200 transition-all\"
                       title=\"Modifier\">
                        <span class=\"material-symbols-outlined text-xl\">edit</span>
                    </a>
                    <form method=\"post\" action=\"{{ path('testpsy_delete', {id: test.idTest}) }}\"
                          onsubmit=\"return confirm('Supprimer « {{ test.titre }} » ? Cette action est irréversible.')\">
                        <button type=\"submit\"
                                class=\"px-3 py-3 rounded-2xl border border-outline/40 text-on-surface-variant hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-all\"
                                title=\"Supprimer\">
                            <span class=\"material-symbols-outlined text-xl\">delete</span>
                        </button>
                    </form>
                    {% endif %}
                </div>
            </div>
            {% endfor %}
        </div>

        <div class=\"mt-12 text-center\">
            <a href=\"{{ path('testpsy_historique') }}\"
               class=\"inline-flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary transition-colors\">
                <span class=\"material-symbols-outlined\">history</span>
                Voir mon historique de tests
            </a>
        </div>
    {% endif %}

</div>

<script>
(function() {
    const input = document.getElementById('search-input');
    const clearBtn = document.getElementById('search-clear');
    const cards = document.querySelectorAll('.test-card');
    const noResults = document.getElementById('no-results');
    const categoryBtns = document.querySelectorAll('.filter-category');
    
    // Favoris logic
    const favToggles = document.querySelectorAll('.fav-btn');
    const favFilterBtn = document.getElementById('toggle-favorites-btn');
    const favBtnText = document.getElementById('fav-btn-text');
    let activeFilter = null;
    let showFavOnly = false;
    let favTests = JSON.parse(localStorage.getItem('psyFavTests') || '[]');

    function updateFavUI() {
        favToggles.forEach(btn => {
            const id = parseInt(btn.dataset.id);
            const icon = btn.querySelector('.fav-icon');
            if (favTests.includes(id)) {
                btn.classList.add('text-red-500', 'bg-red-50', 'border-red-200');
                btn.classList.remove('text-gray-300', 'border-outline/30');
                icon.style.fontVariationSettings = \"'FILL' 1\";
            } else {
                btn.classList.remove('text-red-500', 'bg-red-50', 'border-red-200');
                btn.classList.add('text-gray-300', 'border-outline/30');
                icon.style.fontVariationSettings = \"'FILL' 0\";
            }
        });
    }

    if (!input) return;

    function applyFilters() {
        const q = input.value.trim().toLowerCase();
        let visible = 0;
        cards.forEach(card => {
            const id = parseInt(card.dataset.testid);
            const matchTitle = card.dataset.titre.includes(q);
            const matchType = !activeFilter || card.dataset.type === activeFilter;
            const matchFav = !showFavOnly || favTests.includes(id);
            const isVisible = matchTitle && matchType && matchFav;
            
            card.style.display = isVisible ? '' : 'none';
            if (isVisible) visible++;
        });
        if (noResults) noResults.classList.toggle('hidden', visible > 0);
    }

    // Initialize favors UI
    updateFavUI();

    favToggles.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const id = parseInt(this.dataset.id);
            if (favTests.includes(id)) {
                favTests = favTests.filter(tId => tId !== id);
            } else {
                favTests.push(id);
            }
            localStorage.setItem('psyFavTests', JSON.stringify(favTests));
            updateFavUI();
            if (showFavOnly) applyFilters();
        });
    });

    if (favFilterBtn) {
        favFilterBtn.addEventListener('click', function() {
            showFavOnly = !showFavOnly;
            if (showFavOnly) {
                this.classList.add('bg-red-50', 'text-red-600', 'border-red-200');
                this.classList.remove('bg-white', 'text-on-surface-variant', 'border-outline/30');
                favBtnText.textContent = \"Masquer mes favoris\";
            } else {
                this.classList.remove('bg-red-50', 'text-red-600', 'border-red-200');
                this.classList.add('bg-white', 'text-on-surface-variant', 'border-outline/30');
                favBtnText.textContent = \"Afficher mes favoris\";
            }
            applyFilters();
        });
    }

    input.addEventListener('input', function() {
        clearBtn.classList.toggle('hidden', this.value.trim() === '');
        applyFilters();
    });

    clearBtn.addEventListener('click', function() {
        input.value = '';
        input.dispatchEvent(new Event('input'));
        input.focus();
    });

    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;
            if (activeFilter === filter) {
                activeFilter = null;
                this.classList.remove('ring-2', 'ring-primary', 'bg-primary/5');
            } else {
                categoryBtns.forEach(b => b.classList.remove('ring-2', 'ring-primary', 'bg-primary/5'));
                activeFilter = filter;
                this.classList.add('ring-2', 'ring-primary', 'bg-primary/5');
            }
            applyFilters();
        });
    });
})();
</script>
{% endblock %}
", "pages/testpsy/index.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\testpsy\\index.html.twig");
    }
}
