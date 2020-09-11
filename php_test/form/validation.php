<?php

function validation($data) {
    $error = [];
    //ローカル変数

    if (empty($data['your_name']) || 20 < mb_strlen($data['your_name'])) {
        $error[] = '氏名は20文字以内で入力してください';
    }

    //フィルターバー
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $error[] = 'メールアドレスは正しい形式で入力してください';
        //空の場合か FILTER_VALIDATE_EMAILでemailの形かどうかを判定
        //!filter_varでメールアドレスの形でないならエラー
    }

    if (!empty($data['url'])) {
        if (!filter_var($data['url'], FILTER_VALIDATE_URL)) {
            $error[] = 'ホームページは正しい形式で入力してください';
        }
    }

    if (!isset($data['gender'])) {
        $error[] = '性別は必ず入力してください';
        //radioボタンでvalue 0 1で管理
        //emptyと書くと0の場合でも通ってしまう 男性を選んでいたとしてもエラーになる 
        //今回はissetで処理
        //$data['gender']に0か1が設定されていなかったらerrorに値をいれる
    }

    if (empty($data['age']) || 6 < $data['age']) {
        $error[] = '年齢は必ず入力してください';
    }

    if (empty($data['contact']) || 200 < mb_strlen($data['contact'])) {
        $error[] = 'お問い合わせ内容は200文字以内で入力してください';
    }

    if ($data['caution'] !== '1') {
        $error[] = '注意事項をご確認ください';
    }


    return $error;
}