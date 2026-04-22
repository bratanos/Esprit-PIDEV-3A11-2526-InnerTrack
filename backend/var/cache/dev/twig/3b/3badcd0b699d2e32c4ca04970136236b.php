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

/* categorie/show.html.twig */
class __TwigTemplate_c603b2568014fecf3dcd458a91144ea1 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "categorie/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "categorie/show.html.twig"));

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
        yield "<canvas id=\"particle-canvas\"
        style=\"position:fixed;top:0;left:0;width:100%;height:100%;
               pointer-events:none;z-index:0;opacity:0.35\"></canvas>

<div class=\"relative z-10\" style=\"max-width:780px\">

    ";
        // line 15
        yield "    <div class=\"hero-header relative overflow-hidden rounded-[2.5rem] mb-8 p-8 pt-10\"
         style=\"background: linear-gradient(135deg, #0d1b2a 0%, #1b2d40 50%, #0f2337 100%);
                min-height: 220px;\">

        ";
        // line 20
        yield "        <div style=\"position:absolute;top:-60px;right:-40px;
                    width:280px;height:280px;
                    background:radial-gradient(circle, rgba(0,210,190,0.18) 0%, transparent 70%);
                    border-radius:50%;pointer-events:none\"></div>
        <div style=\"position:absolute;bottom:-80px;left:30%;
                    width:200px;height:200px;
                    background:radial-gradient(circle, rgba(120,80,255,0.12) 0%, transparent 70%);
                    border-radius:50%;pointer-events:none\"></div>

        ";
        // line 30
        yield "        <div style=\"position:absolute;inset:0;
                    background-image:linear-gradient(rgba(0,210,190,0.04) 1px,transparent 1px),
                                     linear-gradient(90deg,rgba(0,210,190,0.04) 1px,transparent 1px);
                    background-size:32px 32px;border-radius:inherit;pointer-events:none\"></div>

        ";
        // line 36
        yield "        <a href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_categorie_index");
        yield "\"
           class=\"back-btn inline-flex items-center gap-2 mb-6\"
           style=\"color:rgba(0,210,190,0.8);font-size:12px;font-weight:700;
                  letter-spacing:.08em;text-transform:uppercase;text-decoration:none;
                  transition:all .2s\">
            <span class=\"material-symbols-outlined\" style=\"font-size:15px\">arrow_back</span>
            All Categories
        </a>

        <div class=\"flex items-start justify-between gap-4 flex-wrap\">
            <div class=\"flex items-center gap-5\">
                ";
        // line 48
        yield "                <div class=\"cat-icon-wrap\"
                     style=\"width:64px;height:64px;border-radius:20px;
                            background:linear-gradient(135deg,rgba(0,210,190,0.2),rgba(0,210,190,0.05));
                            border:1px solid rgba(0,210,190,0.25);
                            display:flex;align-items:center;justify-content:center;
                            box-shadow:0 0 24px rgba(0,210,190,0.15),inset 0 1px 0 rgba(255,255,255,0.08);
                            flex-shrink:0\">
                    <span class=\"material-symbols-outlined\"
                          style=\"font-size:28px;color:#00d2be\">psychology</span>
                </div>
                <div>
                    <div style=\"font-size:10px;font-weight:800;letter-spacing:.15em;
                                color:rgba(0,210,190,0.7);text-transform:uppercase;margin-bottom:4px\">
                        Category
                    </div>
                    <h1 style=\"font-size:clamp(1.6rem,4vw,2.4rem);font-weight:900;
                               color:#f0f6ff;letter-spacing:-.02em;line-height:1.1;
                               font-family:'Georgia',serif\">
                        ";
        // line 66
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 66, $this->source); })()), "nom", [], "any", false, false, false, 66), "html", null, true);
        yield "
                    </h1>
                    <div class=\"stat-row\" style=\"display:flex;align-items:center;gap:16px;margin-top:8px\">
                        <span style=\"font-size:12px;color:rgba(240,246,255,0.5);font-weight:500\">
                            <span style=\"color:#00d2be;font-weight:800;font-size:14px\">
                                ";
        // line 71
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 71, $this->source); })()), "articles", [], "any", false, false, false, 71)), "html", null, true);
        yield "
                            </span>
                            article";
        // line 73
        yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 73, $this->source); })()), "articles", [], "any", false, false, false, 73)) != 1)) ? ("s") : (""));
        yield "
                        </span>
                        <span style=\"width:4px;height:4px;border-radius:50%;
                                     background:rgba(0,210,190,0.4)\"></span>
                        <span style=\"font-size:11px;color:rgba(240,246,255,0.35);font-weight:500\">
                            Psychology Resource
                        </span>
                    </div>
                </div>
            </div>

            ";
        // line 84
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE"))) {
            // line 85
            yield "                <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_categorie_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 85, $this->source); })()), "id", [], "any", false, false, false, 85)]), "html", null, true);
            yield "\"
                   class=\"edit-btn\"
                   style=\"display:inline-flex;align-items:center;gap:6px;
                          padding:8px 18px;border-radius:12px;
                          border:1px solid rgba(0,210,190,0.3);
                          background:rgba(0,210,190,0.08);
                          color:rgba(0,210,190,0.9);
                          font-size:12px;font-weight:700;
                          text-decoration:none;letter-spacing:.04em;
                          transition:all .2s;white-space:nowrap\">
                    <span class=\"material-symbols-outlined\" style=\"font-size:15px\">edit</span>
                    Edit Category
                </a>
            ";
        }
        // line 99
        yield "        </div>

        ";
        // line 101
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 101, $this->source); })()), "description", [], "any", false, false, false, 101)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 102
            yield "            <div style=\"margin-top:20px;padding-top:16px;
                        border-top:1px solid rgba(255,255,255,0.06)\">
                <p style=\"font-size:13px;line-height:1.7;
                           color:rgba(240,246,255,0.55);max-width:520px\">
                    ";
            // line 106
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 106, $this->source); })()), "description", [], "any", false, false, false, 106), "html", null, true);
            yield "
                </p>
            </div>
        ";
        }
        // line 110
        yield "
        ";
        // line 112
        yield "        <div class=\"stats-bar\"
             style=\"display:flex;gap:24px;margin-top:20px;flex-wrap:wrap\">
            ";
        // line 114
        $context["readCount"] = 0;
        // line 115
        yield "            ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 115, $this->source); })()), "articles", [], "any", false, false, false, 115));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 116
            yield "                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 116) == "Easy")) {
                $context["readCount"] = ((isset($context["readCount"]) || array_key_exists("readCount", $context) ? $context["readCount"] : (function () { throw new RuntimeError('Variable "readCount" does not exist.', 116, $this->source); })()) + 1);
            }
            // line 117
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['article'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 118
        yield "            ";
        $context["levels"] = ["Easy" => 0, "Medium" => 0, "Advanced" => 0];
        // line 119
        yield "            ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 119, $this->source); })()), "articles", [], "any", false, false, false, 119));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 120
            yield "                ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 120)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 121
                yield "                    ";
                $context["levels"] = Twig\Extension\CoreExtension::merge((isset($context["levels"]) || array_key_exists("levels", $context) ? $context["levels"] : (function () { throw new RuntimeError('Variable "levels" does not exist.', 121, $this->source); })()), [CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 121) => (CoreExtension::getAttribute($this->env, $this->source, (isset($context["levels"]) || array_key_exists("levels", $context) ? $context["levels"] : (function () { throw new RuntimeError('Variable "levels" does not exist.', 121, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 121), [], "array", false, false, false, 121) + 1)]);
                // line 122
                yield "                ";
            }
            // line 123
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['article'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 124
        yield "
            ";
        // line 125
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["levels"]) || array_key_exists("levels", $context) ? $context["levels"] : (function () { throw new RuntimeError('Variable "levels" does not exist.', 125, $this->source); })()));
        foreach ($context['_seq'] as $context["level"] => $context["count"]) {
            // line 126
            yield "                ";
            if (($context["count"] > 0)) {
                // line 127
                yield "                    ";
                $context["lc"] = ["Easy" => "#22c55e", "Medium" => "#f59e0b", "Advanced" => "#f87171"];
                // line 128
                yield "                    <div style=\"display:flex;align-items:center;gap:6px\">
                        <span style=\"width:6px;height:6px;border-radius:50%;
                                     background:";
                // line 130
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["lc"]) || array_key_exists("lc", $context) ? $context["lc"] : (function () { throw new RuntimeError('Variable "lc" does not exist.', 130, $this->source); })()), $context["level"], [], "array", false, false, false, 130), "html", null, true);
                yield ";
                                     box-shadow:0 0 6px ";
                // line 131
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["lc"]) || array_key_exists("lc", $context) ? $context["lc"] : (function () { throw new RuntimeError('Variable "lc" does not exist.', 131, $this->source); })()), $context["level"], [], "array", false, false, false, 131), "html", null, true);
                yield "\"></span>
                        <span style=\"font-size:11px;color:rgba(240,246,255,0.45);font-weight:600\">
                            ";
                // line 133
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["count"], "html", null, true);
                yield " ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["level"], "html", null, true);
                yield "
                        </span>
                    </div>
                ";
            }
            // line 137
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['level'], $context['count'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 138
        yield "        </div>
    </div>

    ";
        // line 144
        yield "    ";
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 144, $this->source); })()), "articles", [], "any", false, false, false, 144))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 145
            yield "        <div class=\"articles-section\">
            <div style=\"display:flex;align-items:center;justify-content:space-between;margin-bottom:16px\">
                <h2 style=\"font-size:10px;font-weight:800;letter-spacing:.15em;
                            text-transform:uppercase;color:var(--on-surface-variant,#666)\">
                    Articles in this category
                </h2>
                <span style=\"font-size:10px;font-weight:700;
                              color:rgba(0,210,190,0.7);letter-spacing:.08em\">
                    ";
            // line 153
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 153, $this->source); })()), "articles", [], "any", false, false, false, 153)), "html", null, true);
            yield " TOTAL
                </span>
            </div>

            <div class=\"articles-list\" style=\"display:flex;flex-direction:column;gap:8px\">
                ";
            // line 158
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 158, $this->source); })()), "articles", [], "any", false, false, false, 158));
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
                // line 159
                yield "                    <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 159)]), "html", null, true);
                yield "\"
                       class=\"article-item\"
                       style=\"--i:";
                // line 161
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 161), "html", null, true);
                yield ";
                              display:flex;align-items:center;gap:16px;
                              background:white;border-radius:18px;
                              border:1px solid rgba(0,0,0,0.07);
                              padding:16px 20px;text-decoration:none;
                              transition:all .25s cubic-bezier(.4,0,.2,1);
                              position:relative;overflow:hidden\">

                        ";
                // line 170
                yield "                        <div class=\"item-accent\"
                             style=\"position:absolute;left:0;top:16px;bottom:16px;
                                    width:3px;border-radius:0 3px 3px 0;
                                    background:linear-gradient(180deg,#00d2be,#7c3aed);
                                    transform:scaleY(0);transform-origin:bottom;
                                    transition:transform .25s cubic-bezier(.4,0,.2,1)\"></div>

                        ";
                // line 178
                yield "                        <div style=\"width:32px;height:32px;border-radius:10px;
                                    background:linear-gradient(135deg,#f0f4ff,#e8edf8);
                                    display:flex;align-items:center;justify-content:center;
                                    font-size:11px;font-weight:800;
                                    color:#94a3b8;flex-shrink:0;
                                    transition:all .25s\" class=\"item-num\">
                            ";
                // line 184
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 184), "html", null, true);
                yield "
                        </div>

                        ";
                // line 188
                yield "                        <div style=\"width:36px;height:36px;border-radius:12px;
                                    background:rgba(0,210,190,0.08);
                                    display:flex;align-items:center;justify-content:center;
                                    flex-shrink:0;transition:all .25s\" class=\"item-icon\">
                            <span class=\"material-symbols-outlined\"
                                  style=\"font-size:17px;color:#00a896;transition:color .25s\">
                                article
                            </span>
                        </div>

                        ";
                // line 199
                yield "                        <div style=\"flex:1;min-width:0\">
                            <p style=\"font-size:13px;font-weight:700;
                                      color:#1e293b;line-height:1.3;
                                      white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
                                      transition:color .2s\" class=\"item-title\">
                                ";
                // line 204
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "titre", [], "any", false, false, false, 204), "html", null, true);
                yield "
                            </p>
                            <div style=\"display:flex;align-items:center;gap:8px;margin-top:4px;flex-wrap:wrap\">
                                ";
                // line 207
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 207)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 208
                    yield "                                    ";
                    $context["rc"] = ["Easy" => "rgba(34,197,94,.12)|#16a34a", "Medium" => "rgba(245,158,11,.12)|#d97706", "Advanced" => "rgba(248,113,113,.12)|#dc2626"];
                    // line 213
                    yield "                                    ";
                    $context["parts"] = Twig\Extension\CoreExtension::split($this->env->getCharset(), ((CoreExtension::getAttribute($this->env, $this->source, ($context["rc"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 213), [], "array", true, true, false, 213)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["rc"]) || array_key_exists("rc", $context) ? $context["rc"] : (function () { throw new RuntimeError('Variable "rc" does not exist.', 213, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 213), [], "array", false, false, false, 213), "rgba(0,0,0,.06)|#666")) : ("rgba(0,0,0,.06)|#666")), "|");
                    // line 214
                    yield "                                    <span style=\"font-size:10px;font-weight:700;
                                                  padding:2px 8px;border-radius:20px;
                                                  background:";
                    // line 216
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["parts"]) || array_key_exists("parts", $context) ? $context["parts"] : (function () { throw new RuntimeError('Variable "parts" does not exist.', 216, $this->source); })()), 0, [], "array", false, false, false, 216), "html", null, true);
                    yield ";color:";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["parts"]) || array_key_exists("parts", $context) ? $context["parts"] : (function () { throw new RuntimeError('Variable "parts" does not exist.', 216, $this->source); })()), 1, [], "array", false, false, false, 216), "html", null, true);
                    yield "\">
                                        ";
                    // line 217
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "readability", [], "any", false, false, false, 217), "html", null, true);
                    yield "
                                    </span>
                                ";
                }
                // line 220
                yield "                                ";
                $context["wc"] = Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "contenu", [], "any", false, false, false, 220)), " "));
                // line 221
                yield "                                <span style=\"font-size:10px;color:#94a3b8;font-weight:500\">
                                    ~";
                // line 222
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round(((isset($context["wc"]) || array_key_exists("wc", $context) ? $context["wc"] : (function () { throw new RuntimeError('Variable "wc" does not exist.', 222, $this->source); })()) / 200), 0, "ceil"), "html", null, true);
                yield " min read
                                </span>
                            </div>
                        </div>

                        ";
                // line 228
                yield "                        <div style=\"text-align:right;flex-shrink:0\">
                            <span style=\"font-size:11px;color:#94a3b8;font-weight:500;
                                         white-space:nowrap\">
                                ";
                // line 231
                yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["article"], "datePublication", [], "any", false, false, false, 231)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["article"], "datePublication", [], "any", false, false, false, 231), "d/m/Y"), "html", null, true)) : ("—"));
                yield "
                            </span>
                        </div>

                        ";
                // line 236
                yield "                        <span class=\"material-symbols-outlined item-arrow\"
                              style=\"font-size:16px;color:#cbd5e1;flex-shrink:0;
                                     transition:all .25s\">
                            arrow_forward
                        </span>
                    </a>
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
            unset($context['_seq'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 243
            yield "            </div>
        </div>
    ";
        } else {
            // line 246
            yield "        ";
            // line 247
            yield "        <div style=\"background:white;border-radius:2rem;border:1px solid rgba(0,0,0,0.07);
                    padding:60px 40px;text-align:center\">
            <div style=\"width:64px;height:64px;border-radius:20px;
                        background:linear-gradient(135deg,#f0f4ff,#e8edf8);
                        display:flex;align-items:center;justify-content:center;
                        margin:0 auto 16px\">
                <span class=\"material-symbols-outlined\" style=\"font-size:28px;color:#cbd5e1\">
                    article
                </span>
            </div>
            <p style=\"font-size:14px;font-weight:700;color:#64748b;margin-bottom:4px\">
                No articles yet
            </p>
            <p style=\"font-size:12px;color:#94a3b8\">
                Articles added to this category will appear here.
            </p>
        </div>
    ";
        }
        // line 265
        yield "
    ";
        // line 269
        yield "    <div style=\"display:flex;align-items:center;justify-content:space-between;
                margin-top:24px;padding-top:20px;
                border-top:1px solid rgba(0,0,0,0.07)\">
        <a href=\"";
        // line 272
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index", ["categorie" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 272, $this->source); })()), "id", [], "any", false, false, false, 272)]), "html", null, true);
        yield "\"
           class=\"cta-link\"
           style=\"display:inline-flex;align-items:center;gap:8px;
                  padding:12px 24px;border-radius:14px;
                  background:linear-gradient(135deg,#0d1b2a,#1b2d40);
                  color:#00d2be;font-size:13px;font-weight:700;
                  text-decoration:none;letter-spacing:.03em;
                  box-shadow:0 4px 20px rgba(13,27,42,0.2);
                  transition:all .25s\">
            <span class=\"material-symbols-outlined\" style=\"font-size:16px\">
                open_in_new
            </span>
            Browse all ";
        // line 284
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 284, $this->source); })()), "articles", [], "any", false, false, false, 284)), "html", null, true);
        yield " articles
            <span class=\"material-symbols-outlined cta-arrow\"
                  style=\"font-size:15px;transition:transform .2s\">
                arrow_forward
            </span>
        </a>

        <div style=\"font-size:11px;color:#94a3b8;font-weight:500\">
            ";
        // line 292
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 292, $this->source); })()), "articles", [], "any", false, false, false, 292)), "html", null, true);
        yield " article";
        yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie"]) || array_key_exists("categorie", $context) ? $context["categorie"] : (function () { throw new RuntimeError('Variable "categorie" does not exist.', 292, $this->source); })()), "articles", [], "any", false, false, false, 292)) != 1)) ? ("s") : (""));
        yield " total
        </div>
    </div>

</div>

<style>
/* ── Google Font import ── */
@import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@400;500;600;700;800&display=swap');

/* ── Page font override ── */
#article-wrapper, .relative.z-10 {
    font-family: 'DM Sans', sans-serif;
}

/* ── Back button hover ── */
.back-btn:hover {
    color: #00d2be !important;
    gap: 10px !important;
}

/* ── Edit button hover ── */
.edit-btn:hover {
    background: rgba(0,210,190,0.15) !important;
    border-color: rgba(0,210,190,0.5) !important;
    box-shadow: 0 0 20px rgba(0,210,190,0.1);
}

/* ── Hero entrance ── */
@keyframes heroIn {
    from { opacity:0; transform: translateY(20px) scale(0.98); }
    to   { opacity:1; transform: translateY(0)    scale(1);    }
}
.hero-header {
    animation: heroIn .6s cubic-bezier(.4,0,.2,1) forwards;
}

/* ── Icon pulse ── */
@keyframes iconPulse {
    0%, 100% { box-shadow: 0 0 24px rgba(0,210,190,.15), inset 0 1px 0 rgba(255,255,255,.08); }
    50%       { box-shadow: 0 0 40px rgba(0,210,190,.30), inset 0 1px 0 rgba(255,255,255,.08); }
}
.cat-icon-wrap { animation: iconPulse 3s ease-in-out infinite; }

/* ── Article items stagger in ── */
@keyframes itemSlideIn {
    from { opacity:0; transform: translateX(-12px); }
    to   { opacity:1; transform: translateX(0); }
}
.article-item {
    opacity: 0;
    animation: itemSlideIn .4s cubic-bezier(.4,0,.2,1) forwards;
    animation-delay: calc(var(--i) * 0.06s + 0.3s);
}

/* ── Article item hover ── */
.article-item:hover {
    border-color: rgba(0,210,190,0.25) !important;
    box-shadow: 0 8px 30px rgba(0,210,190,0.08), 0 2px 8px rgba(0,0,0,0.06) !important;
    transform: translateX(4px) !important;
}
.article-item:hover .item-accent { transform: scaleY(1) !important; }
.article-item:hover .item-title  { color: #00a896 !important; }
.article-item:hover .item-arrow  { color: #00d2be !important; transform: translateX(3px) !important; }
.article-item:hover .item-num    { background: linear-gradient(135deg,rgba(0,210,190,.15),rgba(0,210,190,.05)) !important; color: #00a896 !important; }
.article-item:hover .item-icon   { background: rgba(0,210,190,.15) !important; }

/* ── CTA link hover ── */
.cta-link:hover {
    background: linear-gradient(135deg, #162a3d, #24405c) !important;
    box-shadow: 0 8px 30px rgba(13,27,42,0.35) !important;
    transform: translateY(-1px);
}
.cta-link:hover .cta-arrow { transform: translateX(4px); }

/* ── Stats bar entrance ── */
@keyframes fadeIn {
    from { opacity:0; } to { opacity:1; }
}
.stats-bar { animation: fadeIn .8s ease .5s both; }

/* ── Section entrance ── */
@keyframes sectionIn {
    from { opacity:0; transform: translateY(16px); }
    to   { opacity:1; transform: translateY(0); }
}
.articles-section {
    animation: sectionIn .5s cubic-bezier(.4,0,.2,1) .25s both;
}
</style>

<script>
/* ── Particle canvas — subtle floating neural dots ── */
(function() {
    const canvas = document.getElementById('particle-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let W, H, particles = [];

    function resize() {
        W = canvas.width  = window.innerWidth;
        H = canvas.height = window.innerHeight;
    }

    function Particle() {
        this.x    = Math.random() * W;
        this.y    = Math.random() * H;
        this.r    = Math.random() * 1.8 + 0.4;
        this.vx   = (Math.random() - .5) * 0.3;
        this.vy   = (Math.random() - .5) * 0.3;
        this.life = Math.random();
        this.speed= Math.random() * 0.003 + 0.001;
        // Alternate between teal and violet
        this.teal = Math.random() > 0.5;
    }

    function init() {
        resize();
        particles = Array.from({length: 55}, () => new Particle());
    }

    function draw() {
        ctx.clearRect(0, 0, W, H);

        // Draw connection lines
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const dist = Math.sqrt(dx*dx + dy*dy);
                if (dist < 130) {
                    ctx.beginPath();
                    ctx.strokeStyle = `rgba(0,210,190,\${(1 - dist/130) * 0.07})`;
                    ctx.lineWidth = 0.5;
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }

        // Draw particles
        particles.forEach(p => {
            p.life += p.speed;
            const opacity = (Math.sin(p.life * Math.PI) * 0.5 + 0.5) * 0.6;
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fillStyle = p.teal
                ? `rgba(0,210,190,\${opacity})`
                : `rgba(124,58,237,\${opacity * 0.6})`;
            ctx.fill();

            p.x += p.vx;
            p.y += p.vy;
            if (p.x < 0) p.x = W;
            if (p.x > W) p.x = 0;
            if (p.y < 0) p.y = H;
            if (p.y > H) p.y = 0;
        });

        requestAnimationFrame(draw);
    }

    window.addEventListener('resize', resize);
    init();
    draw();
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
        return "categorie/show.html.twig";
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
        return array (  540 => 292,  529 => 284,  514 => 272,  509 => 269,  506 => 265,  486 => 247,  484 => 246,  479 => 243,  459 => 236,  452 => 231,  447 => 228,  439 => 222,  436 => 221,  433 => 220,  427 => 217,  421 => 216,  417 => 214,  414 => 213,  411 => 208,  409 => 207,  403 => 204,  396 => 199,  384 => 188,  378 => 184,  370 => 178,  361 => 170,  350 => 161,  344 => 159,  327 => 158,  319 => 153,  309 => 145,  306 => 144,  301 => 138,  295 => 137,  286 => 133,  281 => 131,  277 => 130,  273 => 128,  270 => 127,  267 => 126,  263 => 125,  260 => 124,  254 => 123,  251 => 122,  248 => 121,  245 => 120,  240 => 119,  237 => 118,  231 => 117,  226 => 116,  221 => 115,  219 => 114,  215 => 112,  212 => 110,  205 => 106,  199 => 102,  197 => 101,  193 => 99,  175 => 85,  173 => 84,  159 => 73,  154 => 71,  146 => 66,  126 => 48,  111 => 36,  104 => 30,  93 => 20,  87 => 15,  79 => 6,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block content %}

{# ── Ambient background particles ── #}
<canvas id=\"particle-canvas\"
        style=\"position:fixed;top:0;left:0;width:100%;height:100%;
               pointer-events:none;z-index:0;opacity:0.35\"></canvas>

<div class=\"relative z-10\" style=\"max-width:780px\">

    {# ══════════════════════════════════════
       HERO HEADER
    ══════════════════════════════════════ #}
    <div class=\"hero-header relative overflow-hidden rounded-[2.5rem] mb-8 p-8 pt-10\"
         style=\"background: linear-gradient(135deg, #0d1b2a 0%, #1b2d40 50%, #0f2337 100%);
                min-height: 220px;\">

        {# Glowing orb #}
        <div style=\"position:absolute;top:-60px;right:-40px;
                    width:280px;height:280px;
                    background:radial-gradient(circle, rgba(0,210,190,0.18) 0%, transparent 70%);
                    border-radius:50%;pointer-events:none\"></div>
        <div style=\"position:absolute;bottom:-80px;left:30%;
                    width:200px;height:200px;
                    background:radial-gradient(circle, rgba(120,80,255,0.12) 0%, transparent 70%);
                    border-radius:50%;pointer-events:none\"></div>

        {# Grid texture overlay #}
        <div style=\"position:absolute;inset:0;
                    background-image:linear-gradient(rgba(0,210,190,0.04) 1px,transparent 1px),
                                     linear-gradient(90deg,rgba(0,210,190,0.04) 1px,transparent 1px);
                    background-size:32px 32px;border-radius:inherit;pointer-events:none\"></div>

        {# Back button #}
        <a href=\"{{ path('app_categorie_index') }}\"
           class=\"back-btn inline-flex items-center gap-2 mb-6\"
           style=\"color:rgba(0,210,190,0.8);font-size:12px;font-weight:700;
                  letter-spacing:.08em;text-transform:uppercase;text-decoration:none;
                  transition:all .2s\">
            <span class=\"material-symbols-outlined\" style=\"font-size:15px\">arrow_back</span>
            All Categories
        </a>

        <div class=\"flex items-start justify-between gap-4 flex-wrap\">
            <div class=\"flex items-center gap-5\">
                {# Animated icon container #}
                <div class=\"cat-icon-wrap\"
                     style=\"width:64px;height:64px;border-radius:20px;
                            background:linear-gradient(135deg,rgba(0,210,190,0.2),rgba(0,210,190,0.05));
                            border:1px solid rgba(0,210,190,0.25);
                            display:flex;align-items:center;justify-content:center;
                            box-shadow:0 0 24px rgba(0,210,190,0.15),inset 0 1px 0 rgba(255,255,255,0.08);
                            flex-shrink:0\">
                    <span class=\"material-symbols-outlined\"
                          style=\"font-size:28px;color:#00d2be\">psychology</span>
                </div>
                <div>
                    <div style=\"font-size:10px;font-weight:800;letter-spacing:.15em;
                                color:rgba(0,210,190,0.7);text-transform:uppercase;margin-bottom:4px\">
                        Category
                    </div>
                    <h1 style=\"font-size:clamp(1.6rem,4vw,2.4rem);font-weight:900;
                               color:#f0f6ff;letter-spacing:-.02em;line-height:1.1;
                               font-family:'Georgia',serif\">
                        {{ categorie.nom }}
                    </h1>
                    <div class=\"stat-row\" style=\"display:flex;align-items:center;gap:16px;margin-top:8px\">
                        <span style=\"font-size:12px;color:rgba(240,246,255,0.5);font-weight:500\">
                            <span style=\"color:#00d2be;font-weight:800;font-size:14px\">
                                {{ categorie.articles|length }}
                            </span>
                            article{{ categorie.articles|length != 1 ? 's' : '' }}
                        </span>
                        <span style=\"width:4px;height:4px;border-radius:50%;
                                     background:rgba(0,210,190,0.4)\"></span>
                        <span style=\"font-size:11px;color:rgba(240,246,255,0.35);font-weight:500\">
                            Psychology Resource
                        </span>
                    </div>
                </div>
            </div>

            {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_PSYCHOLOGUE') %}
                <a href=\"{{ path('app_categorie_edit', {id: categorie.id}) }}\"
                   class=\"edit-btn\"
                   style=\"display:inline-flex;align-items:center;gap:6px;
                          padding:8px 18px;border-radius:12px;
                          border:1px solid rgba(0,210,190,0.3);
                          background:rgba(0,210,190,0.08);
                          color:rgba(0,210,190,0.9);
                          font-size:12px;font-weight:700;
                          text-decoration:none;letter-spacing:.04em;
                          transition:all .2s;white-space:nowrap\">
                    <span class=\"material-symbols-outlined\" style=\"font-size:15px\">edit</span>
                    Edit Category
                </a>
            {% endif %}
        </div>

        {% if categorie.description %}
            <div style=\"margin-top:20px;padding-top:16px;
                        border-top:1px solid rgba(255,255,255,0.06)\">
                <p style=\"font-size:13px;line-height:1.7;
                           color:rgba(240,246,255,0.55);max-width:520px\">
                    {{ categorie.description }}
                </p>
            </div>
        {% endif %}

        {# Stats bar #}
        <div class=\"stats-bar\"
             style=\"display:flex;gap:24px;margin-top:20px;flex-wrap:wrap\">
            {% set readCount = 0 %}
            {% for article in categorie.articles %}
                {% if article.readability == 'Easy' %}{% set readCount = readCount + 1 %}{% endif %}
            {% endfor %}
            {% set levels = {'Easy': 0, 'Medium': 0, 'Advanced': 0} %}
            {% for article in categorie.articles %}
                {% if article.readability %}
                    {% set levels = levels|merge({(article.readability): levels[article.readability] + 1}) %}
                {% endif %}
            {% endfor %}

            {% for level, count in levels %}
                {% if count > 0 %}
                    {% set lc = {'Easy': '#22c55e', 'Medium': '#f59e0b', 'Advanced': '#f87171'} %}
                    <div style=\"display:flex;align-items:center;gap:6px\">
                        <span style=\"width:6px;height:6px;border-radius:50%;
                                     background:{{ lc[level] }};
                                     box-shadow:0 0 6px {{ lc[level] }}\"></span>
                        <span style=\"font-size:11px;color:rgba(240,246,255,0.45);font-weight:600\">
                            {{ count }} {{ level }}
                        </span>
                    </div>
                {% endif %}
            {% endfor %}
        </div>
    </div>

    {# ══════════════════════════════════════
       ARTICLES LIST
    ══════════════════════════════════════ #}
    {% if categorie.articles is not empty %}
        <div class=\"articles-section\">
            <div style=\"display:flex;align-items:center;justify-content:space-between;margin-bottom:16px\">
                <h2 style=\"font-size:10px;font-weight:800;letter-spacing:.15em;
                            text-transform:uppercase;color:var(--on-surface-variant,#666)\">
                    Articles in this category
                </h2>
                <span style=\"font-size:10px;font-weight:700;
                              color:rgba(0,210,190,0.7);letter-spacing:.08em\">
                    {{ categorie.articles|length }} TOTAL
                </span>
            </div>

            <div class=\"articles-list\" style=\"display:flex;flex-direction:column;gap:8px\">
                {% for article in categorie.articles %}
                    <a href=\"{{ path('app_article_show', {id: article.id}) }}\"
                       class=\"article-item\"
                       style=\"--i:{{ loop.index }};
                              display:flex;align-items:center;gap:16px;
                              background:white;border-radius:18px;
                              border:1px solid rgba(0,0,0,0.07);
                              padding:16px 20px;text-decoration:none;
                              transition:all .25s cubic-bezier(.4,0,.2,1);
                              position:relative;overflow:hidden\">

                        {# Left accent line that slides in on hover #}
                        <div class=\"item-accent\"
                             style=\"position:absolute;left:0;top:16px;bottom:16px;
                                    width:3px;border-radius:0 3px 3px 0;
                                    background:linear-gradient(180deg,#00d2be,#7c3aed);
                                    transform:scaleY(0);transform-origin:bottom;
                                    transition:transform .25s cubic-bezier(.4,0,.2,1)\"></div>

                        {# Index number #}
                        <div style=\"width:32px;height:32px;border-radius:10px;
                                    background:linear-gradient(135deg,#f0f4ff,#e8edf8);
                                    display:flex;align-items:center;justify-content:center;
                                    font-size:11px;font-weight:800;
                                    color:#94a3b8;flex-shrink:0;
                                    transition:all .25s\" class=\"item-num\">
                            {{ loop.index }}
                        </div>

                        {# Article icon #}
                        <div style=\"width:36px;height:36px;border-radius:12px;
                                    background:rgba(0,210,190,0.08);
                                    display:flex;align-items:center;justify-content:center;
                                    flex-shrink:0;transition:all .25s\" class=\"item-icon\">
                            <span class=\"material-symbols-outlined\"
                                  style=\"font-size:17px;color:#00a896;transition:color .25s\">
                                article
                            </span>
                        </div>

                        {# Title + meta #}
                        <div style=\"flex:1;min-width:0\">
                            <p style=\"font-size:13px;font-weight:700;
                                      color:#1e293b;line-height:1.3;
                                      white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
                                      transition:color .2s\" class=\"item-title\">
                                {{ article.titre }}
                            </p>
                            <div style=\"display:flex;align-items:center;gap:8px;margin-top:4px;flex-wrap:wrap\">
                                {% if article.readability %}
                                    {% set rc = {
                                        'Easy':     'rgba(34,197,94,.12)|#16a34a',
                                        'Medium':   'rgba(245,158,11,.12)|#d97706',
                                        'Advanced': 'rgba(248,113,113,.12)|#dc2626'
                                    } %}
                                    {% set parts = rc[article.readability]|default('rgba(0,0,0,.06)|#666')|split('|') %}
                                    <span style=\"font-size:10px;font-weight:700;
                                                  padding:2px 8px;border-radius:20px;
                                                  background:{{ parts[0] }};color:{{ parts[1] }}\">
                                        {{ article.readability }}
                                    </span>
                                {% endif %}
                                {% set wc = article.contenu|striptags|split(' ')|length %}
                                <span style=\"font-size:10px;color:#94a3b8;font-weight:500\">
                                    ~{{ (wc / 200)|round(0,'ceil') }} min read
                                </span>
                            </div>
                        </div>

                        {# Date #}
                        <div style=\"text-align:right;flex-shrink:0\">
                            <span style=\"font-size:11px;color:#94a3b8;font-weight:500;
                                         white-space:nowrap\">
                                {{ article.datePublication ? article.datePublication|date('d/m/Y') : '—' }}
                            </span>
                        </div>

                        {# Arrow #}
                        <span class=\"material-symbols-outlined item-arrow\"
                              style=\"font-size:16px;color:#cbd5e1;flex-shrink:0;
                                     transition:all .25s\">
                            arrow_forward
                        </span>
                    </a>
                {% endfor %}
            </div>
        </div>
    {% else %}
        {# Empty state #}
        <div style=\"background:white;border-radius:2rem;border:1px solid rgba(0,0,0,0.07);
                    padding:60px 40px;text-align:center\">
            <div style=\"width:64px;height:64px;border-radius:20px;
                        background:linear-gradient(135deg,#f0f4ff,#e8edf8);
                        display:flex;align-items:center;justify-content:center;
                        margin:0 auto 16px\">
                <span class=\"material-symbols-outlined\" style=\"font-size:28px;color:#cbd5e1\">
                    article
                </span>
            </div>
            <p style=\"font-size:14px;font-weight:700;color:#64748b;margin-bottom:4px\">
                No articles yet
            </p>
            <p style=\"font-size:12px;color:#94a3b8\">
                Articles added to this category will appear here.
            </p>
        </div>
    {% endif %}

    {# ══════════════════════════════════════
       FOOTER ACTION
    ══════════════════════════════════════ #}
    <div style=\"display:flex;align-items:center;justify-content:space-between;
                margin-top:24px;padding-top:20px;
                border-top:1px solid rgba(0,0,0,0.07)\">
        <a href=\"{{ path('app_article_index', {categorie: categorie.id}) }}\"
           class=\"cta-link\"
           style=\"display:inline-flex;align-items:center;gap:8px;
                  padding:12px 24px;border-radius:14px;
                  background:linear-gradient(135deg,#0d1b2a,#1b2d40);
                  color:#00d2be;font-size:13px;font-weight:700;
                  text-decoration:none;letter-spacing:.03em;
                  box-shadow:0 4px 20px rgba(13,27,42,0.2);
                  transition:all .25s\">
            <span class=\"material-symbols-outlined\" style=\"font-size:16px\">
                open_in_new
            </span>
            Browse all {{ categorie.articles|length }} articles
            <span class=\"material-symbols-outlined cta-arrow\"
                  style=\"font-size:15px;transition:transform .2s\">
                arrow_forward
            </span>
        </a>

        <div style=\"font-size:11px;color:#94a3b8;font-weight:500\">
            {{ categorie.articles|length }} article{{ categorie.articles|length != 1 ? 's' : '' }} total
        </div>
    </div>

</div>

<style>
/* ── Google Font import ── */
@import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@400;500;600;700;800&display=swap');

/* ── Page font override ── */
#article-wrapper, .relative.z-10 {
    font-family: 'DM Sans', sans-serif;
}

/* ── Back button hover ── */
.back-btn:hover {
    color: #00d2be !important;
    gap: 10px !important;
}

/* ── Edit button hover ── */
.edit-btn:hover {
    background: rgba(0,210,190,0.15) !important;
    border-color: rgba(0,210,190,0.5) !important;
    box-shadow: 0 0 20px rgba(0,210,190,0.1);
}

/* ── Hero entrance ── */
@keyframes heroIn {
    from { opacity:0; transform: translateY(20px) scale(0.98); }
    to   { opacity:1; transform: translateY(0)    scale(1);    }
}
.hero-header {
    animation: heroIn .6s cubic-bezier(.4,0,.2,1) forwards;
}

/* ── Icon pulse ── */
@keyframes iconPulse {
    0%, 100% { box-shadow: 0 0 24px rgba(0,210,190,.15), inset 0 1px 0 rgba(255,255,255,.08); }
    50%       { box-shadow: 0 0 40px rgba(0,210,190,.30), inset 0 1px 0 rgba(255,255,255,.08); }
}
.cat-icon-wrap { animation: iconPulse 3s ease-in-out infinite; }

/* ── Article items stagger in ── */
@keyframes itemSlideIn {
    from { opacity:0; transform: translateX(-12px); }
    to   { opacity:1; transform: translateX(0); }
}
.article-item {
    opacity: 0;
    animation: itemSlideIn .4s cubic-bezier(.4,0,.2,1) forwards;
    animation-delay: calc(var(--i) * 0.06s + 0.3s);
}

/* ── Article item hover ── */
.article-item:hover {
    border-color: rgba(0,210,190,0.25) !important;
    box-shadow: 0 8px 30px rgba(0,210,190,0.08), 0 2px 8px rgba(0,0,0,0.06) !important;
    transform: translateX(4px) !important;
}
.article-item:hover .item-accent { transform: scaleY(1) !important; }
.article-item:hover .item-title  { color: #00a896 !important; }
.article-item:hover .item-arrow  { color: #00d2be !important; transform: translateX(3px) !important; }
.article-item:hover .item-num    { background: linear-gradient(135deg,rgba(0,210,190,.15),rgba(0,210,190,.05)) !important; color: #00a896 !important; }
.article-item:hover .item-icon   { background: rgba(0,210,190,.15) !important; }

/* ── CTA link hover ── */
.cta-link:hover {
    background: linear-gradient(135deg, #162a3d, #24405c) !important;
    box-shadow: 0 8px 30px rgba(13,27,42,0.35) !important;
    transform: translateY(-1px);
}
.cta-link:hover .cta-arrow { transform: translateX(4px); }

/* ── Stats bar entrance ── */
@keyframes fadeIn {
    from { opacity:0; } to { opacity:1; }
}
.stats-bar { animation: fadeIn .8s ease .5s both; }

/* ── Section entrance ── */
@keyframes sectionIn {
    from { opacity:0; transform: translateY(16px); }
    to   { opacity:1; transform: translateY(0); }
}
.articles-section {
    animation: sectionIn .5s cubic-bezier(.4,0,.2,1) .25s both;
}
</style>

<script>
/* ── Particle canvas — subtle floating neural dots ── */
(function() {
    const canvas = document.getElementById('particle-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let W, H, particles = [];

    function resize() {
        W = canvas.width  = window.innerWidth;
        H = canvas.height = window.innerHeight;
    }

    function Particle() {
        this.x    = Math.random() * W;
        this.y    = Math.random() * H;
        this.r    = Math.random() * 1.8 + 0.4;
        this.vx   = (Math.random() - .5) * 0.3;
        this.vy   = (Math.random() - .5) * 0.3;
        this.life = Math.random();
        this.speed= Math.random() * 0.003 + 0.001;
        // Alternate between teal and violet
        this.teal = Math.random() > 0.5;
    }

    function init() {
        resize();
        particles = Array.from({length: 55}, () => new Particle());
    }

    function draw() {
        ctx.clearRect(0, 0, W, H);

        // Draw connection lines
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const dist = Math.sqrt(dx*dx + dy*dy);
                if (dist < 130) {
                    ctx.beginPath();
                    ctx.strokeStyle = `rgba(0,210,190,\${(1 - dist/130) * 0.07})`;
                    ctx.lineWidth = 0.5;
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }

        // Draw particles
        particles.forEach(p => {
            p.life += p.speed;
            const opacity = (Math.sin(p.life * Math.PI) * 0.5 + 0.5) * 0.6;
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fillStyle = p.teal
                ? `rgba(0,210,190,\${opacity})`
                : `rgba(124,58,237,\${opacity * 0.6})`;
            ctx.fill();

            p.x += p.vx;
            p.y += p.vy;
            if (p.x < 0) p.x = W;
            if (p.x > W) p.x = 0;
            if (p.y < 0) p.y = H;
            if (p.y > H) p.y = 0;
        });

        requestAnimationFrame(draw);
    }

    window.addEventListener('resize', resize);
    init();
    draw();
})();
</script>

{% endblock %}", "categorie/show.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\categorie\\show.html.twig");
    }
}
