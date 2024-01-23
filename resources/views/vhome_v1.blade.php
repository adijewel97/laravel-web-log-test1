@extends('layouts.main')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1></h1>
                    </div>
                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div> --}}
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <div class="card col-md-8">
                        <div class="card-header">
                            <h3 class="card-title" style="font-weight: bold;">MASTER WILAYAH/DISTRIBUSI PLN</h3>

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
                                            style="width:100%">
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
                                {{-- <div class="col-sm-6">
                                   <table id="example1" class="table table-bordered table-striped table-sm">
                                       <thead>
                                           <tr>
                                               <th>NOMOR</th>
                                               <th>DISTRIBUSI</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           <?php //$i = 1;
                                           ?>
                                           @foreach ($data as $item)
                                               <tr>
                                                   <td align="right">{{ $i++ }}</td>
                               {{-- <td>{{ $item['NAMA_DIST'] }}</td> --}}
                                {{-- </tr>
                               @endforeach --}}
                                </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>


            <!-- Page specific script -->
            <script>
                $(function() {
                    $("#example1").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": true,
                        "searching": true,
                        //  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                        //  "buttons": ["excel", "pdf", "colvis"],
                        "info": true,
                        "paging": true,
                        //  "pageLength": 50
                        //  dom: 'Bfrtip',
                        //  lengthMenu: [
                        //      [10, 25, 50, -1],
                        //      ['10 rows', '25 rows', '50 rows', 'Show all']
                        //  ],
                        //  buttons: [
                        //      'pageLength'
                        //  ]
                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                });
            </script>
            <script type="text/javascript">
                $(function() {
                    var table = $('.yajra-datatable').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        lengthChange: false,
                        autoWidth: true,
                        searching: true,
                        paging: true,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, 'All'],
                        ],
                        buttons: ["excel"],
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
                    });
                    table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');

                });
            </script>
        @endsection
