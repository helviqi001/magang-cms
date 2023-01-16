<?php

namespace App\Http\Controllers;

use App\Services\Gateway;
use Illuminate\Http\Request;
use \Yajra\DataTables\DataTables;

class WisataController extends Controller
{

    public function index()
    {
        return view('pages.Administrator.Wisata.index');
    }
    public function create(Request $request)
    {
        // dd($request);
        $gateway = new Gateway();
        $data = $gateway->get('api/cms/wisata/', [
            'page' => 1,
            'perPage' => 999,
            'limit' => 999,
        ])->getData();
        return view('pages.Administrator.Wisata.create')->with('wisata', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name_wisata' => 'required|min:5|max:30',
            'deskripsi' => 'required',
            'harga_dewasa' => 'required',
            'harga_anak' => 'required',
            'fasilitas' => 'required',
            'operasional' => 'required',
            'lokasi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'gambar_wisata' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // $path =$request->file('avatar')->store('public/images');
        $file = $request->file('gambar_wisata');
        //mengambil nama file
        $nama_file = asset('img/wisata') . '/' . $file->getClientOriginalName();

        //memindahkan file ke folder tujuan
        $file->move('img/wisata', $file->getClientOriginalName());
        // $user = new User;
        // $user->save();

        $gateway = new Gateway();
        $storeWisata = $gateway->post('api/cms/wisata', [
            "name_wisata" => $request->get('name_wisata'),
            "deskripsi" => $request->get('deskripsi'),
            "harga_dewasa" => $request->get('harga_dewasa'),
            "harga_anak" => $request->get('harga_anak'),
            "fasilitas" => $request->get('fasilitas'),
            "operasional" => $request->get('operasional'),
            "lokasi" => $request->get('lokasi'),
            "latitude" => $request->get('latitude'),
            "longitude" => $request->get('longitude'),
            "gambar_wisata" => $nama_file,
        ])->getData();
        return redirect('/wisata')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function edit($id)
    {
        $gateway = new Gateway();
        $wisata = $gateway->get('api/cms/wisata/' . $id)->getData()->data;
        return view('pages.Administrator.Wisata.edit', compact('wisata'));
    }

    public function update(Request $request, $id)
    {
        $nama_file = '';
        if ($request->file('gambar_wisata')) {
            $file = $request->file('gambar_wisata');
            //mengambil nama file
            $nama_file = asset('img/wisata') . '/' . $file->getClientOriginalName();

            //memindahkan file ke folder tujuan
            $file->move('img/wisata', $file->getClientOriginalName());
        }
        $gateway = new Gateway();
        $storeWisata = $gateway->post('api/cms/wisata/' . $id, [
            "name_wisata" => $request->get('name_wisata'),
            "deskripsi" => $request->get('deskripsi'),
            "harga_dewasa" => $request->get('harga_dewasa'),
            "harga_anak" => $request->get('harga_anak'),
            "fasilitas" => $request->get('fasilitas'),
            "operasional" => $request->get('operasional'),
            "lokasi" => $request->get('lokasi'),
            "latitude" => $request->get('latitude'),
            "longitude" => $request->get('longitude'),
            "gambar_wisata" => $nama_file,
        ])->getData();
        dd($storeWisata);
        return redirect('/wisata')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function delete($id)
    {
        $gateway = new Gateway();

        $deleteWisata = $gateway->delete('api/cms/wisata/' . $id);
        return redirect('/wisata')->with('success', 'wisata Deleted');
    }

    public function fnGetData(Request $request)
    {
        $gateway = new Gateway();

        $page = $request->input('start') / $request->input('length') + 1;
        $data = $gateway->get('api/cms/wisata', [
            'page' => $page,
            'perPage' => $request->input('length'),
            'limit' => $request->input('length'),
            'keyword' => $request->input('search')['value'],
            'sortBy' => $request->input('columns')[$request->input('order')[0]['column']]['name'],
            'sort' => $request->input('order')[0]['dir'],
        ])->getData()->data;

        return DataTables::of($data)
            ->skipPaging()
            ->setTotalRecords(count($data))
            ->setFilteredRecords(count($data))
            ->addColumn('gambarwisata', function ($data) {
                return '<img src="' . $data->gambar_wisata . '" class="img-circle" alt="User Image" style="width:50px">';
            })
            ->addColumn('action', function ($data) {
                $btn = '<a class="btn btn-default" href="wisata/' . $data->wisata_id . '">Edit</a>';
                $btn .= ' <button class="btn btn-danger btn-xs btnDelete" style="padding: 5px 6px;" onclick="fnDelete(this,' . $data->wisata_id . ')">Delete</button>';
                return $btn;
            })
            ->rawColumns(['gambarwisata', 'action'])
            ->make(true);
    }
}
