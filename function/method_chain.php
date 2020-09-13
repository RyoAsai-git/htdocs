<?php

// http://wwww.objective-php.net/blog/detail/20110113

//商品クラス
class Product {
    private $price = 1000;

    //価格取得
    public function getPrice() {
        return $this->price;
    }
}

//カートクラス
class Cart {
    private $product = [];

    //商品追加
    public function addItem($product) {
        $this->products[] = $product;
    } 

    //商品取得
    public function getItem($index) {
        return $this->products[$index];
    }
}

$cart = new Cart();
//インスタンスを実行

//引数にインスタンス
$cart->addItem(new Product());
//引数でインスタンスを作成することでProductの持っているメソッドを使うことができる

//通常(それぞれメソッドを実行)
$gotItem = $cart->getItem(0);
$price   = $gotItem->getPrice();

echo '<br>';
echo '通常メソッド' . '<br>';
echo $price;
echo '<br>';


//メソッドチェーン
//メソッドの後にインスタンス(ここでの場合はProduct)のメソッド(getPrice)をチェック
$price = $cart->getItem(0)->getPrice();
//$cart->addItem(new Product());を実行したためこのようにメソッドをつなげることができる

echo 'メソッドチェーン' . '<br>';
echo $price;
echo '<br>';