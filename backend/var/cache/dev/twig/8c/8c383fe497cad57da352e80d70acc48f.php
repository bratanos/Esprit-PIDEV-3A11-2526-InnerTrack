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

/* pages/events/certificate.html.twig */
class __TwigTemplate_2394cf4f553125bdcb255ff87ef6c1e3 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/events/certificate.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/events/certificate.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Attestation de Participation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
            color: #333;
        }
        .header {
            margin-bottom: 50px;
        }
        .header h1 {
            font-size: 40px;
            color: #4f46e5; /* Primary */
            margin-bottom: 10px;
        }
        .content {
            font-size: 20px;
            line-height: 1.6;
        }
        .participant-name {
            font-size: 30px;
            font-weight: bold;
            color: #111;
            margin: 20px 0;
            text-transform: uppercase;
        }
        .event-title {
            font-size: 24px;
            font-weight: bold;
            color: #4f46e5;
            margin: 20px 0;
        }
        .footer {
            margin-top: 80px;
            font-size: 16px;
            color: #666;
        }
        .date {
            margin-top: 50px;
            font-weight: bold;
        }
        .signature {
            margin-top: 40px;
            border-top: 1px solid #ccc;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class=\"header\">
        <h1>ATTESTATION DE PARTICIPATION</h1>
        <p>Décernée par InnerTrack</p>
    </div>

    <div class=\"content\">
        <p>Nous certifions par la présente que</p>
        
        <div class=\"participant-name\">
            ";
        // line 68
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscription"]) || array_key_exists("inscription", $context) ? $context["inscription"] : (function () { throw new RuntimeError('Variable "inscription" does not exist.', 68, $this->source); })()), "nomParticipant", [], "any", false, false, false, 68), "html", null, true);
        yield "
        </div>

        <p>a participé avec succès à l'événement :</p>
        
        <div class=\"event-title\">
            \"";
        // line 74
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 74, $this->source); })()), "titre", [], "any", false, false, false, 74), "html", null, true);
        yield "\"
        </div>

        <p>
            Tenu le <strong>";
        // line 78
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 78, $this->source); })()), "date", [], "any", false, false, false, 78), "d/m/Y"), "html", null, true);
        yield "</strong> <br>
            Type : ";
        // line 79
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 79, $this->source); })()), "type", [], "any", false, false, false, 79), "label", [], "method", false, false, false, 79), "html", null, true);
        yield "
        </p>
    </div>

    <div class=\"footer\">
        <div class=\"date\">
            Fait le ";
        // line 85
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "d/m/Y"), "html", null, true);
        yield "
        </div>
        <div class=\"signature\">
            Signature de l'Organisation
        </div>
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
        return "pages/events/certificate.html.twig";
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
        return array (  146 => 85,  137 => 79,  133 => 78,  126 => 74,  117 => 68,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Attestation de Participation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
            color: #333;
        }
        .header {
            margin-bottom: 50px;
        }
        .header h1 {
            font-size: 40px;
            color: #4f46e5; /* Primary */
            margin-bottom: 10px;
        }
        .content {
            font-size: 20px;
            line-height: 1.6;
        }
        .participant-name {
            font-size: 30px;
            font-weight: bold;
            color: #111;
            margin: 20px 0;
            text-transform: uppercase;
        }
        .event-title {
            font-size: 24px;
            font-weight: bold;
            color: #4f46e5;
            margin: 20px 0;
        }
        .footer {
            margin-top: 80px;
            font-size: 16px;
            color: #666;
        }
        .date {
            margin-top: 50px;
            font-weight: bold;
        }
        .signature {
            margin-top: 40px;
            border-top: 1px solid #ccc;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class=\"header\">
        <h1>ATTESTATION DE PARTICIPATION</h1>
        <p>Décernée par InnerTrack</p>
    </div>

    <div class=\"content\">
        <p>Nous certifions par la présente que</p>
        
        <div class=\"participant-name\">
            {{ inscription.nomParticipant }}
        </div>

        <p>a participé avec succès à l'événement :</p>
        
        <div class=\"event-title\">
            \"{{ event.titre }}\"
        </div>

        <p>
            Tenu le <strong>{{ event.date|date('d/m/Y') }}</strong> <br>
            Type : {{ event.type.label() }}
        </p>
    </div>

    <div class=\"footer\">
        <div class=\"date\">
            Fait le {{ 'now'|date('d/m/Y') }}
        </div>
        <div class=\"signature\">
            Signature de l'Organisation
        </div>
    </div>

</body>
</html>
", "pages/events/certificate.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\events\\certificate.html.twig");
    }
}
