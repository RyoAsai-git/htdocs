<?php

namespace App\Models;

class TestModel {
//ファイルと同じ名前のクラスにする必要 1ファイル1クラス
    private $text = 'hello world';

    public function getHello() {
        return $this->text;
    }
}