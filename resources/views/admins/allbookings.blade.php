@extends('layouts.admin-app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Bookings</h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">email</th>
                                <th scope="col">date_booking</th>
                                <th scope="col">num_people</th>
                                <th scope="col">special_request</th>
                                <th scope="col">status</th>
                                <th scope="col">change_status</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allBookings as $cBooking)
                            <tr>
                                <th scope="row">{{$cBooking->id}}</th>
                                <td>{{$cBooking->name}}</td>
                                <td>{{$cBooking->email}}</td>
                                <td>{{$cBooking->date}}</td>
                                <td>{{$cBooking->num_people}}</td>
                                <td>{{$cBooking->spe_request}}</td>
                                <td>{{$cBooking->status}}</td>
                                <td><a href="{{route('bookings.edit',$cBooking->id)}}"
                                    class="btn btn-warning text-white text-center">Change Status</a></td>
                                <td><a href="{{route("bookings.delete",$cBooking->id)}}" class="btn btn-danger  text-center ">delete</a></td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
