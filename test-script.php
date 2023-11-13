<?php
$planets = [
    'Mercury',
    'Venus',
    'Earth',
    'Mars',
    'Jupiter',
    'Saturn',
    'Uranus',
    'Neptune',
];
$stars = [
    'Polaris',
    'Sirius',
    'Alpha Centauari A',
    'Alpha Centauari B',
    'Betelgeuse',
    'Rigel',
    'Other'
];
$locationNameChoices = [
    'solar_system' => array_combine($planets, $planets),
    'star' => array_combine($stars, $stars),
    'interstellar_space' => null,
];
print_r($locationNameChoices);
