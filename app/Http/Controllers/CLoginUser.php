<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class CLoginUser extends Controller
{
    //
    function actionlogin(Request $request)
    {
        $email      = $request->input('email');
        $password   = $request->input('password');

        // dd(config('myconfig.variable.SVR_URL_API') . 'login');
        // die();
        $LoginUserAction = http::post(
            config('myconfig.variable.SVR_URL_API') . 'login',
            [
                'username' => $email,
                'password' => $password,
            ]
        )->json();
        // )->body();


        // dd($LoginUserAction);
        // dd($request->session()->all());
        // dd($LoginUserAction);

        if (isset($LoginUserAction)) {
            // Lakukan sesuatu dengan $myArray[$index]
            // dd('1 - ' . $password . ' ' . $password . ' ' . $LoginUserAction);
            if (($request->session()->exists('_datalogin')) && ($request->session()->get('_datalogin.kode') == 200)) {
                // dd('1');
                $request->session()->put('_datalogin', $LoginUserAction);
                $msg = $LoginUserAction['message'];
                return view('dashboards/vDashboardPerDist', ['title' => 'Dashboard', 'message' => $msg]);
            } else {
                // dd('2');
                $request->session()->regenerate();
                $request->session()->put('_datalogin', $LoginUserAction);

                if ($LoginUserAction['kode'] == 200) {
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
                        )
                        ->json();
                    //buat session untuk listmenu
                    $request->session()->put('UserListMenu', $UserListMenu['data']);

                    return view('dashboards/vDashboardPerDist', ['title' => 'Home', 'message' => $msg]);
                } else {
                    $msg = $LoginUserAction['message'];
                    // Alert::error('Error Login', $msg);
                    // return back()->with('login error', $msg);
                    return redirect()->back()->with('err_msg', $msg);
                }
            }
        } else {
            // Handle jika $myArray[$index] adalah null
            // dd('2' . $LoginUserAction);
            $msg = 'Error Data login User';
            return redirect()->back()->with('err_msg', $msg);
        }
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
                        'http://mivp2apstpln-api-v2.test/api/mivp2apstpln/logout'
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
