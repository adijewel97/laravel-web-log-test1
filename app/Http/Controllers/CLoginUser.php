<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Validator;

class CLoginUser extends Controller
{
    //
    function actionlogin(Request $request)
    {
        $email      = $request->input('email');
        $password   = $request->input('password');

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required', // Tambahkan validasi untuk password
        ], [
            'required' => 'Data :attribute harus diisi.',
        ]);

        // Memeriksa apakah validasi gagal
        if ($validator->fails()) {
            // return redirect()->back()
            //     ->withErrors($validator)  // Mengirim pesan error ke halaman sebelumnya
            //     ->withInput();           // Mengembalikan input yang sudah diisi sebelumnya
            $firstErrors = $validator->errors()->first(); // Mengambil pesan kesalahan pertama untuk setiap kunci
            // dd($firstErrors);
            return redirect()->back()->with('err_msg', $firstErrors)->withInput();
        } else {
            // dd(config('myconfig.variable.SVR_URL_API') . 'login');
            $LoginUserAction = http::post(
                config('myconfig.variable.SVR_URL_API') . 'login',
                [
                    'username' => $email,
                    'password' => $password,
                ]
            )->json();

            // dd($LoginUserAction);
            // dd($request->session()->all());
            // dd($LoginUserAction);

            if (!empty($LoginUserAction)) {
                // dd('1');
                // $request->session()->regenerate();
                // dd($request->session()->get('_datalogin.kode'));
                if (($request->session()->exists('_datalogin')) && ($request->session()->get('_datalogin.kode') == 200)) {
                    // dd('1.1');
                    $request->session()->put('_datalogin', $LoginUserAction);
                    if ($LoginUserAction['kode'] == 200) {
                        // dd('1.2.1');
                        // Panggil lis menu role user
                        $msg        = $LoginUserAction['message'];
                        $UserToken  = $request->Session()->get('_datalogin.data.token');

                        // panggil daftar list menu dari API
                        $UserListMenu = http::withToken($UserToken)
                            ->post(
                                config('myconfig.variable.SVR_URL_API') . 'getlistmenu',
                                [
                                    'emiluser' => $request->Session()->get('_datalogin.data.user.email')
                                ]
                            )->json();

                        // dd($UserListMenu);
                        // dd($UserListMenu['kode']);
                        // dd($UserListMenu['message']);

                        //jika lismenu api sukses dapat data
                        if ($UserListMenu['kode'] == '200') {
                            // dd('3.2.1.a');
                            //buat session untuk listmenu
                            $request->session()->put('UserListMenu', $UserListMenu['data']);
                            return view('dashboards/vDashboardPerDist', ['title' => 'Home', 'message' => $msg]);
                        } else {
                            // dd('3.2.1.b');
                            // Lismenu tidak terbaca
                            session()->flush();
                            return redirect()->back()->with('err_msg', $UserListMenu['message']);
                        }
                    } else {
                        // dd('1.2.2');
                        $msg = $LoginUserAction['message'];
                        return redirect()->back()->with('err_msg', $msg);
                    }
                } else {
                    // dd('1.2');
                    // return redirect()->back()->with('err_msg', '3.2');
                    $request->session()->regenerate();
                    $request->session()->put('_datalogin', $LoginUserAction);
                    // dd($LoginUserAction);
                    if ($LoginUserAction['kode'] == 200) {
                        // dd('1.2.1');
                        // Panggil lis menu role user
                        $msg        = $LoginUserAction['message'];
                        $UserToken  = $request->Session()->get('_datalogin.data.token');

                        // panggil daftar list menu dari API
                        $UserListMenu = http::withToken($UserToken)
                            ->post(
                                config('myconfig.variable.SVR_URL_API') . 'getlistmenu',
                                [
                                    'emiluser' => $request->Session()->get('_datalogin.data.user.email')
                                ]
                            )->json();

                        // dd($UserListMenu);
                        // dd($UserListMenu['kode']);
                        // dd($UserListMenu['message']);

                        //jika lismenu api sukses dapat data
                        if ($UserListMenu['kode'] == '200') {
                            // dd('3.2.1.a');
                            //buat session untuk listmenu
                            $request->session()->put('UserListMenu', $UserListMenu['data']);
                            return view('dashboards/vDashboardPerDist', ['title' => 'Home', 'message' => $msg]);
                        } else {
                            // dd('3.2.1.b');
                            // Lismenu tidak terbaca
                            session()->flush();
                            return redirect()->back()->with('err_msg', $UserListMenu['message']);
                        }
                    } else {
                        // dd('1.2.2');
                        $msg = $LoginUserAction['message'];
                        return redirect()->back()->with('err_msg', $msg);
                    }
                }
            } else {
                // dd('2');
                $msg = 'Error Data login User';
                return redirect()->back()->with('err_msg', $msg);
            }
        }

        // $email      = $request->input('email');
        // $password   = $request->input('password');

        // // Lakukan permintaan HTTP hanya jika validasi berhasil
        // $LoginUserAction = http::post(
        //     config('myconfig.variable.SVR_URL_API') . 'login',
        //     [
        //         'username' => $email,
        //         'password' => $password,
        //     ]
        // )->json();

        // // Memeriksa apakah respons dari API kosong atau tidak
        // if (!empty($LoginUserAction)) {
        //     return redirect()->back()->with('err_msg', '1');
        // } else {
        //     return redirect()->back()->with('err_msg', '2');
        // }
    }


    function actionlogout(Request $request)
    {
        try {
            if (is_array($request->session()->exists('_datalogin'))) {
                // dd('1');
                $data = $request->session()->all();
                $dataUser = $data['_datalogin']['data'];
                $LoginUserAction = http::withToken($dataUser['token'])
                    ->post(
                        'http://mivp2apstpln-api2.test/api/mivp2apstpln/logout'
                    )
                    ->json();

                // dd($LoginUserAction);
                $request->session()->invalidate();
                if ($LoginUserAction['kode'] == 200) {
                    $msg = $LoginUserAction['message'];
                    $request->session()->invalidate();
                    return redirect('/');
                } else {
                    $msg = $LoginUserAction['message'];
                    // Alert::error('Error Login', $msg);
                    return back()->with('login error');
                }
            } else {
                // dd('2');
                $request->session()->invalidate();
                $msg = 'Sessen Login Habis, Silahkan Login Ulang.';
                // Alert::error('Error Login', $msg);
                return redirect('/login');
                // return view('layouts/login', ['title' => 'Login', 'message' => $msg]);
            }
        } catch (Exception $e) {
            // dd('3');
            return $e->getMessage();
        }
    }
}
