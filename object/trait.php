<?php

trait ProductTrait{
    public function getProduct() {
        echo 'プロダクト';
    } 
}

trait NewsTrait {
    public function getNews() {
        echo 'ニュース';
    }
}

class Product {
    use ProductTrait;
    use NewsTrait;
    //useを使うことでproductを持ってくることができる
    //クラスは単一継承だがトレイとは複数作れる

    public function getInformation() {
        echo 'クラスです';
    }

    // public function getNews() {
    //     echo 'クラスのニュースです';
    // }
    //オーバーライドもできる
}

$product = new Product();

$product->getInformation();
echo '<br>';
$product->getProduct();
echo '<br>';
$product->getNews();
echo '<br>'; 

//こういったクラスの関係はコードだとややこしい
//規模が大きくなればなるほど自分がどこの作業をしているかわからなくなる
//クラス図と言った形で残す クラス構成
//統一モデリング言語 UMLといったりもする