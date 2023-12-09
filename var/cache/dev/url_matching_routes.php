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
        '/client' => [[['_route' => 'app_client_index', '_controller' => 'App\\Controller\\ClientController::index'], null, ['GET' => 0], null, true, false, null]],
        '/client/new' => [[['_route' => 'app_client_new', '_controller' => 'App\\Controller\\ClientController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/commandes' => [[['_route' => 'app_commandes_index', '_controller' => 'App\\Controller\\CommandesController::index'], null, ['GET' => 0], null, true, false, null]],
        '/commandes/new' => [[['_route' => 'app_commandes_new', '_controller' => 'App\\Controller\\CommandesController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/employes' => [[['_route' => 'app_employes_index', '_controller' => 'App\\Controller\\EmployesController::index'], null, ['GET' => 0], null, true, false, null]],
        '/employes/new' => [[['_route' => 'app_employes_new', '_controller' => 'App\\Controller\\EmployesController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/entreprise' => [[['_route' => 'app_entreprise_index', '_controller' => 'App\\Controller\\EntrepriseController::index'], null, ['GET' => 0], null, true, false, null]],
        '/entreprise/new' => [[['_route' => 'app_entreprise_new', '_controller' => 'App\\Controller\\EntrepriseController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/produits' => [[['_route' => 'app_produits_index', '_controller' => 'App\\Controller\\ProduitsController::index'], null, ['GET' => 0], null, true, false, null]],
        '/produits/new' => [[['_route' => 'app_produits_new', '_controller' => 'App\\Controller\\ProduitsController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/logout' => [[['_route' => 'api_app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
        '/stocks' => [[['_route' => 'app_stocks_index', '_controller' => 'App\\Controller\\StocksController::index'], null, ['GET' => 0], null, true, false, null]],
        '/stocks/new' => [[['_route' => 'app_stocks_new', '_controller' => 'App\\Controller\\StocksController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
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
                    .')'
                    .'|user_(?'
                        .'|show/([^/]++)(*:242)'
                        .'|edit/([^/]++)(*:263)'
                        .'|delete/([^/]++)(*:286)'
                    .')'
                .')'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:327)'
                    .'|wdt/([^/]++)(*:347)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:393)'
                            .'|router(*:407)'
                            .'|exception(?'
                                .'|(*:427)'
                                .'|\\.css(*:440)'
                            .')'
                        .')'
                        .'|(*:450)'
                    .')'
                .')'
                .'|/c(?'
                    .'|lient/([^/]++)(?'
                        .'|(*:482)'
                        .'|/edit(*:495)'
                        .'|(*:503)'
                    .')'
                    .'|ommandes/([^/]++)(?'
                        .'|(*:532)'
                        .'|/edit(*:545)'
                        .'|(*:553)'
                    .')'
                .')'
                .'|/e(?'
                    .'|mployes/([^/]++)(?'
                        .'|(*:587)'
                        .'|/edit(*:600)'
                        .'|(*:608)'
                    .')'
                    .'|ntreprise/([^/]++)(?'
                        .'|(*:638)'
                        .'|/edit(*:651)'
                        .'|(*:659)'
                    .')'
                .')'
                .'|/produits/([^/]++)(?'
                    .'|(*:690)'
                    .'|/edit(*:703)'
                    .'|(*:711)'
                .')'
                .'|/stocks/([^/]++)(?'
                    .'|(*:739)'
                    .'|/edit(*:752)'
                    .'|(*:760)'
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
        242 => [[['_route' => 'api_app_user_show', '_controller' => 'App\\Controller\\UserController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        263 => [[['_route' => 'api_app_user_edit', '_controller' => 'App\\Controller\\UserController::edit'], ['id'], ['PUT' => 0], null, false, true, null]],
        286 => [[['_route' => 'api_app_user_delete', '_controller' => 'App\\Controller\\UserController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        327 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        347 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        393 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        407 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        427 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        440 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        450 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        482 => [[['_route' => 'app_client_show', '_controller' => 'App\\Controller\\ClientController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        495 => [[['_route' => 'app_client_edit', '_controller' => 'App\\Controller\\ClientController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        503 => [[['_route' => 'app_client_delete', '_controller' => 'App\\Controller\\ClientController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        532 => [[['_route' => 'app_commandes_show', '_controller' => 'App\\Controller\\CommandesController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        545 => [[['_route' => 'app_commandes_edit', '_controller' => 'App\\Controller\\CommandesController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        553 => [[['_route' => 'app_commandes_delete', '_controller' => 'App\\Controller\\CommandesController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        587 => [[['_route' => 'app_employes_show', '_controller' => 'App\\Controller\\EmployesController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        600 => [[['_route' => 'app_employes_edit', '_controller' => 'App\\Controller\\EmployesController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        608 => [[['_route' => 'app_employes_delete', '_controller' => 'App\\Controller\\EmployesController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        638 => [[['_route' => 'app_entreprise_show', '_controller' => 'App\\Controller\\EntrepriseController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        651 => [[['_route' => 'app_entreprise_edit', '_controller' => 'App\\Controller\\EntrepriseController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        659 => [[['_route' => 'app_entreprise_delete', '_controller' => 'App\\Controller\\EntrepriseController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        690 => [[['_route' => 'app_produits_show', '_controller' => 'App\\Controller\\ProduitsController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        703 => [[['_route' => 'app_produits_edit', '_controller' => 'App\\Controller\\ProduitsController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        711 => [[['_route' => 'app_produits_delete', '_controller' => 'App\\Controller\\ProduitsController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        739 => [[['_route' => 'app_stocks_show', '_controller' => 'App\\Controller\\StocksController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        752 => [[['_route' => 'app_stocks_edit', '_controller' => 'App\\Controller\\StocksController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        760 => [
            [['_route' => 'app_stocks_delete', '_controller' => 'App\\Controller\\StocksController::delete'], ['id'], ['POST' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
