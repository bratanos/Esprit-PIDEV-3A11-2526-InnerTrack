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

/* article/pdf_footer.html.twig */
class __TwigTemplate_071f8516fc231a389e287cad603d1b76 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/pdf_footer.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "article/pdf_footer.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
        }
        .footer {
            width: 100%;
            background: #f8f9fa;
            border-top: 2px solid #e9ecef;
            padding: 8px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 9px;
            color: #495057;
            border-radius: 12px 12px 0 0;
        }
        .footer-title {
            max-width: 70%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 500;
        }
        .page-info {
            background: #e9ecef;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class=\"footer\">
        <span class=\"footer-title\">✨ ";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 41, $this->source); })()), "titre", [], "any", false, false, false, 41), 0, 60), "html", null, true);
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 41, $this->source); })()), "titre", [], "any", false, false, false, 41)) > 60)) {
            yield "…";
        }
        yield "</span>
        <span class=\"page-info\">📄 Page <span class=\"page\"></span> / <span class=\"topage\"></span></span>
    </div>
    <script>
        var vars = {};
        var query = window.location.search.substring(1).split('&');
        for (var i = 0; i < query.length; i++) {
            var pair = query[i].split('=');
            vars[pair[0]] = decodeURIComponent(pair[1]);
        }
        document.querySelector('.page').textContent = vars.page || '1';
        document.querySelector('.topage').textContent = vars.topage || '1';
    </script>
</body>
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "article/pdf_footer.html.twig";
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
        return array (  90 => 41,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
        }
        .footer {
            width: 100%;
            background: #f8f9fa;
            border-top: 2px solid #e9ecef;
            padding: 8px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 9px;
            color: #495057;
            border-radius: 12px 12px 0 0;
        }
        .footer-title {
            max-width: 70%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 500;
        }
        .page-info {
            background: #e9ecef;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class=\"footer\">
        <span class=\"footer-title\">✨ {{ article.titre|slice(0,60) }}{% if article.titre|length > 60 %}…{% endif %}</span>
        <span class=\"page-info\">📄 Page <span class=\"page\"></span> / <span class=\"topage\"></span></span>
    </div>
    <script>
        var vars = {};
        var query = window.location.search.substring(1).split('&');
        for (var i = 0; i < query.length; i++) {
            var pair = query[i].split('=');
            vars[pair[0]] = decodeURIComponent(pair[1]);
        }
        document.querySelector('.page').textContent = vars.page || '1';
        document.querySelector('.topage').textContent = vars.topage || '1';
    </script>
</body>
</html>", "article/pdf_footer.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\article\\pdf_footer.html.twig");
    }
}
