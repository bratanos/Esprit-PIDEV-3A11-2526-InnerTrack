import os
import re
import yaml

files_to_process = {
    'templates/pages/dashboard/admin.html.twig': [
        (r'Monthly Signups / Inscriptions mensuelles', r"{{ 'Monthly Signups'|trans }}"),
        (r'No registration data yet / Aucune inscription enregistrée', r"{{ 'No registration data yet'|trans }}"),
        (r'Secure drop / Dépôt sécurisé', r"{{ 'Secure drop'|trans }}"),
        (r'Target / Cible', r"{{ 'Target'|trans }}"),
        (r'Community Reports / Signalements communautaires', r"{{ 'Community Reports'|trans }}"),
        (r'Reported user / Cible', r"{{ 'Reported user'|trans }}"),
        (r'Post content / Contenu', r"{{ 'Post content'|trans }}"),
        (r'User / Utilisateur', r"{{ 'User'|trans }}"),
        (r'All statuses / Tous les statuts', r"{{ 'All statuses'|trans }}"),
        (r'Active / Actif', r"{{ 'Active'|trans }}"),
        (r'Blocked / Bloqué', r"{{ 'Blocked'|trans }}"),
        (r'Pending / En attente', r"{{ 'Pending'|trans }}"),
        (r'Phone / Téléphone', r"{{ 'Phone'|trans }}"),
        (r'Role / Rôle', r"{{ 'Role'|trans }}"),
        (r'Status / Statut', r"{{ 'Status'|trans }}"),
        (r'Psychologist / Psychologue', r"{{ 'Psychologist'|trans }}"),
        (r'Edit / Modifier', r"{{ 'Edit'|trans }}"),
        (r"Edit user / Modifier l\\'utilisateur", r"{{ 'Edit user'|trans|escape('js') }}"),
        (r"Create user / Créer un utilisateur", r"{{ 'Create user'|trans|escape('js') }}"),
        (r'First Name / Prénom', r"{{ 'First Name'|trans }}"),
        (r'Last Name / Nom', r"{{ 'Last Name'|trans }}"),
        (r'Password / Mot de passe', r"{{ 'Password'|trans }}"),
        (r'\(leave blank to keep current / laisser vide pour ne pas changer\)', r"({{ 'leave blank to keep current'|trans }})"),
        (r'Cancel / Annuler', r"{{ 'Cancel'|trans }}"),
        (r'Save User / Enregistrer', r"{{ 'Save User'|trans }}"),
        (r"Delete User / Supprimer l'utilisateur", r"{{ 'Delete User'|trans }}"),
        (r'Are you sure you want to delete / Êtes-vous sûr de vouloir supprimer', r"{{ 'Are you sure you want to delete'|trans|escape('js') }}"),
        (r'This action cannot be undone. / Cette action est irréversible.', r"{{ 'This action cannot be undone.'|trans }}"),
        (r'Delete / Supprimer', r"{{ 'Delete'|trans }}")
    ],
    'templates/pages/dashboard/user.html.twig': [
        (r"TODAY / AUJOURD'HUI", r"{{ 'TODAY'|trans }}"),
        (r'Therapy Plan Update / Mise à jour', r"{{ 'Therapy Plan Update'|trans }}"),
        (r'Dr\. Rossi added the "Morning Reflection" module\. / Dr\. Rossi a ajouté le module "Réflexion"\.', r"{{ 'Dr. Rossi added the \"Morning Reflection\" module.'|trans }}"),
        (r'2 hours ago / Il y a 2h', r"{{ '2 hours ago'|trans }}"),
        (r'New Milestone! / Nouvelle étape !', r"{{ 'New Milestone!'|trans }}"),
        (r'Completed your check-in for 7 days\. / Suivi complété sur 7 jours\.', r"{{ 'Completed your check-in for 7 days.'|trans }}"),
        (r'Yesterday / Hier', r"{{ 'Yesterday'|trans }}"),
        (r"View Activity History / Historique d'activité", r"{{ 'View Activity History'|trans }}"),
        (r'Weekly Focus / Focus de la semaine', r"{{ 'Weekly Focus'|trans }}"),
        (r"Dive into this week's curated exercise\. / Plongez dans cet exercice conçu pour vous\.", r"{{ 'Dive into this week\'s curated exercise.'|trans }}"),
        (r'Start Your Journey / Commencer', r"{{ 'Start Your Journey'|trans }}")
    ],
    'templates/pages/dashboard/therapist.html.twig': [
        (r'Welcome back / Bienvenue, ', r"{{ 'Welcome back, '|trans }}"),
        (r'Your sanctuary for patient care and therapeutic management\. / Votre espace de soins et de suivi thérapeutique\.', r"{{ 'Your sanctuary for patient care and therapeutic management.'|trans }}"),
        (r'Active Patients / Patients Actifs', r"{{ 'Active Patients'|trans }}"),
        (r'Pending Requests / Demandes', r"{{ 'Pending Requests'|trans }}"),
        (r'Unread Notifs / Non Lues', r"{{ 'Unread Notifs'|trans }}"),
        (r'Pending Contact Requests / Demandes de contact', r"{{ 'Pending Contact Requests'|trans }}"),
        (r'View all / Voir tout', r"{{ 'View all'|trans }}"),
        (r'Patient Name / Nom', r"{{ 'Patient Name'|trans }}"),
        (r'No specific message provided\.\.\. / Aucun message spécifique\.\.\.', r"{{ 'No specific message provided...'|trans }}"),
        (r'Accept / Accepter', r"{{ 'Accept'|trans }}"),
        (r'Decline / Refuser', r"{{ 'Decline'|trans }}"),
        (r"No pending contact requests\. You're all caught up! / Aucune demande en attente\.", r"{{ 'No pending contact requests. You\'re all caught up!'|trans }}"),
        (r'Recent Conversations / Conversations récentes', r"{{ 'Recent Conversations'|trans }}"),
        (r'Started a new conversation / Nouvelle conversation', r"{{ 'Started a new conversation'|trans }}"),
        (r'You have no active conversations yet\. / Aucune conversation active\.', r"{{ 'You have no active conversations yet.'|trans }}"),
        (r'Clinical Psychologist / Psychologue Clinicien', r"{{ 'Clinical Psychologist'|trans }}"),
        (r'Edit Profile / Modifier', r"{{ 'Edit Profile'|trans }}"),
        (r'Global Patient Progress / Progrès Global', r"{{ 'Global Patient Progress'|trans }}"),
        (r'Goal Reached / Objectif Atteint', r"{{ 'Goal Reached'|trans }}")
    ]
}

translations_fr = {
    'Monthly Signups': 'Inscriptions mensuelles',
    'No registration data yet': 'Aucune inscription enregistrée',
    'Secure drop': 'Dépôt sécurisé',
    'Target': 'Cible',
    'Community Reports': 'Signalements communautaires',
    'Reported user': 'Cible',
    'Post content': 'Contenu',
    'User': 'Utilisateur',
    'All statuses': 'Tous les statuts',
    'Active': 'Actif',
    'Blocked': 'Bloqué',
    'Pending': 'En attente',
    'Phone': 'Téléphone',
    'Role': 'Rôle',
    'Status': 'Statut',
    'Psychologist': 'Psychologue',
    'Edit': 'Modifier',
    'Edit user': "Modifier l'utilisateur",
    'Create user': 'Créer un utilisateur',
    'First Name': 'Prénom',
    'Last Name': 'Nom',
    'Password': 'Mot de passe',
    'leave blank to keep current': 'laisser vide pour ne pas changer',
    'Cancel': 'Annuler',
    'Save User': 'Enregistrer',
    'Delete User': "Supprimer l'utilisateur",
    'Are you sure you want to delete': 'Êtes-vous sûr de vouloir supprimer',
    'This action cannot be undone.': 'Cette action est irréversible.',
    'Delete': 'Supprimer',
    'TODAY': "AUJOURD'HUI",
    'Therapy Plan Update': 'Mise à jour',
    'Dr. Rossi added the "Morning Reflection" module.': 'Dr. Rossi a ajouté le module "Réflexion".',
    '2 hours ago': 'Il y a 2h',
    'New Milestone!': 'Nouvelle étape !',
    'Completed your check-in for 7 days.': 'Suivi complété sur 7 jours.',
    'Yesterday': 'Hier',
    'View Activity History': "Historique d'activité",
    'Weekly Focus': 'Focus de la semaine',
    "Dive into this week's curated exercise.": 'Plongez dans cet exercice conçu pour vous.',
    'Start Your Journey': 'Commencer',
    'Welcome back, ': 'Bienvenue, ',
    'Your sanctuary for patient care and therapeutic management.': 'Votre espace de soins et de suivi thérapeutique.',
    'Active Patients': 'Patients Actifs',
    'Pending Requests': 'Demandes',
    'Unread Notifs': 'Non Lues',
    'Pending Contact Requests': 'Demandes de contact',
    'View all': 'Voir tout',
    'Patient Name': 'Nom',
    'No specific message provided...': 'Aucun message spécifique...',
    'Accept': 'Accepter',
    'Decline': 'Refuser',
    "No pending contact requests. You're all caught up!": 'Aucune demande en attente.',
    'Recent Conversations': 'Conversations récentes',
    'Started a new conversation': 'Nouvelle conversation',
    'You have no active conversations yet.': 'Aucune conversation active.',
    'Clinical Psychologist': 'Psychologue Clinicien',
    'Edit Profile': 'Modifier',
    'Global Patient Progress': 'Progrès Global',
    'Goal Reached': 'Objectif Atteint'
}

base_path = r'c:\Users\Bratan\javafx-symfony-test\javafx-symfony-test\backend'

for rel_path, reps in files_to_process.items():
    full_path = os.path.join(base_path, rel_path)
    if os.path.exists(full_path):
        with open(full_path, 'r', encoding='utf-8') as f:
            content = f.read()
        
        for pattern, replacement in reps:
            content = re.sub(pattern, replacement, content)
            
        with open(full_path, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Processed {rel_path}")

fr_yaml_path = os.path.join(base_path, 'translations/messages.fr.yaml')
en_yaml_path = os.path.join(base_path, 'translations/messages.en.yaml')

# Append to FR translations
with open(fr_yaml_path, 'a', encoding='utf-8') as f:
    f.write("\n# Dynamically added translations\n")
    for en_text, fr_text in translations_fr.items():
        # Escape quotes if needed
        en_safe = en_text.replace('"', '\\"')
        fr_safe = fr_text.replace('"', '\\"')
        f.write(f'"{en_safe}": "{fr_safe}"\n')

# Append to EN translations
with open(en_yaml_path, 'a', encoding='utf-8') as f:
    f.write("\n# Dynamically added translations\n")
    for en_text, _ in translations_fr.items():
        en_safe = en_text.replace('"', '\\"')
        f.write(f'"{en_safe}": "{en_safe}"\n')

print("Updated yaml files.")
