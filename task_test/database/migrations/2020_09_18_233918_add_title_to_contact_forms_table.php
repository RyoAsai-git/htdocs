<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleToContactFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contact_forms', function (Blueprint $table) {
            //
            //マイグレーションファイルを新規作成した際はSchema::create
            //今回は追加 Schema::table tableだと既存のテーブルを変更する
            // $table->string('title', 50);
            //このまま追加するとtimestampの後ろに追加される(最後尾)
            //->afterという記述を使う
            $table->string('title', 50)->after('your_name');
            //your_nameの後に追加される
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('contact_forms', function (Blueprint $table) {
        //     //
        //     $table->dropColumn('title');
        // });
    }
}
