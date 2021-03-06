<?php
  $routes = array(
    'Api' => [
      'list' => [
        '/api/list/',
        '/api/list/{api_key}/'
      ],
      'add' => [
        '/api/add/',
        '/api/add/{api_key}'
      ],
      'delete' => [
        '/api/delete/{id}/',
        '/api/delete/{id}/{api_key}/'
      ],
      'status' => [
        '/api/status/{site_id}/',
        '/api/status/{site_id}/{api_key}/'
      ],
      'history' => [
        '/api/history/{site_id}/',
        '/api/history/{site_id}/{api_key}/'
      ],
      'home' => [
        '/api/',
        '/api/{api_key}/'
      ],
    ],
    'WebUI' => [
      'home' => '/',
      'login' => '/login',
      'logout' => '/logout',
      'see_history_by_site_id' => '/history/{site_id}',
      'add' => '/add_site',
      'edit_by_id' => '/edit/{site_id}',
      'delete_by_id' => '/delete/{site_id}',
    ]
  );

  define('ROUTES', $routes);
