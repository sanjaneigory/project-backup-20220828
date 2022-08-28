<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Simulation;
use App\Subscribers;
use App\Plans;
use phpDocumentor\Reflection\Types\Integer;

class SimulationController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $simulations = Simulation::all();
        $subscribers = Subscribers::all();
        $plans = Plans::all();


        $simresult = \DB::table('simulations')
            ->join('subscribers', 'subscribers.sub_id', '=', 'simulations.subscriber_id')
            ->join('plans', 'plans.id', '=', 'simulations.plan_id')
            ->get();


        return view('request.simulation')->with('simresult', $simresult);


    }

    public function getCompletedsimulations()
    {
        $simulations = Simulation::all();
        $subscribers = Subscribers::all();
        $plans = Plans::all();

        $simresult = \DB::table('simulations')
            ->join('subscribers', 'subscribers.sub_id', '=', 'simulations.subscriber_id')
            ->join('plans', 'plans.id', '=', 'simulations.plan_id')
            ->where('simulations.sim_status','=','Completed')
            ->get();

        return view('request.activationIndex')->with('simresult', $simresult);

    }

    public function activationQueueIndex()
    {
        //
        $simulations = Simulation::all();
        $subscribers = Subscribers::all();
        $plans = Plans::all();


        $simresult = \DB::table('simulations')
            ->join('subscribers', 'subscribers.sub_id', '=', 'simulations.subscriber_id')
            ->join('plans', 'plans.id', '=', 'simulations.plan_id')
            ->where('simulations.sim_status','=','Completed')
            ->get();


        return view('request.activationIndex')->with('simresult', $simresult);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('request.wizzard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $this->validate($request, [
            'sub_bank_acc_no' => 'required',
            'sub_bank_balance_avg_11' => 'required',
            'sub_bank_balance_avg_12' => 'required',
            'sub_bank_balance_avg_13' => 'required',
            'sub_bank_balance_avg_14' => 'required',

            'sub_bank_balance_avg_21' => 'required',
            'sub_bank_balance_avg_22' => 'required',
            'sub_bank_balance_avg_23' => 'required',
            'sub_bank_balance_avg_24' => 'required',

            'sub_bank_balance_avg_31' => 'required',
            'sub_bank_balance_avg_32' => 'required',
            'sub_bank_balance_avg_33' => 'required',
            'sub_bank_balance_avg_34' => 'required',

        ]);


        $sims = Simulation::create([
            'sim_bank_acc_no' => $request->sub_bank_acc_no,
            'sim_bank_bal_1' => ($request->sub_bank_balance_avg_11+
                    $request->sub_bank_balance_avg_12+$request->sub_bank_balance_avg_13+
                    $request->sub_bank_balance_avg_14)/4,
            'sim_bank_bal_2' => ($request->sub_bank_balance_avg_21+
                    $request->sub_bank_balance_avg_22+$request->sub_bank_balance_avg_23+
                    $request->sub_bank_balance_avg_24)/4,
            'sim_bank_bal_3' => ($request->sub_bank_balance_avg_31+
                    $request->sub_bank_balance_avg_32+$request->sub_bank_balance_avg_33+
                    $request->sub_bank_balance_avg_34)/4,
        ]);


        return redirect()->back();

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function simulator($id)
    {

        $simulation = \DB::table('simulations')
            ->join('plans', 'plans.id', '=', 'simulations.plan_id')
            //                   ->where(function($query) use ($id))

            ->where('simulations.sim_id', '=', $id)->first();

        $sim = Simulation::where('sim_id', '=', $id)->first();
        //   ->select('simulations.sim_id')->get();
        //       $simulation_bal_1 = (float) $simulation_bal_a;
        //  ->update(['sim_result' => 'Eligible', 'sim_status' => 'Completed']);

        if(($simulation->sim_bank_bal_1 > $simulation->plan_price && $simulation->sim_bank_bal_2 > $simulation->plan_price) ||
            ($simulation->sim_bank_bal_2 > $simulation->plan_price && $simulation->sim_bank_bal_3 > $simulation->plan_price) ||
            ($simulation->sim_bank_bal_1 > $simulation->plan_price && $simulation->sim_bank_bal_3 > $simulation->plan_price)
        )
        {
            $change_data = \DB::table('simulations')
                ->join('plans', 'plans.id', '=', 'simulations.plan_id')
                //                   ->where(function($query) use ($id))

                ->where('simulations.sim_id', '=', $id)
                ->update(['sim_result' => 'Eligible', 'sim_status' => 'Completed']);
            ;
        } else {

            $change_data = \DB::table('simulations')
                ->join('plans', 'plans.id', '=', 'simulations.plan_id')
                //                   ->where(function($query) use ($id))

                ->where('simulations.sim_id', '=', $id)
                ->update(['sim_result' => 'Not Eligible', 'sim_status' => 'Completed']);

        }

        return redirect()->back();

    }

}
