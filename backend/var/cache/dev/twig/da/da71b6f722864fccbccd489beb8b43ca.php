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

/* categorie/_list.html.twig */
class __TwigTemplate_1a6596a614f4990c08c6efedf211ef59 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "categorie/_list.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "categorie/_list.html.twig"));

        // line 2
        yield "<div class=\"relative w-full\">
    <span class=\"material-symbols-outlined text-[20px] text-on-surface-variant pointer-events-none\"
          style=\"position:absolute; left:1rem; top:50%; transform:translateY(-50%);\">search</span>
    <input type=\"text\" id=\"cat-search\" placeholder=\"Filter categories…\"
           style=\"padding-left:2.75rem;\"
           class=\"w-full pr-4 py-3 rounded-xl border border-outline/40 bg-white text-sm
                  focus:outline-none focus:ring-2 focus:ring-primary/30 transition shadow-sm\">
</div>

";
        // line 12
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 12, $this->source); })()))) {
            // line 13
            yield "    <div class=\"flex flex-col items-center justify-center py-20 text-on-surface-variant\">
        <span class=\"material-symbols-outlined text-5xl opacity-30 mb-3\">folder_off</span>
        <p class=\"font-semibold\">No categories found</p>
        ";
            // line 16
            if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE"))) {
                // line 17
                yield "            <a href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_categorie_new");
                yield "\"
               class=\"text-primary text-sm font-bold hover:underline mt-2\">
                Create a category
            </a>
        ";
            }
            // line 22
            yield "    </div>
";
        } else {
            // line 24
            yield "    <div class=\"grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4\" id=\"cat-grid\">
        ";
            // line 25
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 25, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["categorie"]) {
                // line 26
                yield "            <div class=\"cat-card group relative bg-white rounded-2xl border border-outline/20 p-5
                        hover:shadow-xl hover:-translate-y-1 transition-all duration-300
                        flex flex-col overflow-hidden\"
                 data-name=\"";
                // line 29
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::lower($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "nom", [], "any", false, false, false, 29)), "html", null, true);
                yield "\">

                ";
                // line 32
                yield "                <div class=\"absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary/40 to-primary/10
                            opacity-0 group-hover:opacity-100 transition\"></div>

                ";
                // line 36
                yield "                <div class=\"flex items-start justify-between gap-2 mb-4\">
                    <div class=\"flex items-center gap-3 min-w-0\">
                        <div class=\"w-12 h-12 rounded-xl bg-gradient-to-br from-primary/20 to-primary/5
                                    flex items-center justify-center shadow-inner shrink-0\">
                            <span class=\"material-symbols-outlined text-primary text-[22px]\">folder</span>
                        </div>
                        <div class=\"min-w-0\">
                            <p class=\"font-semibold text-sm text-on-surface truncate\">";
                // line 43
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "nom", [], "any", false, false, false, 43), "html", null, true);
                yield "</p>
                            <p class=\"text-xs text-on-surface-variant\">
                                ";
                // line 45
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "articles", [], "any", false, false, false, 45)), "html", null, true);
                yield " article";
                yield (((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "articles", [], "any", false, false, false, 45)) != 1)) ? ("s") : (""));
                yield "
                            </p>
                        </div>
                    </div>

                    ";
                // line 50
                if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN") || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_PSYCHOLOGUE"))) {
                    // line 51
                    yield "                        <div class=\"flex items-center gap-1 opacity-0 group-hover:opacity-100 transition shrink-0\">
                            <a href=\"";
                    // line 52
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_categorie_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "id", [], "any", false, false, false, 52)]), "html", null, true);
                    yield "\"
                               class=\"p-1.5 rounded-lg text-on-surface-variant hover:bg-amber-50 hover:text-amber-600 transition\">
                                <span class=\"material-symbols-outlined text-[16px]\">edit</span>
                            </a>
                            <form method=\"post\" action=\"";
                    // line 56
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_categorie_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "id", [], "any", false, false, false, 56)]), "html", null, true);
                    yield "\"
                                  onsubmit=\"return confirm('Delete category « ";
                    // line 57
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "nom", [], "any", false, false, false, 57), "html", null, true);
                    yield " »?')\">
                                <input type=\"hidden\" name=\"_token\" value=\"";
                    // line 58
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "id", [], "any", false, false, false, 58))), "html", null, true);
                    yield "\">
                                <button type=\"submit\"
                                        class=\"p-1.5 rounded-lg text-on-surface-variant hover:bg-red-50 hover:text-red-500 transition\">
                                    <span class=\"material-symbols-outlined text-[16px]\">delete</span>
                                </button>
                            </form>
                        </div>
                    ";
                }
                // line 66
                yield "                </div>

                ";
                // line 69
                yield "                <p class=\"text-sm text-on-surface-variant mb-5 leading-relaxed line-clamp-3 flex-1\">
                    ";
                // line 70
                yield ((CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "description", [], "any", false, false, false, 70)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "description", [], "any", false, false, false, 70), "html", null, true)) : ("No description available."));
                yield "
                </p>

                ";
                // line 74
                yield "                <a href=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_article_index", ["categorie" => CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "id", [], "any", false, false, false, 74)]), "html", null, true);
                yield "\"
                   class=\"mt-auto flex items-center justify-between text-sm font-semibold text-primary\">
                    <span>View articles</span>
                    <span class=\"material-symbols-outlined text-[18px] group-hover:translate-x-1 transition\">
                        arrow_forward
                    </span>
                </a>

            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['categorie'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 84
            yield "    </div>
";
        }
        // line 86
        yield "
<script>
";
        // line 89
        yield "(function () {
    const input = document.getElementById('cat-search');
    if (!input) return;
    input.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.cat-card').forEach(el => {
            el.style.display = el.dataset.name.includes(q) ? '' : 'none';
        });
    });
})();
</script>
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
        return "categorie/_list.html.twig";
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
        return array (  196 => 89,  192 => 86,  188 => 84,  171 => 74,  165 => 70,  162 => 69,  158 => 66,  147 => 58,  143 => 57,  139 => 56,  132 => 52,  129 => 51,  127 => 50,  117 => 45,  112 => 43,  103 => 36,  98 => 32,  93 => 29,  88 => 26,  84 => 25,  81 => 24,  77 => 22,  68 => 17,  66 => 16,  61 => 13,  59 => 12,  48 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# Search bar for filtering categories #}
<div class=\"relative w-full\">
    <span class=\"material-symbols-outlined text-[20px] text-on-surface-variant pointer-events-none\"
          style=\"position:absolute; left:1rem; top:50%; transform:translateY(-50%);\">search</span>
    <input type=\"text\" id=\"cat-search\" placeholder=\"Filter categories…\"
           style=\"padding-left:2.75rem;\"
           class=\"w-full pr-4 py-3 rounded-xl border border-outline/40 bg-white text-sm
                  focus:outline-none focus:ring-2 focus:ring-primary/30 transition shadow-sm\">
</div>

{# Grid of categories #}
{% if categories is empty %}
    <div class=\"flex flex-col items-center justify-center py-20 text-on-surface-variant\">
        <span class=\"material-symbols-outlined text-5xl opacity-30 mb-3\">folder_off</span>
        <p class=\"font-semibold\">No categories found</p>
        {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_PSYCHOLOGUE') %}
            <a href=\"{{ path('app_categorie_new') }}\"
               class=\"text-primary text-sm font-bold hover:underline mt-2\">
                Create a category
            </a>
        {% endif %}
    </div>
{% else %}
    <div class=\"grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4\" id=\"cat-grid\">
        {% for categorie in categories %}
            <div class=\"cat-card group relative bg-white rounded-2xl border border-outline/20 p-5
                        hover:shadow-xl hover:-translate-y-1 transition-all duration-300
                        flex flex-col overflow-hidden\"
                 data-name=\"{{ categorie.nom|lower }}\">

                {# Hover top accent line #}
                <div class=\"absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary/40 to-primary/10
                            opacity-0 group-hover:opacity-100 transition\"></div>

                {# Header #}
                <div class=\"flex items-start justify-between gap-2 mb-4\">
                    <div class=\"flex items-center gap-3 min-w-0\">
                        <div class=\"w-12 h-12 rounded-xl bg-gradient-to-br from-primary/20 to-primary/5
                                    flex items-center justify-center shadow-inner shrink-0\">
                            <span class=\"material-symbols-outlined text-primary text-[22px]\">folder</span>
                        </div>
                        <div class=\"min-w-0\">
                            <p class=\"font-semibold text-sm text-on-surface truncate\">{{ categorie.nom }}</p>
                            <p class=\"text-xs text-on-surface-variant\">
                                {{ categorie.articles|length }} article{{ categorie.articles|length != 1 ? 's' : '' }}
                            </p>
                        </div>
                    </div>

                    {% if is_granted('ROLE_ADMIN') or is_granted('ROLE_PSYCHOLOGUE') %}
                        <div class=\"flex items-center gap-1 opacity-0 group-hover:opacity-100 transition shrink-0\">
                            <a href=\"{{ path('app_categorie_edit', {id: categorie.id}) }}\"
                               class=\"p-1.5 rounded-lg text-on-surface-variant hover:bg-amber-50 hover:text-amber-600 transition\">
                                <span class=\"material-symbols-outlined text-[16px]\">edit</span>
                            </a>
                            <form method=\"post\" action=\"{{ path('app_categorie_delete', {id: categorie.id}) }}\"
                                  onsubmit=\"return confirm('Delete category « {{ categorie.nom }} »?')\">
                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ categorie.id) }}\">
                                <button type=\"submit\"
                                        class=\"p-1.5 rounded-lg text-on-surface-variant hover:bg-red-50 hover:text-red-500 transition\">
                                    <span class=\"material-symbols-outlined text-[16px]\">delete</span>
                                </button>
                            </form>
                        </div>
                    {% endif %}
                </div>

                {# Description #}
                <p class=\"text-sm text-on-surface-variant mb-5 leading-relaxed line-clamp-3 flex-1\">
                    {{ categorie.description ?: 'No description available.' }}
                </p>

                {# Footer link #}
                <a href=\"{{ path('app_article_index', {categorie: categorie.id}) }}\"
                   class=\"mt-auto flex items-center justify-between text-sm font-semibold text-primary\">
                    <span>View articles</span>
                    <span class=\"material-symbols-outlined text-[18px] group-hover:translate-x-1 transition\">
                        arrow_forward
                    </span>
                </a>

            </div>
        {% endfor %}
    </div>
{% endif %}

<script>
{# JavaScript for search filtering #}
(function () {
    const input = document.getElementById('cat-search');
    if (!input) return;
    input.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.cat-card').forEach(el => {
            el.style.display = el.dataset.name.includes(q) ? '' : 'none';
        });
    });
})();
</script>
", "categorie/_list.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\categorie\\_list.html.twig");
    }
}
