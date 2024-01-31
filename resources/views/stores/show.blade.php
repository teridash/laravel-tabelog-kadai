@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-4">
  <div class="col-4 offset-1 mt-5">
  @if ($store->image !== "")
  <img src="{{ asset($store->image) }}" class="img-thumbnail ">
  @else
  <img src="{{ asset('img/noimage.png') }}" class="img-thumbnail">
  @endif
  </div>
  <div class="col">
    <div class="d-flex flex-column m-5">
      <table class="table">
        <tr>
          <th>店舗名</th>
          <th>{{ $store -> name }}</th>
        </tr>
        <tr>
          <th>説明</th>
          <th>{{ $store -> description }}</th>
        </tr>
        <tr>
          <th>カテゴリ</th>
          <th>{{ $store -> category -> name }}</th>
        </tr>
        <tr>
          <th>値段</th>
          <th>{{ $store -> price }}円～</th>
        </tr>
        <tr>
          <th>開店時間</th>
          <th>{{ mb_substr( $store -> opening_time, 0, 5) }}</th>
        </tr>
        <tr>
          <th>閉店時間</th>
          <th>{{ mb_substr( $store -> closing_time, 0, 5) }}</th>
        </tr>
        <tr>
          <th>住所</th>
          <th>
            〒{{ $store -> postal_code }}<br>
            {{ $store -> address }}
          </th>
        </tr>
        <tr>
          <th>電話番号</th>
          <th>{{ $store -> phone_number }}</th>
        </tr>
        <tr>
          <th>定休日</th>
          <th>{{ $store -> holiday }}</th>
        </tr>
      </table>
    </div>
  </div>
</div>

@auth
@if(!$user->subscribed('main'))
@else
<div class="container">
  <div class="row">
    <div class="col text-center">
      <a href="{{ route('reservations.create', ['store_id' => $store->id]) }}" class="btn btn-success mb-3">予約する</a>
    </div>
  </div>
</div>
@endif
@endauth

<div class="justify-content-center m-4">
  <div class="row">
    <div class="col m-5">
      <h1>レビュー</h1>
      @auth
      @if(!$user->subscribed('main'))
      <h5 class="mt-4">
        レビューを投稿するために
        <a href="{{ route('checkout.index') }}">有料会員になる。</a>
      </h5>
      @else
      <form method="POST" action="{{ route('reviews.store') }}">
        @csrf
        <h4 class="mt-4">評価</h4>
        <select name="score" class="form-select mb-3 text-warning">
          <option value="5">★★★★★</option>
          <option value="4">★★★★</option>
          <option value="3">★★★</option>
          <option value="2">★★</option>
          <option value="1">★</option>
        </select>
        <h4>レビュー内容</h4>
        @error('content')
          <strong>レビュー内容を入力してください</strong>
        @enderror
        <textarea name="content" class="form-control"></textarea>
        <input type="hidden" name="store_id" value="{{$store->id}}"><br>
        <button type="submit" class="btn btn-success mb-3">レビューを追加</button>
      </form>
      @endif
      @endauth
    </div>
  </div>

  <div class="row">
    <div class="col m-5">
    @if($reviews->isEmpty())
    <hr>
    <h5 class="mt-5">レビューがありません。</h5>
    @else
      @foreach($reviews as $review)
      <h3>{{ $review->user->user_name }}</h3>
      <h3 class="text-warning">{{ str_repeat('★', $review->score) }}</h3>
      <p>{{ $review->content }}</p>
      <label>
        {{$review->created_at}}
      </label>
      <hr>
      @endforeach
    @endif
    </div>
  </div>
</div>

@endsection