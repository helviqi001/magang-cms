<?php

namespace App\Http\Controllers;

use App\Services\Gateway;
use Illuminate\Http\Request;
use \Yajra\DataTables\DataTables;

class KulinerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.Administrator.Kuliner.index');
    }

    public function create(Request $request)
    {
        // dd($request);
        $gateway = new Gateway();
        $data = $gateway->get('/api/cms/kuliner', [
            'page' => 1,
            'per_page' => 999,
            'limit' => 999,
        ])->getData()->data;
        return view('pages.Administrator.Kuliner.create')->with('kuliner', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name_kuliner' => 'required|min:5|max:20',
            'deskripsi' => 'required',
            'harga_reguler' => 'required',
            'harga_jumbo' => 'required',
            'operasional' => 'required',
            'lokasi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'gambar_kuliner' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // $path = $request->file('gambar_kuliner')->store('public/images');
        $file = $request->file('gambar_kuliner');
        //mengambil nama file
        $nama_file = asset('img/kuliner') . '/' . $file->getClientOriginalName();

        //memindahkan file ke folder tujuan
        $file->move('img/kuliner', $file->getClientOriginalName());
        // dd($request);
        $gateway = new Gateway();
        // dd($gateway);
        $storekuliner = $gateway->post('api/cms/kuliner', [
            "name_kuliner" => $request->get('name_kuliner'),
            "deskripsi" => $request->get('deskripsi'),
            "harga_reguler" => $request->get('harga_reguler'),
            "harga_jumbo" => $request->get('harga_jumbo'),
            "operasional" => $request->get('operasional'),
            "lokasi" => $request->get('lokasi'),
            "latitude" => $request->get('latitude'),
            "longitude" => $request->get('longitude'),
            "gambar_kuliner" => $nama_file,
        ])->getData();

        return redirect('/kuliner')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function edit($id)
    {
        $gateway = new Gateway();
        $kuliner = $gateway->get('api/cms/kuliner/' . $id)->getData()->data;
        return view('pages.Administrator.Kuliner.edit', compact('kuliner'));

    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $nama_file = '';
        if ($request->file('gambar_kuliner')) {
            $file = $request->file('gambar_kuliner');
            //mengambil nama file
            $nama_file = asset('img/kuliner') . '/' . $file->getClientOriginalName();

            //memindahkan file ke folder tujuan
            $file->move('img/kuliner', $file->getClientOriginalName());
        }
        $gateway = new Gateway();
        $storeKuliner = $gateway->put('api/cms/kuliner/' . $id, [
            "name_kuliner" => $request->get('name_kuliner'),
            "deskripsi" => $request->get('deskripsi'),
            "harga_reguler" => $request->get('harga_reguler'),
            "harga_jumbo" => $request->get('harga_jumbo'),
            "operasional" => $request->get('operasional'),
            "lokasi" => $request->get('lokasi'),
            "latitude" => $request->get('latitude'),
            "longitude" => $request->get('longitude'),
            "gambar_kuliner" => $nama_file,
        ])->getData();
        dd($storeKuliner);
        return redirect('/kuliner')->with('success', 'Data Berhasil Di Tambahkan');
        // if ($storeKuliner->success) {
        //     return redirect('/kuliner')->with('success', 'Data Berhasil Di Tambahkan');
        // } else {
        //     return redirect('/kuliner')->with('error', 'Data gagal di tambahkan');
        // }
    }

    public function delete($id)
    {
        $gateway = new Gateway();

        $deleteKuliner = $gateway->delete('api/cms/kuliner/' . $id);
        return redirect('/kuliner')->with('success', 'Kuliner Deleted');
    }

    public function fnGetData(Request $request)
    {
        $gateway = new Gateway();

        $page = $request->input('start') / $request->input('length') + 1;
        $data = $gateway->get('/api/cms/kuliner', [
            'page' => $page,
            'per_page' => $request->input('length'),
            'limit' => $request->input('length'),
            'keyword' => $request->input('search')['value'],
            'sort_by' => $request->input('columns')[$request->input('order')[0]['column']]['name'],
            'sort' => $request->input('order')[0]['dir'],
        ])->getData()->data;

        return DataTables::of($data->items)
            ->skipPaging()
            ->setTotalRecords($data->total)
            ->setFilteredRecords($data->total)
            ->addColumn('gambarkuliner', function ($data) {
                return '<img src="' . $data->gambar_kuliner . '" class="img-circle" alt="User Image" style="width:50px">';
            })
            ->addColumn('action', function ($data) {
                $btn = '<a class="btn btn-default" href="kuliner/' . $data->kuliner_id . '">Edit</a>';
                $btn .= ' <button class="btn btn-danger btn-xs btnDelete" style="padding: 5px 6px;" onclick="fnDelete(this,' . $data->kuliner_id . ')">Delete</button>';
                return $btn;
            })
            ->rawColumns(['gambarkuliner', 'action'])
            ->make(true);
    }

}
