<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Masters;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use stdClass;

class APIController extends Controller
{

    
    public function get_vehicles()
    {
        $master = new Masters;
        $client = new Client();

        

        $username = $master->getOnebyName('username')->first();
        $api_key = $master->getOnebyName('api_key')->first();


        $token = base64_encode($username->value.':'.$api_key->value);

        $base_url = $master->getOnebyName('url')->first();
        
        $params = [
            //If you have any Params Pass here
        ];

        $headers = [
            'Authorization' => 'Basic '.$token,
            'Content-Type' => 'application/json',
        ];

        // dd($headers);

        $responseApi = $client->request('GET', $base_url->value, [
            // 'json' => $params,
            'headers' => $headers,
            'verify'  => true,
        ]);

        $data = json_decode($responseApi->getBody()->getContents())->data;

        $response = array();

        foreach ($data as $key => $value) {
            $temp = new stdClass();
            $temp->id = $value->vehicle_id;
            $temp->registration = $value->registration;
            $temp->chassis_number = $value->chassis_number;
            $temp->odometer = $value->odometer;
            $temp->speed = $value->speed;
            $temp->fuel = array($value->fuel);
            $temp->location = array($value->location);
            
            $response[] = $temp;
        }
        return ResponseFormatter::success(
            $response,
            'Data list successfully retrieved'
        );
    }

    public function get_vehicle_by_user_id()
    {
        
    }
}
