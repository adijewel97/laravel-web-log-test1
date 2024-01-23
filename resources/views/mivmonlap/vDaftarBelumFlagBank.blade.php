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
                {{-- <div class="col-lg-1"></div> --}}
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
                                <form action="" style="font-size: 8px">
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
                                    </div>
                                    <div class="row mt-2" style="font-size:11px">
                                        <label for="" class="col-sm-2 col-form-label">
                                            Bank MIV
                                        </label>
                                        <div class="col-3">
                                            <select class="form-control" id="pilihkdbankmiv">
                                                @foreach ($combobankmiv as $item)
                                                    <option value="{{ $item['KODE_BANK'] }}">{{ $item['NAMA_BANK'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <button id='BtnShowDist' name='next' type='button'
                                                class='btn btn-block btn-primary'><i class="fa fa-spinner"></i>
                                                Tampil</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table id="mytable" class="table table-sm yjtd-belumflagbank" style="font-size: 9px">
                                    <thead>
                                        <tr>
                                            <th class="text-center">NO</th>
                                            <th class="text-center">PROSES</th>
                                            <th class="text-center">WILAYAH</th>
                                            <th class="text-center">TGL. PENGAJUAN</th>
                                            <th class="text-center">NOUSULAN</th>
                                            <th class="text-center">SATKER</th>
                                            <th class="text-center">BANK</th>
                                            <th class="text-center">BLM. LUNAS</th>
                                            <th class="text-center">PENDING</th>
                                            <th class="text-center">TAGIHAN</th>
                                            <th class="text-center">LBH. 4 LBR</th>
                                            <th class="text-center">HARI</th>
                                            <th class="text-center">INDIKASI</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyid">
                                    </tbody>
                                    <tfoot style="background-color: #a5a7a9">
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>TOTAL</th>
                                            {{-- <th colspan="7" class="text-center">TOTAL</th> --}}
                                            <th id="tJMLBELUMLUNAS" class="text-right">0</th>
                                            <th id="tDATAUNPENDING" class="text-right">0</th>
                                            <th id="tRPTAG" class="text-right">0</th>
                                            <th id="tDATALBIH4LBR" class="text-right">0</th>
                                            <th id="tLAMA_HARI" class="text-right">0</th>
                                            <th id="f" class="text-right"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{-- Footer --}}
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
                {{-- </div> --}}
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
                            url: "{{ route('monlap.daftarbelumflagbank') }}",
                            dataType: 'json',
                            data: {
                                vblthlaporan: blthlaporan,
                                vkdbank: kdbankmiv
                            },
                            success: function(respon) {
                                // alert('status ' + respon.kode + ' : ' + respon.message);
                                if (respon.kode == '200') {
                                    // document.getElementById('DataTables_Table_0_processing').style.display =
                                    //     'block';
                                    listdata = JSON.stringify(respon.data);
                                    tampilmydatatable(listdata);
                                } else {
                                    ShowMsgSm('Info', respon.message, 'MB_CLOSE');
                                    $("#tbodyid").empty();
                                    $('#tJMLBELUMLUNAS').html($.fn.dataTable.render.number('.', '.', 0).display(
                                        0));
                                    $('#tDATAUNPENDING').html($.fn.dataTable.render.number('.', '.', 0).display(
                                        0));
                                    $('#tRPTAG').html($.fn.dataTable.render.number('.', '.', 0).display(
                                        0));
                                    $('#tDATALBIH4LBR').html($.fn.dataTable.render.number('.', '.', 0).display(
                                        0));
                                    $('#tLAMA_HARI').html($.fn.dataTable.render.number('.', '.', 0).display(
                                        0));
                                }
                            },
                            error: function(result) {
                                ShowMsgSm('Info', 'Data Tidak Ditemukan atau Session Habis Login Ulang',
                                    'MB_CLOSE');
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
                            // responsive: true,
                            autoWidth: true,
                            searching: true,
                            paging: false,
                            language: {
                                'loadingRecords': '&nbsp;',
                                'processing': 'Loading...',
                                'emptyTable': 'No records are available',
                            },
                            // scrollY: "300px",
                            scrollX: true,
                            // scrollCollapse: true,
                            // fixedColumns: {
                            //     left: 2
                            // },
                            dom: 'Blfrtip',
                            buttons: [{
                                    extend: 'excelHtml5',
                                    text: '<i class="fa fa-file-excel"></i> Excel',
                                    titleAttr: 'Excel',
                                    className: 'dt-button buttons-excel buttons-html5 btn btn-xs btn-success',
                                    // className: 'green glyphicon glyphicon-list-alt',
                                    footer: true,
                                    title: 'DAFTAR BELUM LUNAS BANK MIV',
                                    filename: 'MIV-BelumLunasBank_', /// + DateTime.Now.ToString("ddMMMyyyy"),
                                    exportOptions: {
                                        columns: "thead th:not(.noExport)",
                                        rows: function(indx, rowData, domElement) {
                                            return $(domElement).css("display") != "none";
                                        }
                                    },
                                    // customize: function(xlsx) {
                                    //     $sheet - > appendRow(2, array(
                                    //         'appended', 'appended'
                                    //     ));
                                    // }
                                    // exportOptions: {
                                    //     columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                    // }
                                },
                                {
                                    extend: 'pdf',
                                    footer: true,
                                    text: '<i class="fa fa-file-pdf"></i> PDF  ',
                                    className: 'dt-button buttons-excel buttons-html5 btn btn-xs btn-danger',
                                    footer: true,
                                    title: 'DAFTAR BELUM LUNAS BANK MIV',
                                    filename: 'MIV-BelumLunasBank_', /// + DateTime.Now.ToString("ddMMMyyyy"),
                                    orientation: 'landscape',
                                    // exportOptions: {
                                    //     columns: [0, 1, 3, 5]
                                    // }
                                }
                            ],
                            columnDefs: [{
                                "defaultContent": "",
                                "targets": "_all"
                            }, {
                                "className": "text-left",
                                "targets": [1, 2, 3, 4, 5, 6],
                            }, {
                                "width": "1%",
                                "targets": [7, 8, 9, 10, 11],
                                className: 'text-right',
                                render: $.fn.dataTable.render.number('.', ',', 0, '')
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
                                width: "1%",
                                // render: function(data, type, row) {
                                //     return row['KD_DIST'] + ' - ' + row['DIST'];
                                // }
                            }, {
                                title: 'WILAYAH',
                                data: 'KD_DIST',
                            }, {
                                title: 'TGL. PENGAJUAN',
                                data: 'TGLAPPROVE',
                                className: 'text-right'
                            }, {
                                data: 'NOUSULAN'
                            }, {
                                data: 'SATKER',
                                width: "20%"
                            }, {
                                data: 'BANK',
                                width: "10%"
                            }, {
                                title: 'BLM. LUNAS',
                                data: 'JMLBELUMLUNAS',
                                width: "1%"
                            }, {
                                title: 'PENDING',
                                data: 'DATAUNPENDING'
                            }, {
                                title: 'TAGIHAN',
                                data: 'RPTAG',
                            }, {
                                title: 'LBH. 4 LBR',
                                data: 'DATALBIH4LBR',
                            }, {
                                title: 'HARI',
                                data: 'LAMA_HARI',
                            }, {
                                data: 'INDIKASI',
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
                                tJMLBELUMLUNAS = api
                                    .column(7)
                                    .data()
                                    .reduce(function(a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);
                                tDATAUNPENDING = api
                                    .column(8)
                                    .data()
                                    .reduce(function(a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);
                                tRPTAG = api
                                    .column(9)
                                    .data()
                                    .reduce(function(a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);
                                tDATALBIH4LBR = api
                                    .column(10)
                                    .data()
                                    .reduce(function(a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);
                                tLAMA_HARI = api
                                    .column(11)
                                    .data()
                                    .reduce(function(a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0);

                                $('#tJMLBELUMLUNAS').html($.fn.dataTable.render.number('.', '.', 0).display(
                                    tJMLBELUMLUNAS));
                                $('#tDATAUNPENDING').html($.fn.dataTable.render.number('.', '.', 0).display(
                                    tDATAUNPENDING));
                                $('#tRPTAG').html($.fn.dataTable.render.number('.', '.', 0).display(
                                    tRPTAG));
                                $('#tDATALBIH4LBR').html($.fn.dataTable.render.number('.', '.', 0).display(
                                    tDATALBIH4LBR));
                                $('#tLAMA_HARI').html($.fn.dataTable.render.number('.', '.', 0).display(
                                    tLAMA_HARI));
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
