<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plans;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plans = Plans::all();
        $plans = Plans::paginate(4);
        return view('plan.index')->with('plans', Plans::paginate(4));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'plan_name' => 'required',
            'plan_price' => 'required',
            'plan_deposit' => 'required',
            'plan_cib' => 'required',

        ]);


        $subscriber = Plans::create([
            'plan_name' => $request->plan_name,
            'plan_price' => $request->plan_price,
            'plan_deposit' => $request->plan_deposit,
            'plan_cib' => $request->plan_cib,
            'plan_services' => $request->plan_services,
            'plan_type' => $request->plan_type,
        ]);

        return redirect()->back();
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


    public function search(Request $request){

        $search = $request->get('search');
        $plans = \DB::table('plans')->where('plan_name','like', '%'.$search.'%')->paginate(3);
        return view('plan.index', ['plans' => $plans]);
    }
}
