@extends('layouts.main')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard v3</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v3</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="row">
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                    <h5 class="description-header"><label id="mytotallbr"></label></h5>
                    <span class="description-text">TOTAL COUNT REVENUE</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                    <h5 class="description-header"><label id="mytotalrp"></label></h5>
                    <span class="description-text">TOTAL AMOUNT REVENUE</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                    <h5 class="description-header"><label id="mytotalrp"></h5>
                    <span class="description-text">TOTAL PROFIT</span>
                </div>
                <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-6">
                <div class="description-block">
                    <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                </div>
                <!-- /.description-block -->
            </div>
        </div>


        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Online Store Visitors</h3>
                                    <a href="javascript:void(0);">View Report</a>
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">820</span>
                                        <span>Visitors Over Time</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <span class="text-success">
                                            <i class="fas fa-arrow-up"></i> 12.5%
                                        </span>
                                        <span class="text-muted">Since last week</span>
                                    </p>
                                </div> --}}
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <table class="table table-bordered table-striped table-sm yajra-datatable"
                                        style="font-size: 10px">
                                        <thead>
                                            <tr>
                                                <th class="text-center">NOMOR</th>
                                                <th class="text-center">DISTRIBUSI</th>
                                                <th class="text-center">BANK</th>
                                                <th class="text-center">LEMBAR</th>
                                                <th class="text-center">RUPIAH/Rp.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot style="background-color: #a5a7a9">
                                            <tr>
                                                <th colspan="3">TOTAL</th>
                                                <th id="lembar">0</th>
                                                <th id="total">0</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                {{-- <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> This Week
                                    </span>

                                    <span>
                                        <i class="fas fa-square text-gray"></i> Last Week
                                    </span>
                                </div> --}}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- /.col-md-6 -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Sales</h3>
                                    <a href="javascript:void(0);">View Report</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">$18,230.00</span>
                                        <span>Sales Over Time</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <span class="text-success">
                                            <i class="fas fa-arrow-up"></i> 33.1%
                                        </span>
                                        <span class="text-muted">Since last month</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <canvas id="sales-chart" height="200"></canvas>
                                </div>

                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> This year
                                    </span>

                                    <span>
                                        <i class="fas fa-square text-gray"></i> Last year
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Page specific script -->
    <script type="text/javascript">
        // alert('chek 1');
        $(function() {
            const rupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }

            // alert('chek 2');
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: true,
                searching: true,
                paging: false,
                // lengthChange: true,
                // pageLength: 25,
                // lengthMenu: [
                //     [10, 25, 50, 100, 1000, -1],
                //     ['10', '25', '50', '100', '1000', 'All']
                // ],
                destroy: true,
                bInfo: false,
                // oLanguage: {
                //     "sInfo": "Awal _START_ ke _END_ (_TOTAL_ Data)", // text you want show for info section
                // },
                dom: 'Blfrtip',
                buttons: [
                    'excel'
                ],
                ajax: "{{ route('dashboard.flagperdist') }}",
                columnDefs: [{
                    "targets": 0, // your case first column
                    "className": "text-left"
                }],
                columns: [{
                        title: 'NOMOR',
                        data: null,
                        sortable: false,
                        className: "text-right",
                        width: "4%",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    }, {
                        title: 'DISTRIBUSI',
                        data: null,
                        render: function(data, type, row) {
                            return row['KD_DIST'] + ' - ' + row['DIST'];
                        }
                    }, {
                        title: 'BANK',
                        data: 'NAMA_BANK',
                    }, {
                        data: 'JML',
                        className: 'text-right',
                        render: $.fn.dataTable.render.number(',', '.', 0, '')
                    }, {
                        data: 'RPTAG',
                        className: 'text-right',
                        render: $.fn.dataTable.render.number('.', ',', 0, '')
                    }
                    //  {
                    //      data: 'action',
                    //      name: 'action',
                    //      orderable: true,
                    //      searchable: true
                    //  },
                ],
                drawCallback: function(row, data, start, end, display) {
                    var api = this.api();

                    // Remove the formatting to get integer data for summation
                    var intVal = function(i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ? i : 0;
                    };
                    // Total over all pages
                    lembar = api
                        .column(3)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    total = api
                        .column(4)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    $('#lembar').html($.fn.dataTable.render.number('.', '.', 0).display(lembar));
                    $('#total').html($.fn.dataTable.render.number('.', '.', 0).display(total));
                    $('#mytotallbr').html($.fn.dataTable.render.number('.', '.', 0).display(lembar));
                    $('#mytotalrp').html('Rp. ' + $.fn.dataTable.render.number('.', '.', 0).display(
                        total) + ',-');
                },
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
