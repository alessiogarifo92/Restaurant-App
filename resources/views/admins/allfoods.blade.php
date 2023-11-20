@extends('layouts.admin-app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        @if (Session::has('success'))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                {{ Session::get('success') }}</p>
                        @endif
                    </div>
                    <h5 class="card-title mb-4 d-inline">Foods</h5>
                    <a href="{{ route('create.food') }}" class="btn btn-primary mb-4 text-center float-right">Create Foods</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">image</th>
                                <th scope="col">price</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allFoods as $cFood)
                                <tr>
                                    <th scope="row">{{ $cFood->id }}</th>
                                    <td>{{ $cFood->name }}</td>
                                    <td><img width="100" height="100" src="{{ asset('assets/img/' . $cFood->image) }}">
                                    </td>
                                    <td>€{{ $cFood->price }}</td>
                                    <td><a href="{{route('food.delete', [$cFood->id, $cFood->image])}}" class="btn btn-danger  text-center ">Delete</a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
