<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolesController extends Controller
{
    function __construct()
    {
        $this->middleware('role:Admin');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function permissions(Request $request)
    {
        $data = Permission::All();

        return response()->json($data,200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function roles(Request $request)
    {
        $data = Role::All();

        return response()->json($data,200);
    }

    /**
     * @param $roleId
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addRole($roleId, $userId)
    {
        $user = User::find($userId);
        $role = Role::find($roleId);
        $user->assignRole($role);

        return response()->json($user,200);
    }

    /**
     * @param $permissionId
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPermission($permissionId, $userId)
    {
        $user = User::find($userId);
        $permission = Permission::find($permissionId);
        $user->givePermissionTo($permission);

        return response()->json($user,200);
    }
}
