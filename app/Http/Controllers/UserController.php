<?php

namespace App\Http\Controllers;

use App\Services\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use \Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index()
    {
        return view('pages.Administrator.User.index');
    }

    public function create()
    {
        return view('pages.Administrator.User.create');
    }

    public function store()
    {

    }

    public function edit($id)
    {
        return view('pages.Administrator.User.edit');
    }

    public function update(Request $request, $id)
    {

    }

    public function delete($id)
    {
        return redirect('/admin');
    }

    public function fnGetData(Request $request)
    {
        $gateway = new Gateway();

        $page = $request->input('start') / $request->input('length') + 1;
        $data = $gateway->get('/api/cms/manage/user', [
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
            ->addColumn('avatar', function ($data) {
                return '<img src="'. $data->avatar .'" class="img-circle" alt="User Image" style="width:50px">';
            })
            ->addColumn('action', function ($data) {
                $btn = '<a class="btn btn-default" href="admin/' . $data->userId . '">Edit</a>';
                $btn .= ' <button class="btn btn-danger btn-xs btnDelete" style="padding: 5px 6px;" onclick="fnDelete(this,' . $data->userId . ')">Delete</button>';
                return $btn;
            })
            ->rawColumns(['avatar', 'action'])
            ->make(true);
    }
}


