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

/* article/pdf.html.twig */
class __TwigTemplate_5382c403f34cfc369214f4c8254ed3c6 extends Template
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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/pdf.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/pdf.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 5, $this->source); })()), "titre", [], "any", false, false, false, 5), "html", null, true);
        yield " – InnerTrack</title>
    <style>
        /* ── Reset ── */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            font-size: 11pt;
            line-height: 1.65;
            color: #1a1a2e;
            background: white;
            padding: 28px 44px 44px;
        }

        /* ── Category pill ── */
        .category {
            display: inline-block;
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 7.5pt;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            background: linear-gradient(135deg, #5b21b6, #7c3aed);
            color: white;
            padding: 4px 16px;
            border-radius: 30px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(91,33,182,.25);
        }

        /* ── Title ── */
        h1 {
            font-size: 26pt;
            line-height: 1.18;
            margin: 0 0 16px;
            font-weight: 800;
            color: #0f0a1e;
            border-left: 5px solid #7c3aed;
            padding-left: 20px;
        }

        /* ── Divider line ── */
        .title-rule {
            height: 2px;
            background: linear-gradient(to right, #7c3aed, #ec4899, #f9fafb);
            border: none;
            margin: 0 0 20px;
            border-radius: 2px;
        }

        /* ── Meta bar ── */
        .meta {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 9pt;
            color: #4b5563;
            background: #f5f3ff;
            border: 1px solid #ede9fe;
            padding: 11px 18px;
            border-radius: 14px;
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 14px;
        }
        .meta-item { display: inline-flex; align-items: center; gap: 5px; }

        /* ── Readability badge ── */
        .readability-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            border-radius: 30px;
            padding: 2px 10px;
            font-size: 8pt;
            font-weight: 700;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .readability-badge.Easy     { background: #d1fae5; color: #065f46; }
        .readability-badge.Medium   { background: #fef3c7; color: #92400e; }
        .readability-badge.Advanced { background: #fee2e2; color: #991b1b; }

        /* ── Tags ── */
        .tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 18px; }
        .tag-badge {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 8pt;
            font-weight: 600;
            background: #ede9fe;
            color: #5b21b6;
            padding: 3px 10px;
            border-radius: 30px;
        }

        /* ── Reading time ── */
        .reading-time {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 9pt;
            color: #6d28d9;
            background: #f5f3ff;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 14px;
            border-radius: 30px;
            margin-bottom: 22px;
            font-weight: 600;
        }

        /* ── Lead / pull quote ── */
        .lead {
            font-size: 11.5pt;
            line-height: 1.55;
            color: #2d1b69;
            background: #faf5ff;
            border-left: 4px solid #7c3aed;
            padding: 16px 22px 16px 28px;
            margin: 0 0 24px;
            border-radius: 0 14px 14px 0;
            position: relative;
            font-style: italic;
            box-shadow: 0 2px 10px rgba(124,58,237,.07);
        }
        .lead::before {
            content: \"\\201C\";
            font-size: 52px;
            color: #7c3aed;
            opacity: 0.18;
            position: absolute;
            left: 8px;
            top: -6px;
            line-height: 1;
        }

        /* ── Drop-cap ── */
        .content p:first-of-type::first-letter {
            font-size: 52px;
            font-weight: 900;
            color: #7c3aed;
            float: left;
            padding-right: 6px;
            line-height: 0.82;
            font-family: Georgia, serif;
        }

        /* ── Content ── */
        .content {
            font-size: 11pt;
            line-height: 1.75;
            text-align: justify;
        }
        .content p { margin-bottom: 1em; }
        .content h2, .content h3 {
            color: #2d1b69;
            margin-top: 1.3em;
            margin-bottom: 0.5em;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .content ul, .content ol { margin: 0.5em 0 1em 1.5em; }
        .content li { margin-bottom: 0.3em; }
        .content blockquote {
            border-left: 3px solid #a78bfa;
            background: #faf5ff;
            padding: 8px 16px;
            margin: 1em 0;
            border-radius: 0 8px 8px 0;
            font-style: italic;
            color: #4c1d95;
        }

        /* ── Separator ── */
        hr {
            margin: 32px 0 18px;
            border: none;
            height: 1.5px;
            background: linear-gradient(to right, #f3f4f6, #a78bfa, #f3f4f6);
        }

        /* ── Footer note ── */
        .export-note {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 8pt;
            color: #9ca3af;
            text-align: center;
            display: flex;
            justify-content: center;
            gap: 24px;
        }

        /* ── Page-break helper ── */
        @media print {
            h2, h3 { page-break-after: avoid; }
            .lead, .reading-time { page-break-inside: avoid; }
        }
    </style>
</head>
<body>

    ";
        // line 204
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 204, $this->source); })()), "categorie", [], "any", false, false, false, 204)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 205
            yield "        <div class=\"category\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 205, $this->source); })()), "categorie", [], "any", false, false, false, 205), "nom", [], "any", false, false, false, 205), "html", null, true);
            yield "</div>
    ";
        }
        // line 207
        yield "
    ";
        // line 209
        yield "    <h1>";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 209, $this->source); })()), "titre", [], "any", false, false, false, 209), "html", null, true);
        yield "</h1>
    <hr class=\"title-rule\">

    ";
        // line 213
        yield "    <div class=\"meta\">
        ";
        // line 214
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 214, $this->source); })()), "auteur", [], "any", false, false, false, 214)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 215
            yield "            <span class=\"meta-item\">✍️ ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 215, $this->source); })()), "auteur", [], "any", false, false, false, 215), "firstName", [], "any", false, false, false, 215), "html", null, true);
            yield " ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 215, $this->source); })()), "auteur", [], "any", false, false, false, 215), "lastName", [], "any", false, false, false, 215), "html", null, true);
            yield "</span>
        ";
        }
        // line 217
        yield "        <span class=\"meta-item\">📅 ";
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 217, $this->source); })()), "datePublication", [], "any", false, false, false, 217)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 217, $this->source); })()), "datePublication", [], "any", false, false, false, 217), "d M Y"), "html", null, true)) : ("—"));
        yield "</span>
        ";
        // line 218
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 218, $this->source); })()), "readability", [], "any", false, false, false, 218)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 219
            yield "            <span class=\"meta-item\">
                Readability: <span class=\"readability-badge ";
            // line 220
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 220, $this->source); })()), "readability", [], "any", false, false, false, 220), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 220, $this->source); })()), "readability", [], "any", false, false, false, 220), "html", null, true);
            yield "</span>
            </span>
        ";
        }
        // line 223
        yield "    </div>

    ";
        // line 226
        yield "    ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 226, $this->source); })()), "tags", [], "any", false, false, false, 226)) > 0)) {
            // line 227
            yield "        <div class=\"tags\">
            ";
            // line 228
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 228, $this->source); })()), "tags", [], "any", false, false, false, 228));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 229
                yield "                <span class=\"tag-badge\">#";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tag"], "nom", [], "any", false, false, false, 229), "html", null, true);
                yield "</span>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['tag'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 231
            yield "        </div>
    ";
        }
        // line 233
        yield "
    ";
        // line 235
        yield "    ";
        $context["wordCount"] = Twig\Extension\CoreExtension::length($this->env->getCharset(), Twig\Extension\CoreExtension::split($this->env->getCharset(), Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 235, $this->source); })()), "contenu", [], "any", false, false, false, 235)), " "));
        // line 236
        yield "    ";
        $context["readingTime"] = Twig\Extension\CoreExtension::round(((isset($context["wordCount"]) || array_key_exists("wordCount", $context) ? $context["wordCount"] : (function () { throw new RuntimeError('Variable "wordCount" does not exist.', 236, $this->source); })()) / 200), 0, "ceil");
        // line 237
        yield "    <div class=\"reading-time\">⏱ ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["readingTime"]) || array_key_exists("readingTime", $context) ? $context["readingTime"] : (function () { throw new RuntimeError('Variable "readingTime" does not exist.', 237, $this->source); })()), "html", null, true);
        yield " min read · ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["wordCount"]) || array_key_exists("wordCount", $context) ? $context["wordCount"] : (function () { throw new RuntimeError('Variable "wordCount" does not exist.', 237, $this->source); })()), "html", null, true);
        yield " words</div>

    ";
        // line 240
        yield "    ";
        $context["plainContent"] = Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 240, $this->source); })()), "contenu", [], "any", false, false, false, 240));
        // line 241
        yield "    ";
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["plainContent"]) || array_key_exists("plainContent", $context) ? $context["plainContent"] : (function () { throw new RuntimeError('Variable "plainContent" does not exist.', 241, $this->source); })())) > 300)) {
            // line 242
            yield "        <div class=\"lead\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), (isset($context["plainContent"]) || array_key_exists("plainContent", $context) ? $context["plainContent"] : (function () { throw new RuntimeError('Variable "plainContent" does not exist.', 242, $this->source); })()), 0, 320), "html", null, true);
            yield "…</div>
    ";
        }
        // line 244
        yield "
    ";
        // line 246
        yield "    <div class=\"content\">";
        yield CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 246, $this->source); })()), "contenu", [], "any", false, false, false, 246);
        yield "</div>

    <hr>

    <div class=\"export-note\">
        <span>📘 InnerTrack Knowledge Base</span>
        <span>🔗 Exported on ";
        // line 252
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "d M Y H:i"), "html", null, true);
        yield "</span>
    </div>

</body>
</html>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "article/pdf.html.twig";
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
        return array (  374 => 252,  364 => 246,  361 => 244,  355 => 242,  352 => 241,  349 => 240,  341 => 237,  338 => 236,  335 => 235,  332 => 233,  328 => 231,  319 => 229,  315 => 228,  312 => 227,  309 => 226,  305 => 223,  297 => 220,  294 => 219,  292 => 218,  287 => 217,  279 => 215,  277 => 214,  274 => 213,  267 => 209,  264 => 207,  258 => 205,  255 => 204,  54 => 5,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>{{ article.titre }} – InnerTrack</title>
    <style>
        /* ── Reset ── */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            font-size: 11pt;
            line-height: 1.65;
            color: #1a1a2e;
            background: white;
            padding: 28px 44px 44px;
        }

        /* ── Category pill ── */
        .category {
            display: inline-block;
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 7.5pt;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            background: linear-gradient(135deg, #5b21b6, #7c3aed);
            color: white;
            padding: 4px 16px;
            border-radius: 30px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(91,33,182,.25);
        }

        /* ── Title ── */
        h1 {
            font-size: 26pt;
            line-height: 1.18;
            margin: 0 0 16px;
            font-weight: 800;
            color: #0f0a1e;
            border-left: 5px solid #7c3aed;
            padding-left: 20px;
        }

        /* ── Divider line ── */
        .title-rule {
            height: 2px;
            background: linear-gradient(to right, #7c3aed, #ec4899, #f9fafb);
            border: none;
            margin: 0 0 20px;
            border-radius: 2px;
        }

        /* ── Meta bar ── */
        .meta {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 9pt;
            color: #4b5563;
            background: #f5f3ff;
            border: 1px solid #ede9fe;
            padding: 11px 18px;
            border-radius: 14px;
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 14px;
        }
        .meta-item { display: inline-flex; align-items: center; gap: 5px; }

        /* ── Readability badge ── */
        .readability-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            border-radius: 30px;
            padding: 2px 10px;
            font-size: 8pt;
            font-weight: 700;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .readability-badge.Easy     { background: #d1fae5; color: #065f46; }
        .readability-badge.Medium   { background: #fef3c7; color: #92400e; }
        .readability-badge.Advanced { background: #fee2e2; color: #991b1b; }

        /* ── Tags ── */
        .tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 18px; }
        .tag-badge {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 8pt;
            font-weight: 600;
            background: #ede9fe;
            color: #5b21b6;
            padding: 3px 10px;
            border-radius: 30px;
        }

        /* ── Reading time ── */
        .reading-time {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 9pt;
            color: #6d28d9;
            background: #f5f3ff;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 14px;
            border-radius: 30px;
            margin-bottom: 22px;
            font-weight: 600;
        }

        /* ── Lead / pull quote ── */
        .lead {
            font-size: 11.5pt;
            line-height: 1.55;
            color: #2d1b69;
            background: #faf5ff;
            border-left: 4px solid #7c3aed;
            padding: 16px 22px 16px 28px;
            margin: 0 0 24px;
            border-radius: 0 14px 14px 0;
            position: relative;
            font-style: italic;
            box-shadow: 0 2px 10px rgba(124,58,237,.07);
        }
        .lead::before {
            content: \"\\201C\";
            font-size: 52px;
            color: #7c3aed;
            opacity: 0.18;
            position: absolute;
            left: 8px;
            top: -6px;
            line-height: 1;
        }

        /* ── Drop-cap ── */
        .content p:first-of-type::first-letter {
            font-size: 52px;
            font-weight: 900;
            color: #7c3aed;
            float: left;
            padding-right: 6px;
            line-height: 0.82;
            font-family: Georgia, serif;
        }

        /* ── Content ── */
        .content {
            font-size: 11pt;
            line-height: 1.75;
            text-align: justify;
        }
        .content p { margin-bottom: 1em; }
        .content h2, .content h3 {
            color: #2d1b69;
            margin-top: 1.3em;
            margin-bottom: 0.5em;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .content ul, .content ol { margin: 0.5em 0 1em 1.5em; }
        .content li { margin-bottom: 0.3em; }
        .content blockquote {
            border-left: 3px solid #a78bfa;
            background: #faf5ff;
            padding: 8px 16px;
            margin: 1em 0;
            border-radius: 0 8px 8px 0;
            font-style: italic;
            color: #4c1d95;
        }

        /* ── Separator ── */
        hr {
            margin: 32px 0 18px;
            border: none;
            height: 1.5px;
            background: linear-gradient(to right, #f3f4f6, #a78bfa, #f3f4f6);
        }

        /* ── Footer note ── */
        .export-note {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 8pt;
            color: #9ca3af;
            text-align: center;
            display: flex;
            justify-content: center;
            gap: 24px;
        }

        /* ── Page-break helper ── */
        @media print {
            h2, h3 { page-break-after: avoid; }
            .lead, .reading-time { page-break-inside: avoid; }
        }
    </style>
</head>
<body>

    {# Category #}
    {% if article.categorie %}
        <div class=\"category\">{{ article.categorie.nom }}</div>
    {% endif %}

    {# Title #}
    <h1>{{ article.titre }}</h1>
    <hr class=\"title-rule\">

    {# Meta bar #}
    <div class=\"meta\">
        {% if article.auteur %}
            <span class=\"meta-item\">✍️ {{ article.auteur.firstName }} {{ article.auteur.lastName }}</span>
        {% endif %}
        <span class=\"meta-item\">📅 {{ article.datePublication ? article.datePublication|date('d M Y') : '—' }}</span>
        {% if article.readability %}
            <span class=\"meta-item\">
                Readability: <span class=\"readability-badge {{ article.readability }}\">{{ article.readability }}</span>
            </span>
        {% endif %}
    </div>

    {# Tags #}
    {% if article.tags|length > 0 %}
        <div class=\"tags\">
            {% for tag in article.tags %}
                <span class=\"tag-badge\">#{{ tag.nom }}</span>
            {% endfor %}
        </div>
    {% endif %}

    {# Reading time #}
    {% set wordCount = article.contenu|striptags|split(' ')|length %}
    {% set readingTime = (wordCount / 200)|round(0, 'ceil') %}
    <div class=\"reading-time\">⏱ {{ readingTime }} min read · {{ wordCount }} words</div>

    {# Lead paragraph #}
    {% set plainContent = article.contenu|striptags %}
    {% if plainContent|length > 300 %}
        <div class=\"lead\">{{ plainContent|slice(0, 320) }}…</div>
    {% endif %}

    {# Main content #}
    <div class=\"content\">{{ article.contenu|raw }}</div>

    <hr>

    <div class=\"export-note\">
        <span>📘 InnerTrack Knowledge Base</span>
        <span>🔗 Exported on {{ \"now\"|date(\"d M Y H:i\") }}</span>
    </div>

</body>
</html>
", "article/pdf.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\article\\pdf.html.twig");
    }
}
