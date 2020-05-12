@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact_styles.css')}}">

{{-- <style type="text/css">
	/**
	 * The CSS shown here will not be introduced in the Quickstart guide, but shows
	 * how you can use CSS to style your Element's container.
	 */
	.StripeElement {
	  box-sizing: border-box;

	  height: 40px;
	  width: 100%;

	  padding: 10px 12px;

	  border: 1px solid transparent;
	  border-radius: 4px;
	  background-color: white;

	  box-shadow: 0 1px 3px 0 #e6ebf1;
	  -webkit-transition: box-shadow 150ms ease;
	  transition: box-shadow 150ms ease;
	}

	.StripeElement--focus {
	  box-shadow: 0 1px 3px 0 #cfd7df;
	}

	.StripeElement--invalid {
	  border-color: #fa755a;
	}

	.StripeElement--webkit-autofill {
	  background-color: #fefde5 !important;
	}
</style> --}}

@php  
	$setting          = DB::table('settings')->first();
    $shipping_charge  = $setting->shipping_charge;
	$vat              = $setting->vat;
	
    $cart    = Cart::content();
@endphp

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 "  style="border-right: 1px solid grey; padding: 20px;">
                    <div class="cart_container">
						<div class="contact_form_title text-center">Cart Products</div>
						<table class="table mt-5">
                            <thead>
                                <tr class="text-center table-secondary">
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="style"> 
                                @php $i = 1 @endphp
                                @foreach($cart as $row)
                                    <tr class="text-center">
                                        <td>{{$i++}}</td>
                                        <td><img src="{{ asset($row->options->image) }}" style="height: 60px;"></td>
                                        <td>{{ $row->name }}</td>
                                        <td>@if($row->options->color) {{ $row->options->color }} @else <span class="font-italic text-warning">None</span> @endif</td>
                                        <td>@if($row->options->size) {{ $row->options->size }} @else <span class="font-italic text-warning">None</span> @endif</td>
                                        <td>{{ $row->qty }}</td>
                                        <td>${{ $row->price }}</td>
                                        <td>${{ $row->price * $row->qty }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
						<br><br><hr>
					
						<ul class="list-group col-lg-8" >
                                <li class="list-group-item">Item Quantity :  <span style="float: right;"> <b> {{ Cart::count() }} </b></span></li>

                            @if(Session::has('coupon'))
                                <li class="list-group-item">Subtotal :  <span style="float: right;"> <b>$ {{ Session::get('coupon')['balance'] }}</b> </span></li>
                                <li class="list-group-item">Coupon : ({{   Session::get('coupon')['name'] }})  <span style="float: right;"> <b>$  {{ Session::get('coupon')['discount'] }}</b> </span> </li>
                            @else
                                <li class="list-group-item">Subtotal :  <span style="float: right;"> <b>$ {{ Cart::Subtotal() }}</b> </span> </li>
                            @endif
							  
                                <li class="list-group-item">Shipping Charge: <span style="float: right;"> <b>$ {{ $shipping_charge }}</b> </span></li>
                                <li class="list-group-item">Vat :  <span style="float: right;"> <b>$ {{ $vat }}</b> </span></li>
                            @if(Session::has('coupon'))
                                <!--about 'number_formate()' please check "CartController" or "checkout.blade.php" -->
                                <li class="list-group-item">Total:  <span style="float: right;"> <b>$ {{ number_format(implode(explode(',',Session::get('coupon')['balance'])) + $shipping_charge + $vat , 2) }}</b> </span> </li>
                            @else
                                <!--about 'number_formate()' please check "CartController" or "checkout.blade.php" -->
                                <li class="list-group-item">Total:  <span style="float: right;"> <b>$ {{ number_format(implode(explode(',',Cart::Subtotal())) + $shipping_charge + $vat , 2) }}</b> </span> </li>
                            @endif
						</ul>	

					</div>
                </div>

                 <div class="col-lg-5 " style=" padding: 20px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center">Pay Now </div>

                        {{-- <form action="{{ route('stripe.charge') }}" method="post" id="payment-form" style="border: 1px solid grey; padding: 20px;">
                        	@csrf
                          <div class="form-row">
                            <label for="card-element">
                              Credit or debit card
                            </label>
                            <div id="card-element">
                              <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                          </div><br>
                        <!--   extra data -->
                          <input type="hidden" name="shipping" value="{{ $charge }}">
                           <input type="hidden" name="vat" value="0">
                           <input type="hidden" name="total" value="{{ Cart::Subtotal() + $charge }}">
                             <!-- shipping details pass -->
                         <input type="hidden" name="ship_name" value="{{ $data['name'] }}">
                         <input type="hidden" name="ship_email" value="{{ $data['email'] }}">
                         <input type="hidden" name="ship_phone" value="{{ $data['phone'] }}">
                         <input type="hidden" name="ship_address" value="{{ $data['address'] }}">
                         <input type="hidden" name="ship_city" value="{{ $data['city'] }}">
                         <input type="hidden" name="payment_type" value="{{ $data['payment'] }}">
                          <button class="btn btn-info">Pay Now</button>
                        </form> --}}
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="panel"></div>
    </div>

{{-- <script type="text/javascript">
	// Create a Stripe client.
var stripe = Stripe('pk_test_2hQ55fBqMuRip6PMXJRKojsg');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script> --}}


@endsection
