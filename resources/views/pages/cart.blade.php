@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/cart_responsive.css') }}">
<style>
    #style tr td{
        border:1px solid #DDDFE2;
    }
</style>
<!-- Cart -->

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="cart_container">
                    <div class="cart_title">Shopping Cart</div>

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


                    {{-- <div class="cart_items">
                        <ul class="cart_list">
                        @foreach($cart as $row)
                            <li class="cart_item clearfix">
                                <div class="cart_item_image"><img src="{{ asset( $row->options->image) }}" style="height: 100px;"></div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_title">Name</div>
                                        <div class="cart_item_text">{{ $row->name }}</div>
                                    </div>
                                    @if($row->options->color != NULL)
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_title">Color</div>
                                            <div class="cart_item_text">
                                                    {{ $row->options->color }}
                                            </div>
                                        </div>
                                    @endif

                                    @if($row->options->size != NULL)
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_title">Size</div>
                                            <div class="cart_item_text">
                                                    {{ $row->options->size }}
                                            </div>
                                        </div>
                                    @endif
  
                                    <div class="cart_item_quantity cart_info_col">
                                        <div class="cart_item_title">Quantity</div><br>
                                        <form method="post" action="{{ route('update.cartitem') }}">
                                            @csrf
                                            <input type="hidden" name="productid" value="{{ $row->rowId }}">	
                                            <input type="number" name="qty" value="{{ $row->qty }}" style="width: 60px; height: 30px;">
                                            <button title="Update" type="submit" class="btn btn-success btn-sm"><i class="fa fa-check-square"></i></button>
                                        </form>
                                    </div>
                                    <div class="cart_item_price cart_info_col">
                                        <div class="cart_item_title">Price</div>
                                        <div class="cart_item_text">${{ $row->price }}</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_title">Total</div>
                                        <div class="cart_item_text">${{ $row->price * $row->qty }}</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_title">Action</div><br><br>
                                        <a title="Remove" href="{{ route('remove.cart',$row->rowId) }}" class="btn btn-sm btn-danger">X</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div> --}}
                    
                    <!-- Order Total -->
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                            <div class="order_total_amount">${{ Cart::Subtotal() }}</div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <button type="button" class="button cart_button_clear">All Cancel</button>
                        <a href="{{ route('user.checkout') }}" class="button cart_button_checkout text-light">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('frontend/js/cart_custom.js') }}"></script>
@endsection