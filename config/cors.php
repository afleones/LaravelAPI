<?php

return [
    'paths' => ['v1/*'], // Permitir todas las rutas bajo v1/
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'], // Reemplaza '*' por el origen de tu frontend si es necesario
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
