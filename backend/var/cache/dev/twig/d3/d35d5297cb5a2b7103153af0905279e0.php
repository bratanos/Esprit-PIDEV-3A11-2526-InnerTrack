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

/* learning_path/_list.html.twig */
class __TwigTemplate_d8d9c30c0b746434b2cad4574a238540 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "learning_path/_list.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "learning_path/_list.html.twig"));

        // line 1
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["paths"]) || array_key_exists("paths", $context) ? $context["paths"] : (function () { throw new RuntimeError('Variable "paths" does not exist.', 1, $this->source); })()))) {
            // line 2
            yield "    ";
            // line 3
            yield "    <div class=\"bg-white rounded-[2rem] border border-outline/30 py-16 flex flex-col items-center gap-3
                text-on-surface-variant soft-elevation\">
        <span class=\"material-symbols-outlined text-5xl opacity-30\">route</span>
        <p class=\"font-semibold\">No learning paths available</p>
        ";
            // line 7
            if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE"))) {
                // line 8
                yield "            <a href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_new");
                yield "\"
               class=\"text-primary text-sm font-bold hover:underline\">
                Create the first path
            </a>
        ";
            }
            // line 13
            yield "    </div>
";
        } else {
            // line 15
            yield "    ";
            // line 16
            yield "    <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5\">
        ";
            // line 17
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["paths"]) || array_key_exists("paths", $context) ? $context["paths"] : (function () { throw new RuntimeError('Variable "paths" does not exist.', 17, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["lp"]) {
                // line 18
                yield "            <div class=\"group bg-white rounded-[2rem] border border-outline/30 p-6 soft-elevation
                        hover:border-primary/30 hover:shadow-lg transition-all duration-300 flex flex-col gap-4\">

                <div class=\"w-10 h-10 rounded-2xl bg-primary/10 flex items-center justify-center\">
                    <span class=\"material-symbols-outlined text-primary text-[20px]\">route</span>
                </div>

                <div class=\"flex-1\">
                    <h2 class=\"font-extrabold text-on-surface text-base group-hover:text-primary transition-colors\">
                        ";
                // line 27
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["lp"], "titre", [], "any", false, false, false, 27), "html", null, true);
                yield "
                    </h2>
                    <p class=\"text-xs text-on-surface-variant mt-1 line-clamp-2 leading-relaxed\">
                        ";
                // line 30
                yield ((CoreExtension::getAttribute($this->env, $this->source, $context["lp"], "description", [], "any", false, false, false, 30)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["lp"], "description", [], "any", false, false, false, 30), "html", null, true)) : ("No description."));
                yield "
                    </p>
                </div>

                <div class=\"flex items-center justify-between pt-3 border-t border-outline/20\">
                    <span class=\"text-xs font-bold text-on-surface-variant\">
                        ";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["lp"], "pathArticles", [], "any", false, false, false, 36)), "html", null, true);
                yield " step";
                yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["lp"], "pathArticles", [], "any", false, false, false, 36)) != 1)) ? ("s") : (""));
                yield "
                    </span>
                    ";
                // line 38
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["lp"], "createdBy", [], "any", false, false, false, 38)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 39
                    yield "                        <span class=\"text-xs text-on-surface-variant\">
                            ";
                    // line 40
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["lp"], "createdBy", [], "any", false, false, false, 40), "firstName", [], "any", false, false, false, 40), "html", null, true);
                    yield " ";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["lp"], "createdBy", [], "any", false, false, false, 40), "lastName", [], "any", false, false, false, 40), "html", null, true);
                    yield "
                        </span>
                    ";
                }
                // line 43
                yield "                </div>

                <div class=\"flex items-center gap-2\">
                    <a href=\"";
                // line 46
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["lp"], "id", [], "any", false, false, false, 46)]), "html", null, true);
                yield "\"
                       class=\"flex-1 flex items-center justify-center gap-1.5 py-2.5 rounded-xl text-xs font-bold
                              bg-primary text-white hover:bg-primary/90 transition-all\">
                        <span class=\"material-symbols-outlined text-[15px]\">play_arrow</span>
                        View path
                    </a>
                    ";
                // line 52
                if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE"))) {
                    // line 53
                    yield "                        <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["lp"], "id", [], "any", false, false, false, 53)]), "html", null, true);
                    yield "\"
                           class=\"p-2.5 rounded-xl border border-outline text-on-surface-variant
                                  hover:bg-amber-50 hover:text-amber-600 transition-all\">
                            <span class=\"material-symbols-outlined text-[16px]\">edit</span>
                        </a>
                        <form method=\"POST\" action=\"";
                    // line 58
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_learning_path_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["lp"], "id", [], "any", false, false, false, 58)]), "html", null, true);
                    yield "\"
                              onsubmit=\"return confirm('Delete this learning path?')\">
                            <input type=\"hidden\" name=\"_token\" value=\"";
                    // line 60
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete_lp_" . CoreExtension::getAttribute($this->env, $this->source, $context["lp"], "id", [], "any", false, false, false, 60))), "html", null, true);
                    yield "\">
                            <button class=\"p-2.5 rounded-xl border border-outline text-on-surface-variant
                                           hover:bg-red-50 hover:text-red-500 transition-all\">
                                <span class=\"material-symbols-outlined text-[16px]\">delete</span>
                            </button>
                        </form>
                    ";
                }
                // line 67
                yield "                </div>

            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['lp'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 71
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
        return "learning_path/_list.html.twig";
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
        return array (  177 => 71,  168 => 67,  158 => 60,  153 => 58,  144 => 53,  142 => 52,  133 => 46,  128 => 43,  120 => 40,  117 => 39,  115 => 38,  108 => 36,  99 => 30,  93 => 27,  82 => 18,  78 => 17,  75 => 16,  73 => 15,  69 => 13,  60 => 8,  58 => 7,  52 => 3,  50 => 2,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% if paths is empty %}
    {# Show message when no learning paths exist #}
    <div class=\"bg-white rounded-[2rem] border border-outline/30 py-16 flex flex-col items-center gap-3
                text-on-surface-variant soft-elevation\">
        <span class=\"material-symbols-outlined text-5xl opacity-30\">route</span>
        <p class=\"font-semibold\">No learning paths available</p>
        {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_PSYCHOLOGUE') %}
            <a href=\"{{ path('app_learning_path_new') }}\"
               class=\"text-primary text-sm font-bold hover:underline\">
                Create the first path
            </a>
        {% endif %}
    </div>
{% else %}
    {# Display learning paths in a grid #}
    <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5\">
        {% for lp in paths %}
            <div class=\"group bg-white rounded-[2rem] border border-outline/30 p-6 soft-elevation
                        hover:border-primary/30 hover:shadow-lg transition-all duration-300 flex flex-col gap-4\">

                <div class=\"w-10 h-10 rounded-2xl bg-primary/10 flex items-center justify-center\">
                    <span class=\"material-symbols-outlined text-primary text-[20px]\">route</span>
                </div>

                <div class=\"flex-1\">
                    <h2 class=\"font-extrabold text-on-surface text-base group-hover:text-primary transition-colors\">
                        {{ lp.titre }}
                    </h2>
                    <p class=\"text-xs text-on-surface-variant mt-1 line-clamp-2 leading-relaxed\">
                        {{ lp.description ?: 'No description.' }}
                    </p>
                </div>

                <div class=\"flex items-center justify-between pt-3 border-t border-outline/20\">
                    <span class=\"text-xs font-bold text-on-surface-variant\">
                        {{ lp.pathArticles|length }} step{{ lp.pathArticles|length != 1 ? 's' : '' }}
                    </span>
                    {% if lp.createdBy %}
                        <span class=\"text-xs text-on-surface-variant\">
                            {{ lp.createdBy.firstName }} {{ lp.createdBy.lastName }}
                        </span>
                    {% endif %}
                </div>

                <div class=\"flex items-center gap-2\">
                    <a href=\"{{ path('app_learning_path_show', {id: lp.id}) }}\"
                       class=\"flex-1 flex items-center justify-center gap-1.5 py-2.5 rounded-xl text-xs font-bold
                              bg-primary text-white hover:bg-primary/90 transition-all\">
                        <span class=\"material-symbols-outlined text-[15px]\">play_arrow</span>
                        View path
                    </a>
                    {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_PSYCHOLOGUE') %}
                        <a href=\"{{ path('app_learning_path_edit', {id: lp.id}) }}\"
                           class=\"p-2.5 rounded-xl border border-outline text-on-surface-variant
                                  hover:bg-amber-50 hover:text-amber-600 transition-all\">
                            <span class=\"material-symbols-outlined text-[16px]\">edit</span>
                        </a>
                        <form method=\"POST\" action=\"{{ path('app_learning_path_delete', {id: lp.id}) }}\"
                              onsubmit=\"return confirm('Delete this learning path?')\">
                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete_lp_' ~ lp.id) }}\">
                            <button class=\"p-2.5 rounded-xl border border-outline text-on-surface-variant
                                           hover:bg-red-50 hover:text-red-500 transition-all\">
                                <span class=\"material-symbols-outlined text-[16px]\">delete</span>
                            </button>
                        </form>
                    {% endif %}
                </div>

            </div>
        {% endfor %}
    </div>
{% endif %}
", "learning_path/_list.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\learning_path\\_list.html.twig");
    }
}
