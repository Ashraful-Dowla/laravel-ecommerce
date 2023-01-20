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
                        <h4>Submit Your Ticket</h4>
                        <form action="{{ route('ticket.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row m-3">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                    id="subject" name="subject" required>
                                @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row m-1">
                                <div class="form-group col-6">
                                    <label for="priority">Priority</label>
                                    <select name="priority" class="form-control" style="min-width: 100%;">
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="subject">Subject</label>
                                    <select name="service" class="form-control" style="min-width: 100%;">
                                        <option value="Technical">Technical</option>
                                        <option value="Payment">Payment</option>
                                        <option value="Affliate">Affliate</option>
                                        <option value="Return">Return</option>
                                        <option value="Refund">Refund</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row m-3">
                                <label for="message">Message</label>
                                <textarea type="text" class="form-control" id="message" name="message" placeholder="Write your message"></textarea>
                            </div>
                            <div class="form-group row m-3">
                                <label for="website_review_rating">Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="row m-3">
                                <button type="submit" class="btn btn-primary">Submit Ticket</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
@endsection
