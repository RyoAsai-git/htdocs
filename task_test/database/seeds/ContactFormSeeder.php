<?php

use App\Models\ContactForm;
use Illuminate\Database\Seeder;

class ContactFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ContactForm::class, 200)->create();
        //200のダミーデータを生成
        //factoryというヘルパ関数
        //ここでのモデル名（ContactFormなど）が冒頭の記述でインポートできているか確認する癖をつける
        //+ DatabaseSeeder内にも記述を忘れずに
    }
}
