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

/* article/index.html.twig */
class __TwigTemplate_f706ef78d590789966fe1d37006b5a5d extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/index.html.twig"));

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
        yield "<div class=\"space-y-6\">

    ";
        // line 7
        yield "    <div class=\"flex items-center justify-between\">
        <div>
            <h1 class=\"text-3xl font-extrabold text-on-surface tracking-tight\">Articles Space</h1>
            <p class=\"text-on-surface-variant text-sm mt-1\">Articles, categories, learning paths and tags</p>
        </div>
        ";
        // line 12
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE"))) {
            // line 13
            yield "            <div class=\"flex items-center gap-2\" id=\"header-actions\">
                <a href=\"";
            // line 14
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_new");
            yield "\" id=\"btn-new-article\"
                   class=\"flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold text-sm
                          hover:bg-primary/90 transition-all shadow-md shadow-primary/20\">
                    <span class=\"material-symbols-outlined text-[18px]\">add</span>
                    New article
                </a>
                <a href=\"";
            // line 20
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_categorie_new");
            yield "\" id=\"btn-new-categorie\"
                   class=\"hidden flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold text-sm
                          hover:bg-primary/90 transition-all shadow-md shadow-primary/20\">
                    <span class=\"material-symbols-outlined text-[18px]\">add</span>
                    New category
                </a>
                <a href=\"";
            // line 26
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_new");
            yield "\" id=\"btn-new-path\"
                   class=\"hidden flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold text-sm
                          hover:bg-primary/90 transition-all shadow-md shadow-primary/20\">
                    <span class=\"material-symbols-outlined text-[18px]\">add</span>
                    New path
                </a>
            </div>
        ";
        }
        // line 34
        yield "    </div>

    ";
        // line 37
        yield "    <div class=\"flex items-center gap-1 bg-gray-100/80 p-1 rounded-2xl w-fit\">
        <button onclick=\"switchTab('articles')\" id=\"tab-articles\"
                class=\"tab-btn active-tab flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all\">
            <span class=\"material-symbols-outlined text-[17px]\">article</span>
            Articles
            <span class=\"text-[10px] bg-primary/20 text-primary px-1.5 py-0.5 rounded-full\">";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 42, $this->source); })())), "html", null, true);
        yield "</span>
        </button>
        <button onclick=\"switchTab('categories')\" id=\"tab-categories\"
                class=\"tab-btn flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all\">
            <span class=\"material-symbols-outlined text-[17px]\">folder</span>
            Categories
            <span class=\"text-[10px] bg-gray-200 text-on-surface-variant px-1.5 py-0.5 rounded-full\">";
        // line 48
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 48, $this->source); })())), "html", null, true);
        yield "</span>
        </button>
        <button onclick=\"switchTab('paths')\" id=\"tab-paths\"
                class=\"tab-btn flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all\">
            <span class=\"material-symbols-outlined text-[17px]\">route</span>
            Learning Paths
            <span class=\"text-[10px] bg-gray-200 text-on-surface-variant px-1.5 py-0.5 rounded-full\">";
        // line 54
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["paths"]) || array_key_exists("paths", $context) ? $context["paths"] : (function () { throw new RuntimeError('Variable "paths" does not exist.', 54, $this->source); })())), "html", null, true);
        yield "</span>
        </button>
        <button onclick=\"switchTab('tags')\" id=\"tab-tags\"
                class=\"tab-btn flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all\">
            <span class=\"material-symbols-outlined text-[17px]\">label</span>
            Tags
        </button>
    </div>

    ";
        // line 66
        yield "    <div id=\"panel-articles\" class=\"tab-panel space-y-5\">

        ";
        // line 69
        yield "        <div class=\"relative w-full\">
            <span class=\"material-symbols-outlined text-[20px] text-on-surface-variant pointer-events-none\"
                  style=\"position:absolute; left:1rem; top:50%; transform:translateY(-50%);\">search</span>
            <input type=\"text\" id=\"article-search\" placeholder=\"Search articles…\"
                   style=\"padding-left:2.75rem;\"
                   class=\"w-full pr-4 py-3 rounded-xl border border-outline/40 bg-white text-sm
                          focus:outline-none focus:ring-2 focus:ring-primary/30 transition shadow-sm\">
        </div>

        ";
        // line 79
        yield "        <div class=\"flex items-center gap-2 overflow-x-auto pb-1\" id=\"cat-chips\">
            <button onclick=\"filterArticlesByCategory(null)\"
                    class=\"cat-chip active-chip shrink-0 px-4 py-1.5 rounded-full text-xs font-bold border transition-all\">
                All
            </button>
            ";
        // line 84
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 84, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
            // line 85
            yield "                <button onclick=\"filterArticlesByCategory('";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cat"], "id", [], "any", false, false, false, 85), "html", null, true);
            yield "')\"
                        data-cat-id=\"";
            // line 86
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cat"], "id", [], "any", false, false, false, 86), "html", null, true);
            yield "\"
                        class=\"cat-chip shrink-0 flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold border transition-all
                               bg-white text-on-surface-variant border-outline/40 hover:bg-gray-50\">
                    ";
            // line 89
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cat"], "nom", [], "any", false, false, false, 89), "html", null, true);
            yield "
                    <span class=\"opacity-60\">(";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["cat"], "articles", [], "any", false, false, false, 90)), "html", null, true);
            yield ")</span>
                </button>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['cat'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 93
        yield "        </div>

        ";
        // line 96
        yield "        <div class=\"bg-white rounded-[2rem] border border-outline/30 overflow-hidden soft-elevation\">
            <div class=\"overflow-x-auto\">
                <table class=\"w-full text-left\">
                    <thead>
                        <tr class=\"border-b border-outline/20\">
                            <th class=\"px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-on-surface-variant\">Title</th>
                            <th class=\"px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-on-surface-variant\">Author</th>
                            <th class=\"px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-on-surface-variant\">Category</th>
                            <th class=\"px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-on-surface-variant\">Date</th>
                            <th class=\"px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-on-surface-variant\">Readability</th>
                            <th class=\"px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-on-surface-variant text-right\">Actions</th>
                        </tr>
                    </thead>
                    <tbody class=\"divide-y divide-outline/10\" id=\"article-tbody\">
                    ";
        // line 110
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 110, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 111
            yield "                        <tr class=\"article-row hover:bg-gray-50/50 transition-colors group\"
                            data-search=\"";
            // line 112
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), ((((((CoreExtension::getAttribute($this->env, $this->source, $context["article"], "titre", [], "any", false, false, false, 112) . " ") . Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "contenu", [], "any", false, false, false, 112))) . " ") . (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 112)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 112), "firstName", [], "any", false, false, false, 112) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 112), "lastName", [], "any", false, false, false, 112))) : (""))) . " ") . (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 112)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 112), "nom", [], "any", false, false, false, 112)) : ("")))), "html", null, true);
            yield "\"
                            data-cat-id=\"";
            // line 113
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 113)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 113), "id", [], "any", false, false, false, 113), "html", null, true)) : (""));
            yield "\">
                            <td class=\"px-6 py-4 max-w-xs\">
                                <p class=\"font-semibold text-sm text-on-surface line-clamp-1\">";
            // line 115
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "titre", [], "any", false, false, false, 115), "html", null, true);
            yield "</p>
                                <p class=\"text-xs text-on-surface-variant mt-0.5 line-clamp-1\">
                                    ";
            // line 117
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "contenu", [], "any", false, false, false, 117)), 0, 60), "html", null, true);
            yield "…
                                </p>
                            </td>
                            <td class=\"px-6 py-4\">
                                ";
            // line 121
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 121)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 122
                yield "                                    <div class=\"flex items-center gap-2\">
                                        <div class=\"w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center text-[10px] font-bold overflow-hidden shrink-0\">
                                            ";
                // line 124
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 124), "firstName", [], "any", false, false, false, 124))), "html", null, true);
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 124), "lastName", [], "any", false, false, false, 124))), "html", null, true);
                yield "
                                        </div>
                                        <span class=\"text-xs font-medium text-on-surface-variant whitespace-nowrap\">
                                            ";
                // line 127
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 127), "firstName", [], "any", false, false, false, 127), "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 127), "lastName", [], "any", false, false, false, 127), "html", null, true);
                yield "
                                        </span>
                                    </div>
                                ";
            } else {
                // line 130
                yield "—";
            }
            // line 131
            yield "                            </td>
                            <td class=\"px-6 py-4\">
                                ";
            // line 133
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 133)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 134
                yield "                                    <span class=\"px-2.5 py-1 rounded-full text-xs font-semibold bg-primary/10 text-primary\">
                                        ";
                // line 135
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 135), "nom", [], "any", false, false, false, 135), "html", null, true);
                yield "
                                    </span>
                                ";
            } else {
                // line 138
                yield "                                    <span class=\"px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-on-surface-variant\">—</span>
                                ";
            }
            // line 140
            yield "                            </td>
                            <td class=\"px-6 py-4 text-xs text-on-surface-variant whitespace-nowrap\">
                                ";
            // line 142
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "datePublication", [], "any", false, false, false, 142)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "datePublication", [], "any", false, false, false, 142), "d/m/Y"), "html", null, true)) : ("—"));
            yield "
                            </td>
                            <td class=\"px-6 py-4\">
                                ";
            // line 145
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 145)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 146
                yield "                                    ";
                $context["rc"] = ["Easy" => "bg-green-100 text-green-700", "Intermediate" => "bg-amber-100 text-amber-700", "Advanced" => "bg-red-100 text-red-700"];
                // line 151
                yield "                                    <span class=\"px-2.5 py-1 rounded-full text-xs font-semibold ";
                yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["rc"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 151), [], "array", true, true, false, 151) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["rc"]) || array_key_exists("rc", $context) ? $context["rc"] : (function () { throw new RuntimeError('Variable "rc" does not exist.', 151, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 151), [], "array", false, false, false, 151)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rc"]) || array_key_exists("rc", $context) ? $context["rc"] : (function () { throw new RuntimeError('Variable "rc" does not exist.', 151, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 151), [], "array", false, false, false, 151), "html", null, true)) : (""));
                yield "\">
                                        ";
                // line 152
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 152), "html", null, true);
                yield "
                                    </span>
                                ";
            } else {
                // line 154
                yield "—";
            }
            // line 155
            yield "                            </td>
                            <td class=\"px-6 py-4\">
                                <div class=\"flex items-center justify-end gap-1\">
                                    <a href=\"";
            // line 158
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 158)]), "html", null, true);
            yield "\"
                                       class=\"p-2 rounded-xl text-on-surface-variant hover:bg-primary/10 hover:text-primary transition-all\"
                                       title=\"View\">
                                        <span class=\"material-symbols-outlined text-[18px]\">visibility</span>
                                    </a>
                                    ";
            // line 163
            if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE"))) {
                // line 164
                yield "                                        <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 164)]), "html", null, true);
                yield "\"
                                           class=\"p-2 rounded-xl text-on-surface-variant hover:bg-amber-50 hover:text-amber-600 transition-all\"
                                           title=\"Edit\">
                                            <span class=\"material-symbols-outlined text-[18px]\">edit</span>
                                        </a>
                                        <form method=\"post\" action=\"";
                // line 169
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 169)]), "html", null, true);
                yield "\"
                                              onsubmit=\"return confirm('Delete this article?')\">
                                            <input type=\"hidden\" name=\"_token\" value=\"";
                // line 171
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 171))), "html", null, true);
                yield "\">
                                            <button class=\"p-2 rounded-xl text-on-surface-variant hover:bg-red-50 hover:text-red-500 transition-all\">
                                                <span class=\"material-symbols-outlined text-[18px]\">delete</span>
                                            </button>
                                        </form>
                                    ";
            }
            // line 177
            yield "                                </div>
                            </td>
                        </tr>
                    ";
            $context['_iterated'] = true;
        }
        // line 180
        if (!$context['_iterated']) {
            // line 181
            yield "                        <tr id=\"no-articles-row\">
                            <td colspan=\"6\" class=\"px-6 py-16 text-center text-on-surface-variant\">
                                <span class=\"material-symbols-outlined text-5xl opacity-30 block mb-2\">article</span>
                                <p class=\"font-semibold\">No articles found</p>
                            </td>
                        </tr>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['article'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 188
        yield "                    </tbody>
                </table>
            </div>
        </div>

    </div>";
        // line 194
        yield "
    ";
        // line 198
        yield "    <div id=\"panel-categories\" class=\"tab-panel hidden space-y-5\">
        ";
        // line 199
        yield Twig\Extension\CoreExtension::include($this->env, $context, "categorie/_list.html.twig");
        yield "
    </div>

    ";
        // line 205
        yield "    <div id=\"panel-paths\" class=\"tab-panel hidden space-y-5\">
        ";
        // line 206
        yield Twig\Extension\CoreExtension::include($this->env, $context, "learning_path/_list.html.twig");
        yield "
    </div>

    ";
        // line 212
        yield "    <div id=\"panel-tags\" class=\"tab-panel hidden space-y-5\">
        ";
        // line 213
        yield Twig\Extension\CoreExtension::include($this->env, $context, "tag/_list.html.twig");
        yield "
    </div>

</div>

<style>
.tab-btn { color: var(--on-surface-variant); }
.tab-btn.active-tab {
    background: white;
    color: var(--primary);
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.cat-chip {
    background: white;
    color: var(--on-surface-variant);
    border-color: rgba(0,0,0,0.12);
}
.cat-chip.active-chip {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}
</style>

<script>
/* ── Tab switching ── */
const TAB_ACTIONS = {
    articles:   ['btn-new-article'],
    categories: ['btn-new-categorie'],
    paths:      ['btn-new-path'],
    tags:       [],
};

function switchTab(name) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
    document.getElementById('panel-' + name).classList.remove('hidden');

    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active-tab'));
    document.getElementById('tab-' + name).classList.add('active-tab');

    ['btn-new-article', 'btn-new-categorie', 'btn-new-path'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.classList.add('hidden');
    });
    (TAB_ACTIONS[name] || []).forEach(id => {
        const el = document.getElementById(id);
        if (el) el.classList.remove('hidden');
    });

    history.replaceState(null, '', '#' + name);
}

/* ── Article real-time search + category filter ── */
let activeSearch = '';
let activeCatId  = null;

function applyArticleFilters() {
    const rows = document.querySelectorAll('.article-row');
    let visibleCount = 0;

    rows.forEach(row => {
        const matchesSearch = !activeSearch || row.dataset.search.includes(activeSearch);
        const matchesCat    = !activeCatId  || row.dataset.catId === activeCatId;
        const visible       = matchesSearch && matchesCat;
        row.style.display   = visible ? '' : 'none';
        if (visible) visibleCount++;
    });

    // Show/hide the empty state row if it exists
    const emptyRow = document.getElementById('no-articles-row');
    if (emptyRow) emptyRow.style.display = visibleCount === 0 ? '' : 'none';
}

function filterArticlesByCategory(catId) {
    activeCatId = catId ? String(catId) : null;

    // Update chip styles
    document.querySelectorAll('.cat-chip').forEach(chip => {
        const chipCat = chip.dataset.catId || null;
        const isActive = (!catId && !chipCat) || (catId && chipCat === String(catId));
        chip.classList.toggle('active-chip', isActive);
    });

    applyArticleFilters();
}

document.addEventListener('DOMContentLoaded', () => {
    // Real-time search
    const searchInput = document.getElementById('article-search');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            activeSearch = this.value.toLowerCase().trim();
            applyArticleFilters();
        });
    }

    // Restore tab from URL hash
    const hash = window.location.hash.replace('#', '');
    if (['articles', 'categories', 'paths', 'tags'].includes(hash)) {
        switchTab(hash);
    }
});
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
        return "article/index.html.twig";
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
        return array (  424 => 213,  421 => 212,  415 => 206,  412 => 205,  406 => 199,  403 => 198,  400 => 194,  393 => 188,  381 => 181,  379 => 180,  372 => 177,  363 => 171,  358 => 169,  349 => 164,  347 => 163,  339 => 158,  334 => 155,  331 => 154,  325 => 152,  320 => 151,  317 => 146,  315 => 145,  309 => 142,  305 => 140,  301 => 138,  295 => 135,  292 => 134,  290 => 133,  286 => 131,  283 => 130,  274 => 127,  267 => 124,  263 => 122,  261 => 121,  254 => 117,  249 => 115,  244 => 113,  240 => 112,  237 => 111,  232 => 110,  216 => 96,  212 => 93,  203 => 90,  199 => 89,  193 => 86,  188 => 85,  184 => 84,  177 => 79,  166 => 69,  162 => 66,  150 => 54,  141 => 48,  132 => 42,  125 => 37,  121 => 34,  110 => 26,  101 => 20,  92 => 14,  89 => 13,  87 => 12,  80 => 7,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}
<div class=\"space-y-6\">

    {# Page header with title and actions #}
    <div class=\"flex items-center justify-between\">
        <div>
            <h1 class=\"text-3xl font-extrabold text-on-surface tracking-tight\">Articles Space</h1>
            <p class=\"text-on-surface-variant text-sm mt-1\">Articles, categories, learning paths and tags</p>
        </div>
        {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_PSYCHOLOGUE') %}
            <div class=\"flex items-center gap-2\" id=\"header-actions\">
                <a href=\"{{ path('app_article_new') }}\" id=\"btn-new-article\"
                   class=\"flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold text-sm
                          hover:bg-primary/90 transition-all shadow-md shadow-primary/20\">
                    <span class=\"material-symbols-outlined text-[18px]\">add</span>
                    New article
                </a>
                <a href=\"{{ path('app_categorie_new') }}\" id=\"btn-new-categorie\"
                   class=\"hidden flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold text-sm
                          hover:bg-primary/90 transition-all shadow-md shadow-primary/20\">
                    <span class=\"material-symbols-outlined text-[18px]\">add</span>
                    New category
                </a>
                <a href=\"{{ path('app_learning_path_new') }}\" id=\"btn-new-path\"
                   class=\"hidden flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold text-sm
                          hover:bg-primary/90 transition-all shadow-md shadow-primary/20\">
                    <span class=\"material-symbols-outlined text-[18px]\">add</span>
                    New path
                </a>
            </div>
        {% endif %}
    </div>

    {# Tab navigation for different sections #}
    <div class=\"flex items-center gap-1 bg-gray-100/80 p-1 rounded-2xl w-fit\">
        <button onclick=\"switchTab('articles')\" id=\"tab-articles\"
                class=\"tab-btn active-tab flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all\">
            <span class=\"material-symbols-outlined text-[17px]\">article</span>
            Articles
            <span class=\"text-[10px] bg-primary/20 text-primary px-1.5 py-0.5 rounded-full\">{{ articles|length }}</span>
        </button>
        <button onclick=\"switchTab('categories')\" id=\"tab-categories\"
                class=\"tab-btn flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all\">
            <span class=\"material-symbols-outlined text-[17px]\">folder</span>
            Categories
            <span class=\"text-[10px] bg-gray-200 text-on-surface-variant px-1.5 py-0.5 rounded-full\">{{ categories|length }}</span>
        </button>
        <button onclick=\"switchTab('paths')\" id=\"tab-paths\"
                class=\"tab-btn flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all\">
            <span class=\"material-symbols-outlined text-[17px]\">route</span>
            Learning Paths
            <span class=\"text-[10px] bg-gray-200 text-on-surface-variant px-1.5 py-0.5 rounded-full\">{{ paths|length }}</span>
        </button>
        <button onclick=\"switchTab('tags')\" id=\"tab-tags\"
                class=\"tab-btn flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all\">
            <span class=\"material-symbols-outlined text-[17px]\">label</span>
            Tags
        </button>
    </div>

    {# ════════════════════════════════════════════════════════════
       TAB: ARTICLES
    ════════════════════════════════════════════════════════════ #}
    <div id=\"panel-articles\" class=\"tab-panel space-y-5\">

        {# Search — real-time client-side filter #}
        <div class=\"relative w-full\">
            <span class=\"material-symbols-outlined text-[20px] text-on-surface-variant pointer-events-none\"
                  style=\"position:absolute; left:1rem; top:50%; transform:translateY(-50%);\">search</span>
            <input type=\"text\" id=\"article-search\" placeholder=\"Search articles…\"
                   style=\"padding-left:2.75rem;\"
                   class=\"w-full pr-4 py-3 rounded-xl border border-outline/40 bg-white text-sm
                          focus:outline-none focus:ring-2 focus:ring-primary/30 transition shadow-sm\">
        </div>

        {# Category filter chips #}
        <div class=\"flex items-center gap-2 overflow-x-auto pb-1\" id=\"cat-chips\">
            <button onclick=\"filterArticlesByCategory(null)\"
                    class=\"cat-chip active-chip shrink-0 px-4 py-1.5 rounded-full text-xs font-bold border transition-all\">
                All
            </button>
            {% for cat in categories %}
                <button onclick=\"filterArticlesByCategory('{{ cat.id }}')\"
                        data-cat-id=\"{{ cat.id }}\"
                        class=\"cat-chip shrink-0 flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold border transition-all
                               bg-white text-on-surface-variant border-outline/40 hover:bg-gray-50\">
                    {{ cat.nom }}
                    <span class=\"opacity-60\">({{ cat.articles|length }})</span>
                </button>
            {% endfor %}
        </div>

        {# Articles table #}
        <div class=\"bg-white rounded-[2rem] border border-outline/30 overflow-hidden soft-elevation\">
            <div class=\"overflow-x-auto\">
                <table class=\"w-full text-left\">
                    <thead>
                        <tr class=\"border-b border-outline/20\">
                            <th class=\"px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-on-surface-variant\">Title</th>
                            <th class=\"px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-on-surface-variant\">Author</th>
                            <th class=\"px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-on-surface-variant\">Category</th>
                            <th class=\"px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-on-surface-variant\">Date</th>
                            <th class=\"px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-on-surface-variant\">Readability</th>
                            <th class=\"px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-on-surface-variant text-right\">Actions</th>
                        </tr>
                    </thead>
                    <tbody class=\"divide-y divide-outline/10\" id=\"article-tbody\">
                    {% for article in articles %}
                        <tr class=\"article-row hover:bg-gray-50/50 transition-colors group\"
                            data-search=\"{{ (article.titre ~ ' ' ~ article.contenu|striptags ~ ' ' ~ (article.auteur ? article.auteur.firstName ~ ' ' ~ article.auteur.lastName : '') ~ ' ' ~ (article.categorie ? article.categorie.nom : ''))|lower }}\"
                            data-cat-id=\"{{ article.categorie ? article.categorie.id : '' }}\">
                            <td class=\"px-6 py-4 max-w-xs\">
                                <p class=\"font-semibold text-sm text-on-surface line-clamp-1\">{{ article.titre }}</p>
                                <p class=\"text-xs text-on-surface-variant mt-0.5 line-clamp-1\">
                                    {{ article.contenu|striptags|slice(0,60) }}…
                                </p>
                            </td>
                            <td class=\"px-6 py-4\">
                                {% if article.auteur %}
                                    <div class=\"flex items-center gap-2\">
                                        <div class=\"w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center text-[10px] font-bold overflow-hidden shrink-0\">
                                            {{ article.auteur.firstName|first|upper }}{{ article.auteur.lastName|first|upper }}
                                        </div>
                                        <span class=\"text-xs font-medium text-on-surface-variant whitespace-nowrap\">
                                            {{ article.auteur.firstName }} {{ article.auteur.lastName }}
                                        </span>
                                    </div>
                                {% else %}—{% endif %}
                            </td>
                            <td class=\"px-6 py-4\">
                                {% if article.categorie %}
                                    <span class=\"px-2.5 py-1 rounded-full text-xs font-semibold bg-primary/10 text-primary\">
                                        {{ article.categorie.nom }}
                                    </span>
                                {% else %}
                                    <span class=\"px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-on-surface-variant\">—</span>
                                {% endif %}
                            </td>
                            <td class=\"px-6 py-4 text-xs text-on-surface-variant whitespace-nowrap\">
                                {{ article.datePublication ? article.datePublication|date('d/m/Y') : '—' }}
                            </td>
                            <td class=\"px-6 py-4\">
                                {% if article.readability %}
                                    {% set rc = {
                                        'Easy':         'bg-green-100 text-green-700',
                                        'Intermediate': 'bg-amber-100 text-amber-700',
                                        'Advanced':     'bg-red-100 text-red-700'
                                    } %}
                                    <span class=\"px-2.5 py-1 rounded-full text-xs font-semibold {{ rc[article.readability] ?? '' }}\">
                                        {{ article.readability }}
                                    </span>
                                {% else %}—{% endif %}
                            </td>
                            <td class=\"px-6 py-4\">
                                <div class=\"flex items-center justify-end gap-1\">
                                    <a href=\"{{ path('app_article_show', {id: article.id}) }}\"
                                       class=\"p-2 rounded-xl text-on-surface-variant hover:bg-primary/10 hover:text-primary transition-all\"
                                       title=\"View\">
                                        <span class=\"material-symbols-outlined text-[18px]\">visibility</span>
                                    </a>
                                    {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_PSYCHOLOGUE') %}
                                        <a href=\"{{ path('app_article_edit', {id: article.id}) }}\"
                                           class=\"p-2 rounded-xl text-on-surface-variant hover:bg-amber-50 hover:text-amber-600 transition-all\"
                                           title=\"Edit\">
                                            <span class=\"material-symbols-outlined text-[18px]\">edit</span>
                                        </a>
                                        <form method=\"post\" action=\"{{ path('app_article_delete', {id: article.id}) }}\"
                                              onsubmit=\"return confirm('Delete this article?')\">
                                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ article.id) }}\">
                                            <button class=\"p-2 rounded-xl text-on-surface-variant hover:bg-red-50 hover:text-red-500 transition-all\">
                                                <span class=\"material-symbols-outlined text-[18px]\">delete</span>
                                            </button>
                                        </form>
                                    {% endif %}
                                </div>
                            </td>
                        </tr>
                    {% else %}
                        <tr id=\"no-articles-row\">
                            <td colspan=\"6\" class=\"px-6 py-16 text-center text-on-surface-variant\">
                                <span class=\"material-symbols-outlined text-5xl opacity-30 block mb-2\">article</span>
                                <p class=\"font-semibold\">No articles found</p>
                            </td>
                        </tr>
                    {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>

    </div>{# /panel-articles #}

    {# ════════════════════════════════════════════════════════════
       TAB: CATEGORIES  — pulled from the shared partial
    ════════════════════════════════════════════════════════════ #}
    <div id=\"panel-categories\" class=\"tab-panel hidden space-y-5\">
        {{ include('categorie/_list.html.twig') }}
    </div>

    {# ════════════════════════════════════════════════════════════
       TAB: LEARNING PATHS  — pulled from the shared partial
    ════════════════════════════════════════════════════════════ #}
    <div id=\"panel-paths\" class=\"tab-panel hidden space-y-5\">
        {{ include('learning_path/_list.html.twig') }}
    </div>

    {# ════════════════════════════════════════════════════════════
       TAB: TAGS  — pulled from the shared partial
    ════════════════════════════════════════════════════════════ #}
    <div id=\"panel-tags\" class=\"tab-panel hidden space-y-5\">
        {{ include('tag/_list.html.twig') }}
    </div>

</div>

<style>
.tab-btn { color: var(--on-surface-variant); }
.tab-btn.active-tab {
    background: white;
    color: var(--primary);
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.cat-chip {
    background: white;
    color: var(--on-surface-variant);
    border-color: rgba(0,0,0,0.12);
}
.cat-chip.active-chip {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}
</style>

<script>
/* ── Tab switching ── */
const TAB_ACTIONS = {
    articles:   ['btn-new-article'],
    categories: ['btn-new-categorie'],
    paths:      ['btn-new-path'],
    tags:       [],
};

function switchTab(name) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
    document.getElementById('panel-' + name).classList.remove('hidden');

    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active-tab'));
    document.getElementById('tab-' + name).classList.add('active-tab');

    ['btn-new-article', 'btn-new-categorie', 'btn-new-path'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.classList.add('hidden');
    });
    (TAB_ACTIONS[name] || []).forEach(id => {
        const el = document.getElementById(id);
        if (el) el.classList.remove('hidden');
    });

    history.replaceState(null, '', '#' + name);
}

/* ── Article real-time search + category filter ── */
let activeSearch = '';
let activeCatId  = null;

function applyArticleFilters() {
    const rows = document.querySelectorAll('.article-row');
    let visibleCount = 0;

    rows.forEach(row => {
        const matchesSearch = !activeSearch || row.dataset.search.includes(activeSearch);
        const matchesCat    = !activeCatId  || row.dataset.catId === activeCatId;
        const visible       = matchesSearch && matchesCat;
        row.style.display   = visible ? '' : 'none';
        if (visible) visibleCount++;
    });

    // Show/hide the empty state row if it exists
    const emptyRow = document.getElementById('no-articles-row');
    if (emptyRow) emptyRow.style.display = visibleCount === 0 ? '' : 'none';
}

function filterArticlesByCategory(catId) {
    activeCatId = catId ? String(catId) : null;

    // Update chip styles
    document.querySelectorAll('.cat-chip').forEach(chip => {
        const chipCat = chip.dataset.catId || null;
        const isActive = (!catId && !chipCat) || (catId && chipCat === String(catId));
        chip.classList.toggle('active-chip', isActive);
    });

    applyArticleFilters();
}

document.addEventListener('DOMContentLoaded', () => {
    // Real-time search
    const searchInput = document.getElementById('article-search');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            activeSearch = this.value.toLowerCase().trim();
            applyArticleFilters();
        });
    }

    // Restore tab from URL hash
    const hash = window.location.hash.replace('#', '');
    if (['articles', 'categories', 'paths', 'tags'].includes(hash)) {
        switchTab(hash);
    }
});
</script>

{% endblock %}
", "article/index.html.twig", "C:\\Users\\user\\Documents\\master\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\article\\index.html.twig");
    }
}
