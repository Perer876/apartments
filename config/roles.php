<?php

return [

    'lessor' => [
        
        'buildings' => [
            'index',
            'show',
            'create',
            'edit',
            'delete',
        ],
        
        'apartments' => [
            'index',
            'show',
            'create',
            'edit',
            'delete',
        ],

        'tenants' => [
            'index',
            'show',
            'create',
            'edit',
            'delete',
            'invite',
        ],

        'contracts' => [
            'index',
            'show',
            'create',
            'cancel',
        ],

    ],

    'tenant' => [

        'buildings' => [
            'index',
            'show',
        ],
  
        'apartments' => [
            'index',
            'show',
        ],
  
        'contracts' => [
            'show',
        ],

    ],
];