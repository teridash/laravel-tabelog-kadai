@extends('layouts.app')

@section('content')
<!doctype html>
<html lang="ja">
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <div class="container">
    <div>
        <h1 class="mt-4">会社情報</h1>
      <table class="table table-striped mt-4">
        <tr>
          <th scope="row">会社名</th>
          <td>{{ $campany->name }}</td>
        </tr>
        <tr>
          <th scope="row">住所</th>
          <td>{{ $campany->address }}</td>
        </tr>
        <tr>
          <th scope="row">代表者</th>
          <td>{{ $campany->representative }}</td>
        </tr>
        <tr>
          <th scope="row">メールアドレス</th>
          <td>{{ $campany->email }}</td>
        </tr>
      </table>
    </div>
  </div>
  <script src="js/bootstrap.min.js"></script>
</html>
@endsection