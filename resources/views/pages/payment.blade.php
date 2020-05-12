@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/contact_styles.css')}}">
@php  
	// $setting          = DB::table('settings')->first();
    // $shipping_charge  = $setting->shipping_charge;
    // $vat              = $setting->vat;
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
                        <div class="contact_form_title text-center">Shipping Address</div>

                        <form action="{{ route('payment.process') }}" id="contact_form" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Full Name </label>
                                <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Full Name " name="name" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone </label>
                                <input type="text" class="form-control " name="phone"  aria-describedby="emailHelp" placeholder="Phone "  required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email </label>
                                <input type="text" class="form-control " name="email"   aria-describedby="emailHelp" placeholder="Email " required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="address" name="address" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City</label>
                                <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="city" name="city" required="">
                            </div>
                            <div class="contact_form_title text-center">Payment By</div>
                           <div class="form-group">
                                <ul class="logos_list " >
                                    <li><input type="radio" name="payment" value="stripe"> <img src="{{ asset('frontend/images/mastercard.png') }}" style="width: 100px; height: 60px;"></li>
                                    <li><input type="radio" name="payment" value="paypal"> <img src="{{ asset('frontend/images/paypal.png') }}" style="width: 100px;"></li>
                                    <li><input type="radio" name="payment" value="ideal"> <img src="{{ asset('frontend/images/mollie.png') }}" style="width: 100px; height: 80px;"></li>
                                    <li><input type="radio" name="payment" value="hand_to_hand_cash"> <img src="{{ asset('frontend/images/hand_to_hand_cash.png') }}" style="width: 100px; height: 80px;"></li>
                                </ul>
                            </div><br>
                            <div class="contact_form_button">
                                <button type="submit" class="btn btn-info">Pay Now</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="panel"></div>
    </div>

@endsection
