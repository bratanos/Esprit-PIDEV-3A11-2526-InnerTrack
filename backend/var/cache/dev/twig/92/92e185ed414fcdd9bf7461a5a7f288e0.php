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

/* pages/profile/view.html.twig */
class __TwigTemplate_91a19137e55333f0f1675f8ed6512e3d extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/profile/view.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/profile/view.html.twig"));

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

        yield "Mon Profil";
        
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
        yield "<div class=\"max-w-4xl mx-auto space-y-8\">
    
    ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 8, $this->source); })()), "flashes", ["success"], "method", false, false, false, 8));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 9
            yield "        <div class=\"p-4 rounded-xl bg-emerald-50 text-emerald-700 text-sm font-medium border border-emerald-100 flex items-center gap-3\">
            <svg class=\"w-5 h-5 shrink-0\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M5 13l4 4L19 7\"></path></svg>
            ";
            // line 11
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        yield "    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 14, $this->source); })()), "flashes", ["error"], "method", false, false, false, 14));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 15
            yield "        <div class=\"p-4 rounded-xl bg-red-50 text-red-600 text-sm font-medium border border-red-100 flex items-center gap-3\">
            <svg class=\"w-5 h-5 shrink-0\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"></path></svg>
            ";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        yield "
    <div class=\"grid grid-cols-1 md:grid-cols-3 gap-8\">
        
        <!-- Left Column: Avatar & Quick Actions -->
        <div class=\"md:col-span-1 space-y-6\">
            <div class=\"bg-white rounded-[2rem] p-8 shadow-sm border border-[#e5f7f6] flex flex-col items-center relative overflow-hidden\">
                <div class=\"absolute inset-0 bg-gradient-to-b from-[#ebfdfc] to-transparent h-1/2\"></div>
                <div class=\"relative z-10 flex flex-col items-center\">
                    <div class=\"w-32 h-32 rounded-full bg-slate-100 border-4 border-white shadow-md overflow-hidden mb-4 relative group cursor-pointer\" onclick=\"document.getElementById('profilePicture').click()\">
                        ";
        // line 29
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 29, $this->source); })()), "profilePictureUrl", [], "any", false, false, false, 29)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 30
            yield "                            <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 30, $this->source); })()), "profilePictureUrl", [], "any", false, false, false, 30), "html", null, true);
            yield "\" alt=\"Profile\" class=\"w-full h-full object-cover\">
                        ";
        } else {
            // line 32
            yield "                            <div class=\"w-full h-full bg-gradient-to-br from-[#00bcd4] to-[#006876] flex items-center justify-center text-white text-4xl font-bold\">
                                ";
            // line 33
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 33, $this->source); })()), "firstName", [], "any", false, false, false, 33))), "html", null, true);
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::upper($this->env->getCharset(), Twig\Extension\CoreExtension::first($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 33, $this->source); })()), "lastName", [], "any", false, false, false, 33))), "html", null, true);
            yield "
                            </div>
                        ";
        }
        // line 36
        yield "                        <div class=\"absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity\">
                            <svg class=\"w-8 h-8 text-white\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z\"></path><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M15 13a3 3 0 11-6 0 3 3 0 016 0z\"></path></svg>
                        </div>
                    </div>
                    
                    <form action=\"";
        // line 41
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile_picture");
        yield "\" method=\"POST\" enctype=\"multipart/form-data\" class=\"hidden\">
                        <input type=\"file\" name=\"profilePicture\" id=\"profilePicture\" accept=\"image/*\" onchange=\"this.form.submit()\">
                    </form>

                    <h2 class=\"text-xl font-bold text-[#0e1e1e] text-center\">";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 45, $this->source); })()), "fullName", [], "any", false, false, false, 45), "html", null, true);
        yield "</h2>
                    <span class=\"px-3 py-1 bg-cyan-50 text-cyan-700 rounded-full text-xs font-semibold uppercase tracking-wider mt-2\">";
        // line 46
        yield (((($tmp = (isset($context["isTherapist"]) || array_key_exists("isTherapist", $context) ? $context["isTherapist"] : (function () { throw new RuntimeError('Variable "isTherapist" does not exist.', 46, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("Praticien") : ("Utilisateur"));
        yield "</span>
                </div>
            </div>

            <div class=\"bg-white rounded-[1.5rem] p-6 shadow-sm border border-[#e5f7f6]\">
                <h3 class=\"text-[#3c494c] font-semibold mb-4\">Sécurité</h3>
                <a href=\"";
        // line 52
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_profile_change_password");
        yield "\" class=\"w-full flex items-center justify-between px-4 py-3 rounded-xl bg-slate-50 text-slate-700 hover:bg-slate-100 transition font-medium text-sm\">
                    Modifier le mot de passe
                    <svg class=\"w-4 h-4\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 5l7 7-7 7\"></path></svg>
                </a>
            </div>
        </div>

        <!-- Right Column: Profile Form -->
        <div class=\"md:col-span-2\">
            <form method=\"POST\" class=\"bg-white rounded-[2rem] p-8 lg:p-10 shadow-sm border border-[#e5f7f6]\">
                <h3 class=\"text-xl font-bold text-[#0e1e1e] mb-6\">Informations Personnelles</h3>
                
                <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6 mb-6\">
                    <div class=\"space-y-2\">
                        <label class=\"block text-sm font-medium text-slate-700 ml-1\">Prénom</label>
                        <input type=\"text\" name=\"firstName\" value=\"";
        // line 67
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 67, $this->source); })()), "firstName", [], "any", false, false, false, 67), "html", null, true);
        yield "\" required
                               class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                    </div>
                    <div class=\"space-y-2\">
                        <label class=\"block text-sm font-medium text-slate-700 ml-1\">Nom</label>
                        <input type=\"text\" name=\"lastName\" value=\"";
        // line 72
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 72, $this->source); })()), "lastName", [], "any", false, false, false, 72), "html", null, true);
        yield "\" required
                               class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                    </div>
                </div>

                <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6 mb-6\">
                    <div class=\"space-y-2\">
                        <label class=\"block text-sm font-medium text-slate-700 ml-1\">Email (Non modifiable)</label>
                        <input type=\"email\" value=\"";
        // line 80
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 80, $this->source); })()), "email", [], "any", false, false, false, 80), "html", null, true);
        yield "\" disabled
                               class=\"w-full h-12 bg-slate-100 border-0 rounded-xl px-4 text-slate-500 cursor-not-allowed\">
                    </div>
                    <div class=\"space-y-2\">
                        <label class=\"block text-sm font-medium text-slate-700 ml-1\">Téléphone</label>
                        <input type=\"text\" name=\"phoneNumber\" value=\"";
        // line 85
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 85, $this->source); })()), "phoneNumber", [], "any", false, false, false, 85), "html", null, true);
        yield "\"
                               class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                    </div>
                </div>

                <div class=\"space-y-2 mb-6\">
                    <label class=\"block text-sm font-medium text-slate-700 ml-1\">Bio</label>
                    <textarea name=\"bio\" rows=\"4\"
                              class=\"w-full bg-slate-50 border-0 rounded-xl p-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all resize-none\">";
        // line 93
        yield (((($tmp = (isset($context["isTherapist"]) || array_key_exists("isTherapist", $context) ? $context["isTherapist"] : (function () { throw new RuntimeError('Variable "isTherapist" does not exist.', 93, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 93, $this->source); })()), "therapistProfile", [], "any", false, false, false, 93), "bio", [], "any", false, false, false, 93), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 93, $this->source); })()), "clientProfile", [], "any", false, false, false, 93), "bio", [], "any", false, false, false, 93), "html", null, true)));
        yield "</textarea>
                </div>

                ";
        // line 96
        if ((($tmp = (isset($context["isTherapist"]) || array_key_exists("isTherapist", $context) ? $context["isTherapist"] : (function () { throw new RuntimeError('Variable "isTherapist" does not exist.', 96, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 97
            yield "                <div class=\"space-y-6 pt-6 border-t border-slate-100 mb-6\">
                    <h3 class=\"text-xl font-bold text-[#0e1e1e]\">Informations Professionnelles</h3>
                    
                    <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6\">
                        <div class=\"space-y-2\">
                            <label class=\"block text-sm font-medium text-slate-700 ml-1\">Spécialisation</label>
                            <input type=\"text\" name=\"specialization\" value=\"";
            // line 103
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 103, $this->source); })()), "therapistProfile", [], "any", false, false, false, 103), "specialization", [], "any", false, false, false, 103), "html", null, true);
            yield "\" required
                                   class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                        </div>
                        <div class=\"space-y-2\">
                            <label class=\"block text-sm font-medium text-slate-700 ml-1\">N° de licence (Optionnel)</label>
                            <input type=\"text\" name=\"licenseNumber\" value=\"";
            // line 108
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 108, $this->source); })()), "therapistProfile", [], "any", false, false, false, 108), "licenseNumber", [], "any", false, false, false, 108), "html", null, true);
            yield "\"
                                   class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                        </div>
                    </div>
                    
                    <p class=\"text-sm text-amber-600 bg-amber-50 p-3 rounded-xl border border-amber-100 flex gap-2 items-center\">
                        <svg class=\"w-5 h-5 shrink-0\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"></path></svg>
                        Votre position de cabinet (Carte Leaflet) se configure directement depuis l'onglet \"Carte des thérapeutes\".
                    </p>
                </div>
                ";
        }
        // line 119
        yield "
                <div class=\"flex justify-end pt-4\">
                    <button type=\"submit\" class=\"px-8 py-3 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-semibold shadow-[0_8px_24px_-8px_rgba(0,188,212,0.5)] transition-all\">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
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
        return "pages/profile/view.html.twig";
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
        return array (  289 => 119,  275 => 108,  267 => 103,  259 => 97,  257 => 96,  251 => 93,  240 => 85,  232 => 80,  221 => 72,  213 => 67,  195 => 52,  186 => 46,  182 => 45,  175 => 41,  168 => 36,  161 => 33,  158 => 32,  152 => 30,  150 => 29,  139 => 20,  130 => 17,  126 => 15,  121 => 14,  112 => 11,  108 => 9,  104 => 8,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}Mon Profil{% endblock %}

{% block content %}
<div class=\"max-w-4xl mx-auto space-y-8\">
    
    {% for message in app.flashes('success') %}
        <div class=\"p-4 rounded-xl bg-emerald-50 text-emerald-700 text-sm font-medium border border-emerald-100 flex items-center gap-3\">
            <svg class=\"w-5 h-5 shrink-0\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M5 13l4 4L19 7\"></path></svg>
            {{ message }}
        </div>
    {% endfor %}
    {% for message in app.flashes('error') %}
        <div class=\"p-4 rounded-xl bg-red-50 text-red-600 text-sm font-medium border border-red-100 flex items-center gap-3\">
            <svg class=\"w-5 h-5 shrink-0\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"></path></svg>
            {{ message }}
        </div>
    {% endfor %}

    <div class=\"grid grid-cols-1 md:grid-cols-3 gap-8\">
        
        <!-- Left Column: Avatar & Quick Actions -->
        <div class=\"md:col-span-1 space-y-6\">
            <div class=\"bg-white rounded-[2rem] p-8 shadow-sm border border-[#e5f7f6] flex flex-col items-center relative overflow-hidden\">
                <div class=\"absolute inset-0 bg-gradient-to-b from-[#ebfdfc] to-transparent h-1/2\"></div>
                <div class=\"relative z-10 flex flex-col items-center\">
                    <div class=\"w-32 h-32 rounded-full bg-slate-100 border-4 border-white shadow-md overflow-hidden mb-4 relative group cursor-pointer\" onclick=\"document.getElementById('profilePicture').click()\">
                        {% if user.profilePictureUrl %}
                            <img src=\"{{ user.profilePictureUrl }}\" alt=\"Profile\" class=\"w-full h-full object-cover\">
                        {% else %}
                            <div class=\"w-full h-full bg-gradient-to-br from-[#00bcd4] to-[#006876] flex items-center justify-center text-white text-4xl font-bold\">
                                {{ user.firstName|first|upper }}{{ user.lastName|first|upper }}
                            </div>
                        {% endif %}
                        <div class=\"absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity\">
                            <svg class=\"w-8 h-8 text-white\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z\"></path><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M15 13a3 3 0 11-6 0 3 3 0 016 0z\"></path></svg>
                        </div>
                    </div>
                    
                    <form action=\"{{ path('app_profile_picture') }}\" method=\"POST\" enctype=\"multipart/form-data\" class=\"hidden\">
                        <input type=\"file\" name=\"profilePicture\" id=\"profilePicture\" accept=\"image/*\" onchange=\"this.form.submit()\">
                    </form>

                    <h2 class=\"text-xl font-bold text-[#0e1e1e] text-center\">{{ user.fullName }}</h2>
                    <span class=\"px-3 py-1 bg-cyan-50 text-cyan-700 rounded-full text-xs font-semibold uppercase tracking-wider mt-2\">{{ isTherapist ? 'Praticien' : 'Utilisateur' }}</span>
                </div>
            </div>

            <div class=\"bg-white rounded-[1.5rem] p-6 shadow-sm border border-[#e5f7f6]\">
                <h3 class=\"text-[#3c494c] font-semibold mb-4\">Sécurité</h3>
                <a href=\"{{ path('app_profile_change_password') }}\" class=\"w-full flex items-center justify-between px-4 py-3 rounded-xl bg-slate-50 text-slate-700 hover:bg-slate-100 transition font-medium text-sm\">
                    Modifier le mot de passe
                    <svg class=\"w-4 h-4\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 5l7 7-7 7\"></path></svg>
                </a>
            </div>
        </div>

        <!-- Right Column: Profile Form -->
        <div class=\"md:col-span-2\">
            <form method=\"POST\" class=\"bg-white rounded-[2rem] p-8 lg:p-10 shadow-sm border border-[#e5f7f6]\">
                <h3 class=\"text-xl font-bold text-[#0e1e1e] mb-6\">Informations Personnelles</h3>
                
                <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6 mb-6\">
                    <div class=\"space-y-2\">
                        <label class=\"block text-sm font-medium text-slate-700 ml-1\">Prénom</label>
                        <input type=\"text\" name=\"firstName\" value=\"{{ user.firstName }}\" required
                               class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                    </div>
                    <div class=\"space-y-2\">
                        <label class=\"block text-sm font-medium text-slate-700 ml-1\">Nom</label>
                        <input type=\"text\" name=\"lastName\" value=\"{{ user.lastName }}\" required
                               class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                    </div>
                </div>

                <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6 mb-6\">
                    <div class=\"space-y-2\">
                        <label class=\"block text-sm font-medium text-slate-700 ml-1\">Email (Non modifiable)</label>
                        <input type=\"email\" value=\"{{ user.email }}\" disabled
                               class=\"w-full h-12 bg-slate-100 border-0 rounded-xl px-4 text-slate-500 cursor-not-allowed\">
                    </div>
                    <div class=\"space-y-2\">
                        <label class=\"block text-sm font-medium text-slate-700 ml-1\">Téléphone</label>
                        <input type=\"text\" name=\"phoneNumber\" value=\"{{ user.phoneNumber }}\"
                               class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                    </div>
                </div>

                <div class=\"space-y-2 mb-6\">
                    <label class=\"block text-sm font-medium text-slate-700 ml-1\">Bio</label>
                    <textarea name=\"bio\" rows=\"4\"
                              class=\"w-full bg-slate-50 border-0 rounded-xl p-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all resize-none\">{{ isTherapist ? user.therapistProfile.bio : user.clientProfile.bio }}</textarea>
                </div>

                {% if isTherapist %}
                <div class=\"space-y-6 pt-6 border-t border-slate-100 mb-6\">
                    <h3 class=\"text-xl font-bold text-[#0e1e1e]\">Informations Professionnelles</h3>
                    
                    <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6\">
                        <div class=\"space-y-2\">
                            <label class=\"block text-sm font-medium text-slate-700 ml-1\">Spécialisation</label>
                            <input type=\"text\" name=\"specialization\" value=\"{{ user.therapistProfile.specialization }}\" required
                                   class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                        </div>
                        <div class=\"space-y-2\">
                            <label class=\"block text-sm font-medium text-slate-700 ml-1\">N° de licence (Optionnel)</label>
                            <input type=\"text\" name=\"licenseNumber\" value=\"{{ user.therapistProfile.licenseNumber }}\"
                                   class=\"w-full h-12 bg-slate-50 border-0 rounded-xl px-4 text-slate-800 focus:ring-2 focus:ring-cyan-400 focus:bg-white transition-all\">
                        </div>
                    </div>
                    
                    <p class=\"text-sm text-amber-600 bg-amber-50 p-3 rounded-xl border border-amber-100 flex gap-2 items-center\">
                        <svg class=\"w-5 h-5 shrink-0\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"></path></svg>
                        Votre position de cabinet (Carte Leaflet) se configure directement depuis l'onglet \"Carte des thérapeutes\".
                    </p>
                </div>
                {% endif %}

                <div class=\"flex justify-end pt-4\">
                    <button type=\"submit\" class=\"px-8 py-3 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-semibold shadow-[0_8px_24px_-8px_rgba(0,188,212,0.5)] transition-all\">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{% endblock %}
", "pages/profile/view.html.twig", "C:\\Users\\wiem\\Desktop\\SYmfonymerged\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\profile\\view.html.twig");
    }
}
