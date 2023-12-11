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
        '/api/new_client' => [[['_route' => 'api_app_client_new', '_controller' => 'App\\Controller\\ClientController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/all_commandes' => [[['_route' => 'app_commandes_index', '_controller' => 'App\\Controller\\CommandesController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/new_commande' => [[['_route' => 'app_commandes_new', '_controller' => 'App\\Controller\\CommandesController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/all_employes' => [[['_route' => 'app_employes_index', '_controller' => 'App\\Controller\\EmployesController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/new_employe' => [[['_route' => 'app_employes_new', '_controller' => 'App\\Controller\\EmployesController::new'], null, ['POST' => 0], null, false, false, null]],
        '/api/all_entreprises' => [[['_route' => 'app_entreprise_index', '_controller' => 'App\\Controller\\EntrepriseController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/new_entreprise' => [[['_route' => 'app_entreprise_new', '_controller' => 'App\\Controller\\EntrepriseController::new'], null, ['POST' => 0], null, false, false, null]],
        '/api/all_produits' => [[['_route' => 'app_produits_index', '_controller' => 'App\\Controller\\ProduitsController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/new_produit' => [[['_route' => 'app_produits_new', '_controller' => 'App\\Controller\\ProduitsController::new'], null, ['POST' => 0], null, false, false, null]],
        '/api/register' => [[['_route' => 'api_app_register', '_controller' => 'App\\Controller\\RegisterController::register'], null, null, null, false, false, null]],
        '/api/logout' => [[['_route' => 'api_app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
        '/api/all_stocks' => [[['_route' => 'app_stocks_index', '_controller' => 'App\\Controller\\StocksController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/new_stock' => [[['_route' => 'app_stocks_new', '_controller' => 'App\\Controller\\StocksController::new'], null, ['POST' => 0], null, false, false, null]],
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
                                .'|e(?'
                                    .'|mploye(*:283)'
                                    .'|ntreprise(*:300)'
                                .')'
                                .'|produit(*:316)'
                                .'|stock(*:329)'
                            .')'
                            .'|edit_(?'
                                .'|c(?'
                                    .'|lient(*:355)'
                                    .'|ommande(*:370)'
                                .')'
                                .'|e(?'
                                    .'|mploye(*:389)'
                                    .'|ntreprise(*:406)'
                                .')'
                                .'|produit(*:422)'
                                .'|stock(*:435)'
                            .')'
                            .'|delete_(?'
                                .'|c(?'
                                    .'|lient(*:463)'
                                    .'|ommande(*:478)'
                                .')'
                                .'|e(?'
                                    .'|mploye(*:497)'
                                    .'|ntreprise(*:514)'
                                .')'
                                .'|produit(*:530)'
                                .'|stock(*:543)'
                            .')'
                        .')'
                    .')'
                .')'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:586)'
                    .'|wdt/([^/]++)(*:606)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:652)'
                            .'|router(*:666)'
                            .'|exception(?'
                                .'|(*:686)'
                                .'|\\.css(*:699)'
                            .')'
                        .')'
                        .'|(*:709)'
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
        264 => [[['_route' => 'app_commandes_show', '_controller' => 'App\\Controller\\CommandesController::show'], ['id'], ['GET' => 0], null, false, false, null]],
        283 => [[['_route' => 'app_employes_show', '_controller' => 'App\\Controller\\EmployesController::show'], ['id'], ['GET' => 0], null, false, false, null]],
        300 => [[['_route' => 'app_entreprise_show', '_controller' => 'App\\Controller\\EntrepriseController::show'], ['id'], ['GET' => 0], null, false, false, null]],
        316 => [[['_route' => 'app_produits_show', '_controller' => 'App\\Controller\\ProduitsController::show'], ['id'], ['GET' => 0], null, false, false, null]],
        329 => [[['_route' => 'app_stocks_show', '_controller' => 'App\\Controller\\StocksController::show'], ['id'], ['GET' => 0], null, false, false, null]],
        355 => [[['_route' => 'api_app_client_edit', '_controller' => 'App\\Controller\\ClientController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        370 => [[['_route' => 'app_commandes_edit', '_controller' => 'App\\Controller\\CommandesController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        389 => [[['_route' => 'app_employes_edit', '_controller' => 'App\\Controller\\EmployesController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        406 => [[['_route' => 'app_entreprise_edit', '_controller' => 'App\\Controller\\EntrepriseController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        422 => [[['_route' => 'app_produits_edit', '_controller' => 'App\\Controller\\ProduitsController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        435 => [[['_route' => 'app_stocks_edit', '_controller' => 'App\\Controller\\StocksController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        463 => [[['_route' => 'api_app_client_delete', '_controller' => 'App\\Controller\\ClientController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        478 => [[['_route' => 'app_commandes_delete', '_controller' => 'App\\Controller\\CommandesController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        497 => [[['_route' => 'app_employes_delete', '_controller' => 'App\\Controller\\EmployesController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        514 => [[['_route' => 'app_entreprise_delete', '_controller' => 'App\\Controller\\EntrepriseController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        530 => [[['_route' => 'app_produits_delete', '_controller' => 'App\\Controller\\ProduitsController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        543 => [[['_route' => 'app_stocks_delete', '_controller' => 'App\\Controller\\StocksController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        586 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        606 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        652 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        666 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        686 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        699 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        709 => [
            [['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
