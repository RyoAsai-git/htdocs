<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;

class ShopController extends Controller
{
    public function index() {
        //主 -> 従
        $area_tokyo = Area::find(1)->shops;
        //東京に紐づいているお店が出てくる
        // dd($area_tokyo);

        //主 <- 従
        $shop = Shop::find(3)->area->name;
        //shopのid3つめ

        //laravelのモデルにhasMany belongsToを書いてあげるとINNER JOINを使わずにリレーション

        $shop_route = Shop::find(1)->routes()->get();
        dd($area_tokyo, $shop, $shop_route);
    }
}
