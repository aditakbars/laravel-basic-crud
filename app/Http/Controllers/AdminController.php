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

    public function showIce(Request $request)
    {
        $searchTerm = $request->input('search');
    
        // Query data admin dengan filter berdasarkan nama jika search term ada
        if ($searchTerm) {
            $datas = DB::select('SELECT * FROM `es_krim`  WHERE merk LIKE ? OR rasa LIKE ?', ['%' . $searchTerm . '%', '%' . $searchTerm . '%']);
        } else {
            // Jika tidak ada search term, tampilkan semua data admin
            $datas = DB::select('SELECT * FROM `es_krim`');
        }
    
        return view('admin.ice_cream')->with('datas', $datas)->with('searchTerm', $searchTerm);
    }

    public function showSup(Request $request)
    {
        $searchTerm = $request->input('search');
    
        // Query data admin dengan filter berdasarkan nama jika search term ada
        if ($searchTerm) {
            $datas = DB::select('SELECT * FROM `supplier`  WHERE nama_supplier LIKE ?', ['%' . $searchTerm . '%']);
        } else {
            // Jika tidak ada search term, tampilkan semua data admin
            $datas = DB::select('SELECT * FROM `supplier`');
        }

        return view('admin.supplier')->with('datas', $datas)->with('searchTerm', $searchTerm);
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

    public function createSup()
    {
        $datas = DB::select('SELECT * FROM supplier');
        return view('admin.add_sup')->with('datas',$datas);
    }
    // public function store the value to a table
    public function storeSup(Request $request)
    {
        $request->validate([
            'id_supplier' => 'required',
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'established' => 'required',
        ]);
        DB::insert(
            'INSERT INTO supplier(id_supplier, nama_supplier, alamat_supplier, no_telepon, established) VALUES (:id_supplier, :nama_supplier, :alamat_supplier, :no_telepon, :established)',
            [
                'id_supplier' => $request->id_supplier,
                'nama_supplier' => $request->nama_supplier,
                'alamat_supplier' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'established' => $request->established,
            ]
        );
        return redirect()->route('admin.showSup')->with('success', 'Data Supplier berhasil disimpan');
    }

    // public function edit a row from a table
    public function edit($id)
    {
        $data = DB::table('es_krim')->where('id_es_krim', $id)->first();
        $datas = DB::select('SELECT * FROM es_krim');
        $datasups = DB::select('SELECT * FROM supplier');
        return view('admin.edit')->with('data', $data)->with('datas', $datas)->with('datasups', $datasups);
    }

    // public function to update the table value
    public function update($id, Request $request)
    {
        $request->validate([
            'merk_eskrim' => 'required',
            'rasa' => 'required',
            'harga' => 'required',
            'id_supplier' => 'required',
        ]);

        DB::update(
            'UPDATE es_krim SET merk = :merk_eskrim, rasa = :rasa, harga = :harga, id_supplier = :id_supplier WHERE id_es_krim = :id',
            [
                'id' => $id,
                'merk_eskrim' => $request->merk_eskrim,
                'rasa' => $request->rasa,
                'harga' => $request->harga,
                'id_supplier' => $request->id_supplier,
            ]
        );

        return redirect()->route('admin.index')->with('success', 'Data Es Krim berhasil diubah');
    }

    public function editSup($id)
    {
        $data = DB::table('supplier')->where('id_supplier', $id)->first();
        $datas = DB::select('SELECT * FROM supplier');
        return view('admin.edit_sup')->with('data', $data)->with('datas', $datas);
    }

    // public function to update the table value
    public function updateSup($id, Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'alamat_supplier' => 'required',
            'no_telepon' => 'required',
            'established' => 'required',
        ]);

        // dd($request->all());

        DB::update(
            'UPDATE supplier SET nama_supplier = :nama_supplier, alamat_supplier = :alamat_supplier, no_telepon = :no_telepon, established = :established WHERE id_supplier = :id',
            [
                'id' => $id,
                'nama_supplier' => $request->nama_supplier,
                'alamat_supplier' => $request->alamat_supplier,
                'no_telepon' => $request->no_telepon,
                'established' => $request->established,
            ]
        );

        return redirect()->route('admin.showSup')->with('success', 'Data Supplier berhasil diubah');
    }

    // public function to delete a row from a table
    public function delete($id)
    {
        //$merk = DB::select('SELECT merk FROM es_krim WHERE id_es_krim = :id_es_krim', ['id_es_krim' => $id]);
        DB::delete('DELETE FROM es_krim WHERE id_es_krim = :id_es_krim', ['id_es_krim' => $id]);
        DB::update('ALTER TABLE es_krim DROP id_es_krim');
        DB::update('ALTER TABLE es_krim ADD id_es_krim INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
        return redirect()->route('admin.index')->with('success', 'Data Es Krim berhasil dihapus');
    }

    public function deleteSup($id)
    {
        DB::delete('DELETE FROM supplier WHERE id_supplier = :id_supplier', ['id_supplier' => $id]);
        return redirect()->route('admin.showSup')->with('success', 'Data Supplier berhasil dihapus');
    }
}
