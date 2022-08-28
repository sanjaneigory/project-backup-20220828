<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiskCriteriaController extends Controller
{
    //

    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $riskcriteria = RiskCriteria::paginate(4);
        return view('riskcriteria.index')->with('riskcriteria', RiskCriteria::paginate(8));
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
            'has_bank_debt' => 'required',
            'has_check_returned' => 'required',
            'has_extraordinary_amt' => 'required',
            'has_something' => 'required',

        ]);


        $riskcriteria = RiskCriteria::create([
            'has_bank_debt' => $request->has_bank_debt,
            'has_check_returned' => $request->has_check_returned,
            'has_extraordinary_amt' => $request->has_extraordinary_amts,
            'has_something' => $request->has_something,
        ]);


        return redirect()->back();

    }
}
