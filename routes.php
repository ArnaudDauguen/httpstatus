<?php
  $routes = array(
    'Api' => [
      'list' => [
        '/api/list/',
        '/api/list/{api_key}/'
      ],
      'home' => [
        '/api/',
        '/api/{api_key}/'
      ],
    ],
  );

  define('ROUTES', $routes);
