<?php

use App\Models\ContactForm;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        //ここをコメントアウトするとデータの追加ができない
        $this->call(ContactFormSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(ShopSeeder::class);
    }
}
