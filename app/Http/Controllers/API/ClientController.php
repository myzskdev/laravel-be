<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Clients;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function all(Request $request)
    {
        $id  = $request->input('id');
        $limit  = $request->input('limit', 10);
        $name  = $request->input('name');

        if($id){
            $client = Clients::find($id);

            if($client){
                return ResponseFormatter::success(
                    $client, 'Data successfully retrieved'
                );
            }
            else{
                return ResponseFormatter::error(
                    null, 'Data not found', 404
                ); 
            }
        }

        $client = Clients::query();

        if($name)
        {
            $client->where('name', 'like', '%' . $name . '%');
        }

        return ResponseFormatter::success(
            $client->paginate($limit),
            'Data list successfully retrieved'
        );
    }
}
