<?php

//抽象クラス
//設定するメソッドを強制する
abstract class ProductAbstract {
    //抽象クラスはクラス名にabstractをつける 
    //メソッド名にもAbstractをつけることも
    public function echoProduct() {
        echo '親クラスです';
    }

    abstract public function getProduct();
    //abstractをつけると関数の中身をかけない
    // {echo '親クラスです'}など
}

//具象クラス //親クラス 基底クラス スーパークラス
//インスタンス化できるクラスとして具象クラス
class BaseProduct {
    public function echoProduct() {
        echo '親クラスです';
    }

    public function getProduct() {
        echo '親の関数です';
    }
}

//小クラス 派生クラス サブクラス
//ProductAbstractで抽象クラスを継承
//継承すると抽象クラスのabstractメソッドを絶対に使わないといけない
class Product extends ProductAbstract {
    private $product = [];

    function __construct($product) {
        $this->product = $product;
    }

    public function getProduct() {
        echo $this->product;
    }

    public function addProduct($item) {
        $this->product .= $item;
    }

    public static function getStaticProduct($str) {
        echo $str;
    }
}

$instance = new Product('テスト');

$instance->getProduct();
echo '<br>';

$instance->echoProduct();

$instance->addProduct('追加分');

$instance->getProduct();

Product::getStaticProduct('静的');
echo '<br>';