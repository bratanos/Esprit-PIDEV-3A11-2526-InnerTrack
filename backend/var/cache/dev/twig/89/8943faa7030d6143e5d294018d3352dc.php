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

/* tag/_list.html.twig */
class __TwigTemplate_e727bc51e16c233e6bbe7117154159b3 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tag/_list.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tag/_list.html.twig"));

        // line 1
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["tags"]) || array_key_exists("tags", $context) ? $context["tags"] : (function () { throw new RuntimeError('Variable "tags" does not exist.', 1, $this->source); })()))) {
            // line 2
            yield "    ";
            // line 3
            yield "    <div class=\"bg-white rounded-[2rem] border border-outline/30 py-16 flex flex-col items-center gap-3
                text-on-surface-variant soft-elevation\">
        <span class=\"material-symbols-outlined text-5xl opacity-30\">label</span>
        <p class=\"font-semibold\">No tags available</p>
    </div>
";
        } else {
            // line 9
            yield "    ";
            // line 10
            yield "    <div class=\"flex flex-wrap gap-3\">
        ";
            // line 11
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["tags"]) || array_key_exists("tags", $context) ? $context["tags"] : (function () { throw new RuntimeError('Variable "tags" does not exist.', 11, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 12
                yield "            ";
                $context["tag"] = ((CoreExtension::getAttribute($this->env, $this->source, $context["row"], 0, [], "array", true, true, false, 12)) ? (CoreExtension::getAttribute($this->env, $this->source, $context["row"], 0, [], "array", false, false, false, 12)) : ($context["row"]));
                // line 13
                yield "            ";
                $context["count"] = ((CoreExtension::getAttribute($this->env, $this->source, $context["row"], "articleCount", [], "array", true, true, false, 13)) ? (CoreExtension::getAttribute($this->env, $this->source, $context["row"], "articleCount", [], "array", false, false, false, 13)) : (0));
                // line 14
                yield "            <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_by_tag", ["tagName" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["tag"]) || array_key_exists("tag", $context) ? $context["tag"] : (function () { throw new RuntimeError('Variable "tag" does not exist.', 14, $this->source); })()), "nom", [], "any", false, false, false, 14)]), "html", null, true);
                yield "\"
               class=\"group flex items-center gap-2 bg-white border border-outline/30 px-4 py-2.5 rounded-2xl
                      hover:border-primary/40 hover:bg-primary/5 transition-all soft-elevation\">
                <span class=\"material-symbols-outlined text-on-surface-variant group-hover:text-primary
                             text-[16px] transition-colors\">label</span>
                <span class=\"text-sm font-semibold text-on-surface group-hover:text-primary transition-colors\">
                    #";
                // line 20
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tag"]) || array_key_exists("tag", $context) ? $context["tag"] : (function () { throw new RuntimeError('Variable "tag" does not exist.', 20, $this->source); })()), "nom", [], "any", false, false, false, 20), "html", null, true);
                yield "
                </span>
                <span class=\"text-[10px] font-bold bg-gray-100 text-on-surface-variant px-2 py-0.5 rounded-full\">
                    ";
                // line 23
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["count"]) || array_key_exists("count", $context) ? $context["count"] : (function () { throw new RuntimeError('Variable "count" does not exist.', 23, $this->source); })()), "html", null, true);
                yield "
                </span>
            </a>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['row'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            yield "    </div>
";
        }
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "tag/_list.html.twig";
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
        return array (  101 => 27,  91 => 23,  85 => 20,  75 => 14,  72 => 13,  69 => 12,  65 => 11,  62 => 10,  60 => 9,  52 => 3,  50 => 2,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% if tags is empty %}
    {# Show message when no tags exist #}
    <div class=\"bg-white rounded-[2rem] border border-outline/30 py-16 flex flex-col items-center gap-3
                text-on-surface-variant soft-elevation\">
        <span class=\"material-symbols-outlined text-5xl opacity-30\">label</span>
        <p class=\"font-semibold\">No tags available</p>
    </div>
{% else %}
    {# Display tags as clickable links with article count #}
    <div class=\"flex flex-wrap gap-3\">
        {% for row in tags %}
            {% set tag   = row[0] is defined ? row[0] : row %}
            {% set count = row['articleCount'] is defined ? row['articleCount'] : 0 %}
            <a href=\"{{ path('app_article_by_tag', {tagName: tag.nom}) }}\"
               class=\"group flex items-center gap-2 bg-white border border-outline/30 px-4 py-2.5 rounded-2xl
                      hover:border-primary/40 hover:bg-primary/5 transition-all soft-elevation\">
                <span class=\"material-symbols-outlined text-on-surface-variant group-hover:text-primary
                             text-[16px] transition-colors\">label</span>
                <span class=\"text-sm font-semibold text-on-surface group-hover:text-primary transition-colors\">
                    #{{ tag.nom }}
                </span>
                <span class=\"text-[10px] font-bold bg-gray-100 text-on-surface-variant px-2 py-0.5 rounded-full\">
                    {{ count }}
                </span>
            </a>
        {% endfor %}
    </div>
{% endif %}
", "tag/_list.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\tag\\_list.html.twig");
    }
}
