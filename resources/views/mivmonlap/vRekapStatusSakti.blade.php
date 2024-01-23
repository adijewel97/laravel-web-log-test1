@extends('layouts.main')

@section('container')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>{{ $menuname }}</h5>
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
                            <h3 class="card-title">{{ $title }}</h3>

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

                            <table id="mytable" class="table table-sm yjtd-belumflagbank" style="font-size: 8px">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th class="text-center">PROSES</th>
                                        <th class="text-center">KOGOL</th>
                                        <th class="text-center">JML</th>
                                        <th class="text-center">RPTAG</th>
                                        <th class="text-center">KDGERAK</th>
                                        <th class="text-center">STAUS</th>
                                        <th class="text-center">USERID</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyid">
                                </tbody>
                                <tfoot style="background-color: #a5a7a9">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right">TOTAL</th>
                                        <th id="tJML" class="text-right">0</th>
                                        <th id="tRPTAG" class="text-right">0</th>
                                        <th class="text-right"></th>
                                        <th class="text-right"></th>
                                        <th class="text-right"></th>
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


    {{-- alert boostrap from javasecript me --}}
    <script src="{{ asset('mystyle/js/myalertbs.js') }}"></script>

    <!-- Page specific script -->
    <script type="text/javascript">
        // alert('chek 1');

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
                let kdbankmiv = $('#pilihkdbankmiv').val();
                // alert(vblthlaporan + '---' + kdbankmiv);
                AmbilDataMonLap2(vblthlaporan, kdbankmiv);
            };

            const rupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }

            function AmbilDataMonLap2(blthlaporan, kdbankmiv) {
                // alert('chek 2-->' + blthlaporan);
                $.ajax({
                    url: "{{ route('monlap.rekapstatussakti') }}",
                    dataType: 'json',
                    data: {
                        vblthlaporan: blthlaporan
                    },
                    success: function(respon) {
                        // alert('status ' + respon.kode + ' : ' + respon.message);
                        if (respon.kode == '200') {
                            listdata = JSON.stringify(respon.data);
                            tampilmydatatable(listdata);
                        } else {
                            ShowMsgSm('Info', respon.message, 'MB_CLOSE');
                            $("#tbodyid").empty();
                            $('#tJML').html($.fn.dataTable.render.number('.', '.', 0).display(
                                0));
                            $('#tRPTAG').html($.fn.dataTable.render.number('.', '.', 0).display(
                                0));
                        }
                    },
                    error: function(result) {
                        alert("Data Tidak ditemukan !");
                        document.getElementById('DataTables_Table_0_processing').style.display =
                            'none';
                        $("#tbodyid").empty();
                    }
                });
            }

            function tampilmydatatable(listdata) {
                // var json = '[{"company_id":"1","company_name":"schneider"}]';
                var json = listdata;
                console.log(json);
                $('#mytable').DataTable({
                    data: JSON.parse(json),
                    processing: true,
                    // serverSide: true,
                    destroy: true,
                    responsive: true,
                    autoWidth: true,
                    searching: true,
                    paging: false,
                    language: {
                        'loadingRecords': '&nbsp;',
                        'processing': 'Loading...'
                    },
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
                    columnDefs: [{
                        "defaultContent": "",
                        "targets": "_all"
                    }],
                    columns: [{
                        title: 'NO',
                        data: null,
                        sortable: false,
                        className: "text-right",
                        width: "1%",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    }, {
                        title: 'PROSES',
                        data: 'PROSES',
                        width: "1%"
                    }, {
                        title: 'KOGOL',
                        data: 'KOGOL',
                        width: "1%",
                        className: 'text-center'
                    }, {
                        title: 'JML',
                        data: 'JML',
                        width: "2%",
                        className: 'text-right'
                    }, {
                        data: 'RPTAG',
                        width: "2%",
                        className: 'text-right'
                    }, {
                        data: 'KDGERAK',
                        className: 'text-center',
                        width: "10%"
                    }, {
                        data: 'STAUS',
                        className: 'text-center',
                        width: "10%"
                    }, {
                        title: 'USERID',
                        data: 'USERID',
                        width: "10%"
                    }],
                    drawCallback: function(row, data, start, end, display) {
                        var api = this.api();

                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ? i : 0;
                        };
                        // Total over all pages
                        tJML = api
                            .column(3)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        tRPTAG = api
                            .column(4)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        $('#tJML').html($.fn.dataTable.render.number('.', '.', 0).display(
                            tJML));
                        $('#tRPTAG').html($.fn.dataTable.render.number('.', '.', 0).display(
                            tRPTAG));
                    }
                });
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
