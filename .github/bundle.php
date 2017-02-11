<?php
return [
    [
        'name' => 'Disable Comments',
        'slug' => 'disable-comments',
        'required' => false,
        'force_activation' => true
    ],
    [
        'name' => 'Models',
        'slug' => 'models',
        'source' => 'https://github.com/soberwp/models/archive/master.zip',
        'external_url' => 'https://github.com/models/intervention',
        'required' => true,
        'force_activation' => true,
        'force_deactivation' => false
    ]
];
