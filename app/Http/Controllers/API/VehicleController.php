<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Vehicles;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function all(Request $request)
    {
        $id  = $request->input('id');
        $limit  = $request->input('limit', 10);
        $name  = $request->input('name');

        if ($id) {
            $vehicle = Vehicles::find($id);

            if ($vehicle) {
                return ResponseFormatter::success(
                    $vehicle,
                    'Data successfully retrieved'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }
        }

        $vehicle = Vehicles::query();

        if ($name) {
            $vehicle->where('name', 'like', '%' . $name . '%');
        }

        return ResponseFormatter::success(
            $vehicle->paginate($limit),
            'Data list successfully retrieved'
        );
    }

}
