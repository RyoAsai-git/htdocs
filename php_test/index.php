<?php

$array = [1,2,3];

echo '<pre>';
//preで配列を縦に見やすく出力する
var_dump($array);
echo '</pre>';

$array_2 = [
    ['赤','青','黄色'],
    ['緑', '紫', '黒'],
];

echo '<pre>';
var_dump($array_2);
echo '</pre>';

$array_member_2 = [
    '本田' => [
        'height' => 180,
        'hobby' => 'サッカー',
    ],
    '香川' => [
        'height' => 180,
        'hobby' => 'サッカー',
    ]
];

$array_member_3 = [
    '1kumi' => [
        '本田' => [
            'height' => 180,
            'hobby' => 'サッカー',
        ],
        '香川' => [
            'height' => 180,
            'hobby' => 'サッカー',
        ]
    ],
    '2kumi' => [
        '長友' => [
        'height' => 180,
        'hobby' => 'サッカー',
        ],
        '乾' => [
            'height' => 180,
            'hobby' => 'サッカー',
        ],
    ],

];