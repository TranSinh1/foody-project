<?php

namespace App\Http\Controllers\Organisations\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Roles\RoleInterface;
use App\Http\Resources\Role as RoleResource;

class RoleController extends Controller
{
    protected $roleName;
    public function __construct(RoleInterface $roleName)
    {
        $this->roleName = $roleName;
    }

    public function index ()
    {
        $roleNames = $this->roleName->getNameRole();

        return RoleResource::collection($roleNames);
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $this->roleName->create($request->all());

        return response()->json([
            'message' => config('role.created')
        ]);
    }

    public function update (Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $role = $this->roleName->find($id);
        if (! $role) {
            return response()->json([
                'message' => config('role.notFound')
            ]);
        }

        $role->update([
            'name' => $request->name
        ]);

        return new RoleResource($role);
    }

    public function destroy ($id)
    {
        $role = $this->roleName->find($id);
        if (! $role) {
            return response()->json([
                'message' => config('role.notFound')
            ]);
        }
        $role->delete();

        return response()->json([
            'message' => config('role.deleted')
        ]);
    }
}
