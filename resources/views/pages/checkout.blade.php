@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_responsive.css') }}">
{{-- <style>
    #style tr td{
        border:1px solid #DDDFE2;
    }
</style> --}}
@php  
	// $setting=DB::table('settings')->first();
	// $charge=$setting->shipping_charge;

@endphp
	<!-- Cart -->

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="cart_container">
                    <div class="display-4">Checkout</div>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="style"> 
                            @php $i = 1 @endphp
                            @foreach($cart as $row)
                                <tr class="text-center">
                                    <td>{{$i++}}</td>
                                    <td><img src="{{ asset( $row->options->image) }}" style="height: 100px;"></td>
                                    <td>{{ $row->name }}</td>
                                    <td>@if($row->options->color) {{ $row->options->color }} @else <span class="font-italic text-warning">None</span> @endif</td>
                                    <td>@if($row->options->size) {{ $row->options->size }} @else <span class="font-italic text-warning">None</span> @endif</td>
                                    <td>
                                        <form method="post" action="{{ route('update.cartitem',$row->rowId) }}">
                                            @csrf
                                            <input type="number" name="qty" value="{{ $row->qty }}" style="width: 60px; height: 30px;">
                                            <button title="Update" type="submit" class="btn btn-success btn-sm"><i class="fa fa-check-square"></i></button>
                                        </form>
                                    </td>
                                    <td>${{ $row->price }}</td>
                                    <td>${{ $row->price * $row->qty }}</td>
                                    <td><a title="Remove" href="{{ route('remove.cart',$row->rowId) }}" class="btn btn-sm btn-danger">X</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                        <!-- Order Total -->
                    <div style="float: right">
                        <table class="table text-center">
                            <tr>
                                <td>Order Total :</td>
                                <th>${{Cart::Subtotal() }}</th>
                            </tr>
                            <tr>
                                <td>Vat :</td>
                                <th>$3</th>
                            </tr>
                            <tr>
                                <td>Shipping Charge :</td>
                                <th>$7</th>
                            </tr>
                        </table>
                        
                        <div class="row">
                            <div class="m-3 btn btn-secondary"><a href="{{route('show.cart')}}" class="text-light">Back</a></div>
                            <div class="m-3 btn btn-info"><a href="#" class="text-light">Final Step</a></div>
                        </div>
                    </div>

                        {{-- <div class="order_total_content " style="padding: 14px;">
                            @if(Session::has('coupon'))
                            @else
                                <h5>Apply Coupon</h5>
                                <form action="{{ route('apply.coupon') }}" method="post">
                                @csrf
                                    <div class="form-group col-lg-4">
                                        <input type="text" class="form-control" name="coupon" required=""  aria-describedby="emailHelp" placeholder="Coupon Code">
                                    </div>
                                    <button type="submit" class="btn btn-danger ml-2">submit</button>
                                </form>
                            @endif
                        </div> --}}
                
                        {{-- <ul class="list-group col-lg-4" style="float: right;">
                            @if(Session::has('coupon'))
                                <li class="list-group-item">Subtotal :  <span style="float: right;"> $ {{ Session::get('coupon')['balance'] }}</span> </li>
                                    <li class="list-group-item">Coupon : ({{   Session::get('coupon')['name'] }}) <a href="{{ route('coupon.remove') }}" class="btn btn-danger btn-sm">x</a> <span style="float: right;"> $  {{ Session::get('coupon')['discount'] }} </span> </li>
                                @else
                                <li class="list-group-item">Subtotal :  <span style="float: right;"> $ {{ Cart::Subtotal() }}</span> </li>
                                @endif
                            


                            <li class="list-group-item">Shipping Charge: <span style="float: right;"> $ {{ $charge }}</span></li>
                            <li class="list-group-item">Vat :  <span style="float: right;"> 0</span></li>
                            @if(Session::has('coupon'))
                            <li class="list-group-item">Total:  <span style="float: right;"> $ {{ Session::get('coupon')['balance'] + $charge }}</span> </li>
                            @else
                                <li class="list-group-item">Total:  <span style="float: right;">$ {{ Cart::Subtotal() + $charge }} </span> </li>
                            @endif
                        </ul> --}}
                </div>
            </div>
        </div>
        
        {{-- <div class="cart_buttons">
            <a href="{{ route('show.cart') }}" class="button cart_button_clear">Back</a>
            <a href="#" class="button cart_button_clear">Back</a>



            <form action='https://sandbox.2checkout.com/checkout/purchase' method='post'>
            <input type='hidden' name='sid' value='901418835' />
            <input type='hidden' name='mode' value='2CO' />
            @php 
            $content=Cart::content();
            @endphp

            @foreach ($content as $row) {
            <input type='hidden' name='li_{{ $row->id }}_type' value='product' />
            <input type='hidden' name='li_{{ $row->id }}_name' value='{{ $row->name }}' />
            <input type='hidden' name='li_{{ $row->id }}_price' value='{{ $row->price }}' />
                <input type='hidden' name='li_{{ $row->id }}_quantity' value='{{ $row->qty }}' />
            @endforeach

            <input type='hidden' name='card_holder_name' value='Checkout Shopper' />
            <input type='hidden' name='street_address' value='123 Test Address' />
            <input type='hidden' name='street_address2' value='Suite 200' />
            <input type='hidden' name='city' value='Columbus' />
            <input type='hidden' name='state' value='OH' />
            <input type='hidden' name='zip' value='43228' />
            <input type='hidden' name='country' value='USA' />
            <input type='hidden' name='email' value='example@2co.com' />
            <input type='hidden' name='phone' value='614-921-2450' />
            <input name='submit' class="btn btn-info" type='submit' value='Checkout' />
            </form>
                <a href="{{ route('payment.step') }}" class="button cart_button_checkout">Final Step</a>
        </div> --}}
        
    </div>
</div>
	

<script src="{{ asset('public/frontend/js/cart_custom.js') }}"></script>
@endsection