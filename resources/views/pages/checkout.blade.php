@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_responsive.css') }}">
{{-- <style>
    #style tr td{
        border:1px solid #DDDFE2;
    }
</style> --}}
@php  
	// $setting=DB::table('settings')->first();
	// $vat=$setting->vat;
	// $shipping_charge=$setting->shipping_charge;

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
                                    <td>{{ $row->qty }}</td>
                                    <td>${{ $row->price }}</td>
                                    <td>${{ $row->price * $row->qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                        <!-- Order Total -->
                    <div style="float: right">
                        <table class="table text-center">
                            <tr>
                                <td>Total Items:</td>
                                <th>{{ Cart::count() }} </th>
                            </tr>
                            <tr>
                                <td>Order Total :</td>
                                <th>$ {{ Cart::Subtotal() }} </th>
                            </tr>
                        </table>

                        <div @if (Session::has('coupon')) style="border: 1px solid grey" @endif>
                            <table class="table text-center">
                                @if (Session::has('coupon'))
                                    <tr>
                                        <td>Coupon :</td>
                                        <th>{{Session::get('coupon')['name']}}</th>
                                    </tr>
                                
                                    <tr>
                                        <td>After Discount :</td>
                                        <th>$ {{Session::get('coupon')['balance']}}</th>
                                    </tr>
                                @endif

                                <tr>
                                    <td>Vat :</td>
                                    <th>$ {{$vat}}</th>
                                </tr>
                                <tr>
                                    <td>Shipping Charge :</td>
                                    <th>$ {{$shipping_charge}}</th>
                                </tr>
                                <tr>
                                    <td>Total Amonut :</td>
                                    <th class="text-primary">
                                        @if (Session::has('coupon'))
                                            @php
                                                $subtotal = Session::get('coupon')['balance'];
                                                $discount = implode(explode(',',$subtotal)) ;
                                                $total_amount =  number_format($discount + $vat + $shipping_charge, 2)
                                            @endphp
                                               $ {{ $total_amount }}
                                        @else
                                            @php
                                                // $subtotal = Cart::Subtotal();
                                                // $order_total = implode(explode(',',$subtotal)) ;
                                                // $total_amount =  number_format($order_total + $vat + $shipping_charge, 2)
                                            @endphp
                                                {{-- ${{ $total_amount }}  --}}

                                                <!--or, we can use directly given bello -->
                                                $ {{ number_format(implode(explode(',',Cart::Subtotal())) +$vat +$shipping_charge, 2) }}
                                        @endif
                                    </th>
                                </tr>
                            </table>
                        </div>
                        
                        @if (!Session::has('coupon'))
                            <div class="row" style="border: 1px solid grey; padding:10px;">
                                <form action="{{route('apply.coupon')}}" method="POST" style="margin-left: 40px">
                                    @csrf
                                    <div class="form-group">
                                        <label>Apply Coupon</label>
                                        <input type="text" name="coupon" id="" class="form-control" placeholder="Type Your Coupon Code">
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="float: right">Submit</button>
                                </form>
                            </div>
                        @endif
                        
                        <div class="row mt-4">
                                <a href="{{route('show.cart')}}" class="mr-3 btn btn-secondary text-light">Back</a>
                            @if (Session::has('coupon'))
                                <a href="{{route('session.remove')}}" class="btn btn-danger text-light">Cancel Discount</a>
                            @endif
                                <a href="{{route('payment.step')}}" class="ml-3 btn btn-success text-light">Final Step</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
	

<script src="{{ asset('public/frontend/js/cart_custom.js') }}"></script>
@endsection