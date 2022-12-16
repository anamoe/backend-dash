<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    //

    public function index($id)
    {
        $transaksi = DB::table('transaksis')->where('user_id', $id)->get();
        foreach ($transaksi as $v) {
            $v->bukti_transaksi = url('public/bukti_transaksi/' . $v->bukti_transaksi);
        }

        if ($transaksi) {
            return response()->json([
                'pesan' => 'sukses',
                'data' => $transaksi
            ]);
        } else {
            return response()->json([
                'pesan' => 'gagal',
                'data' => []
            ]);
        }
    }
    public function create(Request $request)
    {

        $req = $request->all();
        $extension = $request->file('bukti_transaksi')->getClientOriginalExtension();
        $filenameSimpan = 'bukti_transaksi' . '_' . time() . '.' . $extension;
        $request->file('bukti_transaksi')->move('public/bukti_transaksi', $filenameSimpan);
        $req['user_id'] = 1;

        $req['bukti_transaksi'] = $filenameSimpan;




        $transaksi = Transaksi::create($req);

        if ($transaksi) {
            return response()->json([
                'pesan' => 'sukses',
                'data' => $transaksi
            ]);
        } else {
            return response()->json([
                'pesan' => 'gagal',
                'data' => []
            ]);
        }
    }

    public function show($id)
    {


        $transaksi = DB::table('transaksis')->where('id', $id)->first();

        if ($transaksi) {
            return response()->json([
                'pesan' => 'sukses',
                'data' => $transaksi
            ]);
        } else {
            return response()->json([
                'pesan' => 'gagal',
                'data' => []
            ]);
        }
    }

    public function update($id, Request $request)
    {


        $transaksi = DB::table('transaksis')->where('id', $id)->first();

        if ($transaksi) {


            if ($request->hasFile('bukti_transaksi')) {

                $extension = $request->file('bukti_transaksi')->getClientOriginalExtension();
                $filenameSimpan = 'bukti_transaksi' . '_' . time() . '.' . $extension;
                $request->file('bukti_transaksi')->move('public/bukti_transaksi', $filenameSimpan);

                $transaksi->update([
                    'transaksi' => $request->transaksi,
                    'biaya' => $request->biaya,
                    'keperluan' => $request->keperluan,
                    'bukti_transaksi'=>$filenameSimpan,
                ]);
            } else {

                $transaksi->update([
                    'transaksi' => $request->transaksi,
                    'biaya' => $request->biaya,
                    'keperluan' => $request->keperluan
                ]);
            }

            return response()->json([
                'pesan' => 'sukses',
                'data' => $transaksi
            ]);
        } else {
            return response()->json([
                'pesan' => 'gagal',
                'data' => []
            ]);
        }
    }
}
