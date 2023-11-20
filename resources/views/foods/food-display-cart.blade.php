@extends('layouts.app')

@section('content')

    <div class="container">
        @if (Session::has('delete'))
            <p class="alert {{ Session::get('alert-class', 'alert-success') }}"> {{ Session::get('delete') }}</p>
        @endif
    </div>

    <div class="container">

        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($cartItems->count() > 0)
                        {{-- @php
                            $total = 0;
                        @endphp --}}
                        @foreach ($cartItems as $item)
                            {{-- @php
                                $total += $item->price;
                            @endphp --}}

                            <tr>
                                <th><img src="{{ asset('/assets/img/' . $item->image) }}" class="img-responsive img-rounded"
                                        style="max-height: 100px; max-width: 100px;"></th>
                                <td class="align-middle">{{ $item->name }}</td>
                                <td class="align-middle">€{{ $item->price }}</td>
                                <td class="align-middle"><a href="{{ route('food.delete.cart', $item->id) }}"
                                        class="btn btn-danger text-white">delete</td>
                            </tr>
                        @endforeach
                    @else
                        <h3 class="alert alert-success">You have no items in cart yet</h3>
                    @endif


                </tbody>
            </table>
            <div class="position-relative mx-auto" style="max-width: 400px; padding-left: 679px;">
                <p style="margin-left: -7px;" class="w-19 py-3 ps-4 pe-5" type="text"> Total: €{{ $total }}</p>
                @if ($total > 0)
                <form method="POST" action="{{route('prepare.checkout')}}">
                    @csrf
                    <input type="hidden" value="{{$total}}" name="price">
                    <button type="submit" name="submit" class="btn btn-primary py-2 top-0 end-0 mt-2 me-2">Checkout</button>
                </form>
                    @endif
            </div>
        </div>
    </div>
@endsection
