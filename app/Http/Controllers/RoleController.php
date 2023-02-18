<?php

namespace App\Http\Controllers;

use App\Services\Gateway;
use Illuminate\Http\Request;
use \Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('pages.Administrator.Role.index');
    }

    public function create()
    {
        $gateway = new Gateway();

        $menuItems = $gateway->get('/api/cms/manage/menu-item', [
            'limit' => 999,
        ])->getData()->data->items;

        return view('pages.Administrator.Role.create', compact('menuItems'));
    }

    public function store(request $request)
    {
        // dd($request->all());
        $privileges = $request->get('menu');
        foreach ($privileges as $i => $privilege) {
            // cek data
            $privileges[$i]['view'] = array_key_exists('view', $privilege);
            $privileges[$i]['add'] = array_key_exists('add', $privilege);
            $privileges[$i]['edit'] = array_key_exists('edit', $privilege);
            $privileges[$i]['delete'] = array_key_exists('delete', $privilege);
            $privileges[$i]['other'] = array_key_exists('other', $privilege);
        }

        // $testRequestToApi = [
        //     "name"=> $request->get('name'),
        //     "description" => $request->get('description'),
        //     "privileges" => $privileges
        // ];
        // dd($testRequestToApi)

        $gateway = new Gateway();
        // Hit ke API untuk menambah data
        $storeRole = $gateway->post('/api/cms/manage/role', [
            "name" => $request->get('name'),
            "description" => $request->get('description'),
            "privileges" => $privileges,
        ])->getData();
        // dd($storeRole);
        // cek balikan api
        if (!$storeRole->success) {
            // // kalo gagal
            // dd($storeRole);

            return redirect()->route('index.role')->with(['error', $storeRole->message]);
        }
        // kalo sukses
        return redirect()->route('index.role');
    }

    public function edit($id)
    {
        $gateway = new Gateway();
        $role = $gateway->get('/api/cms/manage/role/' . $id)->getData();
        if (!$role->success) {
            return redirect()->route('index.role');
        }

        $menuItems = $gateway->get('/api/cms/manage/menu-item', [
            'limit' => 999,
        ])->getData()->data->items;
        // dd($role);
        $role = $role->data;
        $rolePrivilege = collect($role->privileges);

        foreach ($menuItems as $i => $menuItem) {
            $privilege = $rolePrivilege->where('menuItemId', $menuItem->menuItemId)->first();

            if (!$privilege) {
                $menuItems[$i]->roleId = $id;
                $menuItems[$i]->privilegeId = "";
                $menuItems[$i]->view = false;
                $menuItems[$i]->add = false;
                $menuItems[$i]->edit = false;
                $menuItems[$i]->delete = false;
                $menuItems[$i]->other = false;
            } else {
                $menuItems[$i]->roleId = $id;
                $menuItems[$i]->privilegeId = $privilege->privilegeId;
                $menuItems[$i]->view = (bool) $privilege->view;
                $menuItems[$i]->add = (bool) $privilege->add;
                $menuItems[$i]->edit = (bool) $privilege->edit;
                $menuItems[$i]->delete = (bool) $privilege->delete;
                $menuItems[$i]->other = (bool) $privilege->other;
            }

        }
        return view('pages.Administrator.Role.edit', compact('menuItems', 'role'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // dd($id);
        $privileges = $request->get('privileges');
        foreach ($privileges as $i => $privilege) {
            // cek data
            $privileges[$i]['view'] = array_key_exists('view', $privilege) ? $privilege['view'] : '0';
            $privileges[$i]['add'] = array_key_exists('add', $privilege) ? $privilege['add'] : '0';
            $privileges[$i]['edit'] = array_key_exists('edit', $privilege) ? $privilege['edit'] : '0';
            $privileges[$i]['delete'] = array_key_exists('delete', $privilege) ? $privilege['delete'] : '0';
            $privileges[$i]['other'] = array_key_exists('other', $privilege) ? $privilege['other'] : '0';
        }
        $testRequestToApi = [
            "name" => $request->get('name'),
            "description" => $request->get('description'),
            "privileges" => $privileges,
        ];
        // dd($testRequestToApi);
        $gateway = new Gateway();
        // Hit ke API untuk update data
        // dd($testRequestToApi);
        $updateRole = $gateway->put('/api/cms/manage/role/' . $id, $testRequestToApi)->getData();
        dd($updateRole);
        // cek balikan api
        if (!$updateRole->success) {
            // kalo gagal
            // dd($updateRole);

            return redirect()->route('index.role')->with(['error', $updateRole->message]);
        }
        // kalo sukses
        return redirect()->route('index.role');
    }

    public function delete($id)
    {
        $gateway = new Gateway();

        $deleteRole = $gateway->delete('/api/cms/manage/role/' . $id);
        if (!$deleteRole->getData()->success) {
            return redirect('/role')->with('error', $deleteRole->getData()->message);
        }
        return redirect('/role')->with('success', 'Role Berhasil Di Delete');
    }

    public function fnGetData(Request $request)
    {
        $gateway = new Gateway();

        $page = $request->input('start') / $request->input('length') + 1;
        $data = $gateway->get('/api/cms/manage/role', [
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
            ->addColumn('action', function ($data) {
                $btn = '<a class="btn btn-default" href="role/' . $data->roleId . '">Edit</a>';
                $btn .= ' <button class="btn btn-danger btn-xs btnDelete" style="padding: 5px 6px;" onclick="fnDelete(this,' . $data->roleId . ')">Delete</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
