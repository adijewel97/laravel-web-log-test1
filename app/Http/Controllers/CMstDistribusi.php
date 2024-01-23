<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CMstDistribusi extends Controller
{
    //
    function GetApiMstDistribusi()
    {
        // $MstDistData = http::get('http://mivp2apstpln-api-v2.test/api/mivp2apstpln/getmstdistribusi');
        $MstDistData = http::get(config('myconfig.variable.SVR_URL_API') . 'getmstdistribusi');
        return view('vhome', ['title' => 'Home']);
    }

    function GetApiMstAp(Request $request)
    {
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
    }

    // function ShowApiMstDistribusi()
    // {
    //     return view('vhomedatatable');
    // }
}
