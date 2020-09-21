<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SearchData
{
    public static function searchWords($search) {
        $query = DB::table('contact_forms');
        //$queryとしてテーブルをとってくる

            //もし検索ワードがあれば
            if ($search !== null) {
                //全角スペースを半角に
                $search_split = mb_convert_kana($search, 's');
                //引数で's'とすると全角スペースを半角にする
                //ex
                //あああ いいい と言った検索の際に間を全角にする人もいる あああ　いいいのように

                //空白で区切る
                $search_split2 = preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY);
                //正規表現
                //オプション PREG_SPLIT_NO_EMPTY 空文字でないものがpreg_splitにより返される

                //単語をループで回す
                foreach ($search_split2 as $value) {
                    $query->where('your_name', 'like', '%'.$value.'%');
                }
             }
        
        $query->select('id', 'your_name', 'title', 'created_at');
        $query->orderBy('created_at', 'asc');
        
        return $query;
    }
}