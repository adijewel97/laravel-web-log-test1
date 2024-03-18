@extends('layouts.main')

@section('container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            {{-- <div class="row mb-2">
                    <div class="col-sm-6">
                        <h5>{{ $menuname }}</h5>
        </div> --}}
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

    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-12">

            <!-- Default box -->
            <div class="card">
                {{-- <div class="card-header">
                            <h1 class="card-title">{{ $title }}</h1>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div> --}}
            <div class="card-body">
                <fieldset class="border p-3">
                    <legend class="w-auto">{{ $title }}</legend>

                    <div class="callout callout-info">
                        {{-- <h5><i class="fas fa-info"></i> Note:</h5> --}}
                        <form action="" enctype="multipart/form-data">
                            <div class="row" style="font-size:11px">
                                <label for="" class="col-sm-2 col-form-label">
                                    Nomor Usulan MIV
                                </label>
                                <div class="col-3">
                                    <input type="input" class="form-control" id="nosusulan" value='POS23BTG20240116002' required autofocus>
                                </div>
                            </div>
                            <div class="row mt-2" style="font-size:11px">
                                <label for="" class="col-sm-2 col-form-label">
                                    Tanggal File di TXT
                                </label>
                                <div class="col-3">
                                    <div class="input-group date" id="tglfiletxt" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#tglfiletxt" />
                                        <div class="input-group-append" data-target="#tglfiletxt" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-1" style="font-size:11px">
                                <div class="col-5">
                                </div>
                                <div class="col-2">
                                    <button id='BtnFindDataRCN' name='next' type='button' class='btn btn-block btn-primary'>
                                        <i class="fa-solid fa-magnifying-glass"></i> Tampilkan Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </fieldset>
                <br>
                <div class="form-group">
                    <div class="row mt-2" style="font-size:11px">
                        <div class="col-8">
                            <label>Isi File *.txt : </label> <br> <label id="namafile_txt"></label>
                            <select id="isifile_txt" style="height: 100px;" multiple class="form-control listfile">
                            </select>
                        </div>
                        <div class="col-4">
                            <label>Isi File *.txt.ctl :</label> <br> <label id="namafile_txtctl"></label>
                            <select id="isifile_txtctl" style="height: 100px;" multiple class="form-control listfile">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-1" style="font-size:11px">
                    <div class="col-5">
                    </div>
                    <div class="col-2">
                        <button id='BtnPoeseRCN' name='next' type='button' class='btn btn-block btn-primary'><i class="fa fa-file-pdf-o"></i>
                            Proses</button>
                    </div>
                </div>

                <br>
                <div class="form-group">
                    <label>Log Proses Dowload File RCN dan CTL Bank MIV :</label>
                </div>
                <div class="table-responsive">
                    <table id="mytable" class="table table-sm yjtd-belumflagbank" style="font-size: 9px">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">NAMAFILE</th>
                                <th class="text-center">TGLPROSES</th>
                                <th class="text-center">KETERANGAN</th>
                                <th class="text-center">USERID</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyid">
                        </tbody>
                        <!-- <tfoot style="background-color: #a5a7a9">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>TOTAL</th>
                                <th id="tJMLBELUMLUNAS" class="text-right">0</th>
                                <th id="tDATAUNPENDING" class="text-right">0</th>
                                <th id="tRPTAG" class="text-right">0</th>
                                <th id="tDATALBIH4LBR" class="text-right">0</th>
                                <th id="tLAMA_HARI" class="text-right">0</th>
                                <th id="f" class="text-right"></th>
                            </tr>
                        </tfoot> -->
                    </table>
                </div>

                {{-- <div id="pdfContainer"></div> --}}

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
        function TampilkanFileTXT_NamaFile_txt(nosusulan, tglusulan) {
            $.ajax({
                url: "{{ route('mproses.proses-nama-file-txt') }}",
                dataType: 'json',
                data: {
                    vnousulan: nosusulan,
                    vtglfile: tglusulan,
                },
                success: function(respon) {
                    console.log(respon);
                    // console.log(respon.status);
                    // $("#pathfile").html('');
                    namafiletxt = respon.nama_file.data;
                    // console.log(namafiletxt[0].NAMAFILE_TXT);
                    options1 = '';
                    options2 = '';
                    if (respon.status == '200') {
                        options1 = namafiletxt[0].NAMAFILE_TXT;
                        options2 = '<label>' + namafiletxt[0].NAMAFILE_TXT_CTL + '</label>';
                    };

                    $("#namafile_txt").html(options1);
                    $("#namafile_txtctl").html(options2);

                    // }
                },
                error: function(req, status, error) {
                    var errorMessage = "";

                    if (req.responseJSON && req.responseJSON.Message) {
                        errorMessage = req.responseJSON.Message;
                        errorkode = '001';
                    } else if (req.responseText) {
                        errorMessage = req.responseText;
                        errorkode = '002';
                    } else {
                        errorMessage = "An unknown error occurred.";
                        errorkode = '003';
                    }

                    if (errorkode == '002') {
                        ShowMsgSm('Sukses', 'Session User Habis Silahkan Login Uang.', 'MB_CLOSE');
                    } else {
                        ShowMsgSm('Sukses', errorMessage, 'MB_CLOSE');
                    }
                }
            });
        }

        function TampilkanFileTXT_isifile_txt(nosusulan, tglusulan) {
            $.ajax({
                url: "{{ route('mproses.proses-detail-file-txt') }}",
                dataType: 'json',
                data: {
                    vnousulan: nosusulan,
                    vtglfile: tglusulan,
                },
                success: function(respon) {
                    console.log(respon);
                    // console.log(respon.status);
                    // $("#pathfile").html('');
                    //isifiletxt = respon.info_isi_data.data;
                    // console.log(isifiletxt[0].NAMAFILE_TXT);
                    options = '';
                    if (respon.status == '200') {
                        isifiletxt = respon.txtfile.data;
                        // console.log(isifiletxt);
                        options = '';
                        isifiletxt.forEach(function(object) {
                            const isidata = object.DATA; // Note the correction here, using "DATA" instead of "data"
                            options += "<option>" + isidata + "</option>";
                        });

                        $("#isifile_txt").html(options);
                    };
                },
                error: function(req, status, error) {
                    var err = req.responseText.Message;
                    console.log(err);
                    $("#pathfile").html('');
                }
            });
        }

        function TampilkanFileTXT_rekapfile_txtctl(nosusulan, tglusulan) {
            $.ajax({
                url: "{{ route('mproses.proses-rekap-file-txt') }}",
                dataType: 'json',
                data: {
                    vnousulan: nosusulan,
                    vtglfile: tglusulan,
                },
                success: function(respon) {
                    console.log(respon);
                    // console.log(respon.status);
                    // $("#pathfile").html('');
                    //isifiletxt = respon.info_isi_data.data;
                    // console.log(isifiletxt[0].NAMAFILE_TXT);
                    options = '';
                    if (respon.status == '200') {
                        isifiletxt = respon.rkpfile.data;
                        // console.log(isifiletxt);
                        options = '';
                        isifiletxt.forEach(function(object) {
                            const isidata = object.DATA; // Note the correction here, using "DATA" instead of "data"
                            options += "<option>" + isidata + "</option>";
                        });

                        $("#isifile_txtctl").html(options);
                    };
                },
                error: function(req, status, error) {
                    var err = req.responseText.Message;
                    console.log(err);
                    $("#pathfile").html('');
                }
            });
        }

        $(function() {
            //1 cari file RCN yang akan di tampilkan di list dari ftp MIV kiriman Bank
            document.getElementById("BtnFindDataRCN").onclick = function() {
                //1a ambil nama file
                const inosusulan = document.getElementById('nosusulan');
                var vnosusulan = inosusulan.value;
                //1b tanggal file
                const itglsusulan = $("#tglfiletxt").find("input").val();
                const MyBulan = [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                var mytgl = $("#tglfiletxt").find("input").val();
                var getinputblth = mytgl.split(" ");
                let blthlaporan = MyBulan.indexOf(getinputblth[1]) + 1;
                const zeroPad = (num, places) => String(num).padStart(places, '0')
                let vtglusulan = moment(getinputblth[1] + ' ' + getinputblth[0] + ' ' + getinputblth[2], 'MMM DD YYYY').format('YYYYMMDD') + ' 2:30:25';

                // alert(vtglusulan);
                if (vnosusulan === '') {
                    ShowMsgSm('Error', 'Nomor Usulan MIV Tidak Boleh Kosong.', 'MB_CLOSE');
                    setTimeout(() => {
                        // document.getElementById("nosusulan").focus();
                        $("#nosusulan").focus();
                    }, 2);
                } else {
                    TampilkanFileTXT_NamaFile_txt(vnosusulan, vtglusulan);
                    TampilkanFileTXT_isifile_txt(vnosusulan, vtglusulan);
                    TampilkanFileTXT_rekapfile_txtctl(vnosusulan, vtglusulan);
                }
            }

            //2 download file struk ke local device
            document.getElementById("BtnPoeseRCN").onclick = function() {
                //1a ambil nama file
                const inosusulan = document.getElementById('nosusulan');
                var vnosusulan = inosusulan.value;
                //1b tanggal file
                const itglsusulan = $("#tglfiletxt").find("input").val();
                const MyBulan = [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                //1c nama file txt
                var labelElement = document.getElementById("namafile_txt");
                var Nama_file_txt = labelElement.innerText;


                var mytgl = $("#tglfiletxt").find("input").val();
                var getinputblth = mytgl.split(" ");
                let blthlaporan = MyBulan.indexOf(getinputblth[1]) + 1;
                const zeroPad = (num, places) => String(num).padStart(places, '0')
                let vtglusulan = moment(getinputblth[1] + ' ' + getinputblth[0] + ' ' + getinputblth[2], 'MMM DD YYYY').format('YYYYMMDD') + ' 2:30:25';

                // console.log(labelContent);
                // ShowMsgSm('Sukses', 'Chek ' + labelContent, 'MB_CLOSE');
                $.ajax({
                    url: "{{ route('mproses.proses-file-txt-pos') }}",
                    dataType: 'json',
                    data: {
                        vnousulan: vnosusulan,
                        vtglfile: vtglusulan,
                        vNama_file_txt: Nama_file_txt,
                        // vIsi_file_txt: vlistfile.join("\n "),
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.kdstatus = '200') {
                            // ShowMsgSm('Sukses', response.message, 'MB_CLOSE');
                            ShowMsgSm('Sukses', response.message, 'MB_CLOSE');
                            // listdata = JSON.stringify(response.info_progres_ctl.data);
                            // tampilmydatatable(listdata);
                        } else {
                            ShowMsgSm('Error', esponse.message, 'MB_CLOSE');
                        };
                        // TampilkanListFileRCN();
                    },
                    error: function(req, status, error) {
                        var err = req.responseText.Message;
                        console.log(req.responseJSON);
                        ShowMsgSm('Error', 'Terjadi kesalahan saat Membuat file TXT MIV.',
                            'MB_CLOSE');
                        // TampilkanListFileRCN();
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
            $('#tglfiletxt').datetimepicker({
                // format: 'L',
                format: 'DD MMMM YYYY',
            });

            //isi tanggal hari ini
            let nowdate = moment(Date.now()).format('DD MMMM YYYY');
            $("#tglfiletxt").find("input").val(nowdate);

        });
    </script>
    @endsection