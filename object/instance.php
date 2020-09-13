<?php

class Product{
    //アクセス修飾子, private public protected
    //何も書かなけばpublic(公開) 外からでもアクセスできる
    //            private このクラスからしかアクセスできない
    //            protected 自分と継承したクラスのみ使える
    
    //変数
    private $product = [];
    //クラスの中で使える配列
    
    //関数
    function __construct($product) {
        $this->product = $product;
    }
    //クラスを呼び出した初回に起動する関数
    //$thisはこのクラスの中という意味
    //ここではこのクラスの中のproduct ここでのproductは$product $マークを書かない

    public function getProduct() {
        echo $this->product;
    }
    //このクラスの中のproductを呼び出す

    public function addProduct($item) {
        $this->product .= $item;
    }
    //このクラスの中のproductに引数$itemを追加する .=で

    public static function getStaticProduct($str) {
        echo $str;
    }
    //staticとつけることで静的に関数を使うことができる
    //静的にinstanceを作らず使うことができる
}

$instance = new Product('テスト');
//インスタンスを作成
// var_dump($instance);
// object(Product)#1 (1) { ["product":"Product":private]=> string(9) "テスト" } テスト
// 配列であればobjectの箇所にarrayと来ていた

//引数で'テスト'
//最初に呼び出すので__construct内で動く
//$product中身が入ってきた引数'テスト'になる

$instance->getProduct();
echo '<br>';

$instance->addProduct('追加分');

$instance->getProduct();

Product::getStaticProduct('静的');
echo '<br>';

//クラス名::関数名で静的な関数を使うことができる