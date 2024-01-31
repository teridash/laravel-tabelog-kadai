@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center mt-3">
  <div class="w-50">
  <h1 class="mt-4">予約履歴</h1>
  <hr>
    @if($reservations->count() == 0)
    <h4 class="mt-4">予約情報はありません。</h4>
    @else
    @foreach ($reservations as $reservation)
    <table class="table">
    <tr>
      <th>店舗名</th>
      <th>{{ $reservation->store->name }}</th>
    </tr>
    <tr>
      <th>人数</th>
      <th>{{ $reservation->number_of_people }}人</th>
    </tr>
    <tr>
      <th>日時</th>
      <th>{{ $reservation->date_time }}</th>
    </tr>
    </table>
    <form action="{{route('reservations.destroy', $reservation)}}" method="post" onsubmit="return confirm('予約をキャンセルします。よろしいですか？');">
      @csrf
      @method('DELETE')  
      <button type="submit" class="btn btn-danger mb-4">キャンセルする</button>
    </form>
    @endforeach
    @endif
  </div>
</div>
@endsection