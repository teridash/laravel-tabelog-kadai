@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-3">
<div class="w-50">
  <h1 class="mt-4">パスワード変更</h1>
  <hr>
  <form method="post" action="{{route('mypage.update_password')}}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div>
      <label for="password">新しいパスワード</label>

      <div>
        <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control">
        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div>
      <label for="password-confirm">確認用</label>
      <div>
        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control">
      </div>
    </div>

    <div>
      <button type="submit" class="btn btn-success mt-3">パスワード更新</button>
    </div>
  </form>
</div>
</div>

@endsection