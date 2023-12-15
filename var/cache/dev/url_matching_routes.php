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
        '/api/all_client' => [[['_route' => 'api_app_client_index', '_controller' => 'App\\Controller\\ClientController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/new_client' => [[['_route' => 'api_app_client_new', '_controller' => 'App\\Controller\\ClientController::new'], null, ['POST' => 0], null, false, false, null]],
        '/api/all_commandes' => [[['_route' => 'api_app_commandes_index', '_controller' => 'App\\Controller\\CommandesController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/new_commande' => [[['_route' => 'api_app_commandes_new', '_controller' => 'App\\Controller\\CommandesController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/all_employes' => [[['_route' => 'api_app_employes_index', '_controller' => 'App\\Controller\\EmployesController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/count_employes' => [[['_route' => 'api_app_employes_count', '_controller' => 'App\\Controller\\EmployesController::count'], null, ['GET' => 0], null, false, false, null]],
        '/api/new_employe' => [[['_route' => 'api_app_employes_new', '_controller' => 'App\\Controller\\EmployesController::new'], null, ['POST' => 0], null, false, false, null]],
        '/api/all_entreprises' => [[['_route' => 'api_app_entreprise_index', '_controller' => 'App\\Controller\\EntrepriseController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/count_entreprises' => [[['_route' => 'api_app_entreprises_count', '_controller' => 'App\\Controller\\EntrepriseController::count'], null, ['GET' => 0], null, false, false, null]],
        '/api/new_entreprise' => [[['_route' => 'api_app_entreprise_new', '_controller' => 'App\\Controller\\EntrepriseController::new'], null, ['POST' => 0], null, false, false, null]],
        '/forgot/forgot-password' => [[['_route' => 'app_forgotapp_forgot_password', '_controller' => 'App\\Controller\\ForgetPasswordController::forgetPassword'], null, ['POST' => 0], null, false, false, null]],
        '/forgot/reset-password' => [[['_route' => 'app_forgotapp_reset_password', '_controller' => 'App\\Controller\\ForgetPasswordController::resetPassword'], null, ['POST' => 0], null, false, false, null]],
        '/api/all_produits' => [[['_route' => 'api_app_produits_index', '_controller' => 'App\\Controller\\ProduitsController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/new_produit' => [[['_route' => 'api_app_produits_new', '_controller' => 'App\\Controller\\ProduitsController::new'], null, ['POST' => 0], null, false, false, null]],
        '/api/logout' => [[['_route' => 'api_app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
        '/api/all_stocks' => [[['_route' => 'api_app_stocks_index', '_controller' => 'App\\Controller\\StocksController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/new_stock' => [[['_route' => 'api_app_stocks_new', '_controller' => 'App\\Controller\\StocksController::new'], null, ['POST' => 0], null, false, false, null]],
        '/api/all_user' => [[['_route' => 'api_app_user_index', '_controller' => 'App\\Controller\\UserController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/register' => [[['_route' => 'api_app_register', '_controller' => 'App\\Controller\\UserController::register'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/login_check' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/api(?'
                    .'|/\\.well\\-known/genid/([^/]++)(*:43)'
                    .'|(?:/(index)(?:\\.([^/]++))?)?(*:78)'
                    .'|/(?'
                        .'|docs(?:\\.([^/]++))?(*:108)'
                        .'|contexts/([^.]+)(?:\\.(jsonld))?(*:147)'
                        .'|errors/([^/]++)(?'
                            .'|(*:173)'
                        .')'
                        .'|validation_errors/([^/]++)(?'
                            .'|(*:211)'
                        .')'
                        .'|([^/]++)/(?'
                            .'|show_(?'
                                .'|c(?'
                                    .'|lient(*:249)'
                                    .'|ommande(*:264)'
                                .')'
                                .'|employe(*:280)'
                            .')'
                            .'|edit_(?'
                                .'|c(?'
                                    .'|lient(*:306)'
                                    .'|ommande(*:321)'
                                .')'
                                .'|employe(*:337)'
                            .')'
                            .'|delete_(?'
                                .'|c(?'
                                    .'|lient(*:365)'
                                    .'|ommande(*:380)'
                                .')'
                                .'|employe(*:396)'
                            .')'
                        .')'
                        .'|all_clients_entreprise/([^/]++)(*:437)'
                        .'|count_clients_entreprise/([^/]++)(*:478)'
                        .'|([^/]++)/(?'
                            .'|show_(?'
                                .'|entreprise(*:516)'
                                .'|produit(*:531)'
                                .'|stock(*:544)'
                                .'|user(*:556)'
                            .')'
                            .'|edit_(?'
                                .'|entreprise(*:583)'
                                .'|produit(*:598)'
                                .'|stock(*:611)'
                            .')'
                            .'|delete_(?'
                                .'|entreprise(*:640)'
                                .'|produit(*:655)'
                                .'|stock(*:668)'
                            .')'
                            .'|user_(?'
                                .'|edit(*:689)'
                                .'|delete(*:703)'
                            .')'
                        .')'
                    .')'
                .')'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:746)'
                    .'|wdt/([^/]++)(*:766)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:812)'
                            .'|router(*:826)'
                            .'|exception(?'
                                .'|(*:846)'
                                .'|\\.css(*:859)'
                            .')'
                        .')'
                        .'|(*:869)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        43 => [[['_route' => 'api_genid', '_controller' => 'api_platform.action.not_exposed', '_api_respond' => 'true'], ['id'], null, null, false, true, null]],
        78 => [[['_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index', '_format'], null, null, false, true, null]],
        108 => [[['_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], ['_format'], null, null, false, true, null]],
        147 => [[['_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName', '_format'], null, null, false, true, null]],
        173 => [
            [['_route' => '_api_errors_problem', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\ApiResource\\Error', '_api_operation_name' => '_api_errors_problem'], ['status'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_errors_hydra', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\ApiResource\\Error', '_api_operation_name' => '_api_errors_hydra'], ['status'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_errors_jsonapi', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\ApiResource\\Error', '_api_operation_name' => '_api_errors_jsonapi'], ['status'], ['GET' => 0], null, false, true, null],
        ],
        211 => [
            [['_route' => '_api_validation_errors_problem', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Symfony\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_problem'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_validation_errors_hydra', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Symfony\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_hydra'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => '_api_validation_errors_jsonapi', '_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Symfony\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_jsonapi'], ['id'], ['GET' => 0], null, false, true, null],
        ],
        249 => [[['_route' => 'api_app_client_show', '_controller' => 'App\\Controller\\ClientController::show'], ['id'], ['GET' => 0], null, false, false, null]],
        264 => [[['_route' => 'api_app_commandes_show', '_controller' => 'App\\Controller\\CommandesController::show'], ['id'], ['GET' => 0], null, false, false, null]],
        280 => [[['_route' => 'api_app_employes_show', '_controller' => 'App\\Controller\\EmployesController::show'], ['id'], ['GET' => 0], null, false, false, null]],
        306 => [[['_route' => 'api_app_client_edit', '_controller' => 'App\\Controller\\ClientController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        321 => [[['_route' => 'api_app_commandes_edit', '_controller' => 'App\\Controller\\CommandesController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        337 => [[['_route' => 'api_app_employes_edit', '_controller' => 'App\\Controller\\EmployesController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        365 => [[['_route' => 'api_app_client_delete', '_controller' => 'App\\Controller\\ClientController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        380 => [[['_route' => 'api_app_commandes_delete', '_controller' => 'App\\Controller\\CommandesController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        396 => [[['_route' => 'api_app_employes_delete', '_controller' => 'App\\Controller\\EmployesController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        437 => [[['_route' => 'api_app_all_clients', '_controller' => 'App\\Controller\\EntrepriseController::getAllClientsByEntreprise'], ['entrepriseId'], ['GET' => 0], null, false, true, null]],
        478 => [[['_route' => 'api_app_count_clients', '_controller' => 'App\\Controller\\EntrepriseController::countClientsByEntreprise'], ['entrepriseId'], ['GET' => 0], null, false, true, null]],
        516 => [[['_route' => 'api_app_entreprise_show', '_controller' => 'App\\Controller\\EntrepriseController::show'], ['id'], ['GET' => 0], null, false, false, null]],
        531 => [[['_route' => 'api_app_produits_show', '_controller' => 'App\\Controller\\ProduitsController::show'], ['id'], ['GET' => 0], null, false, false, null]],
        544 => [[['_route' => 'api_app_stocks_show', '_controller' => 'App\\Controller\\StocksController::show'], ['id'], ['GET' => 0], null, false, false, null]],
        556 => [[['_route' => 'api_app_user_show', '_controller' => 'App\\Controller\\UserController::show'], ['id'], ['GET' => 0], null, false, false, null]],
        583 => [[['_route' => 'api_app_entreprise_edit', '_controller' => 'App\\Controller\\EntrepriseController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        598 => [[['_route' => 'api_app_produits_edit', '_controller' => 'App\\Controller\\ProduitsController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        611 => [[['_route' => 'api_app_stocks_edit', '_controller' => 'App\\Controller\\StocksController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        640 => [[['_route' => 'api_app_entreprise_delete', '_controller' => 'App\\Controller\\EntrepriseController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        655 => [[['_route' => 'api_app_produits_delete', '_controller' => 'App\\Controller\\ProduitsController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        668 => [[['_route' => 'api_app_stocks_delete', '_controller' => 'App\\Controller\\StocksController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        689 => [[['_route' => 'api_app_user_edit', '_controller' => 'App\\Controller\\UserController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        703 => [[['_route' => 'api_app_user_delete', '_controller' => 'App\\Controller\\UserController::delete'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        746 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        766 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        812 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        826 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        846 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        859 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        869 => [
            [['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
