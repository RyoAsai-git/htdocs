<?php

namespace App\Services;

class CheckFormData
{
    //一覧表示の際にデータベースの値がそのまま表示されるので、genderの内容が0か1で表示される
    //男女で表示するための処理
    public static function checkGender($data) {
        //staticと記述することでクラスのインスタンス化をしなくてもアクセスできる
        if ($data->gender === 0) {
            $gender = '男性';
        }
        if ($data->gender === 1) {
            $gender = '女性';
        }

        return $gender;
    }

    public static function checkAge($data) {

        if ($data->age === 1) {
            $age = '〜19歳';
        }
        if ($data->age === 2) {
            $age = '20歳〜29歳';
        }
        if ($data->age === 3) {
            $age = '30歳〜39歳';
        }
        if ($data->age === 4) {
            $age = '40歳〜49歳';
        }
        if ($data->age === 5) {
            $age = '50歳〜59歳';
        }
        if ($data->age === 6) {
            $age = '60歳〜';
        }

        return $age;
    }
}