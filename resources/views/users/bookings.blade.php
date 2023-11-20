@extends('layouts.app')

@section('content')
    <div class="container-xxl py-5 bg-dark hero-header mb-5" style="margin-top: -25px">
        <div class="container text-center my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">My Bookings</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">My Bookings</a></li>
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
                    <th scope="col">Date</th>
                    <th scope="col">Number of People</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allBookings as $booking)
                    <tr>
                        <td>{{ $booking->name }}</td>
                        <td>{{ $booking->email }}</td>
                        <td>{{ $booking->date }}</td>
                        <td>{{ $booking->num_people }}</td>
                        @if ($booking->status != 'Booked')
                            <td>{{ $booking->status }}</td>
                        @else
                            <td>{{ $booking->status }}</td>

                            <td><a class="btn btn-success" href="{{ route('users.reviews.form') }}" role="button">Review</a>
                            </td>
                        @endif
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
