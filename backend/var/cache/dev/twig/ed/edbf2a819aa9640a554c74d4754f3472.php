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

/* learning_path/form.html.twig */
class __TwigTemplate_c9f3fa5b1018f2ccf29ec9841ee8e7c3 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "learning_path/form.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "learning_path/form.html.twig"));

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

    <div class=\"flex items-center gap-4\">
        <a href=\"";
        // line 7
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_index");
        yield "\"
           class=\"flex items-center gap-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors\">
            <span class=\"material-symbols-outlined text-[18px]\">arrow_back</span>
            Return
        </a>
        <div>
            <h1 class=\"text-3xl font-extrabold text-on-surface tracking-tight\">
                ";
        // line 14
        yield (((($tmp = (isset($context["path"]) || array_key_exists("path", $context) ? $context["path"] : (function () { throw new RuntimeError('Variable "path" does not exist.', 14, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Edit learning path") : ("New learning path"));
        yield "
            </h1>
        </div>
    </div>

    <form method=\"POST\"
          action=\"";
        // line 20
        yield (((($tmp = (isset($context["path"]) || array_key_exists("path", $context) ? $context["path"] : (function () { throw new RuntimeError('Variable "path" does not exist.', 20, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_update", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["path"]) || array_key_exists("path", $context) ? $context["path"] : (function () { throw new RuntimeError('Variable "path" does not exist.', 20, $this->source); })()), "id", [], "any", false, false, false, 20)]), "html", null, true)) : ($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_create")));
        yield "\"
          id=\"lp-form\"
          class=\"space-y-6\">

        ";
        // line 25
        yield "        <div class=\"bg-white rounded-[2rem] border border-outline/30 p-8 soft-elevation space-y-5\">
            <h2 class=\"text-sm font-bold text-on-surface-variant uppercase tracking-widest\">Information</h2>

            <div>
                <label class=\"block text-sm font-semibold text-on-surface mb-1.5\">Title <span class=\"text-red-500\">*</span></label>
                <input type=\"text\" name=\"titre\" value=\"";
        // line 30
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["old"] ?? null), "titre", [], "any", true, true, false, 30) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["old"]) || array_key_exists("old", $context) ? $context["old"] : (function () { throw new RuntimeError('Variable "old" does not exist.', 30, $this->source); })()), "titre", [], "any", false, false, false, 30)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["old"]) || array_key_exists("old", $context) ? $context["old"] : (function () { throw new RuntimeError('Variable "old" does not exist.', 30, $this->source); })()), "titre", [], "any", false, false, false, 30), "html", null, true)) : (""));
        yield "\"
                       placeholder=\"Learning path name…\"
                       class=\"w-full rounded-xl border border-outline/50 bg-gray-50 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 transition
                              ";
        // line 33
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "titre", [], "any", true, true, false, 33)) ? ("border-red-400") : (""));
        yield "\">
                ";
        // line 34
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "titre", [], "any", true, true, false, 34)) {
            // line 35
            yield "                    <p class=\"text-xs text-red-500 mt-1\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 35, $this->source); })()), "titre", [], "any", false, false, false, 35), "html", null, true);
            yield "</p>
                ";
        }
        // line 37
        yield "            </div>

            <div>
                <label class=\"block text-sm font-semibold text-on-surface mb-1.5\">Description</label>
                <textarea name=\"description\" rows=\"3\"
                          placeholder=\"Describe this learning path…\"
                          class=\"w-full rounded-xl border border-outline/50 bg-gray-50 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 transition resize-none\">";
        // line 43
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["old"] ?? null), "description", [], "any", true, true, false, 43) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["old"]) || array_key_exists("old", $context) ? $context["old"] : (function () { throw new RuntimeError('Variable "old" does not exist.', 43, $this->source); })()), "description", [], "any", false, false, false, 43)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["old"]) || array_key_exists("old", $context) ? $context["old"] : (function () { throw new RuntimeError('Variable "old" does not exist.', 43, $this->source); })()), "description", [], "any", false, false, false, 43), "html", null, true)) : (""));
        yield "</textarea>
            </div>
        </div>

        ";
        // line 48
        yield "        <div class=\"bg-white rounded-[2rem] border border-outline/30 p-8 soft-elevation space-y-4\">
            <h2 class=\"text-sm font-bold text-on-surface-variant uppercase tracking-widest\">Learning path articles</h2>
            <p class=\"text-xs text-on-surface-variant\">Check the articles and drag & drop to order them.</p>

            ";
        // line 53
        yield "            <div id=\"selected-list\" class=\"space-y-2 min-h-[60px] rounded-xl border-2 border-dashed border-outline/30 p-3\">
                ";
        // line 54
        if ((($tmp = (isset($context["path"]) || array_key_exists("path", $context) ? $context["path"] : (function () { throw new RuntimeError('Variable "path" does not exist.', 54, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 55
            yield "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["path"]) || array_key_exists("path", $context) ? $context["path"] : (function () { throw new RuntimeError('Variable "path" does not exist.', 55, $this->source); })()), "pathArticles", [], "any", false, false, false, 55));
            foreach ($context['_seq'] as $context["_key"] => $context["pa"]) {
                // line 56
                yield "                        <div class=\"selected-item flex items-center gap-3 bg-primary/5 border border-primary/20 rounded-xl px-4 py-2.5 cursor-grab\"
                             data-id=\"";
                // line 57
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["pa"], "article", [], "any", false, false, false, 57), "id", [], "any", false, false, false, 57), "html", null, true);
                yield "\">
                            <span class=\"material-symbols-outlined text-on-surface-variant text-[16px]\">drag_indicator</span>
                            <span class=\"text-sm font-semibold text-on-surface flex-1 line-clamp-1\">";
                // line 59
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["pa"], "article", [], "any", false, false, false, 59), "titre", [], "any", false, false, false, 59), "html", null, true);
                yield "</span>
                            <button type=\"button\" onclick=\"removeFromPath(this)\"
                                    class=\"text-red-400 hover:text-red-600 transition\">
                                <span class=\"material-symbols-outlined text-[16px]\">close</span>
                            </button>
                            <input type=\"hidden\" name=\"articleIds[]\" value=\"";
                // line 64
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["pa"], "article", [], "any", false, false, false, 64), "id", [], "any", false, false, false, 64), "html", null, true);
                yield "\">
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['pa'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 67
            yield "                ";
        }
        // line 68
        yield "                <p id=\"empty-hint\" class=\"text-xs text-on-surface-variant text-center py-3 ";
        yield ((((isset($context["path"]) || array_key_exists("path", $context) ? $context["path"] : (function () { throw new RuntimeError('Variable "path" does not exist.', 68, $this->source); })()) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["path"]) || array_key_exists("path", $context) ? $context["path"] : (function () { throw new RuntimeError('Variable "path" does not exist.', 68, $this->source); })()), "pathArticles", [], "any", false, false, false, 68)) > 0))) ? ("hidden") : (""));
        yield "\">
                    Add articles from the list below
                </p>
            </div>

            ";
        // line 74
        yield "            <div class=\"space-y-1.5 max-h-72 overflow-y-auto pr-1\">
                ";
        // line 75
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 75, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 76
            yield "                    ";
            $context["alreadyIn"] = ((isset($context["path"]) || array_key_exists("path", $context) ? $context["path"] : (function () { throw new RuntimeError('Variable "path" does not exist.', 76, $this->source); })()) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::filter($this->env, CoreExtension::getAttribute($this->env, $this->source, (isset($context["path"]) || array_key_exists("path", $context) ? $context["path"] : (function () { throw new RuntimeError('Variable "path" does not exist.', 76, $this->source); })()), "pathArticles", [], "any", false, false, false, 76), function ($__pa__) use ($context, $macros) { $context["pa"] = $__pa__; return (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["pa"]) || array_key_exists("pa", $context) ? $context["pa"] : (function () { throw new RuntimeError('Variable "pa" does not exist.', 76, $this->source); })()), "article", [], "any", false, false, false, 76), "id", [], "any", false, false, false, 76) == CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 76)); })) > 0));
            // line 77
            yield "                    <div class=\"available-item flex items-center gap-3 px-4 py-2.5 rounded-xl border border-outline/30 hover:bg-gray-50 transition ";
            yield (((($tmp = (isset($context["alreadyIn"]) || array_key_exists("alreadyIn", $context) ? $context["alreadyIn"] : (function () { throw new RuntimeError('Variable "alreadyIn" does not exist.', 77, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("opacity-40") : (""));
            yield "\"
                         data-id=\"";
            // line 78
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 78), "html", null, true);
            yield "\"
                         data-title=\"";
            // line 79
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "titre", [], "any", false, false, false, 79), "html", null, true);
            yield "\">
                        <span class=\"text-sm text-on-surface flex-1 line-clamp-1\">";
            // line 80
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "titre", [], "any", false, false, false, 80), "html", null, true);
            yield "</span>
                        ";
            // line 81
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 81)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 82
                yield "                            <span class=\"text-[10px] font-bold bg-primary/10 text-primary px-2 py-0.5 rounded-full shrink-0\">
                                ";
                // line 83
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 83), "nom", [], "any", false, false, false, 83), "html", null, true);
                yield "
                            </span>
                        ";
            }
            // line 86
            yield "                        <button type=\"button\" onclick=\"addToPath(this)\"
                                class=\"shrink-0 p-1 rounded-lg bg-primary/10 text-primary hover:bg-primary hover:text-white transition ";
            // line 87
            yield (((($tmp = (isset($context["alreadyIn"]) || array_key_exists("alreadyIn", $context) ? $context["alreadyIn"] : (function () { throw new RuntimeError('Variable "alreadyIn" does not exist.', 87, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("pointer-events-none") : (""));
            yield "\">
                            <span class=\"material-symbols-outlined text-[16px]\">add</span>
                        </button>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['article'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 92
        yield "            </div>
        </div>

        ";
        // line 96
        yield "        <div class=\"flex items-center justify-between\">
            <a href=\"";
        // line 97
        yield (((($tmp = (isset($context["path"]) || array_key_exists("path", $context) ? $context["path"] : (function () { throw new RuntimeError('Variable "path" does not exist.', 97, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["path"]) || array_key_exists("path", $context) ? $context["path"] : (function () { throw new RuntimeError('Variable "path" does not exist.', 97, $this->source); })()), "id", [], "any", false, false, false, 97)]), "html", null, true)) : ($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_index")));
        yield "\"
               class=\"text-sm font-semibold text-on-surface-variant hover:text-on-surface transition\">
                ← Cancel
            </a>
            <button type=\"submit\"
                    class=\"flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-semibold text-sm hover:bg-primary/90 transition shadow-md shadow-primary/20\">
                <span class=\"material-symbols-outlined text-[18px]\">save</span>
                ";
        // line 104
        yield (((($tmp = (isset($context["path"]) || array_key_exists("path", $context) ? $context["path"] : (function () { throw new RuntimeError('Variable "path" does not exist.', 104, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Update") : ("Create learning path"));
        yield "
            </button>
        </div>

    </form>
</div>

<script>
function addToPath(btn) {
    const item = btn.closest('.available-item');
    const id    = item.dataset.id;
    const title = item.dataset.title;

    // Don't add twice
    if (document.querySelector(`#selected-list [data-id=\"\${id}\"]`)) return;

    const div = document.createElement('div');
    div.className = 'selected-item flex items-center gap-3 bg-primary/5 border border-primary/20 rounded-xl px-4 py-2.5 cursor-grab';
    div.dataset.id = id;
    div.innerHTML = `
        <span class=\"material-symbols-outlined text-on-surface-variant text-[16px]\">drag_indicator</span>
        <span class=\"text-sm font-semibold text-on-surface flex-1 line-clamp-1\">\${title}</span>
        <button type=\"button\" onclick=\"removeFromPath(this)\" class=\"text-red-400 hover:text-red-600 transition\">
            <span class=\"material-symbols-outlined text-[16px]\">close</span>
        </button>
        <input type=\"hidden\" name=\"articleIds[]\" value=\"\${id}\">
    `;

    document.getElementById('empty-hint').classList.add('hidden');
    document.getElementById('selected-list').appendChild(div);
    item.classList.add('opacity-40');
}

function removeFromPath(btn) {
    const item = btn.closest('.selected-item');
    const id   = item.dataset.id;
    item.remove();

    const avail = document.querySelector(`.available-item[data-id=\"\${id}\"]`);
    if (avail) avail.classList.remove('opacity-40');

    if (!document.querySelector('.selected-item')) {
        document.getElementById('empty-hint').classList.remove('hidden');
    }
}
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
        return "learning_path/form.html.twig";
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
        return array (  270 => 104,  260 => 97,  257 => 96,  252 => 92,  241 => 87,  238 => 86,  232 => 83,  229 => 82,  227 => 81,  223 => 80,  219 => 79,  215 => 78,  210 => 77,  207 => 76,  203 => 75,  200 => 74,  191 => 68,  188 => 67,  179 => 64,  171 => 59,  166 => 57,  163 => 56,  158 => 55,  156 => 54,  153 => 53,  147 => 48,  140 => 43,  132 => 37,  126 => 35,  124 => 34,  120 => 33,  114 => 30,  107 => 25,  100 => 20,  91 => 14,  81 => 7,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}
<div class=\"max-w-3xl space-y-6\">

    <div class=\"flex items-center gap-4\">
        <a href=\"{{ path('app_learning_path_index') }}\"
           class=\"flex items-center gap-2 text-sm font-semibold text-on-surface-variant hover:text-primary transition-colors\">
            <span class=\"material-symbols-outlined text-[18px]\">arrow_back</span>
            Return
        </a>
        <div>
            <h1 class=\"text-3xl font-extrabold text-on-surface tracking-tight\">
                {{ path ? 'Edit learning path' : 'New learning path' }}
            </h1>
        </div>
    </div>

    <form method=\"POST\"
          action=\"{{ path ? path('app_learning_path_update', {id: path.id}) : path('app_learning_path_create') }}\"
          id=\"lp-form\"
          class=\"space-y-6\">

        {# Info card #}
        <div class=\"bg-white rounded-[2rem] border border-outline/30 p-8 soft-elevation space-y-5\">
            <h2 class=\"text-sm font-bold text-on-surface-variant uppercase tracking-widest\">Information</h2>

            <div>
                <label class=\"block text-sm font-semibold text-on-surface mb-1.5\">Title <span class=\"text-red-500\">*</span></label>
                <input type=\"text\" name=\"titre\" value=\"{{ old.titre ?? '' }}\"
                       placeholder=\"Learning path name…\"
                       class=\"w-full rounded-xl border border-outline/50 bg-gray-50 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 transition
                              {{ errors.titre is defined ? 'border-red-400' : '' }}\">
                {% if errors.titre is defined %}
                    <p class=\"text-xs text-red-500 mt-1\">{{ errors.titre }}</p>
                {% endif %}
            </div>

            <div>
                <label class=\"block text-sm font-semibold text-on-surface mb-1.5\">Description</label>
                <textarea name=\"description\" rows=\"3\"
                          placeholder=\"Describe this learning path…\"
                          class=\"w-full rounded-xl border border-outline/50 bg-gray-50 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 transition resize-none\">{{ old.description ?? '' }}</textarea>
            </div>
        </div>

        {# Article selector #}
        <div class=\"bg-white rounded-[2rem] border border-outline/30 p-8 soft-elevation space-y-4\">
            <h2 class=\"text-sm font-bold text-on-surface-variant uppercase tracking-widest\">Learning path articles</h2>
            <p class=\"text-xs text-on-surface-variant\">Check the articles and drag & drop to order them.</p>

            {# Selected / ordered list (drag target) #}
            <div id=\"selected-list\" class=\"space-y-2 min-h-[60px] rounded-xl border-2 border-dashed border-outline/30 p-3\">
                {% if path %}
                    {% for pa in path.pathArticles %}
                        <div class=\"selected-item flex items-center gap-3 bg-primary/5 border border-primary/20 rounded-xl px-4 py-2.5 cursor-grab\"
                             data-id=\"{{ pa.article.id }}\">
                            <span class=\"material-symbols-outlined text-on-surface-variant text-[16px]\">drag_indicator</span>
                            <span class=\"text-sm font-semibold text-on-surface flex-1 line-clamp-1\">{{ pa.article.titre }}</span>
                            <button type=\"button\" onclick=\"removeFromPath(this)\"
                                    class=\"text-red-400 hover:text-red-600 transition\">
                                <span class=\"material-symbols-outlined text-[16px]\">close</span>
                            </button>
                            <input type=\"hidden\" name=\"articleIds[]\" value=\"{{ pa.article.id }}\">
                        </div>
                    {% endfor %}
                {% endif %}
                <p id=\"empty-hint\" class=\"text-xs text-on-surface-variant text-center py-3 {{ path and path.pathArticles|length > 0 ? 'hidden' : '' }}\">
                    Add articles from the list below
                </p>
            </div>

            {# Available articles #}
            <div class=\"space-y-1.5 max-h-72 overflow-y-auto pr-1\">
                {% for article in articles %}
                    {% set alreadyIn = path and path.pathArticles|filter(pa => pa.article.id == article.id)|length > 0 %}
                    <div class=\"available-item flex items-center gap-3 px-4 py-2.5 rounded-xl border border-outline/30 hover:bg-gray-50 transition {{ alreadyIn ? 'opacity-40' : '' }}\"
                         data-id=\"{{ article.id }}\"
                         data-title=\"{{ article.titre }}\">
                        <span class=\"text-sm text-on-surface flex-1 line-clamp-1\">{{ article.titre }}</span>
                        {% if article.categorie %}
                            <span class=\"text-[10px] font-bold bg-primary/10 text-primary px-2 py-0.5 rounded-full shrink-0\">
                                {{ article.categorie.nom }}
                            </span>
                        {% endif %}
                        <button type=\"button\" onclick=\"addToPath(this)\"
                                class=\"shrink-0 p-1 rounded-lg bg-primary/10 text-primary hover:bg-primary hover:text-white transition {{ alreadyIn ? 'pointer-events-none' : '' }}\">
                            <span class=\"material-symbols-outlined text-[16px]\">add</span>
                        </button>
                    </div>
                {% endfor %}
            </div>
        </div>

        {# Submit #}
        <div class=\"flex items-center justify-between\">
            <a href=\"{{ path ? path('app_learning_path_show', {id: path.id}) : path('app_learning_path_index') }}\"
               class=\"text-sm font-semibold text-on-surface-variant hover:text-on-surface transition\">
                ← Cancel
            </a>
            <button type=\"submit\"
                    class=\"flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-semibold text-sm hover:bg-primary/90 transition shadow-md shadow-primary/20\">
                <span class=\"material-symbols-outlined text-[18px]\">save</span>
                {{ path ? 'Update' : 'Create learning path' }}
            </button>
        </div>

    </form>
</div>

<script>
function addToPath(btn) {
    const item = btn.closest('.available-item');
    const id    = item.dataset.id;
    const title = item.dataset.title;

    // Don't add twice
    if (document.querySelector(`#selected-list [data-id=\"\${id}\"]`)) return;

    const div = document.createElement('div');
    div.className = 'selected-item flex items-center gap-3 bg-primary/5 border border-primary/20 rounded-xl px-4 py-2.5 cursor-grab';
    div.dataset.id = id;
    div.innerHTML = `
        <span class=\"material-symbols-outlined text-on-surface-variant text-[16px]\">drag_indicator</span>
        <span class=\"text-sm font-semibold text-on-surface flex-1 line-clamp-1\">\${title}</span>
        <button type=\"button\" onclick=\"removeFromPath(this)\" class=\"text-red-400 hover:text-red-600 transition\">
            <span class=\"material-symbols-outlined text-[16px]\">close</span>
        </button>
        <input type=\"hidden\" name=\"articleIds[]\" value=\"\${id}\">
    `;

    document.getElementById('empty-hint').classList.add('hidden');
    document.getElementById('selected-list').appendChild(div);
    item.classList.add('opacity-40');
}

function removeFromPath(btn) {
    const item = btn.closest('.selected-item');
    const id   = item.dataset.id;
    item.remove();

    const avail = document.querySelector(`.available-item[data-id=\"\${id}\"]`);
    if (avail) avail.classList.remove('opacity-40');

    if (!document.querySelector('.selected-item')) {
        document.getElementById('empty-hint').classList.remove('hidden');
    }
}
</script>
{% endblock %}
", "learning_path/form.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\learning_path\\form.html.twig");
    }
}
