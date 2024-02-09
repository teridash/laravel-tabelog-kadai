@extends('layouts.app')
 
 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-5">
             <h3 class="text-center mt-5">会員登録ありがとうございます！</h3>
 
             <p class="text-center">
                 現在、仮会員の状態です。  
             </p>
 
             <p class="text-center">
                 ただいま、ご入力いただいたメールアドレス宛に、ご本人様確認用のメールをお送りしました。  
             </p>
 
             <p class="text-center">
                 メール本文内のURLをクリックすると本会員登録が完了となります。  
             </p>
             <div class="text-center">
                 <a href="{{ url('/') }}">トップページへ</a>
             </div>
         </div>
     </div>
 </div>
 @endsection