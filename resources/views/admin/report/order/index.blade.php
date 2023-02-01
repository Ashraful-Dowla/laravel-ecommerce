@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Order List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control submitable" id="status">
                                            <option value="{{ null }}" selected>All</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Received</option>
                                            <option value="2">Shipped</option>
                                            <option value="3">Done</option>
                                            <option value="4">Return</option>
                                            <option value="5">Cancel</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" id="date" class="form-control submitable">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="payment_type">Payment type</label>
                                        <select name="payment_type" class="form-control submitable" id="payment_type">
                                            <option value="{{ null }}" selected>All</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Aamarpay">Aamarpay</option>
                                            <option value="Paypal">Paypal</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <button type="button" class="btn btn-primary print"
                                            style="float: right;">Print</button>
                                    </div>
                                </div>
                                <table class="table table-bordered table-striped table-sm ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Subtotal ({{ $setting->currency }})</th>
                                            <th>Total ({{ $setting->currency }})</th>
                                            <th>Status</th>
                                            <th>Payment</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- script -->
    @push('script')
        {{-- <script src="{{ asset('public/backend') }}/plugins/print_this/printThis.js"></script> --}}
        <script src="{{ asset('public/backend') }}/plugins/print_this/printThis.min.js"></script>
        <script type="text/javascript">
            var table;
            $(function() {
                table = $(".ytable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('report.order.list') }}",
                        data: function(e) {
                            e.status = $("#status").val();
                            e.date = $("#date").val();
                            e.payment_type = $("#payment_type").val();
                        }
                    },
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "c_name",
                            name: "c_name",
                        },
                        {
                            data: "c_phone",
                            name: "c_phone"
                        },
                        {
                            data: "c_email",
                            name: "c_email"
                        },
                        {
                            data: "subtotal",
                            name: "subtotal",
                        },
                        {
                            data: "total",
                            name: "total",
                        },
                        {
                            data: "status",
                            name: "status",
                        },
                        {
                            data: "payment_type",
                            name: "payment_type",
                        },
                        {
                            data: "date",
                            name: "date",
                        },
                    ]
                });

                //filtering
                $('.submitable').change(function() {
                    $('.ytable').DataTable().ajax.reload();
                });
            })
        </script>
        <script>
            $('.print').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('report.order.print') }}",
                    type: 'GET',
                    data: {
                        status: $('#status').val(),
                        date: $('#date').val(),
                        payment_type: $('#payment_type').val()
                    },
                    success: function(data) {
                        $(data).printThis({
                            debug: false,
                            importCSS: true,
                            importStyle: true,
                            removeInline: false,
                            printDelay: 500,
                            header: null,
                            footer: null,
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
