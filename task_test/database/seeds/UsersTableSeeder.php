<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
//ハッシュの読み込み Hashに対しての赤線(VScodeがHashを読み込んでいないと判断)を消す

use Illuminate\Support\Facades\DB;
//ハッシュに同じ DB

class UsersTableSeeder extends Seeder
//ダミーデータはテーブルごとに作成する必要がある
//DatabaseSeederで紐づける必要


{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
        {
        //クエリビルダ
        // DB::table('users')->insert([
        //     // 'name' => Str::random(10),
        //     //randomとなっているが自分で決めることもできる
        //     'name' => 'ああああ',
        //     // 'email' => Str::random(10).'@gmail.com',
        //     'email' => 'test@test.com'
        //     // 'password' => Hash::make('password'),
        //     'password' => Hash::make('password'),
        //     //passwordは必ず暗号化 Hash::make
        // ]);

        DB::table('users')->insert([
            //今回はusersなのでログインするユーザーの初期値を設定
            [ 
                'name' => 'aaa',
                'email' => 'aaa@aaa',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'bbb',
                'email' => 'bbb@bbb',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'ccc',
                'email' => 'ccc@ccc',
                'password' => Hash::make('password'),
            ]
            //連想配列にすることで複数データが追加できる
        ]);
      

    }
}
