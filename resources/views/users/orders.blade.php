@extends('layouts.app')

@section('content')
    <div class="container-xxl py-5 bg-dark hero-header mb-5" style="margin-top: -25px">
        <div class="container text-center my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">My Orders</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">My Orders</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="col-md-8 offset-md-2">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allOrders as $order)
                    <tr>
                        <td>{{ $order->full_name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->phone_number }}</td>
                        <td>{{ $order->address }} , {{ $order->zip_code }}, {{ $order->town }}</td>
                        <td>€{{ $order->price }}</td>
                        
                        @if ($order->status == 'Payed')
                            <td>{{ $order->status }}</td>
                        @else
                            <td>{{ $order->status }}</td>
                            <td><a class="btn btn-primary" href="{{ route('food.display.cart') }}" role="button">Cart</a>
                            </td>
                        @endif

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
