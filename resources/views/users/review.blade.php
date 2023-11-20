@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="col-md-12 bg-dark">
            <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                <h5 class="section-title ff-secondary text-start text-primary fw-normal">Review</h5>
                <h1 class="text-white mb-4">Review</h1>
                <form method="POST" action="{{ route('users.reviews') }}" class="col-md-12">
                    @csrf
                    <div class="row g-3">

                        <div class="">
                            <div class="form-floating">
                                <textarea id="email" type="email"
                                    class="form-control" name="review"
                                    value="{{ old('review') }}" required autofocus></textarea>
                                <label for="email">Review</label>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <button class="btn btn-primary w-100 py-3" name="submit" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
