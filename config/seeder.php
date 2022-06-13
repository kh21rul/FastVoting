<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tester Seeder
    |--------------------------------------------------------------------------
    |
    | This value will be used to seed "The Tester".
    | If `tester_is_admin` is true, The Tester will be an admin.
    |
    */

    'tester_name' => env('SEEDER_TESTER_NAME', 'Tester'),
    'tester_email' => env('SEEDER_TESTER_EMAIL', 'test@fastvoting.online'),
    'tester_password' => env('SEEDER_TESTER_PASSWORD', 'password'),
    'tester_is_admin' => env('SEEDER_TESTER_IS_ADMIN', false),
];
