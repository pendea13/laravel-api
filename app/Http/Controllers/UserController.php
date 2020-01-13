<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    function __construct()
    {
        $this->middleware('role:Admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = User::All();

        return response()->json($data,200);
    }

    public function delete($id)
    {
        $data = User::find($id)->delete();

        return response()->json($data,200);
    }

    public function view($id)
    {
        $user = User::find($id);
        $roles = $user->roles;
        $permissions = $user->getDirectPermissions();
        return response()->json(['user' => $user,'roles' => $roles,'$permissions' => $permissions],200);
    }

    public function update($id,Request $request) {
        $this->validator($request->all())->validate();
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();
        return response()->json($user, 200);
    }
    public function deleteRole($userId, $roleId)
    {
        $data = User::find($id)->delete();

        return response()->json($data,200);
    }
}
