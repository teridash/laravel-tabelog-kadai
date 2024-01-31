@extends('layouts.app')

@section('content')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<div class="container d-flex justify-content-center mt-3">
<div class="w-50">
  <h1 class="mt-4">マイページ</h1>
  @if (session('message'))
  {{ session('message') }}
  @endif
  <hr>
  <div class="container">
    <div class="d-flex justify-content-between">
      <div class="row">
        <div class="align-items-center mt-3 mb-4">
          <div class="d-flex flex-column">
            <a href="{{ route('mypage.edit') }}" class="mypage">プロフィール編集</a>
          </div>
        </div>
        <hr>
        @if(!$user->subscribed('main'))
        <div class="align-items-center mt-3 mb-4">
          <a href="{{ route('checkout.index') }}" class="mypage">有料会員になる</a>
        </div>
        <hr>
        @else
        <div class="align-items-center mt-3 mb-4">
          <a href="{{ route('checkout.cancel') }}" class="mypage">有料会員を解約する</a>
        </div>
        <hr>
        <div class="align-items-center mt-3 mb-4">
          <a href="{{ route('mypage.reservations') }}" class="mypage">予約履歴</a>
        </div>
        <hr>
        @endif
        <div class="align-items-center mt-3 mb-4">
          <a href="{{ route('mypage.edit_password') }}" class="mypage">パスワード変更</a>
        </div>
        <hr>
        <div class="align-items-center mt-3 mb-4">
          <a href="{{ route('logout') }}" class="mypage" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        </div>
        <hr>
          @csrf
      </div>
    </div>
  </div>
</div>
</div>
@endsection