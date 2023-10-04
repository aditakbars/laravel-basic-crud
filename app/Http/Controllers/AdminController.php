<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // public function show all values from a table
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
    
        // Query data admin dengan filter berdasarkan nama jika search term ada
        if ($searchTerm) {
            $datas = DB::select('SELECT e.id_es_krim, e.merk, e.rasa, e.harga, s.nama_supplier, s.established FROM `es_krim` e LEFT JOIN supplier s ON e.id_supplier = s.id_supplier WHERE merk LIKE ? OR rasa LIKE ?', ['%' . $searchTerm . '%', '%' . $searchTerm . '%']);
        } else {
            // Jika tidak ada search term, tampilkan semua data admin
            $datas = DB::select('SELECT e.id_es_krim, e.merk, e.rasa, e.harga, s.nama_supplier, s.established FROM `es_krim` e LEFT JOIN supplier s ON e.id_supplier = s.id_supplier');
        }
    
        return view('admin.index')->with('datas', $datas)->with('searchTerm', $searchTerm);
    }
    //
    public function create()
    {
        $datas = DB::select('SELECT * FROM supplier');
        return view('admin.add')->with('datas',$datas);
    }
    // public function store the value to a table
    public function store(Request $request)
    {
        $request->validate([
            'merk_eskrim' => 'required',
            'rasa' => 'required',
            'harga' => 'required',
            'id_supplier' => 'required',
        ]);
        DB::insert(
            'INSERT INTO es_krim(merk, rasa, harga, id_supplier) VALUES (:merk_eskrim, :rasa, :harga, :id_supplier)',
            [
                'merk_eskrim' => $request->merk_eskrim,
                'rasa' => $request->rasa,
                'harga' => $request->harga,
                'id_supplier' => $request->id_supplier,
            ]
        );
        return redirect()->route('admin.index')->with('success', 'Data Es Krim berhasil disimpan');
    }

    // public function edit a row from a table
    public function edit($id)
    {
        $data = DB::table('es_krim')->where('id_es_krim', $id)->first();
        $datas = DB::select('SELECT * FROM es_krim');
        return view('admin.edit')->with('data', $data)->with('datas', $datas);
    }

    // public function to update the table value
    public function update($id, Request $request)
    {
        $request->validate([
            'merk_eskrim' => 'required',
            'rasa' => 'required',
            'harga' => 'required',
            'supplier' => 'required',
        ]);

        DB::update(
            'UPDATE admin SET id_admin = :id_admin, nama_admin = :nama_admin, alamat = :alamat, username = :username, password = :password WHERE id_admin = :id',
            [
                'id' => $id,
                'id_admin' => $request->id_admin,
                'nama_admin' => $request->nama_admin,
                'alamat' => $request->alamat,
                'username' => $request->username,
                'password' => $request->password,
            ]
        );

        return redirect()->route('admin.index')->with('success', 'Data Es Krim berhasil diubah');
    }

    // public function to delete a row from a table
    public function delete($id)
    {
        DB::delete('DELETE FROM admin WHERE id_es_krim = :id_es_krim', ['id_es_krim' => $id]);
        return redirect()->route('admin.index')->with('success', 'Data Es Krim berhasil dihapus');
    }

    

}
