@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_responsive.css') }}">

<!-- Cart -->

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="cart_container">
                    <div class="cart_title">Your Wishlist</div>

                    <table class="table mt-5">
                        <thead>
                            <tr class="text-center table-secondary">
                                <th>SL</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wishlists as $key => $row)
                                <tr class="text-center">
                                    <td class="pt-5">{{$key+1}}</td>
                                    <td><img src="{{ asset( $row->image_one) }}" style="height: 100px;"></td>
                                    <td class="pt-5">{{ $row->product_name }}</td>
                                    <td class="pt-5">@if($row->product_color) {{ $row->product_color }} @else <span class="font-italic text-warning">None</span> @endif</td>
                                    <td class="pt-5">@if($row->product_size) {{ $row->product_size }} @else <span class="font-italic text-warning">None</span> @endif</td>
                                    <td class="pt-5">
                                        <a title="Remove" href="{{ route('wishlist.delete',$row->id) }}" class="btn btn-sm btn-danger">X</a>
                                        <a href="#" class="ml-3 btn btn-sm btn-info">Add To Cart</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- <div class="cart_items">
                        <ul class="cart_list">
                        @foreach($product as $row)
                            <li class="cart_item clearfix">
                                <div class="cart_item_image"><img src="{{ asset( $row->image_one) }}" style="height: 100px;"></div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_title">Name</div>
                                        <div class="cart_item_text">{{ $row->product_name }}</div>
                                    </div>
                                    @if($row->product_color == NULL)
                                    @else
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_title">Color</div>
                                        <div class="cart_item_text">
                                                {{ $row->product_color }}
                                        </div>
                                    </div>
                                    @endif
                                    @if($row->product_size == NULL)
                                    @else
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_title">Size</div>
                                        <div class="cart_item_text">
                                                {{ $row->product_size }}
                                        </div>
                                    </div>
                                    @endif

                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_title">Action</div><br><br>
                                        <a href="#" class="btn btn-sm btn-danger">Add To Cart</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/frontend/js/cart_custom.js') }}"></script>
@endsection