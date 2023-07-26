<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterRequest;
use App\Models\Masters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master = Masters::with(['master'])->paginate(10);

        foreach($master as $key => $item){
            if(!empty(json_decode($item->master))){
                foreach($item->master as $val){
                    $item->master = $val->name;
                }
            }else{
                $item->master = '';
            }
        }
        
        return view('masters.index', [
            'masters' => $master
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Masters;

        $data = $model->getParent();

        return view('masters.create', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterRequest $request)
    {
        $request['created_by'] = Auth::user()->id;

        $data = $request->all();

        Masters::create($data);

        return redirect()->route('masters.index')->with('status', 'Data successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Masters $master)
    {
        $data = $master->getParent();

        return view('masters.edit', [
            'item' => $master,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MasterRequest $request, Masters $master)
    {
        $data = $request->all();

        $master->update($data);

        return redirect()->route('masters.index')->with('status', 'Data successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Masters $master)
    {
        $master->delete();

        return redirect()->route('masters.index')->with('status', 'Data successfully delete.');
    }
}
