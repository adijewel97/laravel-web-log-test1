@extends('layouts.main')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>MIV - Monitoring/Laporan</h5>
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

            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Rekap/Daftar Lunas Per-Distribusi/Wilayah</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" >
                                    <i class="fas fa-times"></i>
                                </button> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="callout callout-info">
                                {{-- <h5><i class="fas fa-info"></i> Note:</h5> --}}
                                <form action="">
                                    <div class="row" style="font-size:11px">
                                        <label for="" class="col-sm-2 col-form-label">
                                            Bulan Laporan
                                        </label>
                                        <div class="col-3">
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#reservationdate" />
                                                <div class="input-group-append" data-target="#reservationdate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <button id='BtnShowDist' name='next' type='button'
                                                class='btn btn-block btn-primary'><i class="fa fa-spinner"></i>
                                                Tampil</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <table class="table table-sm yajra-datatable" style="font-size: 10px">
                                <thead>
                                    <tr>
                                        <th class="text-center">NOMOR</th>
                                        <th class="text-center">DISTRIBUSI</th>
                                        <th class="text-center">BANK</th>
                                        <th class="text-center">LEMBAR</th>
                                        <th class="text-center">RUPIAH (Rp.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot style="background-color: #a5a7a9">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>TOTAL</th>
                                        <th id="lembar">0</th>
                                        <th id="total">0</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{-- Footer --}}
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Page specific script -->
    <script type="text/javascript">
        // alert('chek 1');a
        $(function() {
            document.getElementById("BtnShowDist").onclick = function() {
                // alert($("#reservationdate").find("input").val());
                const MyBulan = [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                var mytgl = $("#reservationdate").find("input").val();
                var getinputblth = mytgl.split(" ");
                let blthlaporan = MyBulan.indexOf(getinputblth[0]) + 1;
                const zeroPad = (num, places) => String(num).padStart(places, '0')
                let vblthlaporan = moment(new Date(getinputblth[1] + '/' + zeroPad(blthlaporan, 2) + '/01'))
                    .format('YYYYMM');
                // alert(vblthlaporan);
                AmbilDataFlagDist(vblthlaporan);
            };

            const rupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }

            function AmbilDataFlagDist(blthlaporan) {
                // alert('chek 2-->' + blthlaporan);
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
                    buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i> Excel',
                        titleAttr: 'Excel',
                        className: 'dt-button buttons-excel buttons-html5 btn btn-xs btn-success',
                        // className: 'green glyphicon glyphicon-list-alt',
                        footer: true,
                        title: 'REKAP LUNAS BANK PER DISTITBUSI/WILAYAH',
                        filename: 'MIV-LunasPerDist_', /// + DateTime.Now.ToString("ddMMMyyyy"),
                        exportOptions: {
                            columns: "thead th:not(.noExport)",
                            rows: function(indx, rowData, domElement) {
                                return $(domElement).css("display") != "none";
                            }
                        }
                    }],
                    ajax: {
                        url: "{{ route('dashboard.flagperdist') }}",
                        data: {
                            vblthlaporan: blthlaporan,
                        }
                    },
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

                        $('#lembar').html($.fn.dataTable.render.number('.', '.', 0).display(
                            lembar));
                        $('#total').html($.fn.dataTable.render.number('.', '.', 0).display(
                            total));
                    },
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            }
        });
    </script>
@endsection

@section('addfooterjs')
    <!-- daterangepicker -->
    <!-- InputMask -->
    <script src="{{ asset('adminlte320/plugins/moment/moment.min.js') }}"></script>
    {{-- <script src="{{ asset('adminlte320/plugins/inputmask/jquery.inputmask.min.js') }}"></script> --}}
    <!-- date-range-picker -->
    <script src="{{ asset('adminlte320/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('adminlte320/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script>
        $(function() {
            //Date picker
            $('#reservationdate').datetimepicker({
                // format: 'L',
                format: 'MMMM YYYY',
            });

            //isi tanggal hari ini
            let nowdate = moment(Date.now()).format('MMMM YYYY');
            $("#reservationdate").find("input").val(nowdate);

        });
    </script>
@endsection
