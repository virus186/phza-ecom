<?php

namespace App\Http\Controllers\Api\Vendor;

use Exception;
use App\Models\Role;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Resources\ModuleResource;
use App\Http\Resources\UserRoleResource;
use App\Repositories\Role\RoleRepository;
use App\Http\Requests\Validations\CreateRoleRequest;
use App\Http\Requests\Validations\UpdateRoleRequest;

class RoleController extends Controller
{
    //use Authorizable;

    private $model;

    private $role;

    /**
     * construct
     */
    public function __construct(RoleRepository $role)
    {
        parent::__construct();

        $this->model = trans('app.model.role');

        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter');

        if ($filter == 'trash') {
            $roles = $this->role->trashOnly();

            return UserRoleResource::collection($roles);
        }

        $roles = $this->role->all();

        return UserRoleResource::collection($roles);
    }

    /**
     * get permissions with module
     */
    public function module_permissions()
    {
        $modules = Module::active()
            ->with('permissions')
            ->where('access', 'common')
            ->orWhere('access', 'merchant')
            ->orderBy('name', 'asc')->get();

        return ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        try {
            $this->role->store($request);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.role_created_successfully')], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $role_id
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateRoleRequest $request, $role_id)
    public function update(Request $request, $role_id)
    {
        if (config('app.demo') == true && $role_id <= config('system.demo.roles', 3)) {
            return response()->json(['message' => trans('messages.demo_restriction')], 400);
        }

        try {
            $this->role->update($request, $role_id);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.role_updated_successfully')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $role_id
     * @return \Illuminate\Http\Response
     */
    public function show($role_id)
    {
        $role = $this->role->find($role_id);

        return new RoleResource($role);
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $role_id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $role_id)
    {
        if (config('app.demo') == true && $role_id <= config('system.demo.roles', 3)) {
            return response()->json(['message' => trans('messages.demo_restriction')], 400);
        }

        try {
            $this->role->trash($role_id);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.role_trashed_successfully')], 200);
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $role_id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $role_id)
    {
        try {
            $this->role->restore($role_id);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.role_restored_successfully')], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $role_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $role_id)
    {
        try {
            $this->role->destroy($role_id);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.role_deleted_successfully')], 200);
    }
}
