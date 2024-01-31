@extends('layouts.app')

@section('content')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<div class="container mt-2">
  <div class="row">
    <h1 class="mt-3">店舗一覧</h1>
    <div class="text-center d-flex justify-content-center">
      <form action="{{route('stores.index')}}" method="GET">
          <select name="category_id" class="form-select mt-3">
            <option disabled selected value>カテゴリを選択</option>
            @foreach($categories as $category)
            @if(isset($_GET['category_id']) && $category->id == $_GET['category_id'])
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
            @endforeach
          </select>
        <input type="text" name="name" class="form-control mt-3" placeholder="キーワード・店舗名" value="{{isset($_GET['name']) ? $_GET['name'] : ''}}">
        <input type="text" name="address" class="form-control mt-3" placeholder="エリア" value="{{isset($_GET['address']) ? $_GET['address'] : ''}}">
        <button type="submit" class="btn btn-success mt-3 mb-3" value="送信">検索</button>
      </form>
    </div>
  </div>
</div>

<div class="d-flex justify-content-center mt-4">
    <div class="col-4 mt-4">
      @if($stores->isEmpty())
      <h5 class="text-center">検索条件と一致する店舗がありません。</h5>
      @else
      @foreach($stores as $store)
      <a href="{{ route('stores.show', $store->id) }}" class="text-decoration-none">
        @if ($store->image !== "")
        <img src="{{ asset($store->image) }}" class="img-thumbnail ">
        @else
        <img src="{{ asset('img/noimage.png') }}" class="img-thumbnail">
        @endif
        <table class="table">
          <tr>
            <th>店舗名</th>
            <th>{{ $store -> name }}</th>
          </tr>
          <tr>
            <th>値段</th>
            <th>{{ $store -> price }}円～</th>
          </tr>
          <tr>
            <th>住所</th>
            <th>{{ $store -> address }}</th>
          </tr>
          <tr>
            <th>電話番号</th>
            <th>{{ $store -> phone_number }}</th>
          </tr>
        </table>
      </a>
      <br>
      @endforeach
      {{ $stores->links() }}
      @endif
    </div>
    
</div>

@endsection

