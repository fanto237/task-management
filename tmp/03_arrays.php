<?php

    // Simple arrays
    $numbers = [12, 2, 3, 9, 23];
    $fruits = array('ananas', 'tomates', 'oranges');
    print_r($numbers);
    print_r($fruits);
    var_dump($fruits);
    echo $fruits[0];

    // Associative Arrays
    $colors = [
        1 => 'red',
        2 => 'blue',
        5 => 'yellow'
    ];

    echo $colors[1];

    $hex = [
        'red' => '#f00',
        'green' => '#0f0',
        'blue' => '#00f'
    ];

    echo $hex['red'];

    $person = [
        'name' => 'lucien',
        'aka' => 'fanto',
        'email' => 'lucien@fantodev.com'
    ];

    echo $person['name'];

    $people = [
        [
            'name' => 'lucien',
            'aka' => 'fanto',
            'email' => 'lucien@fantodev.com'
        ],
        [
            'name' => 'oscar',
            'aka' => 'toji',
            'email' => 'oscar@tojidev.com'
        ],
        [
            'name' => 'magie',
            'aka' => 'icien',
            'email' => 'magination@fantodev.com'
        ]
    ];

    echo $people[0]['aka'];
    print_r(json_encode($people));
?>