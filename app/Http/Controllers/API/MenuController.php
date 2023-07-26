<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function all(Request $request)
    {
        $id  = $request->input('id');
        $limit  = $request->input('limit', 10);
        $name  = $request->input('name');

        if($id){
            $menu = Menu::find($id);

            if($menu){
                return ResponseFormatter::success(
                    $menu, 'Data successfully retrieved'
                );
            }
            else{
                return ResponseFormatter::error(
                    null, 'Data not found', 404
                ); 
            }
        }

        $menu = Menu::query();

        if($name)
        {
            $menu->where('name', 'like', '%' . $name . '%');
        }

        return ResponseFormatter::success(
            $menu->paginate($limit),
            'Data list successfully retrieved'
        );
    }
}
