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
        yield "
<style>
.material-symbols-outlined {
  font-family: 'Material Symbols Outlined' !important;
  font-weight: normal;
  font-style: normal;
  font-size: 20px;
  display: inline-block;
  line-height: 1;
  letter-spacing: normal;
  text-transform: none;
  white-space: nowrap;
  direction: ltr;

  /* Important fixes */
  -webkit-font-smoothing: antialiased;
  font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 24;
}
</style>


";
        // line 30
        yield "<canvas id=\"idx-particles\"
        style=\"position:fixed;top:0;left:0;width:100%;height:100%;
               pointer-events:none;z-index:0;opacity:0.28\"></canvas>

<div class=\"relative z-10 w-full\" id=\"articles-space\">

";
        // line 39
        yield "<div class=\"idx-hero relative overflow-hidden rounded-[2rem] mb-7 px-8 py-7\"
     style=\"background:linear-gradient(135deg, #232d8d 0%, #131c74 55%, #11125e 100%)\">

    ";
        // line 43
        yield "    <div style=\"position:absolute;inset:0;
                background-image:linear-gradient(rgba(96,165,250,0.08) 1px,transparent 1px),
                                 linear-gradient(90deg,rgba(96,165,250,0.08) 1px,transparent 1px);
                background-size:28px 28px;border-radius:inherit;pointer-events:none\"></div>

    ";
        // line 49
        yield "    <div style=\"position:absolute;top:-80px;right:-60px;width:300px;height:300px;
                background:radial-gradient(circle,rgba(96,165,250,0.2) 0%,transparent 70%);
                border-radius:50%;pointer-events:none\"></div>
    <div style=\"position:absolute;bottom:-60px;left:20%;width:200px;height:200px;
                background:radial-gradient(circle,rgba(59,130,246,0.15) 0%,transparent 70%);
                border-radius:50%;pointer-events:none\"></div>

    <div style=\"display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:16px;position:relative\">
        <div>
            <div style=\"font-size:10px;font-weight:800;letter-spacing:.18em;
                        color:rgba(96,165,250,0.8);text-transform:uppercase;margin-bottom:6px\">
                InnerTrack · Psychology Platform
            </div>
            <h1 style=\"font-family:var(--serif);font-size:clamp(1.6rem,3.5vw,2.2rem);
                       font-weight:400;color:#f0f6ff;letter-spacing:-.01em;line-height:1.15;
                       font-style:italic;margin:0\">
                Articles Space
            </h1>
            
        </div>

        ";
        // line 71
        yield "        <div style=\"display:flex;gap:20px;flex-wrap:wrap\">
            ";
        // line 72
        $context["statData"] = [["val" => Twig\Extension\CoreExtension::length($this->env->getCharset(),         // line 73
(isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 73, $this->source); })())), "label" => "Articles", "icon" => "article"], ["val" => Twig\Extension\CoreExtension::length($this->env->getCharset(),         // line 74
(isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 74, $this->source); })())), "label" => "Categories", "icon" => "folder"], ["val" => Twig\Extension\CoreExtension::length($this->env->getCharset(),         // line 75
(isset($context["paths"]) || array_key_exists("paths", $context) ? $context["paths"] : (function () { throw new RuntimeError('Variable "paths" does not exist.', 75, $this->source); })())), "label" => "Paths", "icon" => "route"]];
        // line 77
        yield "            ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["statData"]) || array_key_exists("statData", $context) ? $context["statData"] : (function () { throw new RuntimeError('Variable "statData" does not exist.', 77, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["s"]) {
            // line 78
            yield "                <div style=\"text-align:center\">
                    <div style=\"font-family:var(--serif);font-size:1.8rem;color:#93c5fd;
                                line-height:1;font-weight:400\" class=\"hero-counter\"
                         data-target=\"";
            // line 81
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["s"], "val", [], "any", false, false, false, 81), "html", null, true);
            yield "\">0</div>
                    <div style=\"font-size:10px;color:rgba(240,246,255,0.4);
                                font-weight:700;letter-spacing:.06em;text-transform:uppercase;margin-top:2px\">
                        ";
            // line 84
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["s"], "label", [], "any", false, false, false, 84), "html", null, true);
            yield "
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['s'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 88
        yield "        </div>
    </div>

    ";
        // line 92
        yield "    ";
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE"))) {
            // line 93
            yield "        <div style=\"display:flex;gap:8px;flex-wrap:wrap;margin-top:18px;position:relative\"
             id=\"header-actions\">
            <a href=\"";
            // line 95
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_new");
            yield "\" id=\"btn-new-article\"
               style=\"display:inline-flex;align-items:center;gap:6px;
                      padding:8px 18px;border-radius:12px;
                      background:linear-gradient(135deg,#60a5fa,#3b82f6);
                      color:#0d1b2a;font-size:12px;font-weight:800;
                      text-decoration:none;letter-spacing:.03em;
                      box-shadow:0 4px 16px rgba(96,165,250,0.3);
                      transition:all .2s\">
                <span class=\"material-symbols-outlined\" style=\"font-size:15px\">add</span>
                New Article
            </a>
            <a href=\"";
            // line 106
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_categorie_new");
            yield "\" id=\"btn-new-categorie\"
               style=\"display:none;align-items:center;gap:6px;
                      padding:8px 18px;border-radius:12px;
                      background:linear-gradient(135deg,#60a5fa,#3b82f6);
                      color:white;font-size:12px;font-weight:800;
                      text-decoration:none;letter-spacing:.03em;
                      box-shadow:0 4px 16px rgba(96,165,250,0.3);
                      transition:all .2s\">
                <span class=\"material-symbols-outlined\" style=\"font-size:15px\">add</span>
                New Category
            </a>
            <a href=\"";
            // line 117
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_new");
            yield "\" id=\"btn-new-path\"
               style=\"display:none;align-items:center;gap:6px;
                      padding:8px 18px;border-radius:12px;
                      background:linear-gradient(135deg,#60a5fa,#3b82f6);
                      color:white;font-size:12px;font-weight:800;
                      text-decoration:none;letter-spacing:.03em;
                      box-shadow:0 4px 16px rgba(96,165,250,0.3);
                      transition:all .2s\">
                <span class=\"material-symbols-outlined\" style=\"font-size:15px\">add</span>
                New Path
            </a>
        </div>
    ";
        }
        // line 130
        yield "</div>

";
        // line 135
        yield "<div style=\"display:flex;gap:4px;background:rgba(13,27,42,0.06);
            padding:4px;border-radius:16px;width:fit-content;margin-bottom:20px\"
     class=\"idx-tabs-wrap\">
   ";
        // line 138
        $context["tabs"] = [["id" => "articles", "label" => "Articles", "icon" => "article", "color" => "#60a5fa", "cnt" => Twig\Extension\CoreExtension::length($this->env->getCharset(),         // line 139
(isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 139, $this->source); })()))], ["id" => "categories", "label" => "Categories", "icon" => "folder", "color" => "#60a5fa", "cnt" => Twig\Extension\CoreExtension::length($this->env->getCharset(),         // line 140
(isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 140, $this->source); })()))], ["id" => "paths", "label" => "Learning Paths", "icon" => "route", "color" => "#60a5fa", "cnt" => Twig\Extension\CoreExtension::length($this->env->getCharset(),         // line 141
(isset($context["paths"]) || array_key_exists("paths", $context) ? $context["paths"] : (function () { throw new RuntimeError('Variable "paths" does not exist.', 141, $this->source); })()))], ["id" => "tags", "label" => "Tags", "icon" => "label", "color" => "#f59e0b", "cnt" => null]];
        // line 144
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["tabs"]) || array_key_exists("tabs", $context) ? $context["tabs"] : (function () { throw new RuntimeError('Variable "tabs" does not exist.', 144, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["tab"]) {
            // line 145
            yield "        <button onclick=\"switchPanel('";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "id", [], "any", false, false, false, 145), "html", null, true);
            yield "')\" id=\"nav-";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "id", [], "any", false, false, false, 145), "html", null, true);
            yield "\"
                class=\"idx-tab ";
            // line 146
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "id", [], "any", false, false, false, 146) == "articles")) {
                yield "idx-tab-active";
            }
            yield "\"
                data-color=\"";
            // line 147
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "color", [], "any", false, false, false, 147), "html", null, true);
            yield "\"
                style=\"display:flex;align-items:center;gap:6px;
                       padding:8px 16px;border-radius:12px;border:none;cursor:pointer;
                       font-family:var(--sans);font-size:12px;font-weight:700;
                       letter-spacing:.02em;transition:all .22s;white-space:nowrap;
                       ";
            // line 152
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "id", [], "any", false, false, false, 152) == "articles")) {
                // line 153
                yield "                           background:white;color:#0d1b2a;
                           box-shadow:0 2px 10px rgba(0,0,0,0.1);
                       ";
            } else {
                // line 156
                yield "                           background:transparent;color:#64748b;
                       ";
            }
            // line 157
            yield "\">
            <span class=\"material-symbols-outlined\" style=\"font-size:15px\">";
            // line 158
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "icon", [], "any", false, false, false, 158), "html", null, true);
            yield "</span>
            ";
            // line 159
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "label", [], "any", false, false, false, 159), "html", null, true);
            yield "
            ";
            // line 160
            if ((($tmp =  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "cnt", [], "any", false, false, false, 160))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 161
                yield "                <span style=\"font-size:10px;font-weight:800;
                              padding:1px 6px;border-radius:20px;
                              background:";
                // line 163
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "id", [], "any", false, false, false, 163) == "articles")) {
                    yield "rgba(96,165,250,0.15)";
                } else {
                    yield "rgba(0,0,0,0.07)";
                }
                yield ";
                              color:";
                // line 164
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "id", [], "any", false, false, false, 164) == "articles")) {
                    yield "#3b82f6";
                } else {
                    yield "#94a3b8";
                }
                yield "\"
                      class=\"tab-cnt-";
                // line 165
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "id", [], "any", false, false, false, 165), "html", null, true);
                yield "\">
                    ";
                // line 166
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "cnt", [], "any", false, false, false, 166), "html", null, true);
                yield "
                </span>
            ";
            }
            // line 169
            yield "        </button>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['tab'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 171
        yield "</div>

";
        // line 176
        yield "<div id=\"panel-articles\" class=\"idx-panel space-y-4\">

    ";
        // line 179
        yield "    <div style=\"display:flex;flex-wrap:wrap;gap:8px;align-items:center\">

        ";
        // line 182
        yield "        <div style=\"flex:1;min-width:200px;display:flex;align-items:center;
                    background:white;border-radius:12px;
                    border:1.5px solid var(--border);
                    box-shadow:0 1px 4px rgba(0,0,0,0.05);overflow:hidden;
                    transition:border-color .2s\"
             class=\"search-wrap\">
            <span class=\"material-symbols-outlined\"
                  style=\"font-size:18px;color:#94a3b8;padding:0 12px;flex-shrink:0\">search</span>
            <input type=\"text\" id=\"article-search\"
                   placeholder=\"Search articles, authors, content…\"
                   style=\"flex:1;padding:10px 8px;font-size:13px;border:none;
                          outline:none;background:transparent;font-family:var(--sans);color:#1e293b\">
            <button id=\"search-clear\" onclick=\"clearSearch()\"
                    style=\"display:none;padding:0 12px;background:none;border:none;
                           cursor:pointer;color:#94a3b8;font-size:16px\">✕</button>
        </div>

        ";
        // line 200
        yield "        <select id=\"cat-select\" onchange=\"filterByCat(this.value)\"
                style=\"padding:10px 14px;border-radius:12px;border:1.5px solid var(--border);
                       background:white;font-size:12px;font-weight:600;color:#334155;
                       font-family:var(--sans);outline:none;cursor:pointer;
                       box-shadow:0 1px 4px rgba(0,0,0,0.05)\">
            <option value=\"\">All categories</option>
            ";
        // line 206
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 206, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
            // line 207
            yield "                <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cat"], "id", [], "any", false, false, false, 207), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cat"], "nom", [], "any", false, false, false, 207), "html", null, true);
            yield "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['cat'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 209
        yield "        </select>

        ";
        // line 212
        yield "        <select id=\"read-select\" onchange=\"filterByReadability(this.value)\"
                style=\"padding:10px 14px;border-radius:12px;border:1.5px solid var(--border);
                       background:white;font-size:12px;font-weight:600;color:#334155;
                       font-family:var(--sans);outline:none;cursor:pointer;
                       box-shadow:0 1px 4px rgba(0,0,0,0.05)\">
            <option value=\"\">All levels</option>
            <option value=\"Easy\">🟢 Easy</option>
            <option value=\"Medium\">🟡 Medium</option>
            <option value=\"Advanced\">🔴 Advanced</option>
        </select>

        ";
        // line 224
        yield "        <div style=\"display:flex;gap:2px;background:rgba(0,0,0,0.06);
                    padding:3px;border-radius:10px\">
            <button id=\"view-table\" onclick=\"setView('table')\"
                    class=\"vbtn vbtn-active\" title=\"Table view\"
                    style=\"padding:7px 10px;border-radius:8px;border:none;cursor:pointer;
                           font-family:var(--sans);transition:all .18s\">
                <span class=\"material-symbols-outlined\" style=\"font-size:16px;display:block\">table_rows</span>
            </button>
            <button id=\"view-cards\" onclick=\"setView('cards')\"
                    class=\"vbtn\" title=\"Card view\"
                    style=\"padding:7px 10px;border-radius:8px;border:none;cursor:pointer;
                           font-family:var(--sans);transition:all .18s\">
                <span class=\"material-symbols-outlined\" style=\"font-size:16px;display:block\">grid_view</span>
            </button>
        </div>
    </div>

    ";
        // line 242
        yield "    <div style=\"display:flex;align-items:center;justify-content:space-between\">
        <span id=\"results-summary\"
              style=\"font-size:11px;font-weight:700;color:#94a3b8;letter-spacing:.04em;
                     text-transform:uppercase\">
            ";
        // line 246
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 246, $this->source); })())), "html", null, true);
        yield " Articles
        </span>
        <button onclick=\"clearAllFilters()\" id=\"clear-filters-btn\"
                style=\"display:none;font-size:11px;font-weight:700;color:#ef4444;
                       background:none;border:none;cursor:pointer;font-family:var(--sans);
                       display:none;align-items:center;gap:4px\">
            <span class=\"material-symbols-outlined\" style=\"font-size:13px\">filter_alt_off</span>
            Clear filters
        </button>
    </div>

    ";
        // line 258
        yield "    <div id=\"view-table-panel\"
         style=\"background:white;border-radius:20px;border:1.5px solid var(--border);
                overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.05)\">
        <div style=\"overflow-x:auto\">
            <table style=\"width:100%;border-collapse:collapse;min-width:580px\">
                <thead>
                    <tr style=\"border-bottom:1px solid #f1f5f9;background:#fafbfc\">
                        ";
        // line 265
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(["Title", "Author", "Category", "Date", "Level", ""]);
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
            // line 266
            yield "                            <th style=\"padding:12px 18px;font-size:10px;font-weight:800;
                                       letter-spacing:.14em;text-transform:uppercase;
                                       color:#94a3b8;text-align:";
            // line 268
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 268)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                yield "right";
            } else {
                yield "left";
            }
            yield "\">
                                ";
            // line 269
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["h"], "html", null, true);
            yield "
                            </th>
                        ";
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
        // line 272
        yield "                    </tr>
                </thead>
                <tbody id=\"article-tbody\">
                ";
        // line 275
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 275, $this->source); })()));
        $context['_iterated'] = false;
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
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 276
            yield "                    <tr class=\"article-row trow\"
                        data-id=\"";
            // line 277
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 277), "html", null, true);
            yield "\"
                        data-search=\"";
            // line 278
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), ((((((CoreExtension::getAttribute($this->env, $this->source, $context["article"], "titre", [], "any", false, false, false, 278) . " ") . Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "contenu", [], "any", false, false, false, 278))) . " ") . (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 278)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 278), "firstName", [], "any", false, false, false, 278) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 278), "lastName", [], "any", false, false, false, 278))) : (""))) . " ") . (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 278)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 278), "nom", [], "any", false, false, false, 278)) : ("")))), "html", null, true);
            yield "\"
                        data-cat-id=\"";
            // line 279
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 279)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 279), "id", [], "any", false, false, false, 279), "html", null, true)) : (""));
            yield "\"
                        data-readability=\"";
            // line 280
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 280), "html", null, true);
            yield "\"
                        style=\"border-bottom:1px solid #f8fafc;transition:background .15s;
                               animation:rowIn .35s ease both;animation-delay:";
            // line 282
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 282) * 0.04), "html", null, true);
            yield "s;opacity:0\">

                        <td style=\"padding:13px 18px;max-width:240px\">
                            <div style=\"display:flex;align-items:center;gap:8px\">
                                <span class=\"read-dot\"
                                      data-article-id=\"";
            // line 287
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 287), "html", null, true);
            yield "\"
                                      style=\"width:6px;height:6px;border-radius:50%;
                                             background:#e2e8f0;flex-shrink:0;transition:all .2s\"></span>
                                <div style=\"min-width:0\">
                                    <p style=\"font-size:13px;font-weight:700;color:#1e293b;
                                               overflow:hidden;white-space:nowrap;text-overflow:ellipsis;
                                               margin:0\">";
            // line 293
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "titre", [], "any", false, false, false, 293), "html", null, true);
            yield "</p>
                                    <p style=\"font-size:11px;color:#94a3b8;margin:2px 0 0;
                                               overflow:hidden;white-space:nowrap;text-overflow:ellipsis\">
                                        ";
            // line 296
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "contenu", [], "any", false, false, false, 296)), 0, 52), "html", null, true);
            yield "…
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td style=\"padding:13px 18px\">
                            ";
            // line 303
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 303)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 304
                yield "                                <div style=\"display:flex;align-items:center;gap:6px\">
                                    <div style=\"width:22px;height:22px;border-radius:50%;
                                                background:linear-gradient(135deg,#60a5fa22,#3b82f608);
                                                border:1px solid rgba(96,165,250,0.3);
                                                color:#3b82f6;font-size:8px;font-weight:800;
                                                display:flex;align-items:center;justify-content:center;
                                                flex-shrink:0\">
                                        ";
                // line 311
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 311), "firstName", [], "any", false, false, false, 311))), "html", null, true);
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 311), "lastName", [], "any", false, false, false, 311))), "html", null, true);
                yield "
                                    </div>
                                    <span style=\"font-size:11px;color:#64748b;white-space:nowrap;
                                                 overflow:hidden;text-overflow:ellipsis;max-width:80px\">
                                        ";
                // line 315
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 315), "firstName", [], "any", false, false, false, 315), "html", null, true);
                yield "
                                    </span>
                                </div>
                            ";
            } else {
                // line 318
                yield "<span style=\"color:#cbd5e1;font-size:12px\">—</span>";
            }
            // line 319
            yield "                        </td>

                        <td style=\"padding:13px 18px\">
                            ";
            // line 322
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 322)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 323
                yield "                                <span style=\"font-size:10px;font-weight:800;
                                              padding:3px 10px;border-radius:20px;
                                              background:rgba(96,165,250,0.1); color:#3b82f6;
                                              white-space:nowrap\">
                                    ";
                // line 327
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 327), "nom", [], "any", false, false, false, 327), "html", null, true);
                yield "
                                </span>
                            ";
            } else {
                // line 329
                yield "<span style=\"color:#cbd5e1;font-size:12px\">—</span>";
            }
            // line 330
            yield "                        </td>

                        <td style=\"padding:13px 18px;font-size:11px;color:#94a3b8;white-space:nowrap\">
                            ";
            // line 333
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "datePublication", [], "any", false, false, false, 333)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "datePublication", [], "any", false, false, false, 333), "d/m/Y"), "html", null, true)) : ("—"));
            yield "
                        </td>

                        <td style=\"padding:13px 18px\">
                            ";
            // line 337
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 337)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 338
                yield "                                ";
                $context["rmap"] = ["Easy" => "rgba(34,197,94,.1)|#16a34a", "Medium" => "rgba(245,158,11,.1)|#b45309", "Advanced" => "rgba(239,68,68,.1)|#dc2626"];
                // line 343
                yield "                                ";
                $context["rp"] = Twig\Extension\CoreExtension::split($this->env->getCharset(), ((CoreExtension::getAttribute($this->env, $this->source, ($context["rmap"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 343), [], "array", true, true, false, 343)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rmap"]) || array_key_exists("rmap", $context) ? $context["rmap"] : (function () { throw new RuntimeError('Variable "rmap" does not exist.', 343, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 343), [], "array", false, false, false, 343), "rgba(0,0,0,.06)|#666")) : ("rgba(0,0,0,.06)|#666")), "|");
                // line 344
                yield "                                <span style=\"font-size:10px;font-weight:800;padding:3px 10px;
                                              border-radius:20px;white-space:nowrap;
                                              background:";
                // line 346
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rp"]) || array_key_exists("rp", $context) ? $context["rp"] : (function () { throw new RuntimeError('Variable "rp" does not exist.', 346, $this->source); })()), 0, [], "array", false, false, false, 346), "html", null, true);
                yield ";color:";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rp"]) || array_key_exists("rp", $context) ? $context["rp"] : (function () { throw new RuntimeError('Variable "rp" does not exist.', 346, $this->source); })()), 1, [], "array", false, false, false, 346), "html", null, true);
                yield "\">
                                    ";
                // line 347
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 347), "html", null, true);
                yield "
                                </span>
                            ";
            } else {
                // line 349
                yield "<span style=\"color:#cbd5e1\">—</span>";
            }
            // line 350
            yield "                        </td>

                        <td style=\"padding:13px 18px\">
                            <div style=\"display:flex;align-items:center;justify-content:flex-end;gap:2px\">
                                <a href=\"";
            // line 354
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 354)]), "html", null, true);
            yield "\"
                                   class=\"tact\" title=\"View\"
                                   style=\"padding:6px;border-radius:8px;color:#94a3b8;
                                          display:flex;transition:all .15s;text-decoration:none\">
                                    <span class=\"material-symbols-outlined\" style=\"font-size:16px\">visibility</span>
                                </a>
                                ";
            // line 360
            if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE"))) {
                // line 361
                yield "                                    <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 361)]), "html", null, true);
                yield "\"
                                       class=\"tact tact-edit\" title=\"Edit\"
                                       style=\"padding:6px;border-radius:8px;color:#94a3b8;
                                              display:flex;transition:all .15s;text-decoration:none\">
                                        <span class=\"material-symbols-outlined\" style=\"font-size:16px\">edit</span>
                                    </a>
                                    <form method=\"post\" action=\"";
                // line 367
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 367)]), "html", null, true);
                yield "\"
                                          onsubmit=\"return confirm('Delete this article?')\"
                                          style=\"display:flex;margin:0\">
                                        <input type=\"hidden\" name=\"_token\" value=\"";
                // line 370
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 370))), "html", null, true);
                yield "\">
                                        <button class=\"tact tact-del\" title=\"Delete\"
                                                style=\"padding:6px;border-radius:8px;color:#94a3b8;
                                                       background:none;border:none;cursor:pointer;
                                                       display:flex;transition:all .15s;font-family:var(--sans)\">
                                            <span class=\"material-symbols-outlined\" style=\"font-size:16px\">delete</span>
                                        </button>
                                    </form>
                                ";
            }
            // line 379
            yield "                            </div>
                        </td>
                    </tr>
                ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        // line 382
        if (!$context['_iterated']) {
            // line 383
            yield "                    <tr>
                        <td colspan=\"6\" style=\"padding:60px;text-align:center;color:#94a3b8\">
                            <span class=\"material-symbols-outlined\"
                                  style=\"font-size:40px;display:block;opacity:.2;margin-bottom:8px\">article</span>
                            <p style=\"font-size:13px;font-weight:600;margin:0\">No articles found</p>
                        </td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['article'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 391
        yield "                </tbody>
            </table>
        </div>
    </div>

    ";
        // line 397
        yield "    <div id=\"view-cards-panel\" style=\"display:none\">
        <div style=\"display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:12px\"
             id=\"article-cards-grid\">
        ";
        // line 400
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 400, $this->source); })()));
        $context['_iterated'] = false;
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
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 401
            yield "            <div class=\"article-row acard\"
                 data-id=\"";
            // line 402
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 402), "html", null, true);
            yield "\"
                 data-search=\"";
            // line 403
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), ((((((CoreExtension::getAttribute($this->env, $this->source, $context["article"], "titre", [], "any", false, false, false, 403) . " ") . Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "contenu", [], "any", false, false, false, 403))) . " ") . (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 403)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 403), "firstName", [], "any", false, false, false, 403) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 403), "lastName", [], "any", false, false, false, 403))) : (""))) . " ") . (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 403)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 403), "nom", [], "any", false, false, false, 403)) : ("")))), "html", null, true);
            yield "\"
                 data-cat-id=\"";
            // line 404
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 404)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 404), "id", [], "any", false, false, false, 404), "html", null, true)) : (""));
            yield "\"
                 data-readability=\"";
            // line 405
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 405), "html", null, true);
            yield "\"
                 style=\"background:white;border-radius:18px;border:1.5px solid var(--border);
                        overflow:hidden;transition:all .25s;cursor:pointer;
                        animation:cardIn .4s ease both;
                        animation-delay:";
            // line 409
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 409) * 0.05), "html", null, true);
            yield "s;opacity:0\">

                ";
            // line 412
            yield "                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 412) == "Easy")) {
                // line 413
                yield "                    <div style=\"height:3px;background:linear-gradient(90deg,#22c55e,#10b981)\"></div>
                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 414
$context["article"], "readability", [], "any", false, false, false, 414) == "Medium")) {
                // line 415
                yield "                    <div style=\"height:3px;background:linear-gradient(90deg,#f59e0b,#f97316)\"></div>
                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 416
$context["article"], "readability", [], "any", false, false, false, 416) == "Advanced")) {
                // line 417
                yield "                    <div style=\"height:3px;background:linear-gradient(90deg,#ef4444,#f43f5e)\"></div>
                ";
            } else {
                // line 419
                yield "                    <div style=\"height:3px;background:linear-gradient(90deg,#60a5fa,#3b82f6)\"></div>
                ";
            }
            // line 421
            yield "
                <div style=\"padding:16px\">
                    <div style=\"display:flex;align-items:center;gap:6px;flex-wrap:wrap;margin-bottom:10px\">
                        ";
            // line 424
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 424)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 425
                yield "                            <span style=\"font-size:10px;font-weight:800;padding:2px 8px;border-radius:20px;
                                          background:rgba(96,165,250,0.1);color:#3b82f6\">
                                ";
                // line 427
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "categorie", [], "any", false, false, false, 427), "nom", [], "any", false, false, false, 427), "html", null, true);
                yield "
                            </span>
                        ";
            }
            // line 430
            yield "                        ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 430)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 431
                yield "                            ";
                $context["rmap"] = ["Easy" => "rgba(34,197,94,.1)|#16a34a", "Medium" => "rgba(245,158,11,.1)|#b45309", "Advanced" => "rgba(239,68,68,.1)|#dc2626"];
                // line 432
                yield "                            ";
                $context["rp"] = Twig\Extension\CoreExtension::split($this->env->getCharset(), ((CoreExtension::getAttribute($this->env, $this->source, ($context["rmap"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 432), [], "array", true, true, false, 432)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rmap"]) || array_key_exists("rmap", $context) ? $context["rmap"] : (function () { throw new RuntimeError('Variable "rmap" does not exist.', 432, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 432), [], "array", false, false, false, 432), "rgba(0,0,0,.06)|#666")) : ("rgba(0,0,0,.06)|#666")), "|");
                // line 433
                yield "                            <span style=\"font-size:10px;font-weight:800;padding:2px 8px;border-radius:20px;
                                          background:";
                // line 434
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rp"]) || array_key_exists("rp", $context) ? $context["rp"] : (function () { throw new RuntimeError('Variable "rp" does not exist.', 434, $this->source); })()), 0, [], "array", false, false, false, 434), "html", null, true);
                yield ";color:";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rp"]) || array_key_exists("rp", $context) ? $context["rp"] : (function () { throw new RuntimeError('Variable "rp" does not exist.', 434, $this->source); })()), 1, [], "array", false, false, false, 434), "html", null, true);
                yield "\">
                                ";
                // line 435
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 435), "html", null, true);
                yield "
                            </span>
                        ";
            }
            // line 438
            yield "                        <span class=\"read-dot\" data-article-id=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 438), "html", null, true);
            yield "\"
                              style=\"width:6px;height:6px;border-radius:50%;
                                     background:#e2e8f0;margin-left:auto;transition:all .2s\"></span>
                    </div>

                    <h3 style=\"font-size:13px;font-weight:700;color:#1e293b;
                                line-height:1.4;margin:0 0 6px;
                                display:-webkit-box;-webkit-line-clamp:2;
                                -webkit-box-orient:vertical;overflow:hidden\">
                        ";
            // line 447
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "titre", [], "any", false, false, false, 447), "html", null, true);
            yield "
                    </h3>
                    <p style=\"font-size:11px;color:#94a3b8;line-height:1.6;margin:0 0 12px;
                               display:-webkit-box;-webkit-line-clamp:2;
                               -webkit-box-orient:vertical;overflow:hidden\">
                        ";
            // line 452
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "contenu", [], "any", false, false, false, 452)), 0, 90), "html", null, true);
            yield "…
                    </p>

                    <div style=\"display:flex;align-items:center;justify-content:space-between;
                                padding-top:10px;border-top:1px solid #f1f5f9\">
                        <div style=\"display:flex;align-items:center;gap:5px\">
                            ";
            // line 458
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 458)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 459
                yield "                                <div style=\"width:18px;height:18px;border-radius:50%;
                                            background:rgba(96,165,250,0.15);color:#3b82f6;
                                            font-size:7px;font-weight:800;
                                            display:flex;align-items:center;justify-content:center\">
                                    ";
                // line 463
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 463), "firstName", [], "any", false, false, false, 463))), "html", null, true);
                yield "
                                </div>
                                <span style=\"font-size:10px;color:#94a3b8\">";
                // line 465
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["article"], "auteur", [], "any", false, false, false, 465), "firstName", [], "any", false, false, false, 465), "html", null, true);
                yield "</span>
                                <span style=\"font-size:10px;color:#e2e8f0\">·</span>
                            ";
            }
            // line 468
            yield "                            <span style=\"font-size:10px;color:#94a3b8\">
                                ";
            // line 469
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "datePublication", [], "any", false, false, false, 469)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "datePublication", [], "any", false, false, false, 469), "d/m/Y"), "html", null, true)) : (""));
            yield "
                            </span>
                        </div>
                        <a href=\"";
            // line 472
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 472)]), "html", null, true);
            yield "\"
                           style=\"font-size:10px;font-weight:800;color:#3b82f6;
                                  text-decoration:none;display:flex;align-items:center;gap:2px\">
                            Read
                            <span class=\"material-symbols-outlined\" style=\"font-size:12px\">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        // line 481
        if (!$context['_iterated']) {
            // line 482
            yield "            <div style=\"grid-column:1/-1;padding:60px;text-align:center;color:#94a3b8\">
                <span class=\"material-symbols-outlined\" style=\"font-size:40px;display:block;opacity:.2;margin-bottom:8px\">article</span>
                <p style=\"font-size:13px;font-weight:600;margin:0\">No articles found</p>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['article'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 487
        yield "        </div>
    </div>

    ";
        // line 491
        yield "    <div id=\"no-results-state\"
         style=\"display:none;background:white;border-radius:20px;border:1.5px solid var(--border);
                padding:60px;text-align:center;color:#94a3b8\">
        <span class=\"material-symbols-outlined\" style=\"font-size:40px;display:block;opacity:.2;margin-bottom:8px\">search_off</span>
        <p style=\"font-size:13px;font-weight:600;margin:0 0 8px\">No articles match your filters</p>
        <button onclick=\"clearAllFilters()\"
                style=\"font-size:12px;font-weight:800;color:#3b82f6;background:none;
                       border:none;cursor:pointer;font-family:var(--sans)\">
            Clear all filters
        </button>
    </div>

    ";
        // line 504
        yield "    ";
        if ((array_key_exists("pager", $context) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["pager"]) || array_key_exists("pager", $context) ? $context["pager"] : (function () { throw new RuntimeError('Variable "pager" does not exist.', 504, $this->source); })()), "haveToPaginate", [], "any", false, false, false, 504))) {
            // line 505
            yield "        <div style=\"display:flex;align-items:center;justify-content:center;gap:8px;padding-top:8px\">
            ";
            // line 506
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["pager"]) || array_key_exists("pager", $context) ? $context["pager"] : (function () { throw new RuntimeError('Variable "pager" does not exist.', 506, $this->source); })()), "hasPreviousPage", [], "any", false, false, false, 506)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 507
                yield "                <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index", Twig\Extension\CoreExtension::merge(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 507, $this->source); })()), "request", [], "any", false, false, false, 507), "query", [], "any", false, false, false, 507), "all", [], "any", false, false, false, 507), ["page" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["pager"]) || array_key_exists("pager", $context) ? $context["pager"] : (function () { throw new RuntimeError('Variable "pager" does not exist.', 507, $this->source); })()), "previousPage", [], "any", false, false, false, 507)])), "html", null, true);
                yield "\"
                   style=\"display:inline-flex;align-items:center;gap:4px;
                          padding:8px 18px;border-radius:12px;
                          border:1.5px solid var(--border);background:white;
                          font-size:12px;font-weight:700;color:#334155;
                          text-decoration:none;transition:all .2s\">
                    <span class=\"material-symbols-outlined\" style=\"font-size:14px\">arrow_back</span> Prev
                </a>
            ";
            }
            // line 516
            yield "            <span style=\"font-size:12px;font-weight:700;color:#94a3b8;padding:0 8px\">
                ";
            // line 517
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["pager"]) || array_key_exists("pager", $context) ? $context["pager"] : (function () { throw new RuntimeError('Variable "pager" does not exist.', 517, $this->source); })()), "currentPage", [], "any", false, false, false, 517), "html", null, true);
            yield " / ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["pager"]) || array_key_exists("pager", $context) ? $context["pager"] : (function () { throw new RuntimeError('Variable "pager" does not exist.', 517, $this->source); })()), "nbPages", [], "any", false, false, false, 517), "html", null, true);
            yield "
            </span>
            ";
            // line 519
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["pager"]) || array_key_exists("pager", $context) ? $context["pager"] : (function () { throw new RuntimeError('Variable "pager" does not exist.', 519, $this->source); })()), "hasNextPage", [], "any", false, false, false, 519)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 520
                yield "                <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index", Twig\Extension\CoreExtension::merge(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 520, $this->source); })()), "request", [], "any", false, false, false, 520), "query", [], "any", false, false, false, 520), "all", [], "any", false, false, false, 520), ["page" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["pager"]) || array_key_exists("pager", $context) ? $context["pager"] : (function () { throw new RuntimeError('Variable "pager" does not exist.', 520, $this->source); })()), "nextPage", [], "any", false, false, false, 520)])), "html", null, true);
                yield "\"
                   style=\"display:inline-flex;align-items:center;gap:4px;
                          padding:8px 18px;border-radius:12px;
                          border:1.5px solid var(--border);background:white;
                          font-size:12px;font-weight:700;color:#334155;
                          text-decoration:none;transition:all .2s\">
                    Next <span class=\"material-symbols-outlined\" style=\"font-size:14px\">arrow_forward</span>
                </a>
            ";
            }
            // line 529
            yield "        </div>
    ";
        }
        // line 531
        yield "
</div>";
        // line 533
        yield "
";
        // line 535
        yield "<div id=\"panel-categories\" class=\"idx-panel\" style=\"display:none\">
    ";
        // line 536
        yield Twig\Extension\CoreExtension::include($this->env, $context, "categorie/_list.html.twig");
        yield "
</div>

";
        // line 540
        yield "<div id=\"panel-paths\" class=\"idx-panel\" style=\"display:none\">
    ";
        // line 541
        yield Twig\Extension\CoreExtension::include($this->env, $context, "learning_path/_list.html.twig");
        yield "
</div>

";
        // line 545
        yield "<div id=\"panel-tags\" class=\"idx-panel\" style=\"display:none\">
    ";
        // line 546
        yield Twig\Extension\CoreExtension::include($this->env, $context, "tag/_list.html.twig");
        yield "
</div>

</div>";
        // line 550
        yield "
<style>
/* ── Animations ── */
@keyframes heroIn   { from{opacity:0;transform:translateY(16px) scale(.98)} to{opacity:1;transform:none} }
@keyframes tabsIn   { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:none} }
@keyframes rowIn    { from{opacity:0;transform:translateX(-8px)} to{opacity:1;transform:none} }
@keyframes cardIn   { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:none} }
@keyframes panelIn  { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:none} }

.idx-hero       { animation: heroIn .55s cubic-bezier(.4,0,.2,1) both; }
.idx-tabs-wrap  { animation: tabsIn .45s cubic-bezier(.4,0,.2,1) .1s both; }
.idx-panel      { animation: panelIn .38s ease both; }

/* ── Search focus ── */
.search-wrap:focus-within {
    border-color: rgba(96,165,250,0.5) !important;
    box-shadow: 0 0 0 3px rgba(96,165,250,0.1) !important;
}

/* ── Table row hover ── */
.trow:hover { background: #eff6ff !important; }
.tact:hover { background: rgba(96,165,250,.08) !important; color: #3b82f6 !important; }
.tact-edit:hover { background: rgba(245,158,11,.08) !important; color: #d97706 !important; }
.tact-del:hover  { background: rgba(239,68,68,.08) !important; color: #dc2626 !important; }

/* ── Card hover ── */
.acard:hover {
    border-color: rgba(96,165,250,0.3) !important;
    box-shadow: 0 8px 28px rgba(96,165,250,0.1) !important;
    transform: translateY(-3px) !important;
}

/* ── View buttons ── */
.vbtn { background:transparent; color:#94a3b8; }
.vbtn-active { background:white !important; color:#0d1b2a !important; box-shadow:0 1px 4px rgba(0,0,0,.1); }

/* ── Read dot ── */
.read-dot.is-read { background:#22c55e !important; box-shadow:0 0 0 3px rgba(34,197,94,.2); }

/* ── Hero action btn hover ── */
#btn-new-article:hover { box-shadow:0 6px 24px rgba(96,165,250,0.45) !important; }

/* ── Pagination hover ── */
a[href*=\"page\"]:hover { background:#eff6ff !important; border-color:rgba(96,165,250,0.3) !important; }
</style>

<script>
/* ── Particle canvas ── */
(function(){
    const c=document.getElementById('idx-particles');
    if(!c) return;
    const x=c.getContext('2d');
    let W,H,P=[];
    function resize(){ W=c.width=window.innerWidth; H=c.height=window.innerHeight; }
    function mk(){ return {x:Math.random()*W,y:Math.random()*H,r:Math.random()*1.5+.4,
        vx:(Math.random()-.5)*.25,vy:(Math.random()-.5)*.25,
        life:Math.random(),sp:Math.random()*.003+.001,t:Math.random()>.5}; }
    function frame(){
        x.clearRect(0,0,W,H);
        for(let i=0;i<P.length;i++) for(let j=i+1;j<P.length;j++){
            const dx=P[i].x-P[j].x,dy=P[i].y-P[j].y,d=Math.sqrt(dx*dx+dy*dy);
            if(d<120){ x.beginPath();x.strokeStyle=`rgba(96,165,250,\${(1-d/120)*.06})`;
                x.lineWidth=.5;x.moveTo(P[i].x,P[i].y);x.lineTo(P[j].x,P[j].y);x.stroke(); }
        }
        P.forEach(p=>{
            p.life+=p.sp;
            const op=(Math.sin(p.life*Math.PI)*.5+.5)*.5;
            x.beginPath();x.arc(p.x,p.y,p.r,0,Math.PI*2);
            x.fillStyle=p.t?`rgba(96,165,250,\${op})`:`rgba(59,130,246,\${op*.5})`;
            x.fill();
            p.x+=p.vx;p.y+=p.vy;
            if(p.x<0)p.x=W;if(p.x>W)p.x=0;
            if(p.y<0)p.y=H;if(p.y>H)p.y=0;
        });
        requestAnimationFrame(frame);
    }
    window.addEventListener('resize',resize);
    resize();P=Array.from({length:50},mk);frame();
})();

/* ── State ── */
let activeSearch='',activeCatId=null,activeReadability=null;
let currentView=localStorage.getItem('articles_view')||'table';

/* ── Hero counters ── */
function animateCounters(){
    document.querySelectorAll('.hero-counter').forEach(el=>{
        const t=parseInt(el.dataset.target,10);
        let n=0,step=t/(600/16);
        const timer=setInterval(()=>{ n=Math.min(n+step,t); el.textContent=Math.floor(n); if(n>=t)clearInterval(timer); },16);
    });
}

/* ── Read dots ── */
function paintReadDots(){
    const rs=JSON.parse(localStorage.getItem('read_articles')||'[]');
    document.querySelectorAll('.read-dot').forEach(d=>{
        if(rs.includes(String(d.dataset.articleId))) d.classList.add('is-read');
    });
    const el=document.getElementById('read-count');
    if(el) el.textContent=rs.length;
}

/* ── Panel switcher ── */
const PANEL_BTNS={articles:'btn-new-article',categories:'btn-new-categorie',paths:'btn-new-path',tags:null};

function switchPanel(name){
    document.querySelectorAll('.idx-panel').forEach(p=>p.style.display='none');
    const t=document.getElementById('panel-'+name);
    if(t){ t.style.display=''; t.style.animation='none'; void t.offsetWidth; t.style.animation=''; }

    document.querySelectorAll('.idx-tab').forEach(b=>{
        b.style.background='transparent';b.style.color='#64748b';b.style.boxShadow='none';
        const cnt=b.querySelector('[class^=\"tab-cnt\"]');
        if(cnt){ cnt.style.background='rgba(0,0,0,.07)';cnt.style.color='#94a3b8'; }
    });
    const ab=document.getElementById('nav-'+name);
    if(ab){
        ab.style.background='white';ab.style.color='#0d1b2a';ab.style.boxShadow='0 2px 10px rgba(0,0,0,.1)';
        const cnt=ab.querySelector('[class^=\"tab-cnt\"]');
        const color=ab.dataset.color||'#60a5fa';
        if(cnt){ cnt.style.background=color+'22';cnt.style.color=color; }
    }

    ['btn-new-article','btn-new-categorie','btn-new-path'].forEach(id=>{
        const el=document.getElementById(id); if(el) el.style.display='none';
    });
    const bid=PANEL_BTNS[name];
    if(bid){ const el=document.getElementById(bid); if(el) el.style.display='inline-flex'; }

    history.replaceState(null,'','#'+name);
}

/* ── View toggle ── */
function setView(v){
    currentView=v;
    localStorage.setItem('articles_view',v);
    document.getElementById('view-table-panel').style.display=v==='table'?'':'none';
    document.getElementById('view-cards-panel').style.display=v==='cards'?'':'none';
    document.querySelectorAll('.vbtn').forEach(b=>b.classList.remove('vbtn-active'));
    document.getElementById('view-'+v)?.classList.add('vbtn-active');
    applyFilters();
}

/* ── Filters ── */
function applyFilters(){
    const container = currentView === 'table' 
        ? document.getElementById('view-table-panel')
        : document.getElementById('view-cards-panel');
    
    if (!container) return;
    
    const rows = container.querySelectorAll('.article-row');
    let vis = 0;
    
    rows.forEach(r => {
        const ok = (!activeSearch || r.dataset.search.includes(activeSearch))
               && (!activeCatId || r.dataset.catId === activeCatId)
               && (!activeReadability || r.dataset.readability === activeReadability);
        r.style.display = ok ? '' : 'none';
        if (ok) vis++;
    });
    
    const total = rows.length;
    const s = document.getElementById('results-summary');
    if (s) {
        s.textContent = vis === total 
            ? `\${total} Article\${total !== 1 ? 's' : ''}`
            : `\${vis} of \${total} Articles`;
    }
    
    const nr = document.getElementById('no-results-state');
    if (nr) nr.style.display = vis === 0 ? '' : 'none';
    
    const cb = document.getElementById('clear-filters-btn');
    if (cb) cb.style.display = (activeSearch || activeCatId || activeReadability) ? 'flex' : 'none';
}
function filterByCat(id){ activeCatId=id||null; applyFilters(); }
function filterByReadability(v){ activeReadability=v||null; applyFilters(); }
function clearSearch(){
    activeSearch='';
    const i=document.getElementById('article-search'); if(i) i.value='';
    const b=document.getElementById('search-clear'); if(b) b.style.display='none';
    applyFilters();
}
function clearAllFilters(){
    clearSearch(); activeCatId=null; activeReadability=null;
    const cs=document.getElementById('cat-select'); if(cs) cs.value='';
    const rs=document.getElementById('read-select'); if(rs) rs.value='';
    applyFilters();
}

/* ── Init ── */
document.addEventListener('DOMContentLoaded',()=>{
    animateCounters();
    paintReadDots();
    setView(currentView);

    const si=document.getElementById('article-search');
    if(si){
        si.addEventListener('input',function(){
            activeSearch=this.value.toLowerCase().trim();
            const b=document.getElementById('search-clear');
            if(b) b.style.display=activeSearch?'':'none';
            applyFilters();
        });
    }

    const hash=window.location.hash.replace('#','');
    if(['articles','categories','paths','tags'].includes(hash)) switchPanel(hash);
    else switchPanel('articles');
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
        return array (  1056 => 550,  1050 => 546,  1047 => 545,  1041 => 541,  1038 => 540,  1032 => 536,  1029 => 535,  1026 => 533,  1023 => 531,  1019 => 529,  1006 => 520,  1004 => 519,  997 => 517,  994 => 516,  981 => 507,  979 => 506,  976 => 505,  973 => 504,  959 => 491,  954 => 487,  944 => 482,  942 => 481,  920 => 472,  914 => 469,  911 => 468,  905 => 465,  900 => 463,  894 => 459,  892 => 458,  883 => 452,  875 => 447,  862 => 438,  856 => 435,  850 => 434,  847 => 433,  844 => 432,  841 => 431,  838 => 430,  832 => 427,  828 => 425,  826 => 424,  821 => 421,  817 => 419,  813 => 417,  811 => 416,  808 => 415,  806 => 414,  803 => 413,  800 => 412,  795 => 409,  788 => 405,  784 => 404,  780 => 403,  776 => 402,  773 => 401,  755 => 400,  750 => 397,  743 => 391,  730 => 383,  728 => 382,  713 => 379,  701 => 370,  695 => 367,  685 => 361,  683 => 360,  674 => 354,  668 => 350,  665 => 349,  659 => 347,  653 => 346,  649 => 344,  646 => 343,  643 => 338,  641 => 337,  634 => 333,  629 => 330,  626 => 329,  620 => 327,  614 => 323,  612 => 322,  607 => 319,  604 => 318,  597 => 315,  589 => 311,  580 => 304,  578 => 303,  568 => 296,  562 => 293,  553 => 287,  545 => 282,  540 => 280,  536 => 279,  532 => 278,  528 => 277,  525 => 276,  507 => 275,  502 => 272,  485 => 269,  477 => 268,  473 => 266,  456 => 265,  447 => 258,  433 => 246,  427 => 242,  408 => 224,  395 => 212,  391 => 209,  380 => 207,  376 => 206,  368 => 200,  349 => 182,  345 => 179,  341 => 176,  337 => 171,  330 => 169,  324 => 166,  320 => 165,  312 => 164,  304 => 163,  300 => 161,  298 => 160,  294 => 159,  290 => 158,  287 => 157,  283 => 156,  278 => 153,  276 => 152,  268 => 147,  262 => 146,  255 => 145,  250 => 144,  248 => 141,  247 => 140,  246 => 139,  245 => 138,  240 => 135,  236 => 130,  220 => 117,  206 => 106,  192 => 95,  188 => 93,  185 => 92,  180 => 88,  170 => 84,  164 => 81,  159 => 78,  154 => 77,  152 => 75,  151 => 74,  150 => 73,  149 => 72,  146 => 71,  123 => 49,  116 => 43,  111 => 39,  103 => 30,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}

<style>
.material-symbols-outlined {
  font-family: 'Material Symbols Outlined' !important;
  font-weight: normal;
  font-style: normal;
  font-size: 20px;
  display: inline-block;
  line-height: 1;
  letter-spacing: normal;
  text-transform: none;
  white-space: nowrap;
  direction: ltr;

  /* Important fixes */
  -webkit-font-smoothing: antialiased;
  font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 24;
}
</style>


{# ── Neural particle canvas ── #}
<canvas id=\"idx-particles\"
        style=\"position:fixed;top:0;left:0;width:100%;height:100%;
               pointer-events:none;z-index:0;opacity:0.28\"></canvas>

<div class=\"relative z-10 w-full\" id=\"articles-space\">

{# ══════════════════════════════════════════
   HERO HEADER BAND
══════════════════════════════════════════ #}
<div class=\"idx-hero relative overflow-hidden rounded-[2rem] mb-7 px-8 py-7\"
     style=\"background:linear-gradient(135deg, #232d8d 0%, #131c74 55%, #11125e 100%)\">

    {# Grid texture – lighter blue lines #}
    <div style=\"position:absolute;inset:0;
                background-image:linear-gradient(rgba(96,165,250,0.08) 1px,transparent 1px),
                                 linear-gradient(90deg,rgba(96,165,250,0.08) 1px,transparent 1px);
                background-size:28px 28px;border-radius:inherit;pointer-events:none\"></div>

    {# Glow orbs – lighter blue #}
    <div style=\"position:absolute;top:-80px;right:-60px;width:300px;height:300px;
                background:radial-gradient(circle,rgba(96,165,250,0.2) 0%,transparent 70%);
                border-radius:50%;pointer-events:none\"></div>
    <div style=\"position:absolute;bottom:-60px;left:20%;width:200px;height:200px;
                background:radial-gradient(circle,rgba(59,130,246,0.15) 0%,transparent 70%);
                border-radius:50%;pointer-events:none\"></div>

    <div style=\"display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:16px;position:relative\">
        <div>
            <div style=\"font-size:10px;font-weight:800;letter-spacing:.18em;
                        color:rgba(96,165,250,0.8);text-transform:uppercase;margin-bottom:6px\">
                InnerTrack · Psychology Platform
            </div>
            <h1 style=\"font-family:var(--serif);font-size:clamp(1.6rem,3.5vw,2.2rem);
                       font-weight:400;color:#f0f6ff;letter-spacing:-.01em;line-height:1.15;
                       font-style:italic;margin:0\">
                Articles Space
            </h1>
            
        </div>

        {# Hero stats #}
        <div style=\"display:flex;gap:20px;flex-wrap:wrap\">
            {% set statData = [
                {val: articles|length,   label: 'Articles',  icon: 'article'},
                {val: categories|length, label: 'Categories',icon: 'folder'},
                {val: paths|length,      label: 'Paths',     icon: 'route'},
            ] %}
            {% for s in statData %}
                <div style=\"text-align:center\">
                    <div style=\"font-family:var(--serif);font-size:1.8rem;color:#93c5fd;
                                line-height:1;font-weight:400\" class=\"hero-counter\"
                         data-target=\"{{ s.val }}\">0</div>
                    <div style=\"font-size:10px;color:rgba(240,246,255,0.4);
                                font-weight:700;letter-spacing:.06em;text-transform:uppercase;margin-top:2px\">
                        {{ s.label }}
                    </div>
                </div>
            {% endfor %}
        </div>
    </div>

    {# Action buttons row #}
    {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_PSYCHOLOGUE') %}
        <div style=\"display:flex;gap:8px;flex-wrap:wrap;margin-top:18px;position:relative\"
             id=\"header-actions\">
            <a href=\"{{ path('app_article_new') }}\" id=\"btn-new-article\"
               style=\"display:inline-flex;align-items:center;gap:6px;
                      padding:8px 18px;border-radius:12px;
                      background:linear-gradient(135deg,#60a5fa,#3b82f6);
                      color:#0d1b2a;font-size:12px;font-weight:800;
                      text-decoration:none;letter-spacing:.03em;
                      box-shadow:0 4px 16px rgba(96,165,250,0.3);
                      transition:all .2s\">
                <span class=\"material-symbols-outlined\" style=\"font-size:15px\">add</span>
                New Article
            </a>
            <a href=\"{{ path('app_categorie_new') }}\" id=\"btn-new-categorie\"
               style=\"display:none;align-items:center;gap:6px;
                      padding:8px 18px;border-radius:12px;
                      background:linear-gradient(135deg,#60a5fa,#3b82f6);
                      color:white;font-size:12px;font-weight:800;
                      text-decoration:none;letter-spacing:.03em;
                      box-shadow:0 4px 16px rgba(96,165,250,0.3);
                      transition:all .2s\">
                <span class=\"material-symbols-outlined\" style=\"font-size:15px\">add</span>
                New Category
            </a>
            <a href=\"{{ path('app_learning_path_new') }}\" id=\"btn-new-path\"
               style=\"display:none;align-items:center;gap:6px;
                      padding:8px 18px;border-radius:12px;
                      background:linear-gradient(135deg,#60a5fa,#3b82f6);
                      color:white;font-size:12px;font-weight:800;
                      text-decoration:none;letter-spacing:.03em;
                      box-shadow:0 4px 16px rgba(96,165,250,0.3);
                      transition:all .2s\">
                <span class=\"material-symbols-outlined\" style=\"font-size:15px\">add</span>
                New Path
            </a>
        </div>
    {% endif %}
</div>

{# ══════════════════════════════════════════
   NAV PILL TABS
══════════════════════════════════════════ #}
<div style=\"display:flex;gap:4px;background:rgba(13,27,42,0.06);
            padding:4px;border-radius:16px;width:fit-content;margin-bottom:20px\"
     class=\"idx-tabs-wrap\">
   {% set tabs = [
    {id:'articles',   label:'Articles',       icon:'article', color:'#60a5fa', cnt: articles|length},
    {id:'categories', label:'Categories',     icon:'folder',  color:'#60a5fa', cnt: categories|length},
    {id:'paths',      label:'Learning Paths', icon:'route',   color:'#60a5fa', cnt: paths|length},
    {id:'tags',       label:'Tags',           icon:'label',   color:'#f59e0b', cnt: null},
] %}
    {% for tab in tabs %}
        <button onclick=\"switchPanel('{{ tab.id }}')\" id=\"nav-{{ tab.id }}\"
                class=\"idx-tab {% if tab.id == 'articles' %}idx-tab-active{% endif %}\"
                data-color=\"{{ tab.color }}\"
                style=\"display:flex;align-items:center;gap:6px;
                       padding:8px 16px;border-radius:12px;border:none;cursor:pointer;
                       font-family:var(--sans);font-size:12px;font-weight:700;
                       letter-spacing:.02em;transition:all .22s;white-space:nowrap;
                       {% if tab.id == 'articles' %}
                           background:white;color:#0d1b2a;
                           box-shadow:0 2px 10px rgba(0,0,0,0.1);
                       {% else %}
                           background:transparent;color:#64748b;
                       {% endif %}\">
            <span class=\"material-symbols-outlined\" style=\"font-size:15px\">{{ tab.icon }}</span>
            {{ tab.label }}
            {% if tab.cnt is not null %}
                <span style=\"font-size:10px;font-weight:800;
                              padding:1px 6px;border-radius:20px;
                              background:{% if tab.id == 'articles' %}rgba(96,165,250,0.15){% else %}rgba(0,0,0,0.07){% endif %};
                              color:{% if tab.id == 'articles' %}#3b82f6{% else %}#94a3b8{% endif %}\"
                      class=\"tab-cnt-{{ tab.id }}\">
                    {{ tab.cnt }}
                </span>
            {% endif %}
        </button>
    {% endfor %}
</div>

{# ══════════════════════════════════════════
   PANEL: ARTICLES
══════════════════════════════════════════ #}
<div id=\"panel-articles\" class=\"idx-panel space-y-4\">

    {# Filter bar #}
    <div style=\"display:flex;flex-wrap:wrap;gap:8px;align-items:center\">

        {# Search #}
        <div style=\"flex:1;min-width:200px;display:flex;align-items:center;
                    background:white;border-radius:12px;
                    border:1.5px solid var(--border);
                    box-shadow:0 1px 4px rgba(0,0,0,0.05);overflow:hidden;
                    transition:border-color .2s\"
             class=\"search-wrap\">
            <span class=\"material-symbols-outlined\"
                  style=\"font-size:18px;color:#94a3b8;padding:0 12px;flex-shrink:0\">search</span>
            <input type=\"text\" id=\"article-search\"
                   placeholder=\"Search articles, authors, content…\"
                   style=\"flex:1;padding:10px 8px;font-size:13px;border:none;
                          outline:none;background:transparent;font-family:var(--sans);color:#1e293b\">
            <button id=\"search-clear\" onclick=\"clearSearch()\"
                    style=\"display:none;padding:0 12px;background:none;border:none;
                           cursor:pointer;color:#94a3b8;font-size:16px\">✕</button>
        </div>

        {# Category select #}
        <select id=\"cat-select\" onchange=\"filterByCat(this.value)\"
                style=\"padding:10px 14px;border-radius:12px;border:1.5px solid var(--border);
                       background:white;font-size:12px;font-weight:600;color:#334155;
                       font-family:var(--sans);outline:none;cursor:pointer;
                       box-shadow:0 1px 4px rgba(0,0,0,0.05)\">
            <option value=\"\">All categories</option>
            {% for cat in categories %}
                <option value=\"{{ cat.id }}\">{{ cat.nom }}</option>
            {% endfor %}
        </select>

        {# Readability select #}
        <select id=\"read-select\" onchange=\"filterByReadability(this.value)\"
                style=\"padding:10px 14px;border-radius:12px;border:1.5px solid var(--border);
                       background:white;font-size:12px;font-weight:600;color:#334155;
                       font-family:var(--sans);outline:none;cursor:pointer;
                       box-shadow:0 1px 4px rgba(0,0,0,0.05)\">
            <option value=\"\">All levels</option>
            <option value=\"Easy\">🟢 Easy</option>
            <option value=\"Medium\">🟡 Medium</option>
            <option value=\"Advanced\">🔴 Advanced</option>
        </select>

        {# View toggle #}
        <div style=\"display:flex;gap:2px;background:rgba(0,0,0,0.06);
                    padding:3px;border-radius:10px\">
            <button id=\"view-table\" onclick=\"setView('table')\"
                    class=\"vbtn vbtn-active\" title=\"Table view\"
                    style=\"padding:7px 10px;border-radius:8px;border:none;cursor:pointer;
                           font-family:var(--sans);transition:all .18s\">
                <span class=\"material-symbols-outlined\" style=\"font-size:16px;display:block\">table_rows</span>
            </button>
            <button id=\"view-cards\" onclick=\"setView('cards')\"
                    class=\"vbtn\" title=\"Card view\"
                    style=\"padding:7px 10px;border-radius:8px;border:none;cursor:pointer;
                           font-family:var(--sans);transition:all .18s\">
                <span class=\"material-symbols-outlined\" style=\"font-size:16px;display:block\">grid_view</span>
            </button>
        </div>
    </div>

    {# Results bar #}
    <div style=\"display:flex;align-items:center;justify-content:space-between\">
        <span id=\"results-summary\"
              style=\"font-size:11px;font-weight:700;color:#94a3b8;letter-spacing:.04em;
                     text-transform:uppercase\">
            {{ articles|length }} Articles
        </span>
        <button onclick=\"clearAllFilters()\" id=\"clear-filters-btn\"
                style=\"display:none;font-size:11px;font-weight:700;color:#ef4444;
                       background:none;border:none;cursor:pointer;font-family:var(--sans);
                       display:none;align-items:center;gap:4px\">
            <span class=\"material-symbols-outlined\" style=\"font-size:13px\">filter_alt_off</span>
            Clear filters
        </button>
    </div>

    {# ── TABLE VIEW ── #}
    <div id=\"view-table-panel\"
         style=\"background:white;border-radius:20px;border:1.5px solid var(--border);
                overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.05)\">
        <div style=\"overflow-x:auto\">
            <table style=\"width:100%;border-collapse:collapse;min-width:580px\">
                <thead>
                    <tr style=\"border-bottom:1px solid #f1f5f9;background:#fafbfc\">
                        {% for h in ['Title','Author','Category','Date','Level',''] %}
                            <th style=\"padding:12px 18px;font-size:10px;font-weight:800;
                                       letter-spacing:.14em;text-transform:uppercase;
                                       color:#94a3b8;text-align:{% if loop.last %}right{% else %}left{% endif %}\">
                                {{ h }}
                            </th>
                        {% endfor %}
                    </tr>
                </thead>
                <tbody id=\"article-tbody\">
                {% for article in articles %}
                    <tr class=\"article-row trow\"
                        data-id=\"{{ article.id }}\"
                        data-search=\"{{ (article.titre ~ ' ' ~ article.contenu|striptags ~ ' ' ~ (article.auteur ? article.auteur.firstName ~ ' ' ~ article.auteur.lastName : '') ~ ' ' ~ (article.categorie ? article.categorie.nom : ''))|lower }}\"
                        data-cat-id=\"{{ article.categorie ? article.categorie.id : '' }}\"
                        data-readability=\"{{ article.readability }}\"
                        style=\"border-bottom:1px solid #f8fafc;transition:background .15s;
                               animation:rowIn .35s ease both;animation-delay:{{ loop.index * 0.04 }}s;opacity:0\">

                        <td style=\"padding:13px 18px;max-width:240px\">
                            <div style=\"display:flex;align-items:center;gap:8px\">
                                <span class=\"read-dot\"
                                      data-article-id=\"{{ article.id }}\"
                                      style=\"width:6px;height:6px;border-radius:50%;
                                             background:#e2e8f0;flex-shrink:0;transition:all .2s\"></span>
                                <div style=\"min-width:0\">
                                    <p style=\"font-size:13px;font-weight:700;color:#1e293b;
                                               overflow:hidden;white-space:nowrap;text-overflow:ellipsis;
                                               margin:0\">{{ article.titre }}</p>
                                    <p style=\"font-size:11px;color:#94a3b8;margin:2px 0 0;
                                               overflow:hidden;white-space:nowrap;text-overflow:ellipsis\">
                                        {{ article.contenu|striptags|slice(0,52) }}…
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td style=\"padding:13px 18px\">
                            {% if article.auteur %}
                                <div style=\"display:flex;align-items:center;gap:6px\">
                                    <div style=\"width:22px;height:22px;border-radius:50%;
                                                background:linear-gradient(135deg,#60a5fa22,#3b82f608);
                                                border:1px solid rgba(96,165,250,0.3);
                                                color:#3b82f6;font-size:8px;font-weight:800;
                                                display:flex;align-items:center;justify-content:center;
                                                flex-shrink:0\">
                                        {{ article.auteur.firstName|first|upper }}{{ article.auteur.lastName|first|upper }}
                                    </div>
                                    <span style=\"font-size:11px;color:#64748b;white-space:nowrap;
                                                 overflow:hidden;text-overflow:ellipsis;max-width:80px\">
                                        {{ article.auteur.firstName }}
                                    </span>
                                </div>
                            {% else %}<span style=\"color:#cbd5e1;font-size:12px\">—</span>{% endif %}
                        </td>

                        <td style=\"padding:13px 18px\">
                            {% if article.categorie %}
                                <span style=\"font-size:10px;font-weight:800;
                                              padding:3px 10px;border-radius:20px;
                                              background:rgba(96,165,250,0.1); color:#3b82f6;
                                              white-space:nowrap\">
                                    {{ article.categorie.nom }}
                                </span>
                            {% else %}<span style=\"color:#cbd5e1;font-size:12px\">—</span>{% endif %}
                        </td>

                        <td style=\"padding:13px 18px;font-size:11px;color:#94a3b8;white-space:nowrap\">
                            {{ article.datePublication ? article.datePublication|date('d/m/Y') : '—' }}
                        </td>

                        <td style=\"padding:13px 18px\">
                            {% if article.readability %}
                                {% set rmap = {
                                    'Easy':     'rgba(34,197,94,.1)|#16a34a',
                                    'Medium':   'rgba(245,158,11,.1)|#b45309',
                                    'Advanced': 'rgba(239,68,68,.1)|#dc2626'
                                } %}
                                {% set rp = rmap[article.readability]|default('rgba(0,0,0,.06)|#666')|split('|') %}
                                <span style=\"font-size:10px;font-weight:800;padding:3px 10px;
                                              border-radius:20px;white-space:nowrap;
                                              background:{{ rp[0] }};color:{{ rp[1] }}\">
                                    {{ article.readability }}
                                </span>
                            {% else %}<span style=\"color:#cbd5e1\">—</span>{% endif %}
                        </td>

                        <td style=\"padding:13px 18px\">
                            <div style=\"display:flex;align-items:center;justify-content:flex-end;gap:2px\">
                                <a href=\"{{ path('app_article_show', {id: article.id}) }}\"
                                   class=\"tact\" title=\"View\"
                                   style=\"padding:6px;border-radius:8px;color:#94a3b8;
                                          display:flex;transition:all .15s;text-decoration:none\">
                                    <span class=\"material-symbols-outlined\" style=\"font-size:16px\">visibility</span>
                                </a>
                                {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_PSYCHOLOGUE') %}
                                    <a href=\"{{ path('app_article_edit', {id: article.id}) }}\"
                                       class=\"tact tact-edit\" title=\"Edit\"
                                       style=\"padding:6px;border-radius:8px;color:#94a3b8;
                                              display:flex;transition:all .15s;text-decoration:none\">
                                        <span class=\"material-symbols-outlined\" style=\"font-size:16px\">edit</span>
                                    </a>
                                    <form method=\"post\" action=\"{{ path('app_article_delete', {id: article.id}) }}\"
                                          onsubmit=\"return confirm('Delete this article?')\"
                                          style=\"display:flex;margin:0\">
                                        <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ article.id) }}\">
                                        <button class=\"tact tact-del\" title=\"Delete\"
                                                style=\"padding:6px;border-radius:8px;color:#94a3b8;
                                                       background:none;border:none;cursor:pointer;
                                                       display:flex;transition:all .15s;font-family:var(--sans)\">
                                            <span class=\"material-symbols-outlined\" style=\"font-size:16px\">delete</span>
                                        </button>
                                    </form>
                                {% endif %}
                            </div>
                        </td>
                    </tr>
                {% else %}
                    <tr>
                        <td colspan=\"6\" style=\"padding:60px;text-align:center;color:#94a3b8\">
                            <span class=\"material-symbols-outlined\"
                                  style=\"font-size:40px;display:block;opacity:.2;margin-bottom:8px\">article</span>
                            <p style=\"font-size:13px;font-weight:600;margin:0\">No articles found</p>
                        </td>
                    </tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>

    {# ── CARD VIEW ── #}
    <div id=\"view-cards-panel\" style=\"display:none\">
        <div style=\"display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:12px\"
             id=\"article-cards-grid\">
        {% for article in articles %}
            <div class=\"article-row acard\"
                 data-id=\"{{ article.id }}\"
                 data-search=\"{{ (article.titre ~ ' ' ~ article.contenu|striptags ~ ' ' ~ (article.auteur ? article.auteur.firstName ~ ' ' ~ article.auteur.lastName : '') ~ ' ' ~ (article.categorie ? article.categorie.nom : ''))|lower }}\"
                 data-cat-id=\"{{ article.categorie ? article.categorie.id : '' }}\"
                 data-readability=\"{{ article.readability }}\"
                 style=\"background:white;border-radius:18px;border:1.5px solid var(--border);
                        overflow:hidden;transition:all .25s;cursor:pointer;
                        animation:cardIn .4s ease both;
                        animation-delay:{{ loop.index * 0.05 }}s;opacity:0\">

                {# Top strip – blue for default, keep readability colors #}
                {% if article.readability == 'Easy' %}
                    <div style=\"height:3px;background:linear-gradient(90deg,#22c55e,#10b981)\"></div>
                {% elseif article.readability == 'Medium' %}
                    <div style=\"height:3px;background:linear-gradient(90deg,#f59e0b,#f97316)\"></div>
                {% elseif article.readability == 'Advanced' %}
                    <div style=\"height:3px;background:linear-gradient(90deg,#ef4444,#f43f5e)\"></div>
                {% else %}
                    <div style=\"height:3px;background:linear-gradient(90deg,#60a5fa,#3b82f6)\"></div>
                {% endif %}

                <div style=\"padding:16px\">
                    <div style=\"display:flex;align-items:center;gap:6px;flex-wrap:wrap;margin-bottom:10px\">
                        {% if article.categorie %}
                            <span style=\"font-size:10px;font-weight:800;padding:2px 8px;border-radius:20px;
                                          background:rgba(96,165,250,0.1);color:#3b82f6\">
                                {{ article.categorie.nom }}
                            </span>
                        {% endif %}
                        {% if article.readability %}
                            {% set rmap = {'Easy':'rgba(34,197,94,.1)|#16a34a','Medium':'rgba(245,158,11,.1)|#b45309','Advanced':'rgba(239,68,68,.1)|#dc2626'} %}
                            {% set rp = rmap[article.readability]|default('rgba(0,0,0,.06)|#666')|split('|') %}
                            <span style=\"font-size:10px;font-weight:800;padding:2px 8px;border-radius:20px;
                                          background:{{ rp[0] }};color:{{ rp[1] }}\">
                                {{ article.readability }}
                            </span>
                        {% endif %}
                        <span class=\"read-dot\" data-article-id=\"{{ article.id }}\"
                              style=\"width:6px;height:6px;border-radius:50%;
                                     background:#e2e8f0;margin-left:auto;transition:all .2s\"></span>
                    </div>

                    <h3 style=\"font-size:13px;font-weight:700;color:#1e293b;
                                line-height:1.4;margin:0 0 6px;
                                display:-webkit-box;-webkit-line-clamp:2;
                                -webkit-box-orient:vertical;overflow:hidden\">
                        {{ article.titre }}
                    </h3>
                    <p style=\"font-size:11px;color:#94a3b8;line-height:1.6;margin:0 0 12px;
                               display:-webkit-box;-webkit-line-clamp:2;
                               -webkit-box-orient:vertical;overflow:hidden\">
                        {{ article.contenu|striptags|slice(0, 90) }}…
                    </p>

                    <div style=\"display:flex;align-items:center;justify-content:space-between;
                                padding-top:10px;border-top:1px solid #f1f5f9\">
                        <div style=\"display:flex;align-items:center;gap:5px\">
                            {% if article.auteur %}
                                <div style=\"width:18px;height:18px;border-radius:50%;
                                            background:rgba(96,165,250,0.15);color:#3b82f6;
                                            font-size:7px;font-weight:800;
                                            display:flex;align-items:center;justify-content:center\">
                                    {{ article.auteur.firstName|first|upper }}
                                </div>
                                <span style=\"font-size:10px;color:#94a3b8\">{{ article.auteur.firstName }}</span>
                                <span style=\"font-size:10px;color:#e2e8f0\">·</span>
                            {% endif %}
                            <span style=\"font-size:10px;color:#94a3b8\">
                                {{ article.datePublication ? article.datePublication|date('d/m/Y') : '' }}
                            </span>
                        </div>
                        <a href=\"{{ path('app_article_show', {id: article.id}) }}\"
                           style=\"font-size:10px;font-weight:800;color:#3b82f6;
                                  text-decoration:none;display:flex;align-items:center;gap:2px\">
                            Read
                            <span class=\"material-symbols-outlined\" style=\"font-size:12px\">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        {% else %}
            <div style=\"grid-column:1/-1;padding:60px;text-align:center;color:#94a3b8\">
                <span class=\"material-symbols-outlined\" style=\"font-size:40px;display:block;opacity:.2;margin-bottom:8px\">article</span>
                <p style=\"font-size:13px;font-weight:600;margin:0\">No articles found</p>
            </div>
        {% endfor %}
        </div>
    </div>

    {# No results #}
    <div id=\"no-results-state\"
         style=\"display:none;background:white;border-radius:20px;border:1.5px solid var(--border);
                padding:60px;text-align:center;color:#94a3b8\">
        <span class=\"material-symbols-outlined\" style=\"font-size:40px;display:block;opacity:.2;margin-bottom:8px\">search_off</span>
        <p style=\"font-size:13px;font-weight:600;margin:0 0 8px\">No articles match your filters</p>
        <button onclick=\"clearAllFilters()\"
                style=\"font-size:12px;font-weight:800;color:#3b82f6;background:none;
                       border:none;cursor:pointer;font-family:var(--sans)\">
            Clear all filters
        </button>
    </div>

    {# Pagination #}
    {% if pager is defined and pager.haveToPaginate %}
        <div style=\"display:flex;align-items:center;justify-content:center;gap:8px;padding-top:8px\">
            {% if pager.hasPreviousPage %}
                <a href=\"{{ path('app_article_index', app.request.query.all|merge({page: pager.previousPage})) }}\"
                   style=\"display:inline-flex;align-items:center;gap:4px;
                          padding:8px 18px;border-radius:12px;
                          border:1.5px solid var(--border);background:white;
                          font-size:12px;font-weight:700;color:#334155;
                          text-decoration:none;transition:all .2s\">
                    <span class=\"material-symbols-outlined\" style=\"font-size:14px\">arrow_back</span> Prev
                </a>
            {% endif %}
            <span style=\"font-size:12px;font-weight:700;color:#94a3b8;padding:0 8px\">
                {{ pager.currentPage }} / {{ pager.nbPages }}
            </span>
            {% if pager.hasNextPage %}
                <a href=\"{{ path('app_article_index', app.request.query.all|merge({page: pager.nextPage})) }}\"
                   style=\"display:inline-flex;align-items:center;gap:4px;
                          padding:8px 18px;border-radius:12px;
                          border:1.5px solid var(--border);background:white;
                          font-size:12px;font-weight:700;color:#334155;
                          text-decoration:none;transition:all .2s\">
                    Next <span class=\"material-symbols-outlined\" style=\"font-size:14px\">arrow_forward</span>
                </a>
            {% endif %}
        </div>
    {% endif %}

</div>{# /panel-articles #}

{# ══ PANEL: CATEGORIES ══ #}
<div id=\"panel-categories\" class=\"idx-panel\" style=\"display:none\">
    {{ include('categorie/_list.html.twig') }}
</div>

{# ══ PANEL: PATHS ══ #}
<div id=\"panel-paths\" class=\"idx-panel\" style=\"display:none\">
    {{ include('learning_path/_list.html.twig') }}
</div>

{# ══ PANEL: TAGS ══ #}
<div id=\"panel-tags\" class=\"idx-panel\" style=\"display:none\">
    {{ include('tag/_list.html.twig') }}
</div>

</div>{# /articles-space #}

<style>
/* ── Animations ── */
@keyframes heroIn   { from{opacity:0;transform:translateY(16px) scale(.98)} to{opacity:1;transform:none} }
@keyframes tabsIn   { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:none} }
@keyframes rowIn    { from{opacity:0;transform:translateX(-8px)} to{opacity:1;transform:none} }
@keyframes cardIn   { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:none} }
@keyframes panelIn  { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:none} }

.idx-hero       { animation: heroIn .55s cubic-bezier(.4,0,.2,1) both; }
.idx-tabs-wrap  { animation: tabsIn .45s cubic-bezier(.4,0,.2,1) .1s both; }
.idx-panel      { animation: panelIn .38s ease both; }

/* ── Search focus ── */
.search-wrap:focus-within {
    border-color: rgba(96,165,250,0.5) !important;
    box-shadow: 0 0 0 3px rgba(96,165,250,0.1) !important;
}

/* ── Table row hover ── */
.trow:hover { background: #eff6ff !important; }
.tact:hover { background: rgba(96,165,250,.08) !important; color: #3b82f6 !important; }
.tact-edit:hover { background: rgba(245,158,11,.08) !important; color: #d97706 !important; }
.tact-del:hover  { background: rgba(239,68,68,.08) !important; color: #dc2626 !important; }

/* ── Card hover ── */
.acard:hover {
    border-color: rgba(96,165,250,0.3) !important;
    box-shadow: 0 8px 28px rgba(96,165,250,0.1) !important;
    transform: translateY(-3px) !important;
}

/* ── View buttons ── */
.vbtn { background:transparent; color:#94a3b8; }
.vbtn-active { background:white !important; color:#0d1b2a !important; box-shadow:0 1px 4px rgba(0,0,0,.1); }

/* ── Read dot ── */
.read-dot.is-read { background:#22c55e !important; box-shadow:0 0 0 3px rgba(34,197,94,.2); }

/* ── Hero action btn hover ── */
#btn-new-article:hover { box-shadow:0 6px 24px rgba(96,165,250,0.45) !important; }

/* ── Pagination hover ── */
a[href*=\"page\"]:hover { background:#eff6ff !important; border-color:rgba(96,165,250,0.3) !important; }
</style>

<script>
/* ── Particle canvas ── */
(function(){
    const c=document.getElementById('idx-particles');
    if(!c) return;
    const x=c.getContext('2d');
    let W,H,P=[];
    function resize(){ W=c.width=window.innerWidth; H=c.height=window.innerHeight; }
    function mk(){ return {x:Math.random()*W,y:Math.random()*H,r:Math.random()*1.5+.4,
        vx:(Math.random()-.5)*.25,vy:(Math.random()-.5)*.25,
        life:Math.random(),sp:Math.random()*.003+.001,t:Math.random()>.5}; }
    function frame(){
        x.clearRect(0,0,W,H);
        for(let i=0;i<P.length;i++) for(let j=i+1;j<P.length;j++){
            const dx=P[i].x-P[j].x,dy=P[i].y-P[j].y,d=Math.sqrt(dx*dx+dy*dy);
            if(d<120){ x.beginPath();x.strokeStyle=`rgba(96,165,250,\${(1-d/120)*.06})`;
                x.lineWidth=.5;x.moveTo(P[i].x,P[i].y);x.lineTo(P[j].x,P[j].y);x.stroke(); }
        }
        P.forEach(p=>{
            p.life+=p.sp;
            const op=(Math.sin(p.life*Math.PI)*.5+.5)*.5;
            x.beginPath();x.arc(p.x,p.y,p.r,0,Math.PI*2);
            x.fillStyle=p.t?`rgba(96,165,250,\${op})`:`rgba(59,130,246,\${op*.5})`;
            x.fill();
            p.x+=p.vx;p.y+=p.vy;
            if(p.x<0)p.x=W;if(p.x>W)p.x=0;
            if(p.y<0)p.y=H;if(p.y>H)p.y=0;
        });
        requestAnimationFrame(frame);
    }
    window.addEventListener('resize',resize);
    resize();P=Array.from({length:50},mk);frame();
})();

/* ── State ── */
let activeSearch='',activeCatId=null,activeReadability=null;
let currentView=localStorage.getItem('articles_view')||'table';

/* ── Hero counters ── */
function animateCounters(){
    document.querySelectorAll('.hero-counter').forEach(el=>{
        const t=parseInt(el.dataset.target,10);
        let n=0,step=t/(600/16);
        const timer=setInterval(()=>{ n=Math.min(n+step,t); el.textContent=Math.floor(n); if(n>=t)clearInterval(timer); },16);
    });
}

/* ── Read dots ── */
function paintReadDots(){
    const rs=JSON.parse(localStorage.getItem('read_articles')||'[]');
    document.querySelectorAll('.read-dot').forEach(d=>{
        if(rs.includes(String(d.dataset.articleId))) d.classList.add('is-read');
    });
    const el=document.getElementById('read-count');
    if(el) el.textContent=rs.length;
}

/* ── Panel switcher ── */
const PANEL_BTNS={articles:'btn-new-article',categories:'btn-new-categorie',paths:'btn-new-path',tags:null};

function switchPanel(name){
    document.querySelectorAll('.idx-panel').forEach(p=>p.style.display='none');
    const t=document.getElementById('panel-'+name);
    if(t){ t.style.display=''; t.style.animation='none'; void t.offsetWidth; t.style.animation=''; }

    document.querySelectorAll('.idx-tab').forEach(b=>{
        b.style.background='transparent';b.style.color='#64748b';b.style.boxShadow='none';
        const cnt=b.querySelector('[class^=\"tab-cnt\"]');
        if(cnt){ cnt.style.background='rgba(0,0,0,.07)';cnt.style.color='#94a3b8'; }
    });
    const ab=document.getElementById('nav-'+name);
    if(ab){
        ab.style.background='white';ab.style.color='#0d1b2a';ab.style.boxShadow='0 2px 10px rgba(0,0,0,.1)';
        const cnt=ab.querySelector('[class^=\"tab-cnt\"]');
        const color=ab.dataset.color||'#60a5fa';
        if(cnt){ cnt.style.background=color+'22';cnt.style.color=color; }
    }

    ['btn-new-article','btn-new-categorie','btn-new-path'].forEach(id=>{
        const el=document.getElementById(id); if(el) el.style.display='none';
    });
    const bid=PANEL_BTNS[name];
    if(bid){ const el=document.getElementById(bid); if(el) el.style.display='inline-flex'; }

    history.replaceState(null,'','#'+name);
}

/* ── View toggle ── */
function setView(v){
    currentView=v;
    localStorage.setItem('articles_view',v);
    document.getElementById('view-table-panel').style.display=v==='table'?'':'none';
    document.getElementById('view-cards-panel').style.display=v==='cards'?'':'none';
    document.querySelectorAll('.vbtn').forEach(b=>b.classList.remove('vbtn-active'));
    document.getElementById('view-'+v)?.classList.add('vbtn-active');
    applyFilters();
}

/* ── Filters ── */
function applyFilters(){
    const container = currentView === 'table' 
        ? document.getElementById('view-table-panel')
        : document.getElementById('view-cards-panel');
    
    if (!container) return;
    
    const rows = container.querySelectorAll('.article-row');
    let vis = 0;
    
    rows.forEach(r => {
        const ok = (!activeSearch || r.dataset.search.includes(activeSearch))
               && (!activeCatId || r.dataset.catId === activeCatId)
               && (!activeReadability || r.dataset.readability === activeReadability);
        r.style.display = ok ? '' : 'none';
        if (ok) vis++;
    });
    
    const total = rows.length;
    const s = document.getElementById('results-summary');
    if (s) {
        s.textContent = vis === total 
            ? `\${total} Article\${total !== 1 ? 's' : ''}`
            : `\${vis} of \${total} Articles`;
    }
    
    const nr = document.getElementById('no-results-state');
    if (nr) nr.style.display = vis === 0 ? '' : 'none';
    
    const cb = document.getElementById('clear-filters-btn');
    if (cb) cb.style.display = (activeSearch || activeCatId || activeReadability) ? 'flex' : 'none';
}
function filterByCat(id){ activeCatId=id||null; applyFilters(); }
function filterByReadability(v){ activeReadability=v||null; applyFilters(); }
function clearSearch(){
    activeSearch='';
    const i=document.getElementById('article-search'); if(i) i.value='';
    const b=document.getElementById('search-clear'); if(b) b.style.display='none';
    applyFilters();
}
function clearAllFilters(){
    clearSearch(); activeCatId=null; activeReadability=null;
    const cs=document.getElementById('cat-select'); if(cs) cs.value='';
    const rs=document.getElementById('read-select'); if(rs) rs.value='';
    applyFilters();
}

/* ── Init ── */
document.addEventListener('DOMContentLoaded',()=>{
    animateCounters();
    paintReadDots();
    setView(currentView);

    const si=document.getElementById('article-search');
    if(si){
        si.addEventListener('input',function(){
            activeSearch=this.value.toLowerCase().trim();
            const b=document.getElementById('search-clear');
            if(b) b.style.display=activeSearch?'':'none';
            applyFilters();
        });
    }

    const hash=window.location.hash.replace('#','');
    if(['articles','categories','paths','tags'].includes(hash)) switchPanel(hash);
    else switchPanel('articles');
});
</script>

{% endblock %}", "article/index.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\article\\index.html.twig");
    }
}
