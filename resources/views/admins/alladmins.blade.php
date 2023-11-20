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

                    <h5 class="card-title mb-4 d-inline">Admins</h5>
                    <a href="{{ route('admins.create') }}" class="btn btn-primary mb-4 text-center float-right">Create
                        Admins</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">username</th>
                                <th scope="col">email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allAdmins as $cAdmin)
                                <tr>
                                    <th scope="row">{{ $cAdmin->id }}</th>
                                    <td>{{ $cAdmin->name }}</td>
                                    <td>{{ $cAdmin->email }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
