@extends('layout')

{{--メインコンテンツ--}}
@section('contents')
        <h1>ログイン</h1>
        <form action="/login" method="post">
            ログインID:<input name="email"><br>
            パスワード:<input name="password" type="password"><br>
            <button>ログインする</button>
        </form>
@endsection