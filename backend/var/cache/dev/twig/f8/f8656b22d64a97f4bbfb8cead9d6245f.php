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

/* pages/notifications/notifications.html.twig */
class __TwigTemplate_9ac9087a919bd2a923581c31765467de extends Template
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
            'header_title' => [$this, 'block_header_title'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/notifications/notifications.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/notifications/notifications.html.twig"));

        $this->parent = $this->load("layouts/dashboard.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_header_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "header_title"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("nav.notifications"), "html", null, true);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
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

        // line 6
        yield "<div class=\"max-w-4xl mx-auto space-y-6\">

    <div class=\"flex justify-between items-center bg-white rounded-2xl p-6 shadow-sm border border-[#e5f7f6]\">
        <div>
            <h2 class=\"text-xl font-bold text-[#0e1e1e]\">Vos alertes récentes</h2>
            <p class=\"text-slate-500 text-sm mt-1\">Gérez vos demandes et messages importants.</p>
        </div>
        <button onclick=\"fetch('/_internal/notifications/read-all', {method:'POST'}).then(() => location.reload())\" 
                class=\"px-4 py-2 text-sm font-semibold text-cyan-700 bg-cyan-50 hover:bg-cyan-100 rounded-xl transition\">
            ";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("notifications.mark_all_read"), "html", null, true);
        yield "
        </button>
    </div>

    <div class=\"space-y-4\">
        ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["notifications"]) || array_key_exists("notifications", $context) ? $context["notifications"] : (function () { throw new RuntimeError('Variable "notifications" does not exist.', 20, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["notif"]) {
            // line 21
            yield "            <div class=\"flex gap-4 p-5 rounded-2xl shadow-sm border transaction-colors ";
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["notif"], "isRead", [], "any", false, false, false, 21)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-white border-[#e5f7f6]") : ("bg-cyan-50/30 border-cyan-100"));
            yield "\">
                <div class=\"w-12 h-12 shrink-0 rounded-full flex items-center justify-center text-xl bg-gradient-to-br from-cyan-100 to-emerald-100 shadow-inner\">
                    ";
            // line 23
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notif"], "icon", [], "any", false, false, false, 23), "html", null, true);
            yield "
                </div>
                
                <div class=\"flex-1 min-w-0\">
                    <div class=\"flex items-start justify-between\">
                        <h4 class=\"text-[0.95rem] font-bold ";
            // line 28
            yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["notif"], "isRead", [], "any", false, false, false, 28)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("text-slate-700") : ("text-[#006876]"));
            yield "\">
                            ";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notif"], "title", [], "any", false, false, false, 29), "html", null, true);
            yield "
                            ";
            // line 30
            if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["notif"], "isRead", [], "any", false, false, false, 30)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 31
                yield "                                <span class=\"ml-2 w-2 h-2 inline-block rounded-full bg-red-400\"></span>
                            ";
            }
            // line 33
            yield "                        </h4>
                        <span class=\"text-xs font-semibold text-slate-400 shrink-0\">";
            // line 34
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["notif"], "createdAt", [], "any", false, false, false, 34), "d M Y - H:i"), "html", null, true);
            yield "</span>
                    </div>
                    <p class=\"text-slate-600 mt-1 text-sm font-medium\">";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notif"], "body", [], "any", false, false, false, 36), "html", null, true);
            yield "</p>
                    
                    ";
            // line 38
            if ((($tmp =  !CoreExtension::getAttribute($this->env, $this->source, $context["notif"], "isRead", [], "any", false, false, false, 38)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 39
                yield "                        <div class=\"mt-4 flex gap-3\">
                            ";
                // line 40
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["notif"], "type", [], "any", false, false, false, 40) == "CONTACT_REQUEST")) {
                    // line 41
                    yield "                                <a href=\"";
                    yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_dashboard");
                    yield "\" class=\"px-4 py-1.5 bg-emerald-600 hover:bg-emerald-700 font-semibold text-white text-xs rounded-lg transition shadow-sm\">
                                    Voir la demande sur le tableau de bord
                                </a>
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source,                 // line 44
$context["notif"], "type", [], "any", false, false, false, 44) == "MESSAGE")) {
                    // line 45
                    yield "                                <a href=\"";
                    yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_messages");
                    yield "\" class=\"px-4 py-1.5 bg-cyan-600 hover:bg-cyan-700 font-semibold text-white text-xs rounded-lg transition shadow-sm\">
                                    Ouvrir la messagerie
                                </a>
                            ";
                }
                // line 49
                yield "                            
                            <button onclick=\"fetch('/_internal/notifications/";
                // line 50
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["notif"], "id", [], "any", false, false, false, 50), "html", null, true);
                yield "/read', {method:'POST'}).then(() => location.reload())\" 
                                    class=\"px-4 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-xs rounded-lg transition\">
                                ";
                // line 52
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::default($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("notifications.mark_as_read"), "Mark as read"), "html", null, true);
                yield "
                            </button>
                        </div>
                    ";
            }
            // line 56
            yield "                </div>
            </div>
        ";
            $context['_iterated'] = true;
        }
        // line 58
        if (!$context['_iterated']) {
            // line 59
            yield "            <div class=\"p-12 text-center bg-white rounded-3xl border border-[#e5f7f6] shadow-sm\">
                <div class=\"w-20 h-20 mx-auto rounded-full bg-slate-50 flex items-center justify-center mb-4\">
                    <svg class=\"w-10 h-10 text-slate-300\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"1.5\" d=\"M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9\"></path></svg>
                </div>
                <h3 class=\"text-lg font-bold text-slate-700 mb-1\">";
            // line 63
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans("notifications.empty"), "html", null, true);
            yield "</h3>
                <p class=\"text-slate-500 font-medium\">Vous êtes à jour !</p>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['notif'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        yield "    </div>

</div>
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
        return "pages/notifications/notifications.html.twig";
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
        return array (  228 => 67,  218 => 63,  212 => 59,  210 => 58,  204 => 56,  197 => 52,  192 => 50,  189 => 49,  181 => 45,  179 => 44,  172 => 41,  170 => 40,  167 => 39,  165 => 38,  160 => 36,  155 => 34,  152 => 33,  148 => 31,  146 => 30,  142 => 29,  138 => 28,  130 => 23,  124 => 21,  119 => 20,  111 => 15,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}{{ 'nav.notifications'|trans }}{% endblock %}

{% block content %}
<div class=\"max-w-4xl mx-auto space-y-6\">

    <div class=\"flex justify-between items-center bg-white rounded-2xl p-6 shadow-sm border border-[#e5f7f6]\">
        <div>
            <h2 class=\"text-xl font-bold text-[#0e1e1e]\">Vos alertes récentes</h2>
            <p class=\"text-slate-500 text-sm mt-1\">Gérez vos demandes et messages importants.</p>
        </div>
        <button onclick=\"fetch('/_internal/notifications/read-all', {method:'POST'}).then(() => location.reload())\" 
                class=\"px-4 py-2 text-sm font-semibold text-cyan-700 bg-cyan-50 hover:bg-cyan-100 rounded-xl transition\">
            {{ 'notifications.mark_all_read'|trans }}
        </button>
    </div>

    <div class=\"space-y-4\">
        {% for notif in notifications %}
            <div class=\"flex gap-4 p-5 rounded-2xl shadow-sm border transaction-colors {{ notif.isRead ? 'bg-white border-[#e5f7f6]' : 'bg-cyan-50/30 border-cyan-100' }}\">
                <div class=\"w-12 h-12 shrink-0 rounded-full flex items-center justify-center text-xl bg-gradient-to-br from-cyan-100 to-emerald-100 shadow-inner\">
                    {{ notif.icon }}
                </div>
                
                <div class=\"flex-1 min-w-0\">
                    <div class=\"flex items-start justify-between\">
                        <h4 class=\"text-[0.95rem] font-bold {{ notif.isRead ? 'text-slate-700' : 'text-[#006876]' }}\">
                            {{ notif.title }}
                            {% if not notif.isRead %}
                                <span class=\"ml-2 w-2 h-2 inline-block rounded-full bg-red-400\"></span>
                            {% endif %}
                        </h4>
                        <span class=\"text-xs font-semibold text-slate-400 shrink-0\">{{ notif.createdAt|date('d M Y - H:i') }}</span>
                    </div>
                    <p class=\"text-slate-600 mt-1 text-sm font-medium\">{{ notif.body }}</p>
                    
                    {% if not notif.isRead %}
                        <div class=\"mt-4 flex gap-3\">
                            {% if notif.type == 'CONTACT_REQUEST' %}
                                <a href=\"{{ path('app_dashboard') }}\" class=\"px-4 py-1.5 bg-emerald-600 hover:bg-emerald-700 font-semibold text-white text-xs rounded-lg transition shadow-sm\">
                                    Voir la demande sur le tableau de bord
                                </a>
                            {% elseif notif.type == 'MESSAGE' %}
                                <a href=\"{{ path('app_messages') }}\" class=\"px-4 py-1.5 bg-cyan-600 hover:bg-cyan-700 font-semibold text-white text-xs rounded-lg transition shadow-sm\">
                                    Ouvrir la messagerie
                                </a>
                            {% endif %}
                            
                            <button onclick=\"fetch('/_internal/notifications/{{ notif.id }}/read', {method:'POST'}).then(() => location.reload())\" 
                                    class=\"px-4 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-xs rounded-lg transition\">
                                {{ 'notifications.mark_as_read'|trans|default('Mark as read') }}
                            </button>
                        </div>
                    {% endif %}
                </div>
            </div>
        {% else %}
            <div class=\"p-12 text-center bg-white rounded-3xl border border-[#e5f7f6] shadow-sm\">
                <div class=\"w-20 h-20 mx-auto rounded-full bg-slate-50 flex items-center justify-center mb-4\">
                    <svg class=\"w-10 h-10 text-slate-300\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"1.5\" d=\"M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9\"></path></svg>
                </div>
                <h3 class=\"text-lg font-bold text-slate-700 mb-1\">{{ 'notifications.empty'|trans }}</h3>
                <p class=\"text-slate-500 font-medium\">Vous êtes à jour !</p>
            </div>
        {% endfor %}
    </div>

</div>
{% endblock %}
", "pages/notifications/notifications.html.twig", "C:\\Users\\user\\Documents\\fuck2\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\notifications\\notifications.html.twig");
    }
}
