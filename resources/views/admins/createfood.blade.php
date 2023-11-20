@extends('layouts.admin-app')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Create Food Items</h5>
                    <form method="POST" action="{{ route('store.food') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="name" id="form2Example1" class="form-control"
                                placeholder="name" />
                            @error('name')
                                <span class="invslid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="text" name="price" id="form2Example1" class="form-control"
                                placeholder="price" />
                            @error('price')
                                <span class="invslid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-outline mb-4 mt-4">
                            <input type="file" name="image" id="form2Example1" class="form-control" />
                            @error('image')
                                <span class="invslid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                            @error('description')
                                <span class="invslid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-outline mb-4 mt-4">

                            <select name="category" class="form-select  form-control" aria-label="Default select example">
                                <option selected>Choose Meal</option>
                                <option value="1">Breakfast</option>
                                <option value="2">Launch</option>
                                <option value="3">Dinner</option>
                            </select>
                        </div>
                        @error('category')
                            <span class="invslid-feedback" role="alert"> <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <br>



                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
