<?php

namespace App\Http\Controllers;

use App\Services\Gateway;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        $data = $gateway->get('/cms/kuliner', [
            'page' => 1,
            'perPage' => 999,
            'limit' => 999,
        ])->getData();
        return view('pages.Administrator.Kuliner.create')->with('kuliner', $data);
    }

 
    public function store(Request $request)
    {
    //    dd($request->all());
    $this->validate($request,[
        'name_kuliner' => 'required|min:5|max:20',
        'deskripsi' => 'required',
        'harga_reguler' => 'required',
        'harga_jumbo' => 'required',
        'operasional' => 'required',
        'lokasi' => 'required',
        'gambar_kuliner' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ]);

    // $path =$request->file('avatar')->store('public/images');
    $file           = $request->file('gambar_kuliner');
    //mengambil nama file
    $nama_file      = asset('img/kuliner').'/'.$file->getClientOriginalName();
    
    //memindahkan file ke folder tujuan
    $file->move('img/kuliner',$file->getClientOriginalName());
    

    $gateway = new Gateway();
    $storeKuliner = $gateway->post('/cms/kuliner' ,[
        "name"=> $request->get('name'),
        "description"=>$request->get('description'),
        "harga_reguler"=>$request->get('harga_reguler'),
        "harga_jumbo"=>$request->get('harga_jumbo'),
        "operasional"=>$request->get('operasional'),
        "lokasi"=>$request->get('lokasi'),
        "gambar_kuliner"=> $nama_file,
    ])->getData();
    return redirect('/kuliner')->with('success','Data Berhasil Di Tambahkan');
    }

  
    public function edit($id)
    {
        $gateway = new Gateway();
        $kuliner = $gateway->get('/cms/manage/kuliner/'. $id)->getData()->data;
        return view('pages.Administrator.Kuliner.edit', compact('kuliner'));

    }


    public function update(Request $request, $id)
    {
        $nama_file = '';
        if ($request->file('gambar_kuliner')) {
            $file           = $request->file('gambar_kuliner');
            //mengambil nama file
            $nama_file      = asset('img/kuliner').'/'.$file->getClientOriginalName();
            
            //memindahkan file ke folder tujuan
            $file->move('img/kuliner',$file->getClientOriginalName());
        }
        $gateway = new Gateway();
        $storeKuliner = $gateway->put('/cms/kuliner'.$id ,[
            "name"=> $request->get('name'),
            "description"=>$request->get('description'),
            "harga_reguler"=>$request->get('harga_reguler'),
            "harga_jumbo"=>$request->get('harga_jumbo'),
            "operasional"=>$request->get('operasional'),
            "lokasi"=>$request->get('lokasi'),
            "gambar_kuliner"=> $nama_file,
        ])->getData();

        if ($storeKuliner->success) {
            return redirect('/kuliner')->with('success','Data Berhasil Di Tambahkan');
        } else {
            return redirect('/kuliner')->with('error','Data gagal di tambahkan');
        }
    }

    public function delete($id)
    {
        $gateway = new Gateway();

        $deleteKuliner = $gateway->delete('/cms/manage/kuliner/' . $id);
        return redirect('/kuliner')->with('success', 'Kuliner Deleted');
    }

    public function fnGetData(Request $request)
    {
        $gateway = new Gateway();
    
        $page = $request->input('start') / $request->input('length') + 1;
        $data = $gateway->get('/cms/kuliner', [
            'page' => $page,
            'perPage' => $request->input('length'),
            'limit' => $request->input('length'),
            'keyword' => $request->input('search')['value'],
            'sortBy' => $request->input('columns')[$request->input('order')[0]['column']]['name'],
            'sort' => $request->input('order')[0]['dir']
        ])->getData()->data;

        return DataTables::of($data->items)
            ->skipPaging()
            ->setTotalRecords($data->total)
            ->setFilteredRecords($data->total)
            ->addColumn('gambarkuliner', function ($data) {
                return '<img src="'. $data->gambarkuliner .'" class="img-circle" alt="User Image" style="width:50px">';
            })
            ->addColumn('action', function ($data) {
                $btn = '<a class="btn btn-default" href="kuliner/' . $data->kulinerId . '">Edit</a>';
                $btn .= ' <button class="btn btn-danger btn-xs btnDelete" style="padding: 5px 6px;" onclick="fnDelete(this,' . $data->kulinerId . ')">Delete</button>';
                return $btn;
            })
            ->rawColumns(['gambarkuliner', 'action'])
            ->make(true);
    }

}
