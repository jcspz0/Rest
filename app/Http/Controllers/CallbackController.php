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
        Log::create([
            'log' => 'ingresaron al servicio por Rest',
            ]);
        return "servicio Rest para tareas";
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
        Log::create([
            'log' => 'ingresaron al servicio por POST',
            ]);
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
                        'alternativeIdentifier' => $task,
                        'activity_history_id' => $a['id'], 
                        ]);
                    $salida=$salida.' [se registro la alternativeIdentifier -'.$task.'- y la activity_history_id -'.$a['id'].'-]';    
                    Log::create([
                        'log' => $salida,
                        ]);
                }
            }
            Log::create([
                'log' => 'se termino de analizar todos los activity_history',
                ]);
            return $salida;
        }catch(\Exception $e){
            if($request->input('data') == null){
                Log::create([
                    'log' => 'no se enviaron bien los datos al servicio 
                    || la variable enviada no tiene el nombre de data',
                    ]);
                return $e;
            }
            Log::create([
                'log' => 'hubo alguna excepcion 
                || el Request es el siguiente-> '.$request->input('data'),
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
