@extends('layouts.admin-app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card col-md-12">
                <div class="card-body col-md-12">
                    <div class="container">
                        @if (Session::has('success'))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                {{ Session::get('success') }}</p>
                        @endif
                    </div>
                    <h5 class="card-title mb-4 d-inline">Orders</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col" style="max-width: 100px">email</th>
                                <th scope="col">phone_number</th>
                                <th style="max-width: 50px"  scope="col">address</th>
                                <th scope="col">total_price</th>
                                <th scope="col">status</th>
                                <th scope="col">change_status</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allOrders as $cOrder)
                                <tr>
                                    <th scope="row">{{ $cOrder->id }}</th>
                                    <td>{{ $cOrder->full_name }}</td>
                                    <td style="max-width: 100px">{{ $cOrder->email }}</td>
                                    <td>{{ $cOrder->phone_number }}</td>
                                    <td style="max-width: 150px">{{ $cOrder->address }} </td>
                                    <td>€{{ $cOrder->price }}</td>

                                    <td>{{ $cOrder->status }}</td>
                                    <td><a href="{{ route('orders.edit', $cOrder->id) }}"
                                            class="btn btn-warning text-white text-center">Change Status</a></td>
                                    <td><a href="{{route('orders.delete', $cOrder->id)}}" class="btn btn-danger  text-center ">Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
