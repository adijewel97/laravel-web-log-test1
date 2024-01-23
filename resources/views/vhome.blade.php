@extends('layouts.main')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                {{-- <div class="row mb-2"> --}}
                <div class="col-sm-6">
                    <h1></h1>
                </div>
                {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div> --}}
                {{-- </div> --}}
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            {{-- <div>{{ $message }}</div> --}}
            <!-- Default box -->
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="card col-md-8">
                        <div class="card-header">
                            <h3 class="card-title" style="font-weight: bold;">MASTER WILAYAH/DISTRIBUSIPLN </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="container">
                                        <table class="table table-bordered table-striped table-sm yajra-datatable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">NOMOR</th>
                                                    <th class="text-center">DISTRIBUSI</th>
                                                    {{-- <th>ACTION</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        {{-- <div class="card-footer">
                            Footer
                        </div> --}}
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>



        <!-- Page specific script -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script type="text/javascript">
            // alert('chek 1');
            $(function() {
                // alert('chek 2');
                var table = $('.yajra-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    // responsive: true,
                    // lengthChange: false,
                    // autoWidth: true,
                    searching: true,
                    // paging: true,
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                    ajax: "{{ route('monlap.mstdistribusi') }}",
                    columnDefs: [{
                        "targets": 1, // your case first column
                        "className": "text-left"
                    }],
                    columns: [{
                            "data": null,
                            "sortable": false,
                            title: 'NOMOR',
                            "className": "text-right",
                            "width": "4%",
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'NAMA_DIST',
                            title: 'DISTRIBUSI',
                        },
                        //  {
                        //      data: 'action',
                        //      name: 'action',
                        //      orderable: true,
                        //      searchable: true
                        //  },
                    ]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });
        </script>
    @endsection
