<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Worker;
use Validator;
use DB;
use App\Time;

class WorkerController extends Controller
{
    
      public function __construct()
    {
        $this->middleware('auth');

        //$this->middleware('session');

        //$this->flash = app('App\Http\Utilities\Flash');
        parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        return view('addworker.page');
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
        $this->validate($request, [
            'name'    => 'required',
            'surname' => 'required',
            'father'  => 'required',
            'otdel'   => 'required'
            ]);
            $worker = new Worker;
            $worker->name = $request->name;
            $worker->surname = $request->surname;
            $worker->father = $request->father;
            $worker->otdel = $request->otdel;
            $worker->save();
            
            return redirect('worker/' . $worker->id);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {  
        $validator = Validator::make(
                                     array('id' => $id),
                                     array('id' => 'required|numeric')
                                    );
     if ($validator->fails())
     {
      return view('errors.503');
      }
        $start = 1;
        $stop = 0;
        $worker =  DB::table('workers')->where('id', $id)->first(); 
        if( $worker) {
           
            $time = Time::where('worker_id' ,$id)->get();
            
            //dd($time);
            if ( $time->count() == 0) {
               return view('viewWorker.page', ['worker' => $worker, 'start' => $start, 'stop' => $stop]);
            }
            else 
            {
                if ($time->where('stop', NULL)->count() == 1)
                {
                $start = 0;
                $stop = 1;
                $timeNotStop = $time->where('stop', NULL)->first();
               
                 $startTime = date_create($timeNotStop->start);
                 $endTime   = date_create();
     
                  $diff = date_diff($endTime, $startTime);
               
                $hours = $diff->format('%H');
                $min = $diff->format('%i');
                
                 $sutki =  $diff->format('%d');
                 return view('viewWorker.page', ['worker' => $worker, 'start' => $start, 'stop' => $stop, 'hours' => $hours, 'min' => $min, 'sutki' => $sutki]);
                }
                else {
                     $start = 1;
                     $stop = 0;
                     return view('viewWorker.page', ['worker' => $worker, 'start' => $start, 'stop' => $stop]);
                }
            }
        
        
           
       
        
        }
        else
        {
      return view('errors.503');
      }
    }
   
   
   
    public function timestart(Request $request)
    {
       $validator = Validator::make(
                                     array('id' => $request->id),
                                     array('id' => 'required|numeric')
                                    );
     if ($validator->fails())
     {
      return view('errors.503');
      }
      
      DB::table('times')->insert(array(
      'worker_id' => $request->id,
      'start' => date("Y-m-d H:i:s")
      ));
      
      return redirect()->back();
      
      
      
      
    }
    
    
      public function timestop(Request $request)
    {
       $validator = Validator::make(
                                     array('id' => $request->id),
                                     array('id' => 'required|numeric')
                                    );
     if ($validator->fails())
     {
      return view('errors.503');
      }
      
      DB::table('times')->where('worker_id', $request->id)->whereNull('stop')->update(array(
      'worker_id' => $request->id,
      'stop' => date("Y-m-d H:i:s")
      ));
      
      return redirect()->back();
      
      
      
      
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
