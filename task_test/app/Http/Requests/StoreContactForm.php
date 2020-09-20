<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    //認証関連
    {
        return true;
        //ここがfalseだとうまく動かない
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    //ここにバリデーションのルール作成
    {
        return [
            'your_name' => 'required|string|max:20',
            'title'     => 'required|string|max:50',
            'email'     => 'required|email|unique:contact_forms|max:255',
            'url'       => 'url|nullable',
            'gender'    => 'required',
            'age'       => 'required',
            'contact'   => 'required|string|max:20',
            'caution'   => 'required|accepted',
            //左側がformのname属性
            //必須項目についてはrequired
            //emailだけはuniqueで一つしか同じメールアドレスを登録できないようにする
            //acceptedはcheckboxにチェックしているかどうか
        ];
    }
}
