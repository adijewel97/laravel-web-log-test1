@extends('layouts.main')

@section('container')
<!-- Spinner Loading -->
<div id="loadingSpinner">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

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
                                    UIW
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
                                        <option value="{{ $item['KODE_BANK'].'|'.$item['KODE_ERP'] }}">{{ $item['NAMA_BANK'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="" class="col-sm-2 col-form-label">
                                    UP3
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
                                    <button id='BtnFindData' name='next' type='button'
                                        class='btn btn-block btn-primary'><i
                                            class="fa-solid fa-magnifying-glass"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </fieldset>

                <div class="form-group">
                    <label>Pilih File yang akan di Tampilkan/Download :</label>
                    <select id="pathfile" multiple class="form-control listfile">
                    </select>
                </div>
                <div class="row mt-3" style="font-size:11px">
                    <div class="col-4">
                    </div>
                    <div class="col-2">
                        <button id='BtnPrint' name='next' type='button' class='btn btn-block btn-primary'><i
                                class="fa fa-file-pdf-o"></i>
                            Tampil</button>
                    </div>
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

        $(function() {
            //tampilkan up3 pln kode
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

            //cari file struk pdf yang akan di tampilkan di list dari ftp MIV kiriman Bank
            document.getElementById("BtnFindData").onclick = function() {
                //1 asdadas
                $('#loadingSpinner').show();
                $('.overlay').show();
                const MyBulan = [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                var mytgl = $("#reservationdate").find("input").val();
                var getinputblth = mytgl.split(" ");
                let vblthlaporan = MyBulan.indexOf(getinputblth[0]) + 1;
                const zeroPad = (num, places) => String(num).padStart(places, '0')
                let blthlaporan = moment(new Date(getinputblth[1] + '/' + zeroPad(vblthlaporan, 2) + '/01'))
                    .format('YYYYMM');
                let kdbankmiv = $('#pilihkdbankmiv').val();
                // /list-ftp-files
                $.ajax({
                    url: "{{ route('monlap.daftar-file-ftp') }}",
                    dataType: 'json',
                    data: {
                        vblthlaporan: blthlaporan,
                        vkdbank: kdbankmiv,
                        vuiw: $('#pilihkddist').val(),
                        vup3: $('#pilihup3').val()
                    },
                    success: function(respon) {
                        console.log(respon);
                        if (respon.status === '200') {
                            options = '';
                            respon.downloaded_files.forEach(function(object) {
                                const file = object.file;
                                const path = object.path;
                                const status = object.status;

                                options = options + "<option  value=" + path + '/' + file +
                                    ">" + file +
                                    "</option>";
                            });

                            $("#pathfile").html(options);
                            setTimeout(function() {
                                // Menyembunyikan spinner dan overlay setelah proses selesai
                                $('#loadingSpinner').hide();
                                $('.overlay').hide();
                                // alert("Data berhasil diproses!");
                            }, 100);
                        } else {
                            $('#loadingSpinner').hide();
                            $('.overlay').hide();
                            $("#pathfile").html('');
                            ShowMsgSm('Info', respon.status + ' - ' + respon.message,
                                'MB_CLOSE');
                        }
                    },
                    error: function(req, status, error) {
                        setTimeout(function() {
                            // Menyembunyikan spinner dan overlay setelah proses selesai
                            $('#loadingSpinner').hide();
                            $('.overlay').hide();
                            // alert("Data berhasil diproses!");
                        }, 100);
                        var err = req.responseText.Message;
                        console.log(err);
                        $("#pathfile").html('');
                        ShowMsgSm('Error', 'File Tidak DiTemukan/Chek Koneksi FTP ! ',
                            'MB_CLOSE');
                    }
                });
            }

            //download file struk ke local device
            document.getElementById("BtnPrint").onclick = function() {
                //2 ambil file list dari pilihan list browser
                $('#loadingSpinner').show();
                $('.overlay').show();
                var vlistfile = [];
                $.each($(".listfile option:selected"), function() {
                    vlistfile.push($(this).val());
                });
                // ShowMsgSm('Info', 'Test me Print : ' + countries.join(", "), 'MB_CLOSE');


                $.ajax({
                    url: "{{ route('monlap.download-struk-pdf') }}",
                    dataType: 'json',
                    data: {
                        vnamafile: vlistfile.join(", ")
                    },
                    success: function(response) {
                        console.log(response);
                        //Iterating through the array using forEach
                        var res_file = response.downloaded_files;
                        res_file.forEach((file, index) => {
                            if (file.status = '200') {
                                window.open(file.localpath, '_blank');
                                setTimeout(function() {
                                    // Menyembunyikan spinner dan overlay setelah proses selesai
                                    $('#loadingSpinner').hide();
                                    $('.overlay').hide();
                                    // alert("Data berhasil diproses!");
                                }, 100);
                                // alert(response.message);
                            } else {
                                setTimeout(function() {
                                    // Menyembunyikan spinner dan overlay setelah proses selesai
                                    $('#loadingSpinner').hide();
                                    $('.overlay').hide();
                                    // alert("Data berhasil diproses!");
                                }, 100);
                                ShowMsgSm(file.status, file.message, 'MB_CLOSE');
                            }
                        });
                    },
                    error: function(req, status, error) {
                        var err = req.responseText.Message;
                        console.log(req.responseJSON);
                        setTimeout(function() {
                            // Menyembunyikan spinner dan overlay setelah proses selesai
                            $('#loadingSpinner').hide();
                            $('.overlay').hide();
                            // alert("Data berhasil diproses!");
                        }, 100);
                        ShowMsgSm('Error', 'Terjadi kesalahan saat mengambil PDF.',
                            'MB_CLOSE');
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