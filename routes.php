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
        '/api/status/{site_id}',
        '/api/status/{site_id}/{api_key}'
      ],
      'home' => [
        '/api/',
        '/api/{api_key}/'
      ],
    ],
  );

  define('ROUTES', $routes);
