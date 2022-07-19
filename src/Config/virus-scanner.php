<?php

return [
    'eset' => [
        'host' => env('ESET_HOST' , '10.25.146.90'),
        'port' => (int)env('ESET_PORT', 1344),
        'service' => env('ESET_SERVICE', 'echo')
    ]
];