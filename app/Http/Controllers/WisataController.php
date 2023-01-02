<?php

namespace App\Http\Controllers;

use App\Services\Gateway;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;
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
         $data = $gateway->get('/cms/manage/wisata', [
             'page' => 1,
             'perPage' => 999,
             'limit' => 999,
         ])->getData();
         return view('pages.Administrator.Wisata.create')->with('wisata', $data);
    }

    
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required|min:5|max:30',
            'description' => 'required',
            'hargadewasa' => 'required',
            'hargaanak' => 'required',
            'fasilitas' => 'required',
            'operasional' => 'required',
            'lokasi' => 'required',
            'gambarwisata' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // $path =$request->file('avatar')->store('public/images');
        $file           = $request->file('gambarwisata');
        //mengambil nama file
        $nama_file      = asset('img/wisata').'/'.$file->getClientOriginalName();
        
        //memindahkan file ke folder tujuan
        $file->move('img/wisata',$file->getClientOriginalName());
        // $user = new User;
        // $user->save();
        

        $gateway = new Gateway();
        $storeRole = $gateway->post('/cms/manage/wisata' ,[
            "name" => $request->get('name'),
            "description" => $request->get('description'),
            "Harga_Dewasa" => $request->get('Harga_Dewasa'),
            "Harga_Anak" => $request->get('Harga_Anak'),
            "Fasilitas" => $request->get('Fasilitas'),
            "Operasional" => $request->get('Operasional'),
            "lokasi" => $request->get('lokasi'),
            "Gambar_Wisata" => $nama_file
        ])->getData();
        return redirect('/wisata')->with('success','Data Berhasil Di Tambahkan');
    }

  
    public function edit($id)
    {
        $gateway = new Gateway();
        $wisata = $gateway->get('/cms/manage/wisata'. $id)->getData()->data;
        return view('pages.Administrator.Wisata.edit', compact('wisata'));
    }

    public function update(Request $request, $id)
    {
        $nama_file = '';
        if ($request->file('gambarkuliner')) {
            $file           = $request->file('gambarkuliner');
            //mengambil nama file
            $nama_file      = asset('img/').'/'.$file->getClientOriginalName();
            
            //memindahkan file ke folder tujuan
            $file->move('img/kuliner',$file->getClientOriginalName());
        }
        $gateway = new Gateway();
        $storeWisata = $gateway->put('cms/manage/wisata'.$id ,[
            'name' => 'required|min:5|max:30',
            'description' => 'required',
            'hargadewasa' => 'required',
            'hargaanak' => 'required',
            'fasilitas' => 'required',
            'operasional' => 'required',
            'lokasi' => 'required',
            'gambarwisata' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ])->getData();

        if ($storeWisata->success) {
            return redirect('/wisata')->with('success','Data Berhasil Di Tambahkan');
        } else {
            return redirect('/wisata')->with('error','Data gagal di tambahkan');
        }
    }

    public function delete($id)
    {
        $gateway = new Gateway();

        $deleteWisata = $gateway->delete('/cms/manage/wisata' . $id);
        return redirect('/wisata')->with('success', 'wisata Deleted');
    }
    
    public function fnGetData(Request $request)
    {
        $gateway = new Gateway();

        $page = $request->input('start') / $request->input('length') + 1;
        $data = $gateway->get('cms/manage/wisata', [
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
            ->addColumn('gambarwisata', function ($data) {
                return '<img src="'. $data->gambarwisata .'" class="img-circle" alt="User Image" style="width:50px">';
            })
            ->addColumn('action', function ($data) {
                $btn = '<a class="btn btn-default" href="wisata/' . $data->wisataId . '">Edit</a>';
                $btn .= ' <button class="btn btn-danger btn-xs btnDelete" style="padding: 5px 6px;" onclick="fnDelete(this,' . $data->wisataId . ')">Delete</button>';
                return $btn;
            })
            ->rawColumns(['gambarwisata', 'action'])
            ->make(true);
    }
}
