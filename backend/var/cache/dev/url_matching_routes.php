<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin/chat-lock' => [[['_route' => 'admin_chat_lock_add', '_controller' => 'App\\Controller\\AdminController::addChatLock'], null, ['POST' => 0], null, false, false, null]],
        '/admin/users' => [[['_route' => 'admin_user_create', '_controller' => 'App\\Controller\\AdminController::createUser'], null, ['POST' => 0], null, false, false, null]],
        '/article' => [[['_route' => 'app_article_index', '_controller' => 'App\\Controller\\ArticleController::index'], null, ['GET' => 0], null, false, false, null]],
        '/article/new' => [[['_route' => 'app_article_new', '_controller' => 'App\\Controller\\ArticleController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/categorie' => [[['_route' => 'app_categorie_index', '_controller' => 'App\\Controller\\CategorieController::index'], null, ['GET' => 0], null, false, false, null]],
        '/categorie/new' => [[['_route' => 'app_categorie_new', '_controller' => 'App\\Controller\\CategorieController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/community' => [[['_route' => 'app_community_index', '_controller' => 'App\\Controller\\CommunityController::index'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/dashboard' => [[['_route' => 'app_dashboard', '_controller' => 'App\\Controller\\DashboardController::index'], null, null, null, false, false, null]],
        '/api/debug/me' => [[['_route' => 'app_debug_me', '_controller' => 'App\\Controller\\DebugController::me'], null, ['GET' => 0], null, false, false, null]],
        '/admin/events' => [[['_route' => 'admin_event_index', '_controller' => 'App\\Controller\\EventController::index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/events/new' => [[['_route' => 'admin_event_new', '_controller' => 'App\\Controller\\EventController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/inscriptions' => [[['_route' => 'admin_inscription_index', '_controller' => 'App\\Controller\\InscriptionController::index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/inscriptions/new' => [[['_route' => 'admin_inscription_new', '_controller' => 'App\\Controller\\InscriptionController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/journal/entree' => [[['_route' => 'entree_index', '_controller' => 'App\\Controller\\Journal\\EntreeJournalController::index'], null, null, null, true, false, null]],
        '/journal/entree/ajouter' => [[['_route' => 'entree_ajouter', '_controller' => 'App\\Controller\\Journal\\EntreeJournalController::ajouter'], null, null, null, false, false, null]],
        '/journal/entree/export/pdf' => [[['_route' => 'entree_export_pdf', '_controller' => 'App\\Controller\\Journal\\EntreeJournalController::exportPdf'], null, null, null, false, false, null]],
        '/journal/habitude' => [[['_route' => 'habitude_index', '_controller' => 'App\\Controller\\Journal\\HabitudeController::index'], null, null, null, true, false, null]],
        '/journal/habitude/ajouter' => [[['_route' => 'habitude_ajouter', '_controller' => 'App\\Controller\\Journal\\HabitudeController::ajouter'], null, null, null, false, false, null]],
        '/learning-path' => [[['_route' => 'app_learning_path_index', '_controller' => 'App\\Controller\\LearningPathController::index'], null, ['GET' => 0], null, true, false, null]],
        '/learning-path/new' => [
            [['_route' => 'app_learning_path_new', '_controller' => 'App\\Controller\\LearningPathController::new'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'app_learning_path_create', '_controller' => 'App\\Controller\\LearningPathController::create'], null, ['POST' => 0], null, false, false, null],
        ],
        '/map' => [[['_route' => 'app_map', '_controller' => 'App\\Controller\\MapController::index'], null, ['GET' => 0], null, false, false, null]],
        '/map/api/therapists' => [[['_route' => 'api_web_therapists', '_controller' => 'App\\Controller\\MapController::getTherapists'], null, ['GET' => 0], null, false, false, null]],
        '/map/api/setup' => [[['_route' => 'api_web_map_setup', '_controller' => 'App\\Controller\\MapController::setupLocation'], null, ['POST' => 0], null, false, false, null]],
        '/api/report' => [[['_route' => 'api_report_user', '_controller' => 'App\\Controller\\MessagingController::reportUser'], null, ['POST' => 0], null, false, false, null]],
        '/api/block' => [[['_route' => 'api_block_user', '_controller' => 'App\\Controller\\MessagingController::blockUser'], null, ['POST' => 0], null, false, false, null]],
        '/notifications' => [[['_route' => 'app_notifications', '_controller' => 'App\\Controller\\NotificationController::index'], null, null, null, false, false, null]],
        '/_internal/notifications/count' => [[['_route' => 'api_notifications_count', '_controller' => 'App\\Controller\\NotificationController::unreadCount'], null, ['GET' => 0], null, false, false, null]],
        '/_internal/notifications/read-all' => [[['_route' => 'api_notifications_read_all', '_controller' => 'App\\Controller\\NotificationController::markAllAsRead'], null, ['POST' => 0], null, false, false, null]],
        '/api/profile' => [[['_route' => 'api_profile', '_controller' => 'App\\Controller\\ProfileController::profile'], null, ['GET' => 0], null, false, false, null]],
        '/api/me' => [[['_route' => 'api_me', '_controller' => 'App\\Controller\\ProfileController::me'], null, ['GET' => 0], null, false, false, null]],
        '/settings' => [[['_route' => 'app_settings', '_controller' => 'App\\Controller\\SettingsController::index'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/_internal/settings/theme' => [[['_route' => 'api_settings_theme', '_controller' => 'App\\Controller\\SettingsController::updateTheme'], null, ['POST' => 0], null, false, false, null]],
        '/testpsy' => [[['_route' => 'testpsy_index', '_controller' => 'App\\Controller\\Testpsy\\TestPsyController::index'], null, null, null, true, false, null]],
        '/testpsy/historique' => [[['_route' => 'testpsy_historique', '_controller' => 'App\\Controller\\Testpsy\\TestPsyController::historique'], null, null, null, false, false, null]],
        '/testpsy/historique/reset' => [[['_route' => 'testpsy_historique_reset', '_controller' => 'App\\Controller\\Testpsy\\TestPsyController::resetHistorique'], null, ['POST' => 0], null, false, false, null]],
        '/testpsy/statistiques' => [[['_route' => 'testpsy_statistiques', '_controller' => 'App\\Controller\\Testpsy\\TestPsyController::statistiquesGlobales'], null, null, null, false, false, null]],
        '/testpsy/create' => [[['_route' => 'testpsy_create', '_controller' => 'App\\Controller\\Testpsy\\TestPsyController::create'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/events' => [[['_route' => 'app_event_index', '_controller' => 'App\\Controller\\UserEventController::index'], null, ['GET' => 0], null, false, false, null]],
        '/profile' => [[['_route' => 'app_profile', '_controller' => 'App\\Controller\\UserProfileController::index'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/profile/picture' => [[['_route' => 'app_profile_picture', '_controller' => 'App\\Controller\\UserProfileController::uploadPicture'], null, ['POST' => 0], null, false, false, null]],
        '/profile/change-password' => [[['_route' => 'app_profile_change_password', '_controller' => 'App\\Controller\\UserProfileController::changePassword'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/' => [[['_route' => 'app_home', '_controller' => 'App\\Controller\\WebAuthController::home'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\WebAuthController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\WebAuthController::logout'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\WebAuthController::register'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/verify-email' => [[['_route' => 'app_verify_email', '_controller' => 'App\\Controller\\WebAuthController::verifyEmail'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/verify-resend' => [[['_route' => 'app_verify_resend', '_controller' => 'App\\Controller\\WebAuthController::verifyResend'], null, ['POST' => 0], null, false, false, null]],
        '/forgot-password' => [[['_route' => 'app_forgot_password', '_controller' => 'App\\Controller\\WebAuthController::forgotPassword'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/reset-password' => [[['_route' => 'app_reset_password', '_controller' => 'App\\Controller\\WebAuthController::resetPassword'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                    .'|messaging/api/([^/]++)(?'
                        .'|(*:226)'
                        .'|/(?'
                            .'|send(*:242)'
                            .'|read(*:254)'
                        .')'
                    .')'
                    .'|internal/notifications/([^/]++)/read(*:300)'
                .')'
                .'|/a(?'
                    .'|dmin/(?'
                        .'|users/(?'
                            .'|block/([^/]++)(*:345)'
                            .'|([^/]++)(?'
                                .'|(*:364)'
                                .'|/(?'
                                    .'|edit(*:380)'
                                    .'|delete(*:394)'
                                .')'
                            .')'
                        .')'
                        .'|reports/([^/]++)/resolve(*:429)'
                        .'|chat\\-lock/([^/]++)/remove(*:463)'
                        .'|events/([^/]++)(?'
                            .'|(*:489)'
                            .'|/(?'
                                .'|edit(*:505)'
                                .'|delete(*:519)'
                            .')'
                        .')'
                        .'|inscriptions/([^/]++)(?'
                            .'|(*:553)'
                            .'|/(?'
                                .'|edit(*:569)'
                                .'|delete(*:583)'
                            .')'
                        .')'
                    .')'
                    .'|rticle/(?'
                        .'|(\\d+)(*:609)'
                        .'|tag/([^/]++)(*:629)'
                        .'|(\\d+)/edit(*:647)'
                        .'|(\\d+)(*:660)'
                    .')'
                .')'
                .'|/c(?'
                    .'|ategorie/([^/]++)(?'
                        .'|(*:695)'
                        .'|/edit(*:708)'
                        .'|(*:716)'
                    .')'
                    .'|ommunity/([^/]++)(?'
                        .'|/edit(*:750)'
                        .'|(*:758)'
                    .')'
                    .'|hange\\-locale/([^/]++)(*:789)'
                .')'
                .'|/requests/([^/]++)/(?'
                    .'|postpone(*:828)'
                    .'|accept(*:842)'
                    .'|reject(*:856)'
                .')'
                .'|/journal/(?'
                    .'|entree/(?'
                        .'|modifier/([^/]++)(*:904)'
                        .'|supprimer/([^/]++)(*:930)'
                        .'|voir/([^/]++)(*:951)'
                    .')'
                    .'|habitude/(?'
                        .'|modifier/([^/]++)(*:989)'
                        .'|supprimer/([^/]++)(*:1015)'
                        .'|voir/([^/]++)(*:1037)'
                    .')'
                .')'
                .'|/learning\\-path/(?'
                    .'|(\\d+)(*:1072)'
                    .'|(\\d+)/edit(?'
                        .'|(*:1094)'
                    .')'
                    .'|(\\d+)/delete(*:1116)'
                .')'
                .'|/m(?'
                    .'|ap/contact/([^/]++)(*:1150)'
                    .'|essages(?'
                        .'|(?:/([^/]++))?(*:1183)'
                        .'|(*:1192)'
                    .')'
                .')'
                .'|/testpsy/(?'
                    .'|(\\d+)(*:1220)'
                    .'|([^/]++)/passer(*:1244)'
                    .'|resultat/([^/]++)(*:1270)'
                    .'|([^/]++)/(?'
                        .'|edit(*:1295)'
                        .'|delete(*:1310)'
                    .')'
                    .'|question/([^/]++)/(?'
                        .'|edit(*:1345)'
                        .'|delete(*:1360)'
                    .')'
                    .'|resultat/([^/]++)/supprimer(*:1397)'
                .')'
                .'|/events/([^/]++)/(?'
                    .'|participate(*:1438)'
                    .'|c(?'
                        .'|ancel(*:1456)'
                        .'|ertificate(*:1475)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        226 => [[['_route' => 'api_messages_get', '_controller' => 'App\\Controller\\MessagingController::getMessages'], ['id'], ['GET' => 0], null, false, true, null]],
        242 => [[['_route' => 'api_messages_send', '_controller' => 'App\\Controller\\MessagingController::sendMessage'], ['id'], ['POST' => 0], null, false, false, null]],
        254 => [[['_route' => 'api_messages_read', '_controller' => 'App\\Controller\\MessagingController::markAsRead'], ['id'], ['POST' => 0], null, false, false, null]],
        300 => [[['_route' => 'api_notifications_read', '_controller' => 'App\\Controller\\NotificationController::markAsRead'], ['id'], ['POST' => 0], null, false, false, null]],
        345 => [[['_route' => 'admin_user_block', '_controller' => 'App\\Controller\\AdminController::blockUser'], ['id'], ['POST' => 0], null, false, true, null]],
        364 => [[['_route' => 'admin_user_get', '_controller' => 'App\\Controller\\AdminController::fetchUser'], ['id'], ['GET' => 0], null, false, true, null]],
        380 => [[['_route' => 'admin_user_update', '_controller' => 'App\\Controller\\AdminController::updateUser'], ['id'], ['POST' => 0], null, false, false, null]],
        394 => [[['_route' => 'admin_user_delete', '_controller' => 'App\\Controller\\AdminController::deleteUser'], ['id'], ['POST' => 0], null, false, false, null]],
        429 => [[['_route' => 'admin_report_resolve', '_controller' => 'App\\Controller\\AdminController::resolveReport'], ['id'], ['POST' => 0], null, false, false, null]],
        463 => [[['_route' => 'admin_chat_lock_remove', '_controller' => 'App\\Controller\\AdminController::removeChatLock'], ['id'], ['POST' => 0], null, false, false, null]],
        489 => [[['_route' => 'admin_event_show', '_controller' => 'App\\Controller\\EventController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        505 => [[['_route' => 'admin_event_edit', '_controller' => 'App\\Controller\\EventController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        519 => [[['_route' => 'admin_event_delete', '_controller' => 'App\\Controller\\EventController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        553 => [[['_route' => 'admin_inscription_show', '_controller' => 'App\\Controller\\InscriptionController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        569 => [[['_route' => 'admin_inscription_edit', '_controller' => 'App\\Controller\\InscriptionController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        583 => [[['_route' => 'admin_inscription_delete', '_controller' => 'App\\Controller\\InscriptionController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        609 => [[['_route' => 'app_article_show', '_controller' => 'App\\Controller\\ArticleController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        629 => [[['_route' => 'app_article_by_tag', '_controller' => 'App\\Controller\\ArticleController::byTag'], ['tagName'], ['GET' => 0], null, false, true, null]],
        647 => [[['_route' => 'app_article_edit', '_controller' => 'App\\Controller\\ArticleController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        660 => [[['_route' => 'app_article_delete', '_controller' => 'App\\Controller\\ArticleController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        695 => [[['_route' => 'app_categorie_show', '_controller' => 'App\\Controller\\CategorieController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        708 => [[['_route' => 'app_categorie_edit', '_controller' => 'App\\Controller\\CategorieController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        716 => [[['_route' => 'app_categorie_delete', '_controller' => 'App\\Controller\\CategorieController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        750 => [[['_route' => 'app_community_edit', '_controller' => 'App\\Controller\\CommunityController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        758 => [[['_route' => 'app_community_delete', '_controller' => 'App\\Controller\\CommunityController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        789 => [[['_route' => 'app_change_locale', '_controller' => 'App\\Controller\\LocaleController::changeLocale'], ['locale'], null, null, false, true, null]],
        828 => [[['_route' => 'contact_request_postpone', '_controller' => 'App\\Controller\\ContactRequestController::postpone'], ['id'], ['POST' => 0], null, false, false, null]],
        842 => [[['_route' => 'contact_request_accept', '_controller' => 'App\\Controller\\ContactRequestController::accept'], ['id'], ['POST' => 0], null, false, false, null]],
        856 => [[['_route' => 'contact_request_reject', '_controller' => 'App\\Controller\\ContactRequestController::reject'], ['id'], ['POST' => 0], null, false, false, null]],
        904 => [[['_route' => 'entree_modifier', '_controller' => 'App\\Controller\\Journal\\EntreeJournalController::modifier'], ['id'], null, null, false, true, null]],
        930 => [[['_route' => 'entree_supprimer', '_controller' => 'App\\Controller\\Journal\\EntreeJournalController::supprimer'], ['id'], ['POST' => 0], null, false, true, null]],
        951 => [[['_route' => 'entree_voir', '_controller' => 'App\\Controller\\Journal\\EntreeJournalController::voir'], ['id'], null, null, false, true, null]],
        989 => [[['_route' => 'habitude_modifier', '_controller' => 'App\\Controller\\Journal\\HabitudeController::modifier'], ['id'], null, null, false, true, null]],
        1015 => [[['_route' => 'habitude_supprimer', '_controller' => 'App\\Controller\\Journal\\HabitudeController::supprimer'], ['id'], ['POST' => 0], null, false, true, null]],
        1037 => [[['_route' => 'habitude_voir', '_controller' => 'App\\Controller\\Journal\\HabitudeController::voir'], ['id'], null, null, false, true, null]],
        1072 => [[['_route' => 'app_learning_path_show', '_controller' => 'App\\Controller\\LearningPathController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1094 => [
            [['_route' => 'app_learning_path_edit', '_controller' => 'App\\Controller\\LearningPathController::edit'], ['id'], ['GET' => 0], null, false, false, null],
            [['_route' => 'app_learning_path_update', '_controller' => 'App\\Controller\\LearningPathController::update'], ['id'], ['POST' => 0], null, false, false, null],
        ],
        1116 => [[['_route' => 'app_learning_path_delete', '_controller' => 'App\\Controller\\LearningPathController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        1150 => [[['_route' => 'app_map_contact', '_controller' => 'App\\Controller\\MapController::contactRequest'], ['id'], ['POST' => 0], null, false, true, null]],
        1183 => [[['_route' => 'app_messages_show', 'id' => null, '_controller' => 'App\\Controller\\MessagingController::index'], ['id'], ['GET' => 0], null, false, true, null]],
        1192 => [[['_route' => 'app_messages', '_controller' => 'App\\Controller\\MessagingController::index'], [], ['GET' => 0], null, false, false, null]],
        1220 => [[['_route' => 'testpsy_show', '_controller' => 'App\\Controller\\Testpsy\\TestPsyController::show'], ['id'], null, null, false, true, null]],
        1244 => [[['_route' => 'testpsy_passer', '_controller' => 'App\\Controller\\Testpsy\\TestPsyController::passer'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1270 => [[['_route' => 'testpsy_resultat', '_controller' => 'App\\Controller\\Testpsy\\TestPsyController::resultat'], ['id'], null, null, false, true, null]],
        1295 => [[['_route' => 'testpsy_edit', '_controller' => 'App\\Controller\\Testpsy\\TestPsyController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1310 => [[['_route' => 'testpsy_delete', '_controller' => 'App\\Controller\\Testpsy\\TestPsyController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        1345 => [[['_route' => 'testpsy_question_edit', '_controller' => 'App\\Controller\\Testpsy\\TestPsyController::editQuestion'], ['id'], ['POST' => 0], null, false, false, null]],
        1360 => [[['_route' => 'testpsy_question_delete', '_controller' => 'App\\Controller\\Testpsy\\TestPsyController::deleteQuestion'], ['id'], ['POST' => 0], null, false, false, null]],
        1397 => [[['_route' => 'testpsy_supprimer_essai', '_controller' => 'App\\Controller\\Testpsy\\TestPsyController::supprimerEssai'], ['id'], ['POST' => 0], null, false, false, null]],
        1438 => [[['_route' => 'app_event_participate', '_controller' => 'App\\Controller\\UserEventController::participate'], ['id'], ['POST' => 0], null, false, false, null]],
        1456 => [[['_route' => 'app_event_cancel', '_controller' => 'App\\Controller\\UserEventController::cancel'], ['id'], ['POST' => 0], null, false, false, null]],
        1475 => [
            [['_route' => 'app_event_certificate', '_controller' => 'App\\Controller\\UserEventController::certificate'], ['id'], ['GET' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
