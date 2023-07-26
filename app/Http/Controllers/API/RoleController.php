<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function all(Request $request)
    {
        $id  = $request->input('id');
        $limit  = $request->input('limit', 10);
        $name  = $request->input('name');

        if($id){
            $role = Roles::find($id);

            if($role){
                return ResponseFormatter::success(
                    $role, 'Data successfully retrieved'
                );
            }
            else{
                return ResponseFormatter::error(
                    null, 'Data not found', 404
                ); 
            }
        }

        $role = Roles::query();

        if($name)
        {
            $role->where('name', 'like', '%' . $name . '%');
        }

        return ResponseFormatter::success(
            $role->paginate($limit),
            'Data list successfully retrieved'
        );
    }
}
