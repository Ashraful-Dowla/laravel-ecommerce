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
                        All Tickets <a href="{{ route('ticket.new') }}" class="float-right">Open Ticket</a>
                    </div>

                    <div class="card-body">
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1 @endphp
                                    @forelse ($tickets as $row)
                                        <tr>
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ date('d F , Y'), strtotime($row->date) }}</td>
                                            <td> {{ $row->service }}</td>
                                            <td> {{ $row->subject }}</td>
                                            <td>
                                                @if ($row->status == 0)
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($row->status == 1)
                                                    <span class="badge badge-success">Replied</span>
                                                @elseif($row->status == 2)
                                                    <span class="badge badge-danger">Closed</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('ticket.show', $row->id) }}"
                                                    class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="text-center">No Data</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
@endsection
