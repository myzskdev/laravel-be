<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\RoleMenu;
use Illuminate\Http\Request;

class RoleMenuController extends Controller
{
    public function all(Request $request)
    {
        $id  = $request->input('id');
        $limit  = $request->input('limit', 10);
        $role_id  = $request->input('role_id');
        $menu_id  = $request->input('menu_id');

        if($id){
            $role_menu = RoleMenu::find($id);

            if($role_menu){
                return ResponseFormatter::success(
                    $role_menu, 'Data successfully retrieved'
                );
            }
            else{
                return ResponseFormatter::error(
                    null, 'Data not found', 404
                ); 
            }
        }

        $role_menu = RoleMenu::query();

        if($role_id)
        {
            $role_menu->where('role_id', 'like', '%' . $role_id . '%');
        }

        if($menu_id)
        {
            $role_menu->where('menu_id', 'like', '%' . $menu_id . '%');
        }

        return ResponseFormatter::success(
            $role_menu->paginate($limit),
            'Data list successfully retrieved'
        );
    }
}
