<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
// use Monolog\Handler\RotatingFileHandler;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\CMstDistribusi;
use App\Http\Controllers\CLoginUser;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     Log::info('Sukses : test info mang adis.');
//     // Log::warning('Something could be going wrong.');
//     // Log::error('Something is really going wrong.');

//     return view('vhome', [
//         'title' => 'Home'
//     ]);
// });

// ---------------------------------------------------------------
// -- (1) Area LOGIN APP / AUTH USER TOKEN
// ---------------------------------------------------------------
Route::get('/', function (Request $request) {
    // $data = $request->session()->all();
    if (($request->session()->exists('_datalogin')) && ($request->session()->get('_datalogin.kode') == 200)) {
        $msg = $request->session()->get('_datalogin.message');
        return view('dashboards/vDashboardPerDist', ['title' => 'Home', 'message' => $msg]);
    } else {
        $data = $request->session()->all();
        // dd($data);
        return view('layouts/login', ['title' => 'Login', 'message' => '']);
    }
});

Route::get('/login', function (Request $request) {
    // $request->session()->invalidate();
    // dd($request->session()->invalidate());
    // return view('layouts/login', ['title' => 'Login', 'message' => '']);
});

// Route::get('/users', function () {
//     return config('myconfig.variable.SVR_URL_API');
// });

Route::post('/loginuser', [CLoginUser::class, 'actionlogin']);
Route::get('/logoutuser', [CLoginUser::class, 'actionlogout']);

Route::get('/home', [CMstDistribusi::class, 'GetApiMstDistribusi'])->name('home');
Route::get('/dasboardperdist', [CMstDistribusi::class, 'GetApiMstDistribusi'])->name('dasboardperdist');
Route::get('/showmstdist', [CMstDistribusi::class, 'ShowApiMstDistribusi']);

// Route::get('/login', function (Request $request) {
//     if ($request->ajax()) {
//         $ChekLoginUser = http::post(
//             'http://mivp2apstpln-api-v2.test/api/mivp2apstpln/login',
//             [
//                 'username' => 'adis',
//                 'password' => 'adis1234'
//             ]
//         );
//         dd($ChekLoginUser);
//     }
// })->name('actionlogin');

Route::get('getmstdistribusi', function (Request $request) {
    if ($request->ajax()) {
        $MstDistData = http::get(config('myconfig.variable.SVR_URL_API') . 'getmstdistribusi');
        // return $MstDistData['data'];
        // return DataTables::of($MstDistData['data'])->make(true);
        // dd($MstDistData['data']);
        return DataTables::of($MstDistData['data'])
            ->addIndexColumn()
            // ->addColumn('action', function ($row) {
            //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            //     return $actionBtn;
            // })
            // ->rawColumns(['action'])
            ->make(true);
    }
})->name('monlap.mstdistribusi');

// ---------------------------------------------------------------
// -- (2) Area Dasboard Menu
// ---------------------------------------------------------------
Route::get('getdasboardperdist', function (Request $request) {
    if ($request->ajax()) {
        $blthlaporan      = $request->input('vblthlaporan');
        // print_f($blthlaporan);
        // http://mivp2apstpln-api-v2.test/api/mivp2apstpln/mivlunasflagalldist
        $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'mivlunasflagalldist',
                [
                    // 'blthlaporan' => '202303'
                    'blthlaporan' => $blthlaporan
                ]
            );
        // return $MstDistData['data'];
        // return DataTables::of($MstDistData['data'])->make(true);
        // dd($MyData);
        return DataTables::of($MyData['data'])
            ->addIndexColumn()
            // ->addColumn('kd_nama_dist', function ($data) {
            //     return  $data->DIST;
            // })
            // ->addColumn('action', function ($row) {
            //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            //     return $actionBtn;
            // })
            // ->rawColumns(['action'])
            ->make(true);
    }
})->name('dashboard.flagperdist');

// ---------------------------------------------------------------
// -- (3) Area Master-Master Menu
// ---------------------------------------------------------------
//Master wilayah/Distribusi pln
Route::get('/masterdist', function (Request $request) {
    $kddist      = $request->input('vkddist');
    $comboup3 =  http::withToken($request->Session()->get('_datalogin.data.token'))
        ->post(
            config('myconfig.variable.SVR_URL_API') . 'getmstunitap',
            [
                'kddist' => $kddist
            ]
        )->json();
    // dd($comboup3);
    return $comboup3['data'];
})->name('master.mst_wilayah');


//Master Area pln / Unit Pelaksana Pelayanan Pelanggan (UP3)
Route::POST('/masterup3', function (Request $request) {
    $kddist      = $request->input('vkddist');
    $comboup3 =  http::withToken($request->Session()->get('_datalogin.data.token'))
        ->post(
            config('myconfig.variable.SVR_URL_API') . 'getmstunitap',
            [
                'kddist' => $kddist
            ]
        )->json();
    // dd($comboup3);
    return $comboup3['data'];
})->name('master.mst_up3');

// ---------------------------------------------------------------
// -- (4) Area MIV PROSES Menu
// ---------------------------------------------------------------



// ---------------------------------------------------------------
// -- (5) Area MIV MONITORING DAN LAPORAN Menu
// ---------------------------------------------------------------
//1a Data Belum Lunas Bank
// Route::controller(CMonLaporanMiv::class)->group(function () {
//     Route::get('/mivp2apstpln/getmstdistribusi', 'monlap_get_distribusi');
// });

Route::get('/DaftarBelumFlagBank', function (Request $request) {
    try {
        // run your code here
        $combobankmiv = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'getmstbankmiv',
                [
                    'kdbank' => 'ALL'
                ]
            )->json();
        // dd($combobankmiv['data']);

        return view('mivmonlap/vDaftarBelumFlagBank', [
            'menuname' => 'MIV - Monitoring/Laporan',
            'title' => 'Daftar Belum Flag Bank',
            'combobankmiv' =>  $combobankmiv['data']
        ]);
    } catch (exception $e) {
        return redirect('/login')->with(['SessionMessage' => 'Session expired, silahkan login ulang !']);
    }
});

// ---------------------------------------------------------------
//1b ambil data
Route::get('getDaftarBelumFlagBank', function (Request $request) {
    if ($request->ajax()) {
        $blthlaporan      = $request->input('vblthlaporan');
        $kodebank         = $request->input('vkdbank');
        // print_f($blthlaporan . '---' . $kodebank);
        $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'mivbelumflag',
                [
                    // 'blthlaporan' => '202303'
                    'blthlaporan' => $blthlaporan,
                    'kdbank'    => $kodebank
                ]
            )->json();
        // return $MstDistData['data'];
        // return DataTables::of($MstDistData['data'])->make(true);
        // dd($MyData);

        return $MyData;

        // if (Str::upper($MyData['status']) == Str::upper('Error')) {
        //     return $MyData;
        // } else {
        //     return DataTables::of($MyData['data'])
        //         ->addIndexColumn()
        //         // ->addColumn('kd_nama_dist', function ($data) {
        //         //     return  $data->DIST;
        //         // })
        //         // ->addColumn('action', function ($row) {
        //         //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
        //         //     return $actionBtn;
        //         // })
        //         // ->rawColumns(['action'])
        //         ->make(true);
        // }
    }
})->name('monlap.daftarbelumflagbank');

// ---------------------------------------------------------------
//2 Daftar Rekon PLN vs bank file rcn vs olap lunas
Route::get('/DaftarRekonPlnvsBank', function (Request $request) {
    //21 ambil master bank MIV
    // $combobankmiv = file_get_contents(URL::to('master.mst_wilayah'));
    // $combodistpln = Route::getRoutes()->getByName('master.mst_wilayah')->uri();
    // dd($combodistpln);

    // GET Request
    // $response = Http::get(route('master.mst_wilayah'));

    // $combodistpln = http::post(
    //     $request->url() . Route::getRoutes()->getByName('master.mst_wilayah')->uri()
    // )->json();

    //22 ambil master wilayah/distribusi PLN
    $combobankmiv = http::withToken($request->Session()->get('_datalogin.data.token'))
        ->post(
            config('myconfig.variable.SVR_URL_API') . 'getmstbankmiv'
        );


    $combodistpln =  http::withToken($request->Session()->get('_datalogin.data.token'))
        ->post(
            config('myconfig.variable.SVR_URL_API') . 'getmstdistribusi'
        )->json();
    // dd($combodistpln);

    $mydatacombo = [
        'combobankmiv' => $combobankmiv['data'],
        'combodistpln' => $combodistpln['data']
    ];

    return view('mivmonlap/vDaftarRekonPlnvsBank', [
        'menuname' => 'MIV - Monitoring/Laporan',
        'title' => 'Daftar Permohonan/Rekon PLN vs. BANK PerWilayah',
        'mycombo' => $mydatacombo
    ]);
});

//2b ambil API data rekon PLN vs bank MIV
Route::get('getdaptarrekonplnvsbank', function (Request $request) {
    if ($request->ajax()) {
        $blthlaporan      = $request->input('vblthlaporan');
        $kodebank         = $request->input('vkodebank');
        $kddist           = $request->input('vkddist');
        $kdarea           = $request->input('vkdarea');
        // print_f($blthlaporan . '---' . $kodebank);
        $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'mivrekonplnvsbankuiw',
                [
                    // 'blthlaporan' => '202303'
                    'blthlaporan' => $blthlaporan,
                    'kdbank' => $kodebank,
                    'kddist' => $kddist,
                    'kdarea' => $kdarea
                ]
            )->json();
        // return $MstDistData['data'];
        // return DataTables::of($MstDistData['data'])->make(true);
        // dd($MyData);

        return $MyData;
    }
})->name('monlap.daptarrekonplnvsbank');


// ---------------------------------------------------------------
//3a Data Belum Lunas Bank
Route::get('/RekapLunasPerDist', function () {
    return view('mivmonlap/vRekapLunasPerDist', [
        'title' => 'Rekap/Daftar Lunas Per-Distribusi/Wilayah'
    ]);
});

// ---------------------------------------------------------------
//4a Status data pelanggan SAKTI KEU. RI
Route::get('/RekapStatusSakti', function () {
    return view('mivmonlap/vRekapStatusSakti', [
        'menuname' => 'MIV - Monitoring/Laporan',
        'title' => 'Rekap/Daftar Status Pelanggan Sakti'
    ]);
});

//4b ambil API data status sakti
Route::get('getrekapstatussakti', function (Request $request) {
    if ($request->ajax()) {
        $blthlaporan      = $request->input('vblthlaporan');
        $kodebank         = $request->input('vkodebank');
        // print_f($blthlaporan . '---' . $kodebank);
        $MyData = http::withToken($request->Session()->get('_datalogin.data.token'))
            ->post(
                config('myconfig.variable.SVR_URL_API') . 'saktistatus',
                [
                    // 'blthlaporan' => '202303'
                    'blthlaporan' => $blthlaporan
                ]
            )->json();
        // return $MstDistData['data'];
        // return DataTables::of($MstDistData['data'])->make(true);
        // dd($MyData);

        return $MyData;
    }
})->name('monlap.rekapstatussakti');

//5a Report Cetak/download pdf struk MIV
Route::get('/RepCetakStrukMIV', function () {
    return view('mivmonlap/vRepCetakStrukLunasMiv', [
        'menuname' => 'MIV - Download/Cetak Struk PerArea',
        'title' => 'Download/Cetak Struk PerArea'
    ]);
});

//5b baca list file yang ada fi ftp
Route::get('/list-ftp-files', function () {
    // Mendapatkan daftar semua direktori pada disk FTP
    // $directories = Storage::disk('ftp')->allDirectories('/vertikal');
    $directories = [
        '/vertikal/2000001/200CA01/POSTPAID/lunas/struk',
        '/vertikal/2000001/200CA01/NTLS/lunas/struk',
        '/vertikal/2000001/200CA01/PREPAID/lunas/struk',
    ];
    $mydatafile = [];
    foreach ($directories as $directory) {
        $files = Storage::disk('ftp')->allFiles($directory);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
                $mydatafile[] = [
                    'path' => $directory,
                    'file' => pathinfo($file, PATHINFO_BASENAME),
                    'status' => 'Sukses Koneksi FTP'
                ];
                $kdstatus = '200';
            }
        }
    }
    $mydata = [
        'status' =>  $kdstatus,
        'message' => $msg ?? "Files Sukses di Tampilkan !",
        'downloaded_files' => $mydatafile,
    ];
    return json_encode($mydata);
    // return json_encode($mydatafile);
})->name('monlap.daftar-file-ftp');

//5c download file lebih dari 1 atau 1 struk pdf
Route::get('/download-struk-pdf', function (Request $request) {

    // Replace 'your_remote_files' with an array of remote file paths you want to download
    $blthlaporan      = $request->input('vblthlaporan');
    $kodebank         = $request->input('vkodebank');
    $namafile = $request->input('vnamafile');
    $filedataArray = explode(", ", $namafile);

    // Define the local directory where you want to save the downloaded files
    $localDirectory = public_path('downloads');

    // // Initialize an empty array to store information about downloaded files
    $downloadedFiles = [];

    // try {
    // Create the local directory if it doesn't exist
    if (!file_exists($localDirectory)) {
        mkdir($localDirectory, 0755, true);
    }

    // Use a foreach loop to download and process each file
    foreach ($filedataArray as $file) {
        try {

            // Menggunakan Storage dengan disk FTP
            $ftpDisk = Storage::disk('ftp');

            $remoteFilePath = $file; // Ganti dengan path file PDF di FTP
            $localFilePath  = 'public/' . $file; // Nama file untuk disimpan di lokal

            if ($ftpDisk->exists($remoteFilePath)) {
                //copy file dari ftp ke local aplikasi storage/app/public
                $content = $ftpDisk->get($remoteFilePath);
                $result = Storage::disk('local')->put($localFilePath, $content);
                if ($result) {
                    $sukses = true;
                    $msg    = 'PDF file copied successfully';
                } else {
                    $sukses = false;
                    $msg    = 'Failed to copy PDF file';
                }

                //tampilkan file dilocal storage/app/public
                $url = Storage::url($localFilePath);
                if (Storage::disk('local')->exists($localFilePath)) {
                    $kdstatus = '200';
                    $downloadedFiles[] = [
                        'success'   =>  $sukses,
                        'localpath' =>  $url,
                        'status'    => 'Sukses',
                        'message'   => $msg
                    ];
                    // return response()->json([
                    //     'success' => $sukses,
                    //     'message' => $msg,
                    //     'localpath' => $url
                    // ], 200);
                } else {
                    $kdstatus = '404';
                    $downloadedFiles[] = [
                        'success'    =>  $sukses,
                        'localpath'  =>  $url,
                        'status'     => 'Sukses',
                        'message'    =>  $msg
                    ];
                    // return response()->json([
                    //     'success'   => $sukses,
                    //     'message'   => $msg,
                    //     'localpath' => $url
                    // ], 404);
                }
            } else {
                $kdstatus = '404';
                $downloadedFiles[] = [
                    'success'     =>  false,
                    'localpath'   =>  '',
                    'status'      => 'Sukses',
                    'message'     => 'File not found'
                ];
                // return response()->json([
                //     'success' => false,
                //     'message' => 'File not found',
                //     'localpath' => ''
                // ], 404);
            }
            // File downloaded successfully
            // $downloadedFiles[] = [
            //     'file' => $file,
            //     'status' => 'sukses',
            //     'message' => 'sukses '
            // ];
            // $kdstatus = '200';
            // $msg = "sukses Baca File ftp";
        } catch (\Exception $e) {
            // Handle the exception if any errors occur during the download
            // $downloadedFiles[] = [
            //     'file' => file($file),
            //     'status' => 'gagal',
            //     'message' => $e->getMessage(),
            // ];
            // $kdstatus = '401';
            // $msg = "Error: " . $e->getMessage();
        }
    }
    // } catch (\Exception $e) {
    //     // Handle any other exceptions related to directory creation or other issues
    //     $kdstatus = '500';
    //     $msg = "Error: " . $e->getMessage();
    // }

    $data = [
        'status' =>  $kdstatus,
        'message' => $msg, // ?? "Files Sukses di downloaded !",
        'downloaded_files' => $downloadedFiles,
    ];

    return response()->json($data);
})->name('monlap.download-struk-pdf');

// ---------------------------------------------------------------
// -- (6) Area USER APLIKASI Menu
// ---------------------------------------------------------------
