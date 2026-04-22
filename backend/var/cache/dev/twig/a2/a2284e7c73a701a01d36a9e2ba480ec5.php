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

/* pages/events/index.html.twig */
class __TwigTemplate_3b885b03adeb8dc4172c92be3a39f1f6 extends Template
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
            'title' => [$this, 'block_title'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/events/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/events/index.html.twig"));

        $this->parent = $this->load("layouts/dashboard.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Événements - InnerTrack";
        
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
        yield "<div class=\"space-y-12 lg:space-y-16 max-w-7xl mx-auto pb-24\">
    <!-- Header -->
    <section>
        <div class=\"flex items-baseline gap-3\">
            <h2 class=\"text-4xl md:text-5xl font-headline font-extrabold text-on-surface tracking-tight leading-tight\">Événements</h2>
            <span class=\"text-4xl\">📅</span>
        </div>
        <p class=\"mt-4 text-on-surface-variant font-medium max-w-2xl\">
            Découvrez nos conférences, ateliers et webinaires. Rejoignez la communauté et participez aux événements qui vous intéressent.
        </p>
    </section>

    <!-- Events Grid -->
    ";
        // line 19
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["events"]) || array_key_exists("events", $context) ? $context["events"] : (function () { throw new RuntimeError('Variable "events" does not exist.', 19, $this->source); })())) > 0)) {
            // line 20
            yield "    <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8\">
        ";
            // line 21
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["events"]) || array_key_exists("events", $context) ? $context["events"] : (function () { throw new RuntimeError('Variable "events" does not exist.', 21, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
                // line 22
                yield "            ";
                $context["userStatus"] = (((CoreExtension::getAttribute($this->env, $this->source, ($context["registeredStatuses"] ?? null), CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id", [], "any", false, false, false, 22), [], "array", true, true, false, 22) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["registeredStatuses"]) || array_key_exists("registeredStatuses", $context) ? $context["registeredStatuses"] : (function () { throw new RuntimeError('Variable "registeredStatuses" does not exist.', 22, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id", [], "any", false, false, false, 22), [], "array", false, false, false, 22)))) ? (CoreExtension::getAttribute($this->env, $this->source, (isset($context["registeredStatuses"]) || array_key_exists("registeredStatuses", $context) ? $context["registeredStatuses"] : (function () { throw new RuntimeError('Variable "registeredStatuses" does not exist.', 22, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id", [], "any", false, false, false, 22), [], "array", false, false, false, 22)) : (null));
                // line 23
                yield "            ";
                $context["isRegistered"] = ((isset($context["userStatus"]) || array_key_exists("userStatus", $context) ? $context["userStatus"] : (function () { throw new RuntimeError('Variable "userStatus" does not exist.', 23, $this->source); })()) == "CONFIRMÉ");
                // line 24
                yield "            ";
                $context["isWaiting"] = ((isset($context["userStatus"]) || array_key_exists("userStatus", $context) ? $context["userStatus"] : (function () { throw new RuntimeError('Variable "userStatus" does not exist.', 24, $this->source); })()) == "EN_ATTENTE");
                // line 25
                yield "            
            ";
                // line 26
                $context["confirmedCount"] = 0;
                // line 27
                yield "            ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "inscriptions", [], "any", false, false, false, 27));
                foreach ($context['_seq'] as $context["_key"] => $context["insc"]) {
                    // line 28
                    yield "                ";
                    if ((CoreExtension::getAttribute($this->env, $this->source, $context["insc"], "statut", [], "any", false, false, false, 28) == "CONFIRMÉ")) {
                        $context["confirmedCount"] = ((isset($context["confirmedCount"]) || array_key_exists("confirmedCount", $context) ? $context["confirmedCount"] : (function () { throw new RuntimeError('Variable "confirmedCount" does not exist.', 28, $this->source); })()) + 1);
                    }
                    // line 29
                    yield "            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['insc'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 30
                yield "            ";
                $context["isFull"] = ((isset($context["confirmedCount"]) || array_key_exists("confirmedCount", $context) ? $context["confirmedCount"] : (function () { throw new RuntimeError('Variable "confirmedCount" does not exist.', 30, $this->source); })()) >= CoreExtension::getAttribute($this->env, $this->source, $context["event"], "capacite", [], "any", false, false, false, 30));
                // line 31
                yield "            ";
                $context["isPastDate"] = (CoreExtension::getAttribute($this->env, $this->source, $context["event"], "date", [], "any", false, false, false, 31) < $this->extensions['Twig\Extension\CoreExtension']->modifyDate($this->extensions['Twig\Extension\CoreExtension']->convertDate(), "-1 day"));
                // line 32
                yield "
            
            <div class=\"bg-white rounded-[2rem] border border-outline/20 p-8 shadow-sm hover:shadow-xl hover:border-primary/30 transition-all duration-300 flex flex-col group relative overflow-hidden\">
                
                <!-- Background decoration based on type -->
                <div class=\"absolute -right-12 -top-12 w-40 h-40 rounded-full blur-3xl opacity-20 transition-all duration-700 group-hover:scale-125
                    ";
                // line 38
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "type", [], "any", false, false, false, 38), "value", [], "any", false, false, false, 38) == 1)) {
                    yield "bg-blue-500
                    ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,                 // line 39
$context["event"], "type", [], "any", false, false, false, 39), "value", [], "any", false, false, false, 39) == 2)) {
                    yield "bg-green-500
                    ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,                 // line 40
$context["event"], "type", [], "any", false, false, false, 40), "value", [], "any", false, false, false, 40) == 3)) {
                    yield "bg-purple-500
                    ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,                 // line 41
$context["event"], "type", [], "any", false, false, false, 41), "value", [], "any", false, false, false, 41) == 4)) {
                    yield "bg-orange-500
                    ";
                } else {
                    // line 42
                    yield "bg-primary";
                }
                yield "\">
                </div>

                <div class=\"relative z-10 flex-1 flex flex-col\">
                    <div class=\"flex justify-between items-start mb-6\">
                        <span class=\"px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider
                            ";
                // line 48
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "type", [], "any", false, false, false, 48), "value", [], "any", false, false, false, 48) == 1)) {
                    yield "bg-blue-50 text-blue-700
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,                 // line 49
$context["event"], "type", [], "any", false, false, false, 49), "value", [], "any", false, false, false, 49) == 2)) {
                    yield "bg-green-50 text-green-700
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,                 // line 50
$context["event"], "type", [], "any", false, false, false, 50), "value", [], "any", false, false, false, 50) == 3)) {
                    yield "bg-purple-50 text-purple-700
                            ";
                } elseif ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,                 // line 51
$context["event"], "type", [], "any", false, false, false, 51), "value", [], "any", false, false, false, 51) == 4)) {
                    yield "bg-orange-50 text-orange-700
                            ";
                } else {
                    // line 52
                    yield "bg-gray-100 text-gray-700";
                }
                yield "\">
                            ";
                // line 53
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "type", [], "any", false, false, false, 53), "label", [], "method", false, false, false, 53), "html", null, true);
                yield "
                        </span>
                        
                        <div class=\"text-right\">
                            <div class=\"text-sm font-extrabold text-on-surface\">";
                // line 57
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "date", [], "any", false, false, false, 57), "d"), "html", null, true);
                yield "</div>
                            <div class=\"text-[10px] font-bold uppercase text-on-surface-variant\">";
                // line 58
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "date", [], "any", false, false, false, 58), "M"), "html", null, true);
                yield "</div>
                        </div>
                    </div>

                    <h3 class=\"text-2xl font-headline font-extrabold text-on-surface mb-3 leading-tight group-hover:text-primary transition-colors\">
                        ";
                // line 63
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "titre", [], "any", false, false, false, 63), "html", null, true);
                yield "
                    </h3>

                    ";
                // line 66
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["event"], "image", [], "any", false, false, false, 66)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 67
                    yield "                    <div class=\"mb-4 h-32 w-full rounded-2xl overflow-hidden shrink-0\">
                        <img src=\"";
                    // line 68
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/events/" . CoreExtension::getAttribute($this->env, $this->source, $context["event"], "image", [], "any", false, false, false, 68))), "html", null, true);
                    yield "\" alt=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "titre", [], "any", false, false, false, 68), "html", null, true);
                    yield "\" class=\"w-full h-full object-cover\">
                    </div>
                    ";
                }
                // line 71
                yield "                    
                    <p class=\"text-sm text-on-surface-variant line-clamp-3 mb-6 flex-1\">
                        ";
                // line 73
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, $context["event"], "description", [], "any", true, true, false, 73)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "description", [], "any", false, false, false, 73), "Aucune description fournie.")) : ("Aucune description fournie.")), "html", null, true);
                yield "
                    </p>

                    <div class=\"space-y-4 mt-auto border-t border-outline/20 pt-6\">
                        <div class=\"flex justify-between items-center text-xs font-bold text-on-surface-variant\">
                            <span class=\"flex items-center gap-1.5\">
                                <span class=\"material-symbols-outlined text-[16px]\">group</span>
                                ";
                // line 80
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["confirmedCount"]) || array_key_exists("confirmedCount", $context) ? $context["confirmedCount"] : (function () { throw new RuntimeError('Variable "confirmedCount" does not exist.', 80, $this->source); })()), "html", null, true);
                yield " / ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "capacite", [], "any", false, false, false, 80), "html", null, true);
                yield " places confirmées
                            </span>
                        </div>

                        <!-- Progress bar -->
                        <div class=\"w-full bg-gray-100 rounded-full h-1.5 overflow-hidden\">
                            ";
                // line 86
                $context["fillPercent"] = (((isset($context["confirmedCount"]) || array_key_exists("confirmedCount", $context) ? $context["confirmedCount"] : (function () { throw new RuntimeError('Variable "confirmedCount" does not exist.', 86, $this->source); })()) / CoreExtension::getAttribute($this->env, $this->source, $context["event"], "capacite", [], "any", false, false, false, 86)) * 100);
                // line 87
                yield "                            <div class=\"h-full rounded-full transition-all duration-1000
                                ";
                // line 88
                if (((isset($context["fillPercent"]) || array_key_exists("fillPercent", $context) ? $context["fillPercent"] : (function () { throw new RuntimeError('Variable "fillPercent" does not exist.', 88, $this->source); })()) >= 100)) {
                    yield "bg-red-500";
                } elseif (((isset($context["fillPercent"]) || array_key_exists("fillPercent", $context) ? $context["fillPercent"] : (function () { throw new RuntimeError('Variable "fillPercent" does not exist.', 88, $this->source); })()) > 80)) {
                    yield "bg-orange-400";
                } else {
                    yield "bg-primary";
                }
                yield "\"
                                style=\"width: ";
                // line 89
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["fillPercent"]) || array_key_exists("fillPercent", $context) ? $context["fillPercent"] : (function () { throw new RuntimeError('Variable "fillPercent" does not exist.', 89, $this->source); })()), "html", null, true);
                yield "%\">
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class=\"pt-2\">
                            ";
                // line 95
                if (((isset($context["isPastDate"]) || array_key_exists("isPastDate", $context) ? $context["isPastDate"] : (function () { throw new RuntimeError('Variable "isPastDate" does not exist.', 95, $this->source); })()) && (isset($context["isRegistered"]) || array_key_exists("isRegistered", $context) ? $context["isRegistered"] : (function () { throw new RuntimeError('Variable "isRegistered" does not exist.', 95, $this->source); })()))) {
                    // line 96
                    yield "                                <a href=\"";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_event_certificate", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id", [], "any", false, false, false, 96)]), "html", null, true);
                    yield "\" target=\"_blank\" class=\"w-full px-4 py-3 bg-purple-50 text-purple-700 border border-purple-200 rounded-xl text-xs font-bold flex items-center justify-center gap-2 hover:bg-purple-100 transition-colors\">
                                    <span class=\"material-symbols-outlined text-[18px]\">verified</span> Télécharger Attestation
                                </a>
                            ";
                } elseif ((($tmp =                 // line 99
(isset($context["userStatus"]) || array_key_exists("userStatus", $context) ? $context["userStatus"] : (function () { throw new RuntimeError('Variable "userStatus" does not exist.', 99, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 100
                    yield "                                <div class=\"flex gap-2\">
                                    <div class=\"flex-1 px-4 py-3 ";
                    // line 101
                    yield (((($tmp = (isset($context["isRegistered"]) || array_key_exists("isRegistered", $context) ? $context["isRegistered"] : (function () { throw new RuntimeError('Variable "isRegistered" does not exist.', 101, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-green-50 border-green-200 text-green-700") : ("bg-orange-50 border-orange-200 text-orange-700"));
                    yield " border rounded-xl text-center text-xs font-bold flex items-center justify-center gap-2\">
                                        ";
                    // line 102
                    if ((($tmp = (isset($context["isRegistered"]) || array_key_exists("isRegistered", $context) ? $context["isRegistered"] : (function () { throw new RuntimeError('Variable "isRegistered" does not exist.', 102, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 103
                        yield "                                            <span class=\"material-symbols-outlined text-[18px]\">check_circle</span> Inscrit
                                        ";
                    } else {
                        // line 105
                        yield "                                            <span class=\"material-symbols-outlined text-[18px]\">hourglass_empty</span> En attente
                                        ";
                    }
                    // line 107
                    yield "                                    </div>
                                    <form method=\"post\" action=\"";
                    // line 108
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_event_cancel", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id", [], "any", false, false, false, 108)]), "html", null, true);
                    yield "\" onsubmit=\"return confirm('Voulez-vous vraiment annuler votre inscription ?');\" class=\"flex-none\">
                                        <button type=\"submit\" class=\"px-4 py-3 bg-white border border-red-200 text-red-600 hover:bg-red-50 rounded-xl text-xs font-bold transition-colors\" title=\"Annuler\">
                                            <span class=\"material-symbols-outlined text-[18px]\">close</span>
                                        </button>
                                    </form>
                                </div>
                            ";
                } else {
                    // line 115
                    yield "                                ";
                    if ((($tmp = (isset($context["isPastDate"]) || array_key_exists("isPastDate", $context) ? $context["isPastDate"] : (function () { throw new RuntimeError('Variable "isPastDate" does not exist.', 115, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                        // line 116
                        yield "                                    <div class=\"w-full px-4 py-3 bg-gray-100 text-gray-500 rounded-xl text-center text-xs font-bold flex items-center justify-center gap-2\">
                                        <span class=\"material-symbols-outlined text-[18px]\">event_available</span> Terminé
                                    </div>
                                ";
                    } else {
                        // line 120
                        yield "                                    <form method=\"post\" action=\"";
                        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_event_participate", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id", [], "any", false, false, false, 120)]), "html", null, true);
                        yield "\">
                                        <button type=\"submit\" class=\"w-full px-4 py-3 ";
                        // line 121
                        yield (((($tmp = (isset($context["isFull"]) || array_key_exists("isFull", $context) ? $context["isFull"] : (function () { throw new RuntimeError('Variable "isFull" does not exist.', 121, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("bg-orange-500 hover:bg-orange-600 shadow-orange-500/20") : ("bg-primary hover:bg-indigo-700 shadow-primary/20"));
                        yield " text-white rounded-xl text-xs font-bold active:scale-95 transition-all shadow-md flex items-center justify-center gap-2\">
                                            ";
                        // line 122
                        if ((($tmp = (isset($context["isFull"]) || array_key_exists("isFull", $context) ? $context["isFull"] : (function () { throw new RuntimeError('Variable "isFull" does not exist.', 122, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                            // line 123
                            yield "                                                <span class=\"material-symbols-outlined text-[18px]\">queue</span> Liste d'attente
                                            ";
                        } else {
                            // line 125
                            yield "                                                <span class=\"material-symbols-outlined text-[18px]\">how_to_reg</span> Participer
                                            ";
                        }
                        // line 127
                        yield "                                        </button>
                                    </form>
                                ";
                    }
                    // line 130
                    yield "                            ";
                }
                // line 131
                yield "                        </div>
                    </div>
                </div>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['event'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 136
            yield "    </div>
    ";
        } else {
            // line 138
            yield "    <div class=\"bg-white rounded-[3rem] p-16 text-center border border-outline/20\">
        <span class=\"material-symbols-outlined text-6xl text-gray-200 mb-6\">event_busy</span>
        <h3 class=\"text-2xl font-headline font-extrabold text-on-surface mb-2\">Aucun événement à venir</h3>
        <p class=\"text-on-surface-variant\">Revenez plus tard pour découvrir nos prochains événements.</p>
    </div>
    ";
        }
        // line 144
        yield "</div>
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
        return "pages/events/index.html.twig";
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
        return array (  403 => 144,  395 => 138,  391 => 136,  381 => 131,  378 => 130,  373 => 127,  369 => 125,  365 => 123,  363 => 122,  359 => 121,  354 => 120,  348 => 116,  345 => 115,  335 => 108,  332 => 107,  328 => 105,  324 => 103,  322 => 102,  318 => 101,  315 => 100,  313 => 99,  306 => 96,  304 => 95,  295 => 89,  285 => 88,  282 => 87,  280 => 86,  269 => 80,  259 => 73,  255 => 71,  247 => 68,  244 => 67,  242 => 66,  236 => 63,  228 => 58,  224 => 57,  217 => 53,  212 => 52,  207 => 51,  203 => 50,  199 => 49,  195 => 48,  185 => 42,  180 => 41,  176 => 40,  172 => 39,  168 => 38,  160 => 32,  157 => 31,  154 => 30,  148 => 29,  143 => 28,  138 => 27,  136 => 26,  133 => 25,  130 => 24,  127 => 23,  124 => 22,  120 => 21,  117 => 20,  115 => 19,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block title %}Événements - InnerTrack{% endblock %}

{% block content %}
<div class=\"space-y-12 lg:space-y-16 max-w-7xl mx-auto pb-24\">
    <!-- Header -->
    <section>
        <div class=\"flex items-baseline gap-3\">
            <h2 class=\"text-4xl md:text-5xl font-headline font-extrabold text-on-surface tracking-tight leading-tight\">Événements</h2>
            <span class=\"text-4xl\">📅</span>
        </div>
        <p class=\"mt-4 text-on-surface-variant font-medium max-w-2xl\">
            Découvrez nos conférences, ateliers et webinaires. Rejoignez la communauté et participez aux événements qui vous intéressent.
        </p>
    </section>

    <!-- Events Grid -->
    {% if events|length > 0 %}
    <div class=\"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8\">
        {% for event in events %}
            {% set userStatus = registeredStatuses[event.id] ?? null %}
            {% set isRegistered = userStatus == 'CONFIRMÉ' %}
            {% set isWaiting = userStatus == 'EN_ATTENTE' %}
            
            {% set confirmedCount = 0 %}
            {% for insc in event.inscriptions %}
                {% if insc.statut == 'CONFIRMÉ' %}{% set confirmedCount = confirmedCount + 1 %}{% endif %}
            {% endfor %}
            {% set isFull = confirmedCount >= event.capacite %}
            {% set isPastDate = event.date < date()|date_modify('-1 day') %}

            
            <div class=\"bg-white rounded-[2rem] border border-outline/20 p-8 shadow-sm hover:shadow-xl hover:border-primary/30 transition-all duration-300 flex flex-col group relative overflow-hidden\">
                
                <!-- Background decoration based on type -->
                <div class=\"absolute -right-12 -top-12 w-40 h-40 rounded-full blur-3xl opacity-20 transition-all duration-700 group-hover:scale-125
                    {% if event.type.value == 1 %}bg-blue-500
                    {% elseif event.type.value == 2 %}bg-green-500
                    {% elseif event.type.value == 3 %}bg-purple-500
                    {% elseif event.type.value == 4 %}bg-orange-500
                    {% else %}bg-primary{% endif %}\">
                </div>

                <div class=\"relative z-10 flex-1 flex flex-col\">
                    <div class=\"flex justify-between items-start mb-6\">
                        <span class=\"px-4 py-1.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider
                            {% if event.type.value == 1 %}bg-blue-50 text-blue-700
                            {% elseif event.type.value == 2 %}bg-green-50 text-green-700
                            {% elseif event.type.value == 3 %}bg-purple-50 text-purple-700
                            {% elseif event.type.value == 4 %}bg-orange-50 text-orange-700
                            {% else %}bg-gray-100 text-gray-700{% endif %}\">
                            {{ event.type.label() }}
                        </span>
                        
                        <div class=\"text-right\">
                            <div class=\"text-sm font-extrabold text-on-surface\">{{ event.date|date('d') }}</div>
                            <div class=\"text-[10px] font-bold uppercase text-on-surface-variant\">{{ event.date|date('M') }}</div>
                        </div>
                    </div>

                    <h3 class=\"text-2xl font-headline font-extrabold text-on-surface mb-3 leading-tight group-hover:text-primary transition-colors\">
                        {{ event.titre }}
                    </h3>

                    {% if event.image %}
                    <div class=\"mb-4 h-32 w-full rounded-2xl overflow-hidden shrink-0\">
                        <img src=\"{{ asset('uploads/events/' ~ event.image) }}\" alt=\"{{ event.titre }}\" class=\"w-full h-full object-cover\">
                    </div>
                    {% endif %}
                    
                    <p class=\"text-sm text-on-surface-variant line-clamp-3 mb-6 flex-1\">
                        {{ event.description|default('Aucune description fournie.') }}
                    </p>

                    <div class=\"space-y-4 mt-auto border-t border-outline/20 pt-6\">
                        <div class=\"flex justify-between items-center text-xs font-bold text-on-surface-variant\">
                            <span class=\"flex items-center gap-1.5\">
                                <span class=\"material-symbols-outlined text-[16px]\">group</span>
                                {{ confirmedCount }} / {{ event.capacite }} places confirmées
                            </span>
                        </div>

                        <!-- Progress bar -->
                        <div class=\"w-full bg-gray-100 rounded-full h-1.5 overflow-hidden\">
                            {% set fillPercent = (confirmedCount / event.capacite) * 100 %}
                            <div class=\"h-full rounded-full transition-all duration-1000
                                {% if fillPercent >= 100 %}bg-red-500{% elseif fillPercent > 80 %}bg-orange-400{% else %}bg-primary{% endif %}\"
                                style=\"width: {{ fillPercent }}%\">
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class=\"pt-2\">
                            {% if isPastDate and isRegistered %}
                                <a href=\"{{ path('app_event_certificate', {id: event.id}) }}\" target=\"_blank\" class=\"w-full px-4 py-3 bg-purple-50 text-purple-700 border border-purple-200 rounded-xl text-xs font-bold flex items-center justify-center gap-2 hover:bg-purple-100 transition-colors\">
                                    <span class=\"material-symbols-outlined text-[18px]\">verified</span> Télécharger Attestation
                                </a>
                            {% elseif userStatus %}
                                <div class=\"flex gap-2\">
                                    <div class=\"flex-1 px-4 py-3 {{ isRegistered ? 'bg-green-50 border-green-200 text-green-700' : 'bg-orange-50 border-orange-200 text-orange-700' }} border rounded-xl text-center text-xs font-bold flex items-center justify-center gap-2\">
                                        {% if isRegistered %}
                                            <span class=\"material-symbols-outlined text-[18px]\">check_circle</span> Inscrit
                                        {% else %}
                                            <span class=\"material-symbols-outlined text-[18px]\">hourglass_empty</span> En attente
                                        {% endif %}
                                    </div>
                                    <form method=\"post\" action=\"{{ path('app_event_cancel', {id: event.id}) }}\" onsubmit=\"return confirm('Voulez-vous vraiment annuler votre inscription ?');\" class=\"flex-none\">
                                        <button type=\"submit\" class=\"px-4 py-3 bg-white border border-red-200 text-red-600 hover:bg-red-50 rounded-xl text-xs font-bold transition-colors\" title=\"Annuler\">
                                            <span class=\"material-symbols-outlined text-[18px]\">close</span>
                                        </button>
                                    </form>
                                </div>
                            {% else %}
                                {% if isPastDate %}
                                    <div class=\"w-full px-4 py-3 bg-gray-100 text-gray-500 rounded-xl text-center text-xs font-bold flex items-center justify-center gap-2\">
                                        <span class=\"material-symbols-outlined text-[18px]\">event_available</span> Terminé
                                    </div>
                                {% else %}
                                    <form method=\"post\" action=\"{{ path('app_event_participate', {id: event.id}) }}\">
                                        <button type=\"submit\" class=\"w-full px-4 py-3 {{ isFull ? 'bg-orange-500 hover:bg-orange-600 shadow-orange-500/20' : 'bg-primary hover:bg-indigo-700 shadow-primary/20' }} text-white rounded-xl text-xs font-bold active:scale-95 transition-all shadow-md flex items-center justify-center gap-2\">
                                            {% if isFull %}
                                                <span class=\"material-symbols-outlined text-[18px]\">queue</span> Liste d'attente
                                            {% else %}
                                                <span class=\"material-symbols-outlined text-[18px]\">how_to_reg</span> Participer
                                            {% endif %}
                                        </button>
                                    </form>
                                {% endif %}
                            {% endif %}
                        </div>
                    </div>
                </div>
            </div>
        {% endfor %}
    </div>
    {% else %}
    <div class=\"bg-white rounded-[3rem] p-16 text-center border border-outline/20\">
        <span class=\"material-symbols-outlined text-6xl text-gray-200 mb-6\">event_busy</span>
        <h3 class=\"text-2xl font-headline font-extrabold text-on-surface mb-2\">Aucun événement à venir</h3>
        <p class=\"text-on-surface-variant\">Revenez plus tard pour découvrir nos prochains événements.</p>
    </div>
    {% endif %}
</div>
{% endblock %}
", "pages/events/index.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\events\\index.html.twig");
    }
}
