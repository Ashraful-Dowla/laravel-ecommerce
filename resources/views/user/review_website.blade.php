@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @include('user.sidebar')
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Dashboard') }}
                        <a href="{{ route('review.website') }}" style="float:right;"><i class="fas fa-pencil-alt"></i> Write a
                            review</a>
                    </div>

                    <div class="card-body">
                        <h4>Write your valuable review based on our product quality & services</h4>
                        <form action="{{ route('review.website.store') }}" method="POST">
                            @csrf
                            <div class="form-group row m-3">
                                <label for="name">Customer Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    aria-describedby="emailHelp" value="{{ Auth::user()->name }}" readonly>
                            </div>
                            <div class="form-group row m-3">
                                <label for="website_review_description">Your Review</label>
                                <textarea type="text" class="form-control" id="website_review_description" name="website_review_description"
                                    placeholder="Write your valuable review"></textarea>
                            </div>
                            <div class="form-group row m-3">
                                <label for="website_review_rating">Rating</label>
                                <select name="website_review_rating" class="form-control" style="min-width:100%;">
                                    <option value="1">1 star</option>
                                    <option value="2">2 star</option>
                                    <option value="3">3 star</option>
                                    <option value="4">4 star</option>
                                    <option value="5">5 star</option>
                                </select>
                            </div>
                            <div class="row m-3">
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
@endsection
