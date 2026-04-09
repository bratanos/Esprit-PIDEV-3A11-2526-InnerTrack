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

/* pages/map/map.html.twig */
class __TwigTemplate_6a5ae7f7f9b18ab826a47ace6164cd6f extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/map/map.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "pages/map/map.html.twig"));

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

        yield "Carte des thérapeutes
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 6
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

        // line 7
        yield "\t<link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet@1.9.4/dist/leaflet.css\"/>
\t<script src=\"https://unpkg.com/leaflet@1.9.4/dist/leaflet.js\"></script>

\t<div
\t\tclass=\"h-[calc(100vh-140px)] flex gap-6\">

\t\t<!-- Leaflet Map Container -->
\t\t<div id=\"map\" class=\"flex-1 rounded-[2rem] shadow-[0_32px_64px_-16px_rgba(0,104,118,0.08)] border-4 border-white z-0 overflow-hidden relative group\">
\t\t\t";
        // line 15
        if (CoreExtension::inFilter("ROLE_PSYCHOLOGUE", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 15, $this->source); })()), "user", [], "any", false, false, false, 15), "roles", [], "any", false, false, false, 15))) {
            // line 16
            yield "\t\t\t\t<div class=\"absolute top-4 right-4 z-[1000]\">
\t\t\t\t\t<button onclick=\"enableLocationSetup()\" class=\"px-5 py-2.5 bg-cyan-600/90 backdrop-blur-md text-white font-semibold rounded-xl shadow-lg hover:bg-cyan-700 flex items-center gap-2\">
\t\t\t\t\t\t<svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewbox=\"0 0 24 24\">
\t\t\t\t\t\t\t<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z\"></path>
\t\t\t\t\t\t</svg>
\t\t\t\t\t\tDéfinir ma position de cabinet
\t\t\t\t\t</button>
\t\t\t\t</div>
\t\t\t\t<div id=\"setup-banner\" class=\"hidden absolute top-0 left-0 w-full bg-emerald-500/90 backdrop-blur-md text-white py-3 text-center z-[1000] font-semibold flex justify-center items-center gap-4\">
\t\t\t\t\tCliquez n'importe où sur la carte pour placer votre cabinet.
\t\t\t\t\t<button onclick=\"cancelLocationSetup()\" class=\"px-3 py-1 bg-white/20 hover:bg-white/30 rounded-lg text-sm\">Annuler</button>
\t\t\t\t</div>
\t\t\t";
        }
        // line 29
        yield "\t\t</div>

\t\t<!-- Info Panel -->
\t\t<div class=\"w-96 bg-white rounded-[2rem] shadow-sm border border-[#e5f7f6] p-8 flex flex-col shrink-0 overflow-y-auto\">
\t\t\t<h2 class=\"text-2xl font-bold text-[#0e1e1e] mb-2 tracking-tight\">Détails</h2>
\t\t\t<p class=\"text-slate-500 text-sm font-medium mb-6\">Sélectionnez un marqueur pour voir les informations du thérapeute.</p>

\t\t\t<div id=\"therapist-info\" class=\"hidden flex-1 flex flex-col\">
\t\t\t\t<div class=\"flex items-center gap-4 mb-6\">
\t\t\t\t\t<div id=\"t-avatar\" class=\"w-16 h-16 rounded-full bg-gradient-to-br from-[#00bcd4] to-[#006876] flex items-center justify-center text-white text-2xl font-bold shadow-md\"></div>
\t\t\t\t\t<div>
\t\t\t\t\t\t<h3 id=\"t-name\" class=\"text-xl font-bold text-[#0e1e1e]\"></h3>
\t\t\t\t\t\t<p id=\"t-spec\" class=\"text-sm text-[#006876] font-semibold bg-cyan-50 inline-block px-2 py-0.5 rounded-full mt-1\"></p>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"space-y-4 flex-1\">
\t\t\t\t\t<div>
\t\t\t\t\t\t<h4 class=\"text-xs font-bold text-slate-400 uppercase tracking-wider mb-1\">Adresse</h4>
\t\t\t\t\t\t<p id=\"t-address\" class=\"text-slate-700 font-medium\"></p>
\t\t\t\t\t</div>
\t\t\t\t\t<div>
\t\t\t\t\t\t<h4 class=\"text-xs font-bold text-slate-400 uppercase tracking-wider mb-1\">À propos</h4>
\t\t\t\t\t\t<p id=\"t-bio\" class=\"text-slate-600 text-sm leading-relaxed max-h-32 overflow-y-auto pr-2 custom-scrollbar\"></p>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"mt-8 pt-6 border-t border-slate-100\">
\t\t\t\t\t<button id=\"btn-contact\" onclick=\"contactTherapist()\" class=\"w-full h-14 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-lg shadow-[0_8px_24px_-8px_rgba(16,185,129,0.5)] transition-all\">
\t\t\t\t\t\tPrendre contact
\t\t\t\t\t</button>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div id=\"empty-state\" class=\"flex-1 flex flex-col items-center justify-center text-center opacity-50 mt-10\">
\t\t\t\t<svg class=\"w-16 h-16 text-slate-300 mb-4\" fill=\"none\" stroke=\"currentColor\" viewbox=\"0 0 24 24\">
\t\t\t\t\t<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"1.5\" d=\"M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7\"></path>
\t\t\t\t</svg>
\t\t\t\t<p>La carte est à votre disposition.</p>
\t\t\t</div>
\t\t</div>
\t</div>

\t<script>
\t\t// Fix missing Leaflet marker icons
\t\tdelete L.Icon.Default.prototype._getIconUrl;
\t\tL.Icon.Default.mergeOptions({
\t\t\ticonRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
\t\t\ticonUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
\t\t\tshadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
\t\t});

\t\t// Initialize Map
const map = L.map('map').setView([
36.781678, 10.188344
], 12); // Default TUNIS
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
maxZoom: 19,
attribution: '© OpenStreetMap InnerTrack'
}).addTo(map);

let therapists = [];
let currentSelectedId = null;
let setupMode = false;

// Load markers
fetch('/map/api/therapists').then(res => res.json()).then(data => {
therapists = data;
data.forEach(t => {
const marker = L.marker([t.lat, t.lng]).addTo(map);
marker.on('click', () => showInfo(t));

// If it's me
if (t.id === ";
        // line 102
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 102, $this->source); })()), "user", [], "any", false, false, false, 102), "id", [], "any", false, false, false, 102), "html", null, true);
        yield ") {
map.setView([
t.lat, t.lng
], 14);
}
});

// Auto fit bounds if many
if (data.length > 0 && !";
        // line 110
        yield (((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 110, $this->source); })()), "user", [], "any", false, false, false, 110), "therapistProfile", [], "any", false, false, false, 110)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("true") : ("false"));
        yield ") {
const group = new L.featureGroup(data.map(t => L.marker([t.lat, t.lng])));
map.fitBounds(group.getBounds().pad(0.1));
}
});

function showInfo(t) {
currentSelectedId = t.id;
document.getElementById('empty-state').classList.add('hidden');
document.getElementById('therapist-info').classList.remove('hidden');

document.getElementById('t-name').innerText = 'Dr. ' + t.name.split(' ').pop();
document.getElementById('t-avatar').innerText = t.name.charAt(0);
document.getElementById('t-spec').innerText = t.specialization || 'Généraliste';
document.getElementById('t-address').innerText = t.address || 'Adresse non communiquée';
document.getElementById('t-bio').innerText = t.bio || 'Aucune description fournie.';

const btn = document.getElementById('btn-contact');
if (t.id === ";
        // line 128
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 128, $this->source); })()), "user", [], "any", false, false, false, 128), "id", [], "any", false, false, false, 128), "html", null, true);
        yield ") {
btn.classList.add('hidden');
} else {
btn.classList.remove('hidden');
}
}

function contactTherapist() {
if (! currentSelectedId) 
return;



fetch (`/map/contact/\${currentSelectedId}`, {
method: 'POST',
body: JSON.stringify(
{message: \"Bonjour, je souhaite prendre contact avec vous via la carte InnerTrack.\"}
)
}).then(res => res.json()).then(data => {
if (data.success) {
alert(\"Demande envoyée au thérapeute.\");
} else {
alert(data.message || \"Erreur lors de l'envoi.\");
}
});
}

// Interactive placement for therapists
function enableLocationSetup() {
setupMode = true;
document.getElementById('setup-banner').classList.remove('hidden');
document.getElementById('map').style.cursor = 'crosshair';
}

function cancelLocationSetup() {
setupMode = false;
document.getElementById('setup-banner').classList.add('hidden');
document.getElementById('map').style.cursor = '';
}

map.on('click', function (e) {
if (! setupMode) 
return;



const address = prompt(\"Voulez-vous préciser l'adresse textuelle de ce repère ? (Optionnel)\");

fetch('/map/api/setup', {
method: 'POST',
headers: {
'Content-Type': 'application/json'
},
body: JSON.stringify(
{lat: e.latlng.lat, lng: e.latlng.lng, address: address}
)
}).then(res => res.json()).then(data => {
if (data.success) {
alert(\"Position de cabinet enregistrée avec succès.\");
location.reload();
}
});

cancelLocationSetup();
});
\t</script>

\t<style>
\t\t/* Styling scrollbar in bio */
\t\t.custom-scrollbar::-webkit-scrollbar {
\t\t\twidth: 4px;
\t\t}
\t\t.custom-scrollbar::-webkit-scrollbar-track {
\t\t\tbackground: transparent;
\t\t}
\t\t.custom-scrollbar::-webkit-scrollbar-thumb {
\t\t\tbackground: #cbd5e1;
\t\t\tborder-radius: 4px;
\t\t}
\t</style>
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
        return "pages/map/map.html.twig";
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
        return array (  235 => 128,  214 => 110,  203 => 102,  128 => 29,  113 => 16,  111 => 15,  101 => 7,  88 => 6,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'layouts/dashboard.html.twig' %}

{% block header_title %}Carte des thérapeutes
{% endblock %}

{% block content %}
\t<link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet@1.9.4/dist/leaflet.css\"/>
\t<script src=\"https://unpkg.com/leaflet@1.9.4/dist/leaflet.js\"></script>

\t<div
\t\tclass=\"h-[calc(100vh-140px)] flex gap-6\">

\t\t<!-- Leaflet Map Container -->
\t\t<div id=\"map\" class=\"flex-1 rounded-[2rem] shadow-[0_32px_64px_-16px_rgba(0,104,118,0.08)] border-4 border-white z-0 overflow-hidden relative group\">
\t\t\t{% if 'ROLE_PSYCHOLOGUE' in app.user.roles %}
\t\t\t\t<div class=\"absolute top-4 right-4 z-[1000]\">
\t\t\t\t\t<button onclick=\"enableLocationSetup()\" class=\"px-5 py-2.5 bg-cyan-600/90 backdrop-blur-md text-white font-semibold rounded-xl shadow-lg hover:bg-cyan-700 flex items-center gap-2\">
\t\t\t\t\t\t<svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewbox=\"0 0 24 24\">
\t\t\t\t\t\t\t<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z\"></path>
\t\t\t\t\t\t</svg>
\t\t\t\t\t\tDéfinir ma position de cabinet
\t\t\t\t\t</button>
\t\t\t\t</div>
\t\t\t\t<div id=\"setup-banner\" class=\"hidden absolute top-0 left-0 w-full bg-emerald-500/90 backdrop-blur-md text-white py-3 text-center z-[1000] font-semibold flex justify-center items-center gap-4\">
\t\t\t\t\tCliquez n'importe où sur la carte pour placer votre cabinet.
\t\t\t\t\t<button onclick=\"cancelLocationSetup()\" class=\"px-3 py-1 bg-white/20 hover:bg-white/30 rounded-lg text-sm\">Annuler</button>
\t\t\t\t</div>
\t\t\t{% endif %}
\t\t</div>

\t\t<!-- Info Panel -->
\t\t<div class=\"w-96 bg-white rounded-[2rem] shadow-sm border border-[#e5f7f6] p-8 flex flex-col shrink-0 overflow-y-auto\">
\t\t\t<h2 class=\"text-2xl font-bold text-[#0e1e1e] mb-2 tracking-tight\">Détails</h2>
\t\t\t<p class=\"text-slate-500 text-sm font-medium mb-6\">Sélectionnez un marqueur pour voir les informations du thérapeute.</p>

\t\t\t<div id=\"therapist-info\" class=\"hidden flex-1 flex flex-col\">
\t\t\t\t<div class=\"flex items-center gap-4 mb-6\">
\t\t\t\t\t<div id=\"t-avatar\" class=\"w-16 h-16 rounded-full bg-gradient-to-br from-[#00bcd4] to-[#006876] flex items-center justify-center text-white text-2xl font-bold shadow-md\"></div>
\t\t\t\t\t<div>
\t\t\t\t\t\t<h3 id=\"t-name\" class=\"text-xl font-bold text-[#0e1e1e]\"></h3>
\t\t\t\t\t\t<p id=\"t-spec\" class=\"text-sm text-[#006876] font-semibold bg-cyan-50 inline-block px-2 py-0.5 rounded-full mt-1\"></p>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"space-y-4 flex-1\">
\t\t\t\t\t<div>
\t\t\t\t\t\t<h4 class=\"text-xs font-bold text-slate-400 uppercase tracking-wider mb-1\">Adresse</h4>
\t\t\t\t\t\t<p id=\"t-address\" class=\"text-slate-700 font-medium\"></p>
\t\t\t\t\t</div>
\t\t\t\t\t<div>
\t\t\t\t\t\t<h4 class=\"text-xs font-bold text-slate-400 uppercase tracking-wider mb-1\">À propos</h4>
\t\t\t\t\t\t<p id=\"t-bio\" class=\"text-slate-600 text-sm leading-relaxed max-h-32 overflow-y-auto pr-2 custom-scrollbar\"></p>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"mt-8 pt-6 border-t border-slate-100\">
\t\t\t\t\t<button id=\"btn-contact\" onclick=\"contactTherapist()\" class=\"w-full h-14 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-lg shadow-[0_8px_24px_-8px_rgba(16,185,129,0.5)] transition-all\">
\t\t\t\t\t\tPrendre contact
\t\t\t\t\t</button>
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div id=\"empty-state\" class=\"flex-1 flex flex-col items-center justify-center text-center opacity-50 mt-10\">
\t\t\t\t<svg class=\"w-16 h-16 text-slate-300 mb-4\" fill=\"none\" stroke=\"currentColor\" viewbox=\"0 0 24 24\">
\t\t\t\t\t<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"1.5\" d=\"M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7\"></path>
\t\t\t\t</svg>
\t\t\t\t<p>La carte est à votre disposition.</p>
\t\t\t</div>
\t\t</div>
\t</div>

\t<script>
\t\t// Fix missing Leaflet marker icons
\t\tdelete L.Icon.Default.prototype._getIconUrl;
\t\tL.Icon.Default.mergeOptions({
\t\t\ticonRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
\t\t\ticonUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
\t\t\tshadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
\t\t});

\t\t// Initialize Map
const map = L.map('map').setView([
36.781678, 10.188344
], 12); // Default TUNIS
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
maxZoom: 19,
attribution: '© OpenStreetMap InnerTrack'
}).addTo(map);

let therapists = [];
let currentSelectedId = null;
let setupMode = false;

// Load markers
fetch('/map/api/therapists').then(res => res.json()).then(data => {
therapists = data;
data.forEach(t => {
const marker = L.marker([t.lat, t.lng]).addTo(map);
marker.on('click', () => showInfo(t));

// If it's me
if (t.id === {{ app.user.id }}) {
map.setView([
t.lat, t.lng
], 14);
}
});

// Auto fit bounds if many
if (data.length > 0 && !{{ app.user.therapistProfile ? 'true' : 'false' }}) {
const group = new L.featureGroup(data.map(t => L.marker([t.lat, t.lng])));
map.fitBounds(group.getBounds().pad(0.1));
}
});

function showInfo(t) {
currentSelectedId = t.id;
document.getElementById('empty-state').classList.add('hidden');
document.getElementById('therapist-info').classList.remove('hidden');

document.getElementById('t-name').innerText = 'Dr. ' + t.name.split(' ').pop();
document.getElementById('t-avatar').innerText = t.name.charAt(0);
document.getElementById('t-spec').innerText = t.specialization || 'Généraliste';
document.getElementById('t-address').innerText = t.address || 'Adresse non communiquée';
document.getElementById('t-bio').innerText = t.bio || 'Aucune description fournie.';

const btn = document.getElementById('btn-contact');
if (t.id === {{ app.user.id }}) {
btn.classList.add('hidden');
} else {
btn.classList.remove('hidden');
}
}

function contactTherapist() {
if (! currentSelectedId) 
return;



fetch (`/map/contact/\${currentSelectedId}`, {
method: 'POST',
body: JSON.stringify(
{message: \"Bonjour, je souhaite prendre contact avec vous via la carte InnerTrack.\"}
)
}).then(res => res.json()).then(data => {
if (data.success) {
alert(\"Demande envoyée au thérapeute.\");
} else {
alert(data.message || \"Erreur lors de l'envoi.\");
}
});
}

// Interactive placement for therapists
function enableLocationSetup() {
setupMode = true;
document.getElementById('setup-banner').classList.remove('hidden');
document.getElementById('map').style.cursor = 'crosshair';
}

function cancelLocationSetup() {
setupMode = false;
document.getElementById('setup-banner').classList.add('hidden');
document.getElementById('map').style.cursor = '';
}

map.on('click', function (e) {
if (! setupMode) 
return;



const address = prompt(\"Voulez-vous préciser l'adresse textuelle de ce repère ? (Optionnel)\");

fetch('/map/api/setup', {
method: 'POST',
headers: {
'Content-Type': 'application/json'
},
body: JSON.stringify(
{lat: e.latlng.lat, lng: e.latlng.lng, address: address}
)
}).then(res => res.json()).then(data => {
if (data.success) {
alert(\"Position de cabinet enregistrée avec succès.\");
location.reload();
}
});

cancelLocationSetup();
});
\t</script>

\t<style>
\t\t/* Styling scrollbar in bio */
\t\t.custom-scrollbar::-webkit-scrollbar {
\t\t\twidth: 4px;
\t\t}
\t\t.custom-scrollbar::-webkit-scrollbar-track {
\t\t\tbackground: transparent;
\t\t}
\t\t.custom-scrollbar::-webkit-scrollbar-thumb {
\t\t\tbackground: #cbd5e1;
\t\t\tborder-radius: 4px;
\t\t}
\t</style>
{% endblock %}
", "pages/map/map.html.twig", "C:\\Users\\user\\Documents\\fuck2\\Esprit-PIDEV-3A11-2526-InnerTrack\\backend\\templates\\pages\\map\\map.html.twig");
    }
}
