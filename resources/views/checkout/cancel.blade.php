@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-3">
  <div class="w-50">
    <h1 class="mt-4">有料会員を解約する</h1>
    <hr>
    <p class="mt-4">本当に有料会員を解約してもよろしいですか？</p>
    <form id="card_form" action="{{route('checkout.delete')}}" method="POST">
      @csrf
    <button type="submit" class="btn btn-danger mt-2">解約</button>
    </form>
  </div>
</div>
@endsection