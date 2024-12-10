<?php

use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Middleware\AuthenticateSession;

return [



    'stack' => 'livewire',


    'middleware' => ['web'],

    'auth_session' => AuthenticateSession::class,


    'guard' => 'sanctum',

    'features' => [
        // Features::termsAndPrivacyPolicy(),


        // Features::profilePhotos(),


        // Features::api(),


        // Elimina esta línea o coméntala para desactivar equipos
        // Features::teams(['invitations' => true]),
        Features::accountDeletion(),
    ],


    'profile_photo_disk' => 'public',

];
