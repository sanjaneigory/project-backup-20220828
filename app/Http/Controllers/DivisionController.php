<?php

namespace App\Http\Controllers;

use App\Plans;
use App\Simulation;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Division;

class DivisionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $simulations = Simulation::all();
        $subscribers = Subscriber::all();
        $plans = Plans::all();


        $simresult = \DB::table('simulations')
            ->join('subscribers', 'subscribers.sub_id', '=', 'simulations.subscriber_id')
            ->join('plans', 'plans.id', '=', 'simulations.plan_id')
            ->get();


      //  return view('request.simulation')->with('simresult', $simresult);

        return view('system-mgmt/division/index', ['simresult' => $simresult]);
    }

    public function index2()
    {


        $simulations = Simulation::all();
        $subscribers = Subscriber::all();
        $plans = Plans::all();


        $simresult = \DB::table('simulations')
            ->join('subscribers', 'subscribers.sub_id', '=', 'simulations.subscriber_id')
            ->join('plans', 'plans.id', '=', 'simulations.plan_id')
            ->get();


        //  return view('request.simulation')->with('simresult', $simresult);

        return view('system-mgmt/division2/approval', ['simresult' => $simresult]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('system-mgmt/division/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateInput($request);
         Division::create([
            'name' => $request['name']
        ]);

        return redirect()->intended('system-management/division');
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
        $division = Division::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($division == null || count($division) == 0) {
            return redirect()->intended('/system-management/division');
        }

        return view('system-mgmt/division/edit', ['division' => $division]);
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
        $division = Division::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name']
        ];
        Division::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/division');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Division::where('id', $id)->delete();
         return redirect()->intended('system-management/division');
    }

    /**
     * Search division from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $divisions = $this->doSearchingQuery($constraints);
       return view('system-mgmt/division/index', ['divisions' => $divisions, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Division::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }
    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60|unique:division'
    ]);
    }
}
