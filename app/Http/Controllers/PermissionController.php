<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    /**
     * Display listing of the permissions.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created permission in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
       return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }


    // public function apiPermissions(Request $request){
    //     // $permissions = Permission::get();
    //     // return json_encode($permissions);
    //     // $permissions = Permission::get();
    //     // return response()->json([
    //     //     'data' => $permissions
    //     // ]);

    // }


    public function apiPermissions(Request $request)
    {
        $permissions = Permission::query();

        if ($request->has('search') && $request->search['value']) {
            $permissions->where('name', 'like', '%' . $request->search['value'] . '%');
        }

        $totalRecords = $permissions->count();

        if ($request->has('order') && is_array($request->order)) {
            $columnIndex = $request->order[0]['column'];
            $columnName = $request->columns[$columnIndex]['data'];
            $direction = $request->order[0]['dir'];

            $permissions->orderBy($columnName, $direction);
        }
        $perPage = $request->get('length', 10);
        $offset = $request->get('start', 0);
        $permissions = $permissions->skip($offset)->take($perPage)->get();

        return response()->json([
            'draw' => $request->get('draw', 1),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $permissions
        ]);
    }


}
