@extends('layouts.admin')
@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ticket</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Ticket Reply</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="content">
            <div class="container-fluid">
                <div class="card  p-2">
                    <div class="row">
                        <div class="col-md-9">
                            <strong>User: {{ $ticket->user->name }}</strong><br>
                            <strong>Subject: {{ $ticket->subject }}</strong><br>
                            <strong>Service: {{ $ticket->service }}</strong><br>
                            <strong>Priority: {{ $ticket->priority }}</strong><br>
                            <strong>Message: {{ $ticket->message }}</strong>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ asset($ticket->image) }}" target="_blank"><img src="{{ asset($ticket->image) }}"
                                    style="height:80px; width:120px;"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('ticket.reply') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Reply Ticket Message</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="exampleInputEmail1">Message<span class="text-danger">*</span>
                                            </label>
                                            <textarea type="text" class="form-control @error('message') is-invalid @enderror" name="message" required></textarea>
                                            @error('message')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="exampleInputPassword1">Image </label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-info">Reply Message</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <a href="{{ route('ticket.close', $ticket->id) }}" class="btn btn-danger" style="float:right;">
                                Close Ticket
                            </a>
                        </div>
                </form>

                <!-- /.card -->
                <!-- right column -->
                <div class="col-md-6">
                    @php
                        $replies = \App\Models\Reply::where('ticket_id', $ticket->id)
                            ->orderBy('id', 'DESC')
                            ->get();
                    @endphp

                    <!-- Form Element sizes -->
                    <div class="card card-primary">
                        <div class="card-header">All Replies</div>
                        <div class="card-body" style="height: 700px; overflow-y: scroll;">
                            @foreach ($replies as $row)
                                <div class="card mt-1 @if ($row->user->is_admin == 1) ml-4 @endif">
                                    <div
                                        class="card-header @if ($row->user->is_admin == 1) bg-info @else bg-danger @endif ">
                                        <i class="fa fa-user"></i>
                                        @if ($row->user->is_admin == 1)
                                            Admin
                                        @else
                                            {{ $row->user->name }}
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p>{{ $row->message }}</p>
                                            <footer class="blockquote-footer">
                                                {{ date('d F Y'), strtotime($row->reply_date) }}</footer>
                                        </blockquote>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
