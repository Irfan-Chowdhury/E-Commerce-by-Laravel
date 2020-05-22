@extends('layouts.app')
@section('content')

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-8 card">
                <table class="table table-response">
                    <thead>
                        <tr class="text-center">
                            <th>PaymentType</th>
                            <th>Return</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Status </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $row)
                        <tr class="text-center">
                            <th>{{ $row->payment_type }}</th>
                            <td>
                                @if($row->return_order == 0)
                                    <span class="p-2 badge badge-warning">No Request</span>
                                @elseif($row->return_order == 1)
                                    <span class="p-2 badge badge-secondary">Pending</span>
                                @elseif($row->return_order == 2)
                                    <span class="p-2 badge badge-info">Success </span>
                                @endif
                            </td>
                            <td>$ {{ $row->total }}</td>
                            <td>{{ $row->date }}</td>
                            <td>
                                @if($row->status == 0)
                                    <span class="p-2 badge badge-secondary">Pending</span>
                                @elseif($row->status == 1)
                                    <span class="p-2 badge badge-info">Payment Accept</span>
                                @elseif($row->status == 2)
                                    <span class="p-2 badge badge-info">Progress </span>
                                @elseif($row->status == 3)
                                    <span class="p-2 badge badge-success">Delivered </span>
                                @else
                                    <span class="p-2 badge badge-danger">Cancel </span>
                                @endif
                            </td>
                            <td>
                                @if($row->return_order == 0)
                                    <a href="{{route('request.return',$row->id)}}" class="btn btn-sm btn-danger" id="return">Return</a>
                                @elseif($row->return_order == 1)
                                    <span class="p-2 badge badge-secondary">Pending</span>
                                @elseif($row->return_order == 2)
                                    <span class="p-2 badge badge-info">Success </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('public/avatar.jpg') }}" class="card-img-top"
                        style="height: 90px; width: 90px; margin-left: 34%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ Auth::user()->name }}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{ route('password.change') }}"> Password Change </a></li>
                        <li class="list-group-item"><a href="{{ route('password.change') }}"> Edit Profile </a></li>
                        <li class="list-group-item"><a href="{{ route('success.orderlist') }}"> Return Order </a></li>
                    </ul>
                    <div class="card-body">
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection