<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Requestクラスを読み込んでいる
//vender/laravel/framework/src/illuminate/Http/Request.php

use App\Models\ContactForm;
//eloquent機能
//laravelの場合はphpで値をデータベースに保存する手順よりも簡単に保存できる
// php PDO bind など

use Illuminate\Support\Facades\DB;
//クエリビルダを用いるため

use App\Services\CheckFormData;
//ファットコントローラー解消のため showアクション
//Servicesフォルダ内のCheckFormDataへ分けた

use App\Http\Requests\StoreContactForm;
use App\Services\SearchData;

//バリデーションを設定したファイルを読み込む

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    //フォームの値を持ってくる必要があるので Request $request
    //di
    //Requestクラスのインスタンスで$requestを持ってくることができる
    {
        $search = $request->input('search');
        
        //ex aaaと検索
        // dd($request);
        // Illuminate\Http\Request {#51 ▼
        //     #json: null
        //     #convertedFiles: null
        //     #userResolver: Closure($guard = null) {#354 ▶}
        //     #routeResolver: Closure() {#364 ▶}
        //     +attributes: Symfony\Component\HttpFoundation\ParameterBag {#53 ▶}
        //     +request: Symfony\Component\HttpFoundation\ParameterBag {#59 ▼
        //       #parameters: array:1 [▼
        //         "search" => "aaa"
        //       ]
        //     }
        //     +query: Symfony\Component\HttpFoundation\ParameterBag {#59 ▶}
        //     +server: Symfony\Component\HttpFoundation\ServerBag {#55 ▶}
        //     +files: Symfony\Component\HttpFoundation\FileBag {#56 ▶}
        //     +cookies: Symfony\Component\HttpFoundation\ParameterBag {#54 ▶}
        //     +headers: Symfony\Component\HttpFoundation\HeaderBag {#57 ▶}
        //     #content: null
        //     #languages: null
        //     #charsets: null
        //     #encodings: null
        //     #acceptableContentTypes: null
        //     #pathInfo: "/contact/index"
        //     #requestUri: "/contact/index?search=aaa"
        //     #baseUrl: ""
        //     #basePath: null
        //     #method: "GET"
        //     #format: null
        //     #session: Illuminate\Session\Store {#393 ▶}
        //     #locale: null
        //     #defaultLocale: "en"
        //     -preferredFormat: null
        //     -isHostValid: true
        //     -isForwardedValid: true
        //     basePath: ""
        //     format: "html"
        //   }


        // eloquent orマッパー
        // $contacts = ContactForm::all();
        //データベースの値を全て持ってくる

        // dd($contacts);
        //コレクション型で表示

        //クエリビルダ
        // $contacts = DB::table('contact_forms')
        // ->select('id', 'your_name', 'title', 'created_at')
        // // ->orderBy('created_at', 'desc') 降順 新しい順
        // // ->orderBy('created_at', 'asc') 昇順 古い順
        // // ->get();
        // ->paginate(20);

        $query    = SearchData::searchWords($search); 
        $contacts = $query->paginate(20);

        return view('contact.index', compact('contacts'));
        // .があると .の前までがフォルダになり 後がファイル名
        // viewの contactフォルダのindexファイル
        // compactで変数を渡す ('')内は$マーク不要

        // web.phpでは指定されてここへ飛ぶ
        // ここからcontact/indexへ
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactForm $request)
    //引数にRequest
    //phpでは$_POSTで持ってきた laravelの場合はRequestで持ってくる
    //インスタンス化したものを持ってくる DI dependency injection 依存性の注入
    {
        $contact = new ContactForm;
        //インスタンス化
        //データベース名であり、クラス名

        //contactのプロパティ(変数)が用意されている
        //プロパティがテーブルのカラム名と対応
        //インスタンス化した変数で繋ぐ
        $contact->your_name = $request->input('your_name');
        $contact->title     = $request->input('title');
        $contact->email     = $request->input('email');
        $contact->url       = $request->input('url');
        $contact->gender    = $request->input('gender');
        $contact->age       = $request->input('age');
        $contact->contact   = $request->input('contact');

        $contact->save();
        //保存するメソッド

        return redirect('contact/index');
        //強制的に元の画面に戻す

        // dd($your_name, $title);
        
        // $input = $request->all();
        // 全てのデータを持ってくる記述

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    // 引数id 
    // 一人ずつ取り出すのでEloquentの方が早い
    {
        $contact = ContactForm::find($id);
        //findメソッド 一個だけデータをとってくる

        $gender = CheckFormData::checkGender($contact);
        //::でメソッドを指定できる
        $age    = CheckFormData::checkAge($contact);

        return view('contact.show', 
        compact('contact', 'gender', 'age'));
        //compactは変数を複数渡すことができる
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = ContactForm::find($id);

        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    // 引数idを持ってきている
    // 今あるインスタンスを持ってくる必要
    {
        $contact = ContactForm::find($id);
        // $contact = new ContactForm;

        $contact->your_name = $request->input('your_name');
        $contact->title     = $request->input('title');
        $contact->email     = $request->input('email');
        $contact->url       = $request->input('url');
        $contact->gender    = $request->input('gender');
        $contact->age       = $request->input('age');
        $contact->contact   = $request->input('contact');
        //Requestから持ってきた値を今の値で上書き

        $contact->save();
        //保存

        return redirect('contact/index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = ContactForm::find($id);

        $contact->delete();

        return redirect('contact/index');

        // $contact = ContactForm::find($id);
        // $contact->delete();
        // return redirect('contact/index');
    }
}
