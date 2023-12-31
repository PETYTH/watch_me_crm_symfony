<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    'api_genid' => [['id'], ['_controller' => 'api_platform.action.not_exposed', '_api_respond' => 'true'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/.well-known/genid']], [], [], []],
    'api_entrypoint' => [['index', '_format'], ['_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index' => 'index'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', 'index', 'index', true], ['text', '/api']], [], [], []],
    'api_doc' => [['_format'], ['_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], [], [['variable', '.', '[^/]++', '_format', true], ['text', '/api/docs']], [], [], []],
    'api_jsonld_context' => [['shortName', '_format'], ['_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName' => '[^.]+', '_format' => 'jsonld'], [['variable', '.', 'jsonld', '_format', true], ['variable', '/', '[^.]+', 'shortName', true], ['text', '/api/contexts']], [], [], []],
    '_api_errors_problem' => [['status'], ['_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\ApiResource\\Error', '_api_operation_name' => '_api_errors_problem'], [], [['variable', '/', '[^/]++', 'status', true], ['text', '/api/errors']], [], [], []],
    '_api_errors_hydra' => [['status'], ['_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\ApiResource\\Error', '_api_operation_name' => '_api_errors_hydra'], [], [['variable', '/', '[^/]++', 'status', true], ['text', '/api/errors']], [], [], []],
    '_api_errors_jsonapi' => [['status'], ['_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\ApiResource\\Error', '_api_operation_name' => '_api_errors_jsonapi'], [], [['variable', '/', '[^/]++', 'status', true], ['text', '/api/errors']], [], [], []],
    '_api_validation_errors_problem' => [['id'], ['_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Symfony\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_problem'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/validation_errors']], [], [], []],
    '_api_validation_errors_hydra' => [['id'], ['_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Symfony\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_hydra'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/validation_errors']], [], [], []],
    '_api_validation_errors_jsonapi' => [['id'], ['_controller' => 'api_platform.symfony.main_controller', '_format' => null, '_stateless' => true, '_api_resource_class' => 'ApiPlatform\\Symfony\\Validator\\Exception\\ValidationException', '_api_operation_name' => '_api_validation_errors_jsonapi'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/api/validation_errors']], [], [], []],
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], [], []],
    '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], [], []],
    '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], [], []],
    '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], [], []],
    '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], [], []],
    '_profiler_xdebug' => [[], ['_controller' => 'web_profiler.controller.profiler::xdebugAction'], [], [['text', '/_profiler/xdebug']], [], [], []],
    '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], [], []],
    '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::body'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::stylesheet'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    'app_client_index' => [[], ['_controller' => 'App\\Controller\\ClientController::index'], [], [['text', '/client/']], [], [], []],
    'app_client_new' => [[], ['_controller' => 'App\\Controller\\ClientController::new'], [], [['text', '/client/new']], [], [], []],
    'app_client_show' => [['id'], ['_controller' => 'App\\Controller\\ClientController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/client']], [], [], []],
    'app_client_edit' => [['id'], ['_controller' => 'App\\Controller\\ClientController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/client']], [], [], []],
    'app_client_delete' => [['id'], ['_controller' => 'App\\Controller\\ClientController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/client']], [], [], []],
    'app_commandes_index' => [[], ['_controller' => 'App\\Controller\\CommandesController::index'], [], [['text', '/commandes/']], [], [], []],
    'app_commandes_new' => [[], ['_controller' => 'App\\Controller\\CommandesController::new'], [], [['text', '/commandes/new']], [], [], []],
    'app_commandes_show' => [['id'], ['_controller' => 'App\\Controller\\CommandesController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/commandes']], [], [], []],
    'app_commandes_edit' => [['id'], ['_controller' => 'App\\Controller\\CommandesController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/commandes']], [], [], []],
    'app_commandes_delete' => [['id'], ['_controller' => 'App\\Controller\\CommandesController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/commandes']], [], [], []],
    'app_employes_index' => [[], ['_controller' => 'App\\Controller\\EmployesController::index'], [], [['text', '/employes/']], [], [], []],
    'app_employes_new' => [[], ['_controller' => 'App\\Controller\\EmployesController::new'], [], [['text', '/employes/new']], [], [], []],
    'app_employes_show' => [['id'], ['_controller' => 'App\\Controller\\EmployesController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/employes']], [], [], []],
    'app_employes_edit' => [['id'], ['_controller' => 'App\\Controller\\EmployesController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/employes']], [], [], []],
    'app_employes_delete' => [['id'], ['_controller' => 'App\\Controller\\EmployesController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/employes']], [], [], []],
    'app_entreprise_index' => [[], ['_controller' => 'App\\Controller\\EntrepriseController::index'], [], [['text', '/entreprise/']], [], [], []],
    'app_entreprise_new' => [[], ['_controller' => 'App\\Controller\\EntrepriseController::new'], [], [['text', '/entreprise/new']], [], [], []],
    'app_entreprise_show' => [['id'], ['_controller' => 'App\\Controller\\EntrepriseController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/entreprise']], [], [], []],
    'app_entreprise_edit' => [['id'], ['_controller' => 'App\\Controller\\EntrepriseController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/entreprise']], [], [], []],
    'app_entreprise_delete' => [['id'], ['_controller' => 'App\\Controller\\EntrepriseController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/entreprise']], [], [], []],
    'app_produits_index' => [[], ['_controller' => 'App\\Controller\\ProduitsController::index'], [], [['text', '/produits/']], [], [], []],
    'app_produits_new' => [[], ['_controller' => 'App\\Controller\\ProduitsController::new'], [], [['text', '/produits/new']], [], [], []],
    'app_produits_show' => [['id'], ['_controller' => 'App\\Controller\\ProduitsController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/produits']], [], [], []],
    'app_produits_edit' => [['id'], ['_controller' => 'App\\Controller\\ProduitsController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/produits']], [], [], []],
    'app_produits_delete' => [['id'], ['_controller' => 'App\\Controller\\ProduitsController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/produits']], [], [], []],
    'api_app_register' => [[], ['_controller' => 'App\\Controller\\RegisterController::register'], [], [['text', '/api/register']], [], [], []],
    'api_app_logout' => [[], ['_controller' => 'App\\Controller\\SecurityController::logout'], [], [['text', '/api/logout']], [], [], []],
    'app_stocks_index' => [[], ['_controller' => 'App\\Controller\\StocksController::index'], [], [['text', '/stocks/']], [], [], []],
    'app_stocks_new' => [[], ['_controller' => 'App\\Controller\\StocksController::new'], [], [['text', '/stocks/new']], [], [], []],
    'app_stocks_show' => [['id'], ['_controller' => 'App\\Controller\\StocksController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/stocks']], [], [], []],
    'app_stocks_edit' => [['id'], ['_controller' => 'App\\Controller\\StocksController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/stocks']], [], [], []],
    'app_stocks_delete' => [['id'], ['_controller' => 'App\\Controller\\StocksController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/stocks']], [], [], []],
    'api_login_check' => [[], [], [], [['text', '/api/login_check']], [], [], []],
];
