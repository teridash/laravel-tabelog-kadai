@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-3">
  <div class="w-50">
    <h1 class="mt-4">有料会員になる</h1>
    <hr>
    <form id="card_form" action="{{route('checkout.store')}}" method="POST">
      @csrf
      <label for="name" class="mt-2 ms-2 fs-5">クレジットカード登録</label>
      <input id="card-holder-name" type="text" class="form-control mt-1" placeholder="カード名義人">
      <div id="card-element" class="form-control form-control-lg mt-3"></div>
      <input name="payment_method" type="hidden">
    </form>


    <button id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-success mt-3 mb-3">
        登録
    </button>
  </div>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
  const stripe = Stripe("{{env('STRIPE_KEY')}}");

  const elements = stripe.elements();
  const cardElement = elements.create('card',{hidePostalCode: true});

  cardElement.mount('#card-element');


  const cardHolderName = document.getElementById('card-holder-name');
  const cardButton = document.getElementById('card-button');
  const clientSecret = cardButton.dataset.secret;
  
  cardButton.addEventListener('click', async (e) => {
      const { setupIntent, error } = await stripe.confirmCardSetup(
          clientSecret, {
              payment_method: {
                  card: cardElement,
                  billing_details: { name: cardHolderName.value }
              }
          }
      );

      if (error) {
          console.log(error);
      } else {
        const form = document.getElementById('card_form');
        form.payment_method.value = setupIntent.payment_method;
        form.submit();
      }
  });
</script>

@endsection