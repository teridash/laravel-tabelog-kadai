@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-3">
<div class="w-50">
  <h1 class="mt-4">予約</h1>
  <hr>
  <label for="user_name" class="m-2 fs-5">お名前</label><br>
  <h4 class="m-2">{{ $user_name }}</h4>

  <form action="{{ route('reservations.store') }}" method="POST">
    @csrf
    <label for="number_of_people" class="mt-2 ms-2 fs-5">人数</label>
    <input type="number" name="number_of_people" value="{{old('number_of_people')}}" class="form-control mt-1" placeholder="例：1（1人）">

    <label for="date" class="mt-2 ms-2 fs-5">日付</label>
    <input type="date" name="date" value="{{old('date')}}" class="form-control mt-1">

    <label for="time" class="mt-2 ms-2 fs-5">時間</label>
    <input type="number" name="time" value="{{old('time')}}" class="form-control mt-1" placeholder="例：13（13時）">

    <input type="hidden" name="store_id" value="{{ $store_id }}">
    <button type="submit" class="btn btn-success mt-4">予約</button>
  </form>
  @if (isset($errors))
  @foreach ($errors->all() as $error)
  <p class="mt-2 text-danger">※{{ $error }}</p>
  @endforeach
  @endif
</div>
</div>
@endsection