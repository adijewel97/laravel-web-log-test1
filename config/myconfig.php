<?php

return [
    'variable' => [
        'SVR_URL_API' => (strtoupper(env('SVR_API_SVR_USE', '')) == 'URL')
            ?
            env('SVR_API_SVR_URL', 'http://127.0.0.1:8000') . '/' . env('SVR_API_SVR_ALIAS', 'api') . '/'
            :
            'http://' . env('SVR_API_SVR_IP', 'http://127.0.0.1') . ':' . env('SVR_API_SVR_PORT', '8000') . '/' . env('SVR_API_SVR_ALIAS', 'api') . '/'
    ]

];
