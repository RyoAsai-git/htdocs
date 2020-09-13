<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

//インターフェース
interface ProductInterface {
    //名前にもInterfaceをつけることが多い
    // public function echoProduct() {
    //     echo '親クラスです';
    // }
    
    //インターフェースはメソッドの強制部分しかかけない
    public function getProduct();
}


interface NewsInterface {
    
    public function getNews();
}

class BaseProduct {
    public function echoProduct() {
        echo '親クラスです';
    }

    public function getProduct() {
        echo '親の関数です';
    }
}

//インターフェースを使う場合はimplementsを使う
//クラスの場合は継承は一つだけ
//インターフェースの場合は複数
class Product implements ProductInterface, NewsInterface{
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

    public function getNews() {
        echo 'ニュースです';
    }

    public static function getStaticProduct($str) {
        echo $str;
    }

}

$instance = new Product('テスト');

$instance->getProduct();
echo '<br>';

// $instance->echoProduct();
// echo '<br>';

$instance->addProduct('追加分');
echo '<br>';

$instance->getProduct();
echo '<br>';

$instance->getNews();
echo '<br>';

Product::getStaticProduct('静的');
echo '<br>';