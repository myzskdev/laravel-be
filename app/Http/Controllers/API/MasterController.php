<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Masters;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function all(Request $request)
    {
        $id  = $request->input('id');
        $limit  = $request->input('limit', 10);
        $name  = $request->input('name');
        $parent_id  = $request->input('parent_id');

        if($id){
            $master = Masters::find($id);

            if($master){
                return ResponseFormatter::success(
                    $master, 'Data successfully retrieved'
                );
            }
            else{
                return ResponseFormatter::error(
                    null, 'Data not found', 404
                ); 
            }
        }

        $master = Masters::query();

        if($name)
        {
            $master->where('name', 'like', '%' . $name . '%');
        }

        if($parent_id)
        {
            $master->where('parent_id', 'like', '%' . $parent_id . '%');
        }

        return ResponseFormatter::success(
            $master->paginate($limit),
            'Data list successfully retrieved'
        );
    }
}
