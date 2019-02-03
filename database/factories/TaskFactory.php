<?php

use Faker\Generator as Faker;
use App\Models\{Task, TaskType, TaskStatus, User};


$factory->define(Task::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\en_US\Person($faker));

    return [
        'theme' => $faker->text(rand(15,150)),
        'status' => TaskStatus::random(),
        'type' => TaskType::random(),
        'content' => $faker->text(6000),
        'creator_id' => User::random()->id,
        'performer_id' => User::random()->id, 
    ];
});

$factory->state(Task::class, 'open-status' ,function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\en_US\Person($faker));

    return [
        'theme' => $faker->text(rand(15,150)),
        'status' => TaskStatus::$open,
        'type' => TaskType::random(),
        'content' => $faker->text(6000),
        'creator_id' => User::random()->id,
        'performer_id' => User::random()->id,
    ];
});


$factory->state(Task::class, 'closed-status' ,function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\en_US\Person($faker));

    return [
        'theme' => $faker->text(rand(15,150)),
        'status' => TaskStatus::$closed,
        'type' => TaskType::random(),
        'content' => $faker->text(6000),
        'creator_id' => User::random()->id,
        'performer_id' => User::random()->id,
    ];
});



$factory->state(Task::class, 'working-status' ,function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\en_US\Person($faker));
    return [
        'theme' => $faker->text(rand(15,150)),
        'status' => TaskStatus::$working,
        'type' => TaskType::random(),
        'content' => $faker->text(6000),
        'creator_id' => User::random()->id,
        'performer_id' => User::random()->id,
    ];
});


