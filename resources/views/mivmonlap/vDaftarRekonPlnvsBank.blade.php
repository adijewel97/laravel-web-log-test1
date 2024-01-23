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
                                        <label for="" class="col-sm-2 col-form-label">
                                            Distribusi/Wilayah
                                        </label>
                                        <div class="col-5">
                                            <select class="form-control" id="pilihkddist">
                                                @foreach ($mycombo['combodistpln'] as $item)
                                                    <option value="{{ $item['KD_DIST'] }}">{{ $item['NAMA_DIST'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2" style="font-size:11px">
                                        <label for="" class="col-sm-2 col-form-label">
                                            Bank MIV
                                        </label>
                                        <div class="col-3">
                                            <select class="form-control" id="pilihkdbankmiv">
                                                {{-- {{ dd(mycombo) }} --}}
                                                @foreach ($mycombo['combobankmiv'] as $item)
                                                    <option value="{{ $item['KODE_BANK'] }}">{{ $item['NAMA_BANK'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="" class="col-sm-2 col-form-label">
                                            AREA/UP3
                                        </label>
                                        <div class="col-5">
                                            <select class="form-control" id="pilihup3">
                                                {{-- @foreach ($combobankmiv as $item)
                                                    <option value="{{ $item['KODE_BANK'] }}">{{ $item['NAMA_BANK'] }}
                                                    </option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-3" style="font-size:11px">
                                        <div class="col-4">
                                        </div>
                                        <div class="col-2">
                                            <button id='BtnShowDist' name='next' type='button'
                                                class='btn btn-block btn-primary'><i class="fa fa-spinner"></i>
                                                Tampil</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <table id="mytable" class="table borderless table-sm yjtd-belumflagbank"
                                style="font-size: 8px">
                                {{-- <table id="mytable" class="table  table-striped table-sm yjtd-belumflagbank"
                                style="font-size: 8px"> --}}
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">NO</th>
                                        <th colspan="12" class="text-center">PLN</th>
                                        <th colspan="6" class="text-center">BANK</th>
                                        <th colspan="2" class="text-center">REKON ANALISA</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">PRODUK</th>
                                        <th class="text-center">TGLAPPROVE</th>
                                        <th class="text-center">VA</th>
                                        <th class="text-center">SATKER</th>
                                        <th class="text-center">NOUSULAN</th>
                                        <th class="text-center">IDPEL</th>
                                        <th class="text-center">BLTH</th>
                                        <th class="text-center">LUNAS H0</th>
                                        <th class="text-center">RPTAG</th>
                                        <th class="text-center">TGLBAYAR</th>
                                        <th class="text-center">JAMBAYAR</th>
                                        <th class="text-center">USERID</th>
                                        <th class="text-center">IDPEL</th>
                                        <th class="text-center">BLTH</th>
                                        <th class="text-center">RPTAG</th>
                                        <th class="text-center">TGLBAYAR</th>
                                        <th class="text-center">JAMBAYAR</th>
                                        <th class="text-center">USERID</th>
                                        <th class="text-center">SELISIH_RPTAG</th>
                                        <th class="text-center">KETERANGAN</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyid">
                                </tbody>
                                <tfoot style="background-color: #a5a7a9">
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center">TOTAL</th>
                                        <th id="tRPTAGPLN" class="text-right">0</th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th id="tRPTAGBANK" class="text-right">0</th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th id="tRPTAGDELTA" class="text-right">0</th>
                                        <th class="text-center"></th>
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
            $('#pilihup3').append(new Option('PILIH SEMUA', 'ALL'));
            $('#pilihkddist').on('change', function() {
                // Kode untuk ajax request disini
                var vpilihkddist = $('#pilihkddist').val();
                // alert(vpilihkddist);
                $.ajax({
                    url: "{{ route('master.mst_up3') }}",
                    method: 'POST',
                    data: {
                        vkddist: $(this).val()
                    },
                    success: function(response) {
                        $('#pilihup3').empty();

                        $.each(response, function(i, item) {
                            $('#pilihup3').append(new Option(item.NAMA_AREA,
                                item.UNITAP))
                        })
                    }
                })
            });

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
                let vblthlaporan = moment(new Date(getinputblth[1] + '/' + zeroPad(blthlaporan, 2) +
                        '/01'))
                    .format('YYYYMM');
                let kdbankmiv = $('#pilihkdbankmiv').val();
                let kddist = $('#pilihkddist').val();
                let kdarea = $('#pilihup3').val();
                // alert(vblthlaporan + '---' + kdbankmiv);
                AmbilDataMonLap2(vblthlaporan, kdbankmiv, kddist, kdarea);
            };

            const rupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }

            function AmbilDataMonLap2(blthlaporan, kdbankmiv, kddist, kdarea) {
                // alert('chek 2-->' + blthlaporan + '---' + kdbankmiv + '---' + kddist + '---' + kdarea);
                $.ajax({
                    url: "{{ route('monlap.daptarrekonplnvsbank') }}",
                    dataType: 'json',
                    data: {
                        vblthlaporan: blthlaporan,
                        vkodebank: kdbankmiv,
                        vkddist: kddist,
                        vkdarea: kdarea
                    },
                    success: function(respon) {
                        // alert('status ' + respon.kode + ' : ' + respon.message);
                        if (respon.kode == '200') {
                            listdata = JSON.stringify(respon.data);
                            tampilmydatatable(listdata);
                        } else {
                            ShowMsgSm('Info', respon.message, 'MB_CLOSE');
                            $("#tbodyid").empty();
                            $('#tJML').html($.fn.dataTable.render.number('.', '.', 0)
                                .display(
                                    0));
                            $('#tRPTAG').html($.fn.dataTable.render.number('.', '.', 0)
                                .display(
                                    0));
                        }
                    },
                    error: function(result) {
                        ShowMsgSm('Info', 'Data Tidak ditemukan, Lakukan Login ulang', 'MB_CLOSE');
                        document.getElementById('DataTables_Table_0_processing').style
                            .display =
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
                    // responsive: false,
                    autoWidth: true,
                    searching: true,
                    paging: false,
                    language: {
                        'loadingRecords': '&nbsp;',
                        'processing': 'Loading...',
                        'emptyTable': 'Tidak Ada Record',
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
                            header: true,
                            footer: true,
                            title: 'DAFTAR REKON BANK VS BANK',
                            filename: 'MIV-RekoPlnVsBank_', /// + DateTime.Now.ToString("ddMMMyyyy"),
                            exportOptions: {
                                columns: "thead th:not(.noExport)",
                                rows: function(indx, rowData, domElement) {
                                    return $(domElement).css("display") != "none";
                                }
                            },
                            customize: function(xlsx) {

                                //copy _createNode function from source
                                function _createNode(doc, nodeName, opts) {
                                    var tempNode = doc.createElement(nodeName);

                                    if (opts) {
                                        if (opts.attr) {
                                            $(tempNode).attr(opts.attr);
                                        }

                                        if (opts.children) {
                                            $.each(opts.children, function(key, value) {
                                                tempNode.appendChild(value);
                                            });
                                        }

                                        if (opts.text !== null && opts.text !== undefined) {
                                            tempNode.appendChild(doc.createTextNode(opts.text));
                                        }
                                    }

                                    return tempNode;
                                }

                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                var mergeCells = $('mergeCells', sheet);
                                mergeCells[0].children[0].remove(); // remove merge cell 1st row

                                var rows = $('row', sheet);
                                rows[0].children[0].remove(); // clear header cell

                                // create new cell
                                rows[0].appendChild(_createNode(sheet, 'c', {
                                    attr: {
                                        t: 'inlineStr',
                                        r: 'B1', //address of new cell
                                        s: 51 // center style - https://www.datatables.net/reference/button/excelHtml5
                                    },
                                    children: {
                                        row: _createNode(sheet, 'is', {
                                            children: {
                                                row: _createNode(sheet, 't', {
                                                    text: 'new header text'
                                                })
                                            }
                                        })
                                    }
                                }));


                                // set new cell merged
                                mergeCells[0].appendChild(_createNode(sheet, 'mergeCell', {
                                    attr: {
                                        ref: 'B1:E1' // merge address
                                    }
                                }));

                                mergeCells.attr('count', mergeCells.attr('count') + 1);

                                // add another merged cell
                            }
                            // exportOptions: {
                            //     columns: [0, 1, 2, 3, 4, 5, 6, 7]
                            // }
                        },
                        // {
                        //     extend: 'pdf',
                        //     footer: true,
                        //     text: '<i class="fa fa-file-pdf"></i> PDF  ',
                        //     className: 'dt-button buttons-excel buttons-html5 btn btn-xs btn-danger',
                        //     title: 'DAFTAR REKON BANK VS BANK',
                        //     filename: 'MIV-RekoPlnVsBank_', /// + DateTime.Now.ToString("ddMMMyyyy"),
                        //     orientation: 'landscape',
                        //     // exportOptions: {
                        //     //     columns: [0, 1, 3, 5]
                        //     // }
                        // }
                    ],
                    columnDefs: [{
                        "defaultContent": "",
                        "targets": "_all"
                    }],
                    columns: [{
                        title: 'NO',
                        data: null,
                        sortable: false,
                        className: "text-right",
                        width: "0.1%",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    }, {
                        title: 'PRODUK',
                        data: 'PRODUK',
                        width: "1%"
                    }, {
                        title: 'TGLAPPROVE',
                        data: 'TGLAPPROVE',
                        width: "0.1%",
                        className: 'text-left'
                    }, {
                        title: 'VA',
                        data: 'VA',
                        width: "0.1%",
                        className: 'text-left'
                    }, {
                        title: 'SATKER',
                        data: 'SATKER',
                        width: "2%",
                        className: 'text-left'
                    }, {
                        title: 'NO USULAN',
                        data: 'PLN_NOUSULAN',
                        className: 'text-left',
                        width: "1%"
                    }, {
                        title: 'IDPEL',
                        data: 'PLN_IDPEL',
                        className: 'text-left',
                        width: "1%"
                    }, {
                        title: 'BLTH',
                        data: 'PLN_BLTH',
                        width: "0.5%"
                    }, {
                        title: 'LUNAS H0',
                        data: 'PLN_LUNAS_H0',
                        className: 'text-left',
                        width: "1%"
                    }, {
                        title: 'RPTAG',
                        data: 'PLN_RPTAG',
                        className: 'text-right',
                        width: "1%",
                        render: $.fn.dataTable.render.number('.', ',', 0, '')
                    }, {
                        title: 'TGLBAYAR',
                        data: 'PLN_TGLBAYAR',
                        className: 'text-left',
                        width: "1%"
                    }, {
                        title: 'JAMBAYAR',
                        data: 'BANK_JAMBAYAR',
                        className: 'text-left',
                        width: "1%"
                    }, {
                        title: 'KDBANK',
                        data: 'PLN_KDBANK',
                        className: 'text-left',
                        width: "1%"
                    }, {
                        title: 'IDPEL',
                        data: 'BANK_IDPEL',
                        className: 'text-left',
                        width: "1%"
                    }, {
                        title: 'BLTH',
                        data: 'BANK_BLTH',
                        width: "0.5%"
                    }, {
                        title: 'RPTAG',
                        data: 'BANK_RPTAG',
                        className: 'text-right',
                        width: "1%",
                        render: $.fn.dataTable.render.number('.', ',', 0, '')
                    }, {
                        title: 'TGLBAYAR',
                        data: 'BANK_TGLBAYAR',
                        className: 'text-left',
                        width: "1%"
                    }, {
                        title: 'JAMBAYAR',
                        data: 'BANK_JAMBAYAR',
                        className: 'text-left',
                        width: "1%"
                    }, {
                        title: 'USER',
                        data: 'BANK_USERID',
                        className: 'text-left',
                        width: "1%"
                    }, {
                        title: 'SELISIH RPTAG',
                        data: 'SELISIH_RPTAG',
                        className: 'text-right',
                        width: "1%",
                        render: $.fn.dataTable.render.number('.', ',', 0, '')
                    }, {
                        title: 'KETERANGAN',
                        data: 'KETERANGAN',
                        className: 'text-left',
                        width: "1%"
                    }],
                    drawCallback: function(row, data, start, end, display) {
                        var api = this.api();

                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ? i : 0;
                        };
                        // Total over all pages
                        tRPTAGPLN = api
                            .column(9)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        tRPTAGBANK = api
                            .column(16)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        tRPTAGDELTA = api
                            .column(4)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        $('#tRPTAGPLN').html($.fn.dataTable.render.number('.', '.', 0).display(
                            tRPTAGPLN));
                        $('#tRPTAGBANK').html($.fn.dataTable.render.number('.', '.', 0).display(
                            tRPTAGBANK));
                        $('#tRPTAGDELTA').html($.fn.dataTable.render.number('.', '.', 0).display(
                            tRPTAGDELTA));
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
    <script src="{{ asset('adminlte320/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>

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
