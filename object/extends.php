<?php

//親クラス //基底クラス スーパークラス
class BaseProduct {
    //変数 関数
    public function echoProduct() {
        echo '親クラスです';
    }

    // オーバーライド 上書き
    // 親クラスに関数を作っておいて、同じ名前で小クラスに関数を作っておくと小クラスのほうで上書きする
    public function getProduct() {
        echo '親の関数です';
    }

    //アクセス修飾子でprotectedを指定すると親クラスか小クラスからアクセスできるようになる
}

//小クラス //派生クラス サブクラス
class Product extends BaseProduct {
    //extends 親クラスで継承
    //継承を行うことで親クラスの関数などを利用できる

// final class Product extends BaseProduct {
    //finalを先頭につけるともうこのクラスから継承ができなくなる
    private $product = [];

    function __construct($product) {
        $this->product = $product;
    }

    public function getProduct() {
        echo $this->product;
    }
    //親クラスにもgetProductがあるが、オーバーライドによって小クラスのメソッドが優先(上書き)され実行される
    //この関数をコメントアウトすると親クラスの関数はオーバーライドされず、親クラスの関数が実行される


    // final public function getProduct() {
    //     echo $this->product;
    // }
    //finalをつけたことでこの関数から継承できなくなった

    //名前がかぶっている親の関数を使いたい時 Parent::

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
//親クラスのメソッド
//継承によって使えるようになった

$instance->addProduct('追加分');

$instance->getProduct();

Product::getStaticProduct('静的');
echo '<br>';