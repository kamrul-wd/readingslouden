<?php

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'email' => 'ben@pingalamedia.co.uk',
        'password' => bcrypt('pingala123'),
        'remember_token' => str_random(10),
        'created_at' => \Carbon\Carbon::now(),
    ];
});

$factory->define(App\Models\Page::class, function (Faker\Generator $faker) {
    $heading = $faker->bs();

    return [
        'slug' => str_slug($heading),
        'heading' => ucfirst($heading),
        'excerpt' => $faker->paragraph(1),
        'content' => $faker->paragraph(4),
        'template' => '',
        'on_main_nav' => 1,
        'active' => 1,
        'protected' => 0,
    ];
});

$factory->define(App\Models\MediaPreset::class, function (Faker\Generator $faker) {
    $heading = $faker->bs();

    return [
        'name' => ucwords($heading),
        'width' => $faker->randomNumber(4),
        'height' => $faker->randomNumber(3),
    ];
});

$factory->define(App\Models\PageMeta::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->sentence(10),
        'robots' => 'index,follow',
    ];
});

$factory->define(App\Models\PageExtra::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->sentence(10),
        'robots' => 'index,follow',
    ];
});

$factory->define(App\Models\Setting::class, function (Faker\Generator $faker) {
    return [
        'label' => $faker->sentence(3),
        'name' => $faker->bothify('Name ??????'),
        'value' => $faker->bothify('value_????'),
    ];
});

$factory->define(App\Models\CompanyDetail::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'email' => 'example@gmail.com',
        'address' => '234 The Road',
        'post_code' => 'ME5 8OW',
        'telephone_1' => '9876543210',
        'telephone_2' => '1234567890',
    ];
});
