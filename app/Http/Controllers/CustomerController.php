<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;


class CustomerController extends Controller
{
     public function index()
    {
        $cust = Customer::get();

        return response()->json([
            'status' => true,
            'message' => "Sukses Menampilkan semua data Customer",
            'results' => $cust
        ]);
    }

     public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);
        try {
            $cust = new Customer;
            $cust->nama = $request->nama;
            $cust->alamat = $request->alamat;
            $cust->no_telp = $request->no_telp;
            $cust->save();
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Gagal Simpan Customer",
                'error' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'status' => true,
            'message' => "Berhasil Simpan Customer",
             'results' => $cust,
        ], 200);
    }

    public function show($id)
    {
          if (Customer::where('id', $id)->exists())
          {
            $cust = Customer::where('id', $id)->get();
            return response()->json([
                'status' => true,
                'result' => $cust
            ]);
        } else {

              return response()->json([
                'message' => "Data Customer Tidak ditemukan",
             ]);
        }
    }

    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
           ]);
        try {
            $cust = Customer::findOrFail($id);
            $cust->nama = $request->nama;
            $cust->alamat = $request->alamat;
            $cust->no_telp = $request->no_telp;
            $cust->update();

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Gagal Update Customer",
                'error' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'status' => true,
            'message' => "Berhasil Update Customer",
            'results' => $cust,
        ], 200);
    }

    public function destroy($id)
    {

         if (Customer::where('id', $id)->exists())
          {
            $cust = Customer::where('id', $id)->findOrFail($id);
                 return response()->json([
            'status' => true,
            'message' => "Berhasil Delete Customer",
        ], 200);

        } else {
              return response()->json([
                'message' => "Data Customer Tidak ditemukan",
             ]);
        }

    }
}
