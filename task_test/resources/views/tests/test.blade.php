test
<!-- viewファイルは基本的にbladeをつける -->

<!-- TestControllerから渡されたコレクション型の$valuesを表示するためにはforeach -->

@foreach($values as $value)
{{$value->id}}<br>
{{$value->text}}<br>
@endforeach

<!-- 以下のように出力される -->
<!-- test 1
aaa
2
bbb -->

<!-- ここまでの処理の流れ -->
<!-- ルーティングでtests/testにアクセス -->
<!-- コントローラーに渡り、データベースの情報を持ってくる -->
<!-- データベースの情報をviewでforeachで展開 -->