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

/* article/show.html.twig */
class __TwigTemplate_d6d689f9cb2bf2db5087daec76ec7fb3 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/show.html.twig"));

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
        yield "<div class=\"max-w-3xl space-y-6\">

    ";
        // line 7
        yield "    <nav class=\"flex items-center gap-2 text-sm text-on-surface-variant\">
        <a href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index");
        yield "\" class=\"hover:text-primary transition\">Articles</a>
        <span>›</span>
        ";
        // line 10
        if ((($tmp = (isset($context["currentPath"]) || array_key_exists("currentPath", $context) ? $context["currentPath"] : (function () { throw new RuntimeError('Variable "currentPath" does not exist.', 10, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 11
            yield "            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["currentPath"]) || array_key_exists("currentPath", $context) ? $context["currentPath"] : (function () { throw new RuntimeError('Variable "currentPath" does not exist.', 11, $this->source); })()), "id", [], "any", false, false, false, 11)]), "html", null, true);
            yield "\"
               class=\"hover:text-primary transition truncate max-w-[150px]\">
                ";
            // line 13
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["currentPath"]) || array_key_exists("currentPath", $context) ? $context["currentPath"] : (function () { throw new RuntimeError('Variable "currentPath" does not exist.', 13, $this->source); })()), "titre", [], "any", false, false, false, 13), "html", null, true);
            yield "
            </a>
            <span>›</span>
        ";
        }
        // line 17
        yield "        <span class=\"text-on-surface font-medium truncate max-w-xs\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 17, $this->source); })()), "titre", [], "any", false, false, false, 17), "html", null, true);
        yield "</span>
    </nav>

    ";
        // line 21
        yield "    ";
        if ((((isset($context["currentPath"]) || array_key_exists("currentPath", $context) ? $context["currentPath"] : (function () { throw new RuntimeError('Variable "currentPath" does not exist.', 21, $this->source); })()) && (isset($context["currentStep"]) || array_key_exists("currentStep", $context) ? $context["currentStep"] : (function () { throw new RuntimeError('Variable "currentStep" does not exist.', 21, $this->source); })())) && (isset($context["totalSteps"]) || array_key_exists("totalSteps", $context) ? $context["totalSteps"] : (function () { throw new RuntimeError('Variable "totalSteps" does not exist.', 21, $this->source); })()))) {
            // line 22
            yield "        <div class=\"bg-white rounded-2xl border border-outline/30 px-6 py-4 soft-elevation\">
            <div class=\"flex items-center justify-between mb-2\">
                <span class=\"text-xs font-bold text-primary flex items-center gap-1.5\">
                    <span class=\"material-symbols-outlined text-[15px]\">route</span>
                    ";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["currentPath"]) || array_key_exists("currentPath", $context) ? $context["currentPath"] : (function () { throw new RuntimeError('Variable "currentPath" does not exist.', 26, $this->source); })()), "titre", [], "any", false, false, false, 26), "html", null, true);
            yield "
                </span>
                <span class=\"text-xs font-bold text-on-surface-variant\">
                    Step ";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["currentStep"]) || array_key_exists("currentStep", $context) ? $context["currentStep"] : (function () { throw new RuntimeError('Variable "currentStep" does not exist.', 29, $this->source); })()), "html", null, true);
            yield " / ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["totalSteps"]) || array_key_exists("totalSteps", $context) ? $context["totalSteps"] : (function () { throw new RuntimeError('Variable "totalSteps" does not exist.', 29, $this->source); })()), "html", null, true);
            yield "
                </span>
            </div>
            <div class=\"w-full bg-gray-100 rounded-full h-2\">
                <div class=\"bg-primary rounded-full h-2 transition-all duration-500\"
                     style=\"width: ";
            // line 34
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((((isset($context["currentStep"]) || array_key_exists("currentStep", $context) ? $context["currentStep"] : (function () { throw new RuntimeError('Variable "currentStep" does not exist.', 34, $this->source); })()) / (isset($context["totalSteps"]) || array_key_exists("totalSteps", $context) ? $context["totalSteps"] : (function () { throw new RuntimeError('Variable "totalSteps" does not exist.', 34, $this->source); })())) * 100)), "html", null, true);
            yield "%\"></div>
            </div>
        </div>
    ";
        }
        // line 38
        yield "
    ";
        // line 40
        yield "    <div class=\"bg-white rounded-[2rem] border border-outline/30 p-8 soft-elevation space-y-5\">

        ";
        // line 43
        yield "        <div class=\"flex flex-wrap items-center gap-3\">
            ";
        // line 44
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 44, $this->source); })()), "categorie", [], "any", false, false, false, 44)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 45
            yield "                <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index", ["categorie" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 45, $this->source); })()), "categorie", [], "any", false, false, false, 45), "id", [], "any", false, false, false, 45)]), "html", null, true);
            yield "\"
                   class=\"text-xs font-bold bg-primary/10 text-primary px-3 py-1 rounded-full hover:bg-primary/20 transition\">
                    ";
            // line 47
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 47, $this->source); })()), "categorie", [], "any", false, false, false, 47), "nom", [], "any", false, false, false, 47), "html", null, true);
            yield "
                </a>
            ";
        }
        // line 50
        yield "            ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 50, $this->source); })()), "readability", [], "any", false, false, false, 50)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 51
            yield "                ";
            $context["rc"] = ["Easy" => "bg-green-100 text-green-700", "Intermediate" => "bg-amber-100 text-amber-700", "Advanced" => "bg-red-100 text-red-700"];
            // line 56
            yield "                <span class=\"text-xs font-bold px-3 py-1 rounded-full ";
            yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["rc"] ?? null), CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 56, $this->source); })()), "readability", [], "any", false, false, false, 56), [], "array", true, true, false, 56) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["rc"]) || array_key_exists("rc", $context) ? $context["rc"] : (function () { throw new RuntimeError('Variable "rc" does not exist.', 56, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 56, $this->source); })()), "readability", [], "any", false, false, false, 56), [], "array", false, false, false, 56)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rc"]) || array_key_exists("rc", $context) ? $context["rc"] : (function () { throw new RuntimeError('Variable "rc" does not exist.', 56, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 56, $this->source); })()), "readability", [], "any", false, false, false, 56), [], "array", false, false, false, 56), "html", null, true)) : (""));
            yield "\">
                    ";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 57, $this->source); })()), "readability", [], "any", false, false, false, 57), "html", null, true);
            yield "
                </span>
            ";
        }
        // line 60
        yield "            <span class=\"ml-auto text-xs text-on-surface-variant flex items-center gap-1\">
                <span class=\"material-symbols-outlined text-[14px]\">calendar_today</span>
                ";
        // line 62
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 62, $this->source); })()), "datePublication", [], "any", false, false, false, 62)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 62, $this->source); })()), "datePublication", [], "any", false, false, false, 62), "d/m/Y"), "html", null, true)) : ("—"));
        yield "
            </span>
        </div>

        ";
        // line 67
        yield "        <h1 class=\"text-2xl font-extrabold text-on-surface tracking-tight leading-tight\">
            ";
        // line 68
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 68, $this->source); })()), "titre", [], "any", false, false, false, 68), "html", null, true);
        yield "
        </h1>

        ";
        // line 72
        yield "        ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 72, $this->source); })()), "auteur", [], "any", false, false, false, 72)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 73
            yield "            <div class=\"flex items-center gap-2 text-sm text-on-surface-variant\">
                <div class=\"w-6 h-6 rounded-full bg-primary/15 text-primary flex items-center justify-center text-[9px] font-bold shrink-0 overflow-hidden\">
                    ";
            // line 75
            if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["article"] ?? null), "auteur", [], "any", false, true, false, 75), "profilePictureUrl", [], "any", true, true, false, 75) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 75, $this->source); })()), "auteur", [], "any", false, false, false, 75), "profilePictureUrl", [], "any", false, false, false, 75))) {
                // line 76
                yield "                        <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 76, $this->source); })()), "auteur", [], "any", false, false, false, 76), "profilePictureUrl", [], "any", false, false, false, 76), "html", null, true);
                yield "\" class=\"w-full h-full object-cover\" alt=\"\">
                    ";
            } else {
                // line 78
                yield "                        ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 78, $this->source); })()), "auteur", [], "any", false, false, false, 78), "firstName", [], "any", false, false, false, 78))), "html", null, true);
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 78, $this->source); })()), "auteur", [], "any", false, false, false, 78), "lastName", [], "any", false, false, false, 78))), "html", null, true);
                yield "
                    ";
            }
            // line 80
            yield "                </div>
                <span class=\"font-medium text-xs\">";
            // line 81
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 81, $this->source); })()), "auteur", [], "any", false, false, false, 81), "firstName", [], "any", false, false, false, 81), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 81, $this->source); })()), "auteur", [], "any", false, false, false, 81), "lastName", [], "any", false, false, false, 81), "html", null, true);
            yield "</span>
            </div>
        ";
        }
        // line 84
        yield "
        <div class=\"h-px bg-outline/20\"></div>

        ";
        // line 88
        yield "        <div class=\"text-sm text-on-surface leading-relaxed whitespace-pre-line\">
            ";
        // line 89
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 89, $this->source); })()), "contenu", [], "any", false, false, false, 89), "html", null, true);
        yield "
        </div>

        ";
        // line 93
        yield "        ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 93, $this->source); })()), "tags", [], "any", false, false, false, 93)) > 0)) {
            // line 94
            yield "            <div class=\"flex flex-wrap items-center gap-2 pt-2 border-t border-outline/20\">
                <span class=\"material-symbols-outlined text-on-surface-variant text-[16px]\">label</span>
                ";
            // line 96
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 96, $this->source); })()), "tags", [], "any", false, false, false, 96));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 97
                yield "                    <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_by_tag", ["tagName" => CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "nom", [], "any", false, false, false, 97)]), "html", null, true);
                yield "\"
                       class=\"text-xs font-semibold bg-gray-100 text-on-surface-variant px-2.5 py-1 rounded-full
                              hover:bg-primary/10 hover:text-primary transition\">
                        #";
                // line 100
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "nom", [], "any", false, false, false, 100), "html", null, true);
                yield "
                    </a>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['tag'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 103
            yield "            </div>
        ";
        }
        // line 105
        yield "
    </div>

    ";
        // line 109
        yield "    ";
        if ((($tmp = (isset($context["nextStep"]) || array_key_exists("nextStep", $context) ? $context["nextStep"] : (function () { throw new RuntimeError('Variable "nextStep" does not exist.', 109, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 110
            yield "        <div class=\"bg-gradient-to-r from-primary/5 to-primary/10 rounded-2xl border border-primary/20 px-6 py-5
                    flex items-center justify-between gap-4\">
            <div>
                <p class=\"text-xs font-bold text-primary uppercase tracking-widest mb-1\">Continue learning</p>
                <p class=\"text-sm font-semibold text-on-surface line-clamp-1\">";
            // line 114
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["nextStep"]) || array_key_exists("nextStep", $context) ? $context["nextStep"] : (function () { throw new RuntimeError('Variable "nextStep" does not exist.', 114, $this->source); })()), "article", [], "any", false, false, false, 114), "titre", [], "any", false, false, false, 114), "html", null, true);
            yield "</p>
                <p class=\"text-xs text-on-surface-variant mt-0.5\">
                    Step ";
            // line 116
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["nextStep"]) || array_key_exists("nextStep", $context) ? $context["nextStep"] : (function () { throw new RuntimeError('Variable "nextStep" does not exist.', 116, $this->source); })()), "articleOrder", [], "any", false, false, false, 116), "html", null, true);
            yield " / ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["totalSteps"]) || array_key_exists("totalSteps", $context) ? $context["totalSteps"] : (function () { throw new RuntimeError('Variable "totalSteps" does not exist.', 116, $this->source); })()), "html", null, true);
            yield "
                </p>
            </div>
            <a href=\"";
            // line 119
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["nextStep"]) || array_key_exists("nextStep", $context) ? $context["nextStep"] : (function () { throw new RuntimeError('Variable "nextStep" does not exist.', 119, $this->source); })()), "article", [], "any", false, false, false, 119), "id", [], "any", false, false, false, 119)]), "html", null, true);
            yield "\"
               class=\"shrink-0 flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold text-sm
                      hover:bg-primary/90 transition shadow-md shadow-primary/20 whitespace-nowrap\">
                Next
                <span class=\"material-symbols-outlined text-[16px]\">arrow_forward</span>
            </a>
        </div>
    ";
        }
        // line 127
        yield "
    ";
        // line 129
        yield "    ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["relatedArticles"]) || array_key_exists("relatedArticles", $context) ? $context["relatedArticles"] : (function () { throw new RuntimeError('Variable "relatedArticles" does not exist.', 129, $this->source); })())) > 0)) {
            // line 130
            yield "        <div class=\"space-y-3\">
            <h2 class=\"text-xs font-bold text-on-surface-variant uppercase tracking-widest flex items-center gap-2\">
                <span class=\"material-symbols-outlined text-[16px]\">recommend</span>
                You might also like
            </h2>
            ";
            // line 135
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["relatedArticles"]) || array_key_exists("relatedArticles", $context) ? $context["relatedArticles"] : (function () { throw new RuntimeError('Variable "relatedArticles" does not exist.', 135, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["related"]) {
                // line 136
                yield "                <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["related"], "id", [], "any", false, false, false, 136)]), "html", null, true);
                yield "\"
                   class=\"group flex items-center gap-4 bg-white rounded-2xl border border-outline/30 px-5 py-4
                          hover:border-primary/30 hover:shadow-md transition-all\">
                    <div class=\"w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0\">
                        <span class=\"material-symbols-outlined text-primary text-[18px]\">article</span>
                    </div>
                    <div class=\"flex-1 min-w-0\">
                        <p class=\"text-sm font-semibold text-on-surface group-hover:text-primary transition-colors line-clamp-1\">
                            ";
                // line 144
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["related"], "titre", [], "any", false, false, false, 144), "html", null, true);
                yield "
                        </p>
                        <p class=\"text-xs text-on-surface-variant mt-0.5 line-clamp-1\">
                            ";
                // line 147
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["related"], "contenu", [], "any", false, false, false, 147)), 0, 80), "html", null, true);
                yield "…
                        </p>
                    </div>
                    ";
                // line 150
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["related"], "categorie", [], "any", false, false, false, 150)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 151
                    yield "                        <span class=\"shrink-0 text-[10px] font-bold bg-primary/10 text-primary px-2 py-1 rounded-full\">
                            ";
                    // line 152
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["related"], "categorie", [], "any", false, false, false, 152), "nom", [], "any", false, false, false, 152), "html", null, true);
                    yield "
                        </span>
                    ";
                }
                // line 155
                yield "                </a>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['related'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 157
            yield "        </div>
    ";
        }
        // line 159
        yield "
    ";
        // line 161
        yield "    <div class=\"flex items-center justify-between pt-2 border-t border-outline/20\">
        <a href=\"";
        // line 162
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index");
        yield "\"
           class=\"flex items-center gap-1.5 text-sm font-semibold text-on-surface-variant hover:text-primary transition\">
            <span class=\"material-symbols-outlined text-[16px]\">arrow_back</span>
            Back
        </a>
        ";
        // line 167
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE"))) {
            // line 168
            yield "            <div class=\"flex items-center gap-3\">
                <a href=\"";
            // line 169
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 169, $this->source); })()), "id", [], "any", false, false, false, 169)]), "html", null, true);
            yield "\"
                   class=\"flex items-center gap-1.5 px-4 py-2 rounded-xl border border-outline text-sm font-semibold hover:bg-gray-50 transition\">
                    <span class=\"material-symbols-outlined text-[16px]\">edit</span> Edit
                </a>
                <form method=\"post\" action=\"";
            // line 173
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 173, $this->source); })()), "id", [], "any", false, false, false, 173)]), "html", null, true);
            yield "\"
                      onsubmit=\"return confirm('Permanently delete this article?')\">
                    <input type=\"hidden\" name=\"_token\" value=\"";
            // line 175
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 175, $this->source); })()), "id", [], "any", false, false, false, 175))), "html", null, true);
            yield "\">
                    <button class=\"flex items-center gap-1.5 px-4 py-2 rounded-xl border border-red-200 text-sm font-semibold text-red-500 hover:bg-red-50 transition\">
                        <span class=\"material-symbols-outlined text-[16px]\">delete</span> Delete
                    </button>
                </form>
            </div>
        ";
        }
        // line 182
        yield "    </div>

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
        return "article/show.html.twig";
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
        return array (  423 => 182,  413 => 175,  408 => 173,  401 => 169,  398 => 168,  396 => 167,  388 => 162,  385 => 161,  382 => 159,  378 => 157,  371 => 155,  365 => 152,  362 => 151,  360 => 150,  354 => 147,  348 => 144,  336 => 136,  332 => 135,  325 => 130,  322 => 129,  319 => 127,  308 => 119,  300 => 116,  295 => 114,  289 => 110,  286 => 109,  281 => 105,  277 => 103,  268 => 100,  261 => 97,  257 => 96,  253 => 94,  250 => 93,  244 => 89,  241 => 88,  236 => 84,  228 => 81,  225 => 80,  218 => 78,  212 => 76,  210 => 75,  206 => 73,  203 => 72,  197 => 68,  194 => 67,  187 => 62,  183 => 60,  177 => 57,  172 => 56,  169 => 51,  166 => 50,  160 => 47,  154 => 45,  152 => 44,  149 => 43,  145 => 40,  142 => 38,  135 => 34,  125 => 29,  119 => 26,  113 => 22,  110 => 21,  103 => 17,  96 => 13,  90 => 11,  88 => 10,  83 => 8,  80 => 7,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}
<div class=\"max-w-3xl space-y-6\">

    {# Breadcrumb #}
    <nav class=\"flex items-center gap-2 text-sm text-on-surface-variant\">
        <a href=\"{{ path('app_article_index') }}\" class=\"hover:text-primary transition\">Articles</a>
        <span>›</span>
        {% if currentPath %}
            <a href=\"{{ path('app_learning_path_show', {id: currentPath.id}) }}\"
               class=\"hover:text-primary transition truncate max-w-[150px]\">
                {{ currentPath.titre }}
            </a>
            <span>›</span>
        {% endif %}
        <span class=\"text-on-surface font-medium truncate max-w-xs\">{{ article.titre }}</span>
    </nav>

    {# Progress bar (if reading inside a path) #}
    {% if currentPath and currentStep and totalSteps %}
        <div class=\"bg-white rounded-2xl border border-outline/30 px-6 py-4 soft-elevation\">
            <div class=\"flex items-center justify-between mb-2\">
                <span class=\"text-xs font-bold text-primary flex items-center gap-1.5\">
                    <span class=\"material-symbols-outlined text-[15px]\">route</span>
                    {{ currentPath.titre }}
                </span>
                <span class=\"text-xs font-bold text-on-surface-variant\">
                    Step {{ currentStep }} / {{ totalSteps }}
                </span>
            </div>
            <div class=\"w-full bg-gray-100 rounded-full h-2\">
                <div class=\"bg-primary rounded-full h-2 transition-all duration-500\"
                     style=\"width: {{ ((currentStep / totalSteps) * 100)|round }}%\"></div>
            </div>
        </div>
    {% endif %}

    {# Article card #}
    <div class=\"bg-white rounded-[2rem] border border-outline/30 p-8 soft-elevation space-y-5\">

        {# Meta row #}
        <div class=\"flex flex-wrap items-center gap-3\">
            {% if article.categorie %}
                <a href=\"{{ path('app_article_index', {categorie: article.categorie.id}) }}\"
                   class=\"text-xs font-bold bg-primary/10 text-primary px-3 py-1 rounded-full hover:bg-primary/20 transition\">
                    {{ article.categorie.nom }}
                </a>
            {% endif %}
            {% if article.readability %}
                {% set rc = {
                    'Easy':         'bg-green-100 text-green-700',
                    'Intermediate': 'bg-amber-100 text-amber-700',
                    'Advanced':     'bg-red-100 text-red-700'
                } %}
                <span class=\"text-xs font-bold px-3 py-1 rounded-full {{ rc[article.readability] ?? '' }}\">
                    {{ article.readability }}
                </span>
            {% endif %}
            <span class=\"ml-auto text-xs text-on-surface-variant flex items-center gap-1\">
                <span class=\"material-symbols-outlined text-[14px]\">calendar_today</span>
                {{ article.datePublication ? article.datePublication|date('d/m/Y') : '—' }}
            </span>
        </div>

        {# Title #}
        <h1 class=\"text-2xl font-extrabold text-on-surface tracking-tight leading-tight\">
            {{ article.titre }}
        </h1>

        {# Author #}
        {% if article.auteur %}
            <div class=\"flex items-center gap-2 text-sm text-on-surface-variant\">
                <div class=\"w-6 h-6 rounded-full bg-primary/15 text-primary flex items-center justify-center text-[9px] font-bold shrink-0 overflow-hidden\">
                    {% if article.auteur.profilePictureUrl is defined and article.auteur.profilePictureUrl %}
                        <img src=\"{{ article.auteur.profilePictureUrl }}\" class=\"w-full h-full object-cover\" alt=\"\">
                    {% else %}
                        {{ article.auteur.firstName|first|upper }}{{ article.auteur.lastName|first|upper }}
                    {% endif %}
                </div>
                <span class=\"font-medium text-xs\">{{ article.auteur.firstName }} {{ article.auteur.lastName }}</span>
            </div>
        {% endif %}

        <div class=\"h-px bg-outline/20\"></div>

        {# Content #}
        <div class=\"text-sm text-on-surface leading-relaxed whitespace-pre-line\">
            {{ article.contenu }}
        </div>

        {# Tags #}
        {% if article.tags|length > 0 %}
            <div class=\"flex flex-wrap items-center gap-2 pt-2 border-t border-outline/20\">
                <span class=\"material-symbols-outlined text-on-surface-variant text-[16px]\">label</span>
                {% for tag in article.tags %}
                    <a href=\"{{ path('app_article_by_tag', {tagName: tag.nom}) }}\"
                       class=\"text-xs font-semibold bg-gray-100 text-on-surface-variant px-2.5 py-1 rounded-full
                              hover:bg-primary/10 hover:text-primary transition\">
                        #{{ tag.nom }}
                    </a>
                {% endfor %}
            </div>
        {% endif %}

    </div>

    {# Next article in path #}
    {% if nextStep %}
        <div class=\"bg-gradient-to-r from-primary/5 to-primary/10 rounded-2xl border border-primary/20 px-6 py-5
                    flex items-center justify-between gap-4\">
            <div>
                <p class=\"text-xs font-bold text-primary uppercase tracking-widest mb-1\">Continue learning</p>
                <p class=\"text-sm font-semibold text-on-surface line-clamp-1\">{{ nextStep.article.titre }}</p>
                <p class=\"text-xs text-on-surface-variant mt-0.5\">
                    Step {{ nextStep.articleOrder }} / {{ totalSteps }}
                </p>
            </div>
            <a href=\"{{ path('app_article_show', {id: nextStep.article.id}) }}\"
               class=\"shrink-0 flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold text-sm
                      hover:bg-primary/90 transition shadow-md shadow-primary/20 whitespace-nowrap\">
                Next
                <span class=\"material-symbols-outlined text-[16px]\">arrow_forward</span>
            </a>
        </div>
    {% endif %}

    {# Related articles by tags #}
    {% if relatedArticles|length > 0 %}
        <div class=\"space-y-3\">
            <h2 class=\"text-xs font-bold text-on-surface-variant uppercase tracking-widest flex items-center gap-2\">
                <span class=\"material-symbols-outlined text-[16px]\">recommend</span>
                You might also like
            </h2>
            {% for related in relatedArticles %}
                <a href=\"{{ path('app_article_show', {id: related.id}) }}\"
                   class=\"group flex items-center gap-4 bg-white rounded-2xl border border-outline/30 px-5 py-4
                          hover:border-primary/30 hover:shadow-md transition-all\">
                    <div class=\"w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0\">
                        <span class=\"material-symbols-outlined text-primary text-[18px]\">article</span>
                    </div>
                    <div class=\"flex-1 min-w-0\">
                        <p class=\"text-sm font-semibold text-on-surface group-hover:text-primary transition-colors line-clamp-1\">
                            {{ related.titre }}
                        </p>
                        <p class=\"text-xs text-on-surface-variant mt-0.5 line-clamp-1\">
                            {{ related.contenu|striptags|slice(0, 80) }}…
                        </p>
                    </div>
                    {% if related.categorie %}
                        <span class=\"shrink-0 text-[10px] font-bold bg-primary/10 text-primary px-2 py-1 rounded-full\">
                            {{ related.categorie.nom }}
                        </span>
                    {% endif %}
                </a>
            {% endfor %}
        </div>
    {% endif %}

    {# Action bar #}
    <div class=\"flex items-center justify-between pt-2 border-t border-outline/20\">
        <a href=\"{{ path('app_article_index') }}\"
           class=\"flex items-center gap-1.5 text-sm font-semibold text-on-surface-variant hover:text-primary transition\">
            <span class=\"material-symbols-outlined text-[16px]\">arrow_back</span>
            Back
        </a>
        {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_PSYCHOLOGUE') %}
            <div class=\"flex items-center gap-3\">
                <a href=\"{{ path('app_article_edit', {id: article.id}) }}\"
                   class=\"flex items-center gap-1.5 px-4 py-2 rounded-xl border border-outline text-sm font-semibold hover:bg-gray-50 transition\">
                    <span class=\"material-symbols-outlined text-[16px]\">edit</span> Edit
                </a>
                <form method=\"post\" action=\"{{ path('app_article_delete', {id: article.id}) }}\"
                      onsubmit=\"return confirm('Permanently delete this article?')\">
                    <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ article.id) }}\">
                    <button class=\"flex items-center gap-1.5 px-4 py-2 rounded-xl border border-red-200 text-sm font-semibold text-red-500 hover:bg-red-50 transition\">
                        <span class=\"material-symbols-outlined text-[16px]\">delete</span> Delete
                    </button>
                </form>
            </div>
        {% endif %}
    </div>

</div>
{% endblock %}
", "article/show.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\article\\show.html.twig");
    }
}
