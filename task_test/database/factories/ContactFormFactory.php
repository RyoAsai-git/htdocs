<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;
use App\Models\ContactForm;
//ここのModelの箇所を実際にダミーデータを作るモデルと合わせる必要がある
use Faker\Generator as Faker;

// $factory->define(Model::class, function (Faker $faker) {
    //ここのModelも変更
   $factory->define(ContactForm::class, function (Faker $faker) { 
    return [
        'your_name' => $faker->name,
        //左側 カラム
        //右側 $faker->作りたいダミーデータの条件
        'title'     => $faker->realText(50),
        //日本語の場合はRealTextしか使えない ()で文字数
        'email'     => $faker->unique()->email,
        // unique 一つだけのものを作る必要
        'url'       => $faker->url,
        'gender'    => $faker->randomElement(['0', '1']),
        'age'       => $faker->numberBetween($min = 1, $max = 6),
        'contact'   => $faker->realText(200), 
    ];
});

//fakerを設定したらそれをシーダーに加える必要