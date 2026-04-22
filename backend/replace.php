<?php
$files = [
    'c:\\Users\\Bratan\\javafx-symfony-test\\javafx-symfony-test\\backend\\templates\\pages\\dashboard\\admin.html.twig',
    'c:\\Users\\Bratan\\javafx-symfony-test\\javafx-symfony-test\\backend\\templates\\pages\\dashboard\\user.html.twig',
    'c:\\Users\\Bratan\\javafx-symfony-test\\javafx-symfony-test\\backend\\templates\\pages\\dashboard\\therapist.html.twig'
];
$replaces = [
    'Overview / Vue d\'ensemble' => '{{ \'dashboard.overview\'|trans }}',
    'Users / Utilisateurs' => '{{ \'dashboard.tabs.users\'|trans }}',
    'Community / Communauté' => '{{ \'dashboard.tabs.community\'|trans }}',
    'Private Messages / Signalements Privés' => '{{ \'dashboard.tabs.messages\'|trans }}',
    'Reporter / Plaignant' => '{{ \'dashboard.reports.reporter\'|trans }}',
    'Reported / Signalé' => '{{ \'dashboard.reports.reported\'|trans }}',
    'Clean inbox / Canal de messagerie fluide' => '{{ \'dashboard.reports.clean_inbox\'|trans }}',
    'Community Clean / Espace communautaire sûr' => '{{ \'dashboard.reports.community_clean\'|trans }}',
    'No pending messages / Aucun signalement en attente' => '{{ \'dashboard.reports.no_pending\'|trans }}',
    'Good morning / Bonjour' => '{{ \'common.welcome\'|trans }}',
    'Daily goal: 12m Meditation / Objectif : 12m Méditation' => '{{ \'user_dashboard.activity\'|trans }}',
    'Active Conversations / Conv. actives' => '{{ \'user_dashboard.active_sessions\'|trans }}',
    'View all messages / Voir tout' => '{{ \'user_dashboard.messages\'|trans }}',
    'Unread Notifs / Non lues' => '{{ \'nav.notifications\'|trans }}',
    'Catch up now / Consulter' => '{{ \'user_dashboard.quick_actions\'|trans }}',
    'Your Care Team / Équipe de soins' => '{{ \'dashboard.therapist\'|trans }}',
    'Direct access to your primary therapists / Accès direct à vos praticiens' => '{{ \'dashboard.overview\'|trans }}',
    'Explore new matches / Trouver' => '{{ \'user_dashboard.find_therapist\'|trans }}',
    'Send Message / Écrire' => '{{ \'user_dashboard.messages\'|trans }}',
    'No active therapists yet / Aucun praticien actif' => '{{ \'therapist_dashboard.no_appointments\'|trans }}',
    'Find a therapist on the map / Trouver sur la carte' => '{{ \'user_dashboard.find_therapist\'|trans }}',
    'System Health / Santé système' => '{{ \'dashboard.system_health\'|trans }}',
    'DB Latency / Latence BDD' => '{{ \'dashboard.db_latency\'|trans }}',
    'API Load / Charge API' => '{{ \'dashboard.api_load\'|trans }}',
    'msgs/hr / msgs/h' => '{{ \'dashboard.messages_hour\'|trans }}',
    'Security / Sécurité' => '{{ \'dashboard.security_score\'|trans }}',
    'Health / Santé système' => '{{ \'dashboard.system_health\'|trans }}',
    'Activity / Activité' => '{{ \'user_dashboard.activity\'|trans }}',
    'Total Patients / Patients Totaux' => '{{ \'therapist_dashboard.total_patients\'|trans }}',
    'Sessions / Séances' => '{{ \'therapist_dashboard.sessions\'|trans }}',
    'Revenue / Revenus' => '{{ \'therapist_dashboard.revenue\'|trans }}',
    'Today / Aujourd\'hui' => '{{ \'therapist_dashboard.today\'|trans }}',
    'No appointments today / Aucun rendez-vous' => '{{ \'therapist_dashboard.no_appointments\'|trans }}',
    'Action / Action' => '{{ \'dashboard.reports.action\'|trans }}',
    'Reason / Raison' => '{{ \'dashboard.reports.reason\'|trans }}',
    'Date / Date' => '{{ \'dashboard.reports.date\'|trans }}',
    'Reported Post / Message signalé' => '{{ \'dashboard.reports.reported\'|trans }}',
    'Post Snippet / Extrait du post' => '{{ \'dashboard.reports.reported\'|trans }}',
    'Reported Comment / Commentaire signalé' => '{{ \'dashboard.reports.reported\'|trans }}',
    'Dismiss / Passer' => '{{ \'dashboard.reports.dismiss\'|trans }}',
    'Block / Bloquer' => '{{ \'dashboard.reports.ban\'|trans }}',
    'Delete / Supprimer' => '{{ \'dashboard.reports.delete_post\'|trans }}'
];
foreach($files as $f) { 
    $c = file_get_contents($f); 
    foreach($replaces as $s => $r) { 
        $c = str_replace($s, $r, $c); 
    } 
    file_put_contents($f, $c); 
    echo "Processed $f\n"; 
}
