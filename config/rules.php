<?php
return [



    [
        'pattern' => '/event/<id:\d+>',
        'route' => '/site/view/',
        'encodeParams' => false,
    ],

    [
        'pattern' => '/login',
        'route' => 'site/login',
        'encodeParams' => false,
    ],

    [
        'pattern' => '/signup',
        'route' => 'site/signup',
        'encodeParams' => false,
    ],

    [
        'pattern' => '/logout',
        'route' => 'site/logout',
        'encodeParams' => false,
    ],




    [
        'pattern' => '/profile',
        'route' => 'profile/index',
        'encodeParams' => false,
    ],



    [
        'pattern' => '/seek/<full_slug:.*>',
        'route' => 'site/seek',
        'encodeParams' => true,
    ],

    [
        'pattern' => '/site/tag/<id:\d+>',
        'route' => '/site/tag',
        'encodeParams' => true,
    ],





];
