<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Callback as Callback;
use App\Log as Log;

class CallbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "servicio rest para los callbacks de umov.me";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$salida='hubo un error en el proceso de todo el servicio';
        try{
            $xml = simplexml_load_string($request->input('data'));
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
            $task = $array['alternativeIdentifier'];
            $activities = $array['activityHistories'];
            foreach ($activities as $act) {
				$salida='';
                foreach ($act as $a) {
                    Callback::create([
                        'task' => $task,
                        'activity_history' => $a['id'], 
                        ]);
					$salida=$salida.' [se registro la tarea '.$task.' y la actividad '.$a['id'].']';	
                }
            }
			return $salida;
        }catch(\Exception $e){
            Log::create([
                'log' => 'no se enviaron bien los datos al servicio',
                ]);
            return $e;
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
