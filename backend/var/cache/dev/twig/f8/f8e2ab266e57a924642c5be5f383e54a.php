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

/* learning_path/show.html.twig */
class __TwigTemplate_cd8db482d4f3d881f2b8179de63651d0 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "learning_path/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "learning_path/show.html.twig"));

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
        yield "<div class=\"max-w-3xl space-y-8\">

    ";
        // line 7
        yield "    <div class=\"flex items-center justify-between\">
        <a href=\"";
        // line 8
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_index");
        yield "\"
           class=\"flex items-center gap-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors\">
            <span class=\"material-symbols-outlined text-[18px]\">arrow_back</span>
            All paths
        </a>
        ";
        // line 13
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE"))) {
            // line 14
            yield "            <div class=\"flex items-center gap-2\">
                <a href=\"";
            // line 15
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["learningPath"]) || array_key_exists("learningPath", $context) ? $context["learningPath"] : (function () { throw new RuntimeError('Variable "learningPath" does not exist.', 15, $this->source); })()), "id", [], "any", false, false, false, 15)]), "html", null, true);
            yield "\"
                   class=\"flex items-center gap-1.5 px-4 py-2 rounded-xl border border-outline text-sm font-semibold hover:bg-gray-50 transition\">
                    <span class=\"material-symbols-outlined text-[16px]\">edit</span> Edit
                </a>
                <form method=\"POST\" action=\"";
            // line 19
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["learningPath"]) || array_key_exists("learningPath", $context) ? $context["learningPath"] : (function () { throw new RuntimeError('Variable "learningPath" does not exist.', 19, $this->source); })()), "id", [], "any", false, false, false, 19)]), "html", null, true);
            yield "\"
                      onsubmit=\"return confirm('Delete this learning path?')\">
                    <input type=\"hidden\" name=\"_token\" value=\"";
            // line 21
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_lp_" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["learningPath"]) || array_key_exists("learningPath", $context) ? $context["learningPath"] : (function () { throw new RuntimeError('Variable "learningPath" does not exist.', 21, $this->source); })()), "id", [], "any", false, false, false, 21))), "html", null, true);
            yield "\">
                    <button class=\"flex items-center gap-1.5 px-4 py-2 rounded-xl border border-red-200 text-sm font-semibold text-red-500 hover:bg-red-50 transition\">
                        <span class=\"material-symbols-outlined text-[16px]\">delete</span> Delete
                    </button>
                </form>
            </div>
        ";
        }
        // line 28
        yield "    </div>

    ";
        // line 31
        yield "    <div class=\"bg-white rounded-[2rem] border border-outline/30 p-8 soft-elevation space-y-3\">
        <div class=\"flex items-center gap-4\">
            <div class=\"w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center shrink-0\">
                <span class=\"material-symbols-outlined text-primary text-[24px]\">route</span>
            </div>
            <div>
                <h1 class=\"text-2xl font-extrabold text-on-surface tracking-tight\">";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["learningPath"]) || array_key_exists("learningPath", $context) ? $context["learningPath"] : (function () { throw new RuntimeError('Variable "learningPath" does not exist.', 37, $this->source); })()), "titre", [], "any", false, false, false, 37), "html", null, true);
        yield "</h1>
                <p class=\"text-sm text-on-surface-variant mt-0.5\">
                    ";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 39, $this->source); })()), "html", null, true);
        yield " step";
        yield ((((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 39, $this->source); })()) != 1)) ? ("s") : (""));
        yield "
                    ";
        // line 40
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["learningPath"]) || array_key_exists("learningPath", $context) ? $context["learningPath"] : (function () { throw new RuntimeError('Variable "learningPath" does not exist.', 40, $this->source); })()), "createdBy", [], "any", false, false, false, 40)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 41
            yield "                        · by ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["learningPath"]) || array_key_exists("learningPath", $context) ? $context["learningPath"] : (function () { throw new RuntimeError('Variable "learningPath" does not exist.', 41, $this->source); })()), "createdBy", [], "any", false, false, false, 41), "firstName", [], "any", false, false, false, 41), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["learningPath"]) || array_key_exists("learningPath", $context) ? $context["learningPath"] : (function () { throw new RuntimeError('Variable "learningPath" does not exist.', 41, $this->source); })()), "createdBy", [], "any", false, false, false, 41), "lastName", [], "any", false, false, false, 41), "html", null, true);
            yield "
                    ";
        }
        // line 43
        yield "                    · ";
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["learningPath"]) || array_key_exists("learningPath", $context) ? $context["learningPath"] : (function () { throw new RuntimeError('Variable "learningPath" does not exist.', 43, $this->source); })()), "dateCreation", [], "any", false, false, false, 43)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["learningPath"]) || array_key_exists("learningPath", $context) ? $context["learningPath"] : (function () { throw new RuntimeError('Variable "learningPath" does not exist.', 43, $this->source); })()), "dateCreation", [], "any", false, false, false, 43), "d/m/Y"), "html", null, true)) : (""));
        yield "
                </p>
            </div>
        </div>
        ";
        // line 47
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["learningPath"]) || array_key_exists("learningPath", $context) ? $context["learningPath"] : (function () { throw new RuntimeError('Variable "learningPath" does not exist.', 47, $this->source); })()), "description", [], "any", false, false, false, 47)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 48
            yield "            <p class=\"text-sm text-on-surface leading-relaxed border-t border-outline/20 pt-4\">
                ";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["learningPath"]) || array_key_exists("learningPath", $context) ? $context["learningPath"] : (function () { throw new RuntimeError('Variable "learningPath" does not exist.', 49, $this->source); })()), "description", [], "any", false, false, false, 49), "html", null, true);
            yield "
            </p>
        ";
        }
        // line 52
        yield "    </div>

    ";
        // line 55
        yield "    ";
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["steps"]) || array_key_exists("steps", $context) ? $context["steps"] : (function () { throw new RuntimeError('Variable "steps" does not exist.', 55, $this->source); })()))) {
            // line 56
            yield "        <div class=\"bg-white rounded-[2rem] border border-outline/30 py-12 flex flex-col items-center gap-3 text-on-surface-variant\">
            <span class=\"material-symbols-outlined text-4xl opacity-30\">article</span>
            <p class=\"text-sm font-semibold\">No articles in this path yet.</p>
        </div>
    ";
        } else {
            // line 61
            yield "        <div class=\"space-y-3\">
            <h2 class=\"text-xs font-bold text-on-surface-variant uppercase tracking-widest\">Path steps</h2>

            ";
            // line 64
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["steps"]) || array_key_exists("steps", $context) ? $context["steps"] : (function () { throw new RuntimeError('Variable "steps" does not exist.', 64, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["step"]) {
                // line 65
                yield "                ";
                $context["article"] = CoreExtension::getAttribute($this->env, $this->source, $context["step"], "article", [], "any", false, false, false, 65);
                // line 66
                yield "                <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 66, $this->source); })()), "id", [], "any", false, false, false, 66)]), "html", null, true);
                yield "\"
                   class=\"group flex items-start gap-5 bg-white rounded-2xl border border-outline/30 px-6 py-5
                          hover:border-primary/30 hover:shadow-md transition-all\">

                    ";
                // line 71
                yield "                    <div class=\"shrink-0 w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center
                                font-extrabold text-sm group-hover:bg-primary group-hover:text-white transition-all\">
                        ";
                // line 73
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["step"], "articleOrder", [], "any", false, false, false, 73), "html", null, true);
                yield "
                    </div>

                    ";
                // line 77
                yield "                    <div class=\"flex-1 min-w-0\">
                        <p class=\"font-semibold text-sm text-on-surface group-hover:text-primary transition-colors line-clamp-1\">
                            ";
                // line 79
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 79, $this->source); })()), "titre", [], "any", false, false, false, 79), "html", null, true);
                yield "
                        </p>
                        <p class=\"text-xs text-on-surface-variant mt-1 line-clamp-2 leading-relaxed\">
                            ";
                // line 82
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 82, $this->source); })()), "contenu", [], "any", false, false, false, 82)), 0, 100), "html", null, true);
                yield "…
                        </p>
                        <div class=\"flex items-center gap-3 mt-2 text-xs text-on-surface-variant\">
                            ";
                // line 85
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 85, $this->source); })()), "categorie", [], "any", false, false, false, 85)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 86
                    yield "                                <span class=\"px-2 py-0.5 rounded-full bg-primary/10 text-primary font-semibold\">
                                    ";
                    // line 87
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 87, $this->source); })()), "categorie", [], "any", false, false, false, 87), "nom", [], "any", false, false, false, 87), "html", null, true);
                    yield "
                                </span>
                            ";
                }
                // line 90
                yield "                            ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 90, $this->source); })()), "readability", [], "any", false, false, false, 90)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 91
                    yield "                                ";
                    $context["rc"] = ["Easy" => "bg-green-100 text-green-700", "Intermediate" => "bg-amber-100 text-amber-700", "Advanced" => "bg-red-100 text-red-700"];
                    // line 96
                    yield "                                <span class=\"px-2 py-0.5 rounded-full font-semibold ";
                    yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["rc"] ?? null), CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 96, $this->source); })()), "readability", [], "any", false, false, false, 96), [], "array", true, true, false, 96) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["rc"]) || array_key_exists("rc", $context) ? $context["rc"] : (function () { throw new RuntimeError('Variable "rc" does not exist.', 96, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 96, $this->source); })()), "readability", [], "any", false, false, false, 96), [], "array", false, false, false, 96)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rc"]) || array_key_exists("rc", $context) ? $context["rc"] : (function () { throw new RuntimeError('Variable "rc" does not exist.', 96, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 96, $this->source); })()), "readability", [], "any", false, false, false, 96), [], "array", false, false, false, 96), "html", null, true)) : (""));
                    yield "\">
                                    ";
                    // line 97
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 97, $this->source); })()), "readability", [], "any", false, false, false, 97), "html", null, true);
                    yield "
                                </span>
                            ";
                }
                // line 100
                yield "                        </div>
                    </div>

                    <span class=\"material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors shrink-0 self-center\">
                        arrow_forward
                    </span>

                </a>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['step'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 109
            yield "        </div>
    ";
        }
        // line 111
        yield "
    ";
        // line 113
        yield "    ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["steps"]) || array_key_exists("steps", $context) ? $context["steps"] : (function () { throw new RuntimeError('Variable "steps" does not exist.', 113, $this->source); })())) > 0)) {
            // line 114
            yield "        <div class=\"flex justify-center pt-2\">
            <a href=\"";
            // line 115
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["steps"]) || array_key_exists("steps", $context) ? $context["steps"] : (function () { throw new RuntimeError('Variable "steps" does not exist.', 115, $this->source); })()), 0, [], "array", false, false, false, 115), "article", [], "any", false, false, false, 115), "id", [], "any", false, false, false, 115)]), "html", null, true);
            yield "\"
               class=\"flex items-center gap-2 bg-primary text-white px-8 py-3.5 rounded-2xl font-bold text-sm
                      hover:bg-primary/90 transition-all shadow-lg shadow-primary/20\">
                <span class=\"material-symbols-outlined text-[18px]\">play_arrow</span>
                Start the path
            </a>
        </div>
    ";
        }
        // line 123
        yield "
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
        return "learning_path/show.html.twig";
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
        return array (  296 => 123,  285 => 115,  282 => 114,  279 => 113,  276 => 111,  272 => 109,  258 => 100,  252 => 97,  247 => 96,  244 => 91,  241 => 90,  235 => 87,  232 => 86,  230 => 85,  224 => 82,  218 => 79,  214 => 77,  208 => 73,  204 => 71,  196 => 66,  193 => 65,  189 => 64,  184 => 61,  177 => 56,  174 => 55,  170 => 52,  164 => 49,  161 => 48,  159 => 47,  151 => 43,  143 => 41,  141 => 40,  135 => 39,  130 => 37,  122 => 31,  118 => 28,  108 => 21,  103 => 19,  96 => 15,  93 => 14,  91 => 13,  83 => 8,  80 => 7,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}
<div class=\"max-w-3xl space-y-8\">

    {# Header #}
    <div class=\"flex items-center justify-between\">
        <a href=\"{{ path('app_learning_path_index') }}\"
           class=\"flex items-center gap-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors\">
            <span class=\"material-symbols-outlined text-[18px]\">arrow_back</span>
            All paths
        </a>
        {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_PSYCHOLOGUE') %}
            <div class=\"flex items-center gap-2\">
                <a href=\"{{ path('app_learning_path_edit', {id: learningPath.id}) }}\"
                   class=\"flex items-center gap-1.5 px-4 py-2 rounded-xl border border-outline text-sm font-semibold hover:bg-gray-50 transition\">
                    <span class=\"material-symbols-outlined text-[16px]\">edit</span> Edit
                </a>
                <form method=\"POST\" action=\"{{ path('app_learning_path_delete', {id: learningPath.id}) }}\"
                      onsubmit=\"return confirm('Delete this learning path?')\">
                    <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_lp_' ~ learningPath.id) }}\">
                    <button class=\"flex items-center gap-1.5 px-4 py-2 rounded-xl border border-red-200 text-sm font-semibold text-red-500 hover:bg-red-50 transition\">
                        <span class=\"material-symbols-outlined text-[16px]\">delete</span> Delete
                    </button>
                </form>
            </div>
        {% endif %}
    </div>

    {# Path info card #}
    <div class=\"bg-white rounded-[2rem] border border-outline/30 p-8 soft-elevation space-y-3\">
        <div class=\"flex items-center gap-4\">
            <div class=\"w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center shrink-0\">
                <span class=\"material-symbols-outlined text-primary text-[24px]\">route</span>
            </div>
            <div>
                <h1 class=\"text-2xl font-extrabold text-on-surface tracking-tight\">{{ learningPath.titre }}</h1>
                <p class=\"text-sm text-on-surface-variant mt-0.5\">
                    {{ total }} step{{ total != 1 ? 's' : '' }}
                    {% if learningPath.createdBy %}
                        · by {{ learningPath.createdBy.firstName }} {{ learningPath.createdBy.lastName }}
                    {% endif %}
                    · {{ learningPath.dateCreation ? learningPath.dateCreation|date('d/m/Y') : '' }}
                </p>
            </div>
        </div>
        {% if learningPath.description %}
            <p class=\"text-sm text-on-surface leading-relaxed border-t border-outline/20 pt-4\">
                {{ learningPath.description }}
            </p>
        {% endif %}
    </div>

    {# Stepper #}
    {% if steps is empty %}
        <div class=\"bg-white rounded-[2rem] border border-outline/30 py-12 flex flex-col items-center gap-3 text-on-surface-variant\">
            <span class=\"material-symbols-outlined text-4xl opacity-30\">article</span>
            <p class=\"text-sm font-semibold\">No articles in this path yet.</p>
        </div>
    {% else %}
        <div class=\"space-y-3\">
            <h2 class=\"text-xs font-bold text-on-surface-variant uppercase tracking-widest\">Path steps</h2>

            {% for step in steps %}
                {% set article = step.article %}
                <a href=\"{{ path('app_article_show', {id: article.id}) }}\"
                   class=\"group flex items-start gap-5 bg-white rounded-2xl border border-outline/30 px-6 py-5
                          hover:border-primary/30 hover:shadow-md transition-all\">

                    {# Step number circle #}
                    <div class=\"shrink-0 w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center
                                font-extrabold text-sm group-hover:bg-primary group-hover:text-white transition-all\">
                        {{ step.articleOrder }}
                    </div>

                    {# Content #}
                    <div class=\"flex-1 min-w-0\">
                        <p class=\"font-semibold text-sm text-on-surface group-hover:text-primary transition-colors line-clamp-1\">
                            {{ article.titre }}
                        </p>
                        <p class=\"text-xs text-on-surface-variant mt-1 line-clamp-2 leading-relaxed\">
                            {{ article.contenu|striptags|slice(0, 100) }}…
                        </p>
                        <div class=\"flex items-center gap-3 mt-2 text-xs text-on-surface-variant\">
                            {% if article.categorie %}
                                <span class=\"px-2 py-0.5 rounded-full bg-primary/10 text-primary font-semibold\">
                                    {{ article.categorie.nom }}
                                </span>
                            {% endif %}
                            {% if article.readability %}
                                {% set rc = {
                                    'Easy':         'bg-green-100 text-green-700',
                                    'Intermediate': 'bg-amber-100 text-amber-700',
                                    'Advanced':     'bg-red-100 text-red-700'
                                } %}
                                <span class=\"px-2 py-0.5 rounded-full font-semibold {{ rc[article.readability] ?? '' }}\">
                                    {{ article.readability }}
                                </span>
                            {% endif %}
                        </div>
                    </div>

                    <span class=\"material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors shrink-0 self-center\">
                        arrow_forward
                    </span>

                </a>
            {% endfor %}
        </div>
    {% endif %}

    {# Start button #}
    {% if steps|length > 0 %}
        <div class=\"flex justify-center pt-2\">
            <a href=\"{{ path('app_article_show', {id: steps[0].article.id}) }}\"
               class=\"flex items-center gap-2 bg-primary text-white px-8 py-3.5 rounded-2xl font-bold text-sm
                      hover:bg-primary/90 transition-all shadow-lg shadow-primary/20\">
                <span class=\"material-symbols-outlined text-[18px]\">play_arrow</span>
                Start the path
            </a>
        </div>
    {% endif %}

</div>
{% endblock %}
", "learning_path/show.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\learning_path\\show.html.twig");
    }
}
