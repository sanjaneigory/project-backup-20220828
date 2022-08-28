<?php

namespace App\Http\Controllers;

use App\RiskCriteria;
use App\Simulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Department;
use App\Subscriber;
use App\Plans;

class DepartmentController extends Controller
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
        $subscribers = Subscriber::paginate(5);

        return view('system-mgmt/department/index', ['subscribers' => $subscribers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $plans = Plans::all();
        return view('system-mgmt/department/create')->with('plans', $plans);
    }

    public function callMeDirectlyFromUrl()
    {
        return "I have been called from URL :)";
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
            'sub_name' => 'required',
            'sub_doc_id' => 'required',
            'sub_vendor' => 'required',
            'sub_agent' => 'required',
            'sub_account_type' => 'required',
            'sub_contract_no' => 'required',
            'sub_bank_acc_no' => 'required',

        ]);

        $subscriber = tap(new Subscriber([
            'sub_name' => $request->get('sub_name'),
            'sub_doc_id' => $request->get('sub_doc_id'),
            'sub_vendor' => $request->get('sub_vendor'),
            'sub_agent' => $request->get('sub_agent'),
            'sub_account_type' => $request->get('sub_account_type'),
            'sub_contract_no' => '1431243131341234123ABC',
        ]))->save();

        $riskcriteria = new RiskCriteria();
//        $riskcriteria->has_bank_debt = '1';
        if (isset($request->has_bank_debt)) {
            // checked
            $riskcriteria->has_bank_debt = '1';
        } else {//not checked
            $riskcriteria->has_bank_debt = '0';
        }

        if (isset($request->has_extraordinary_amt)) {
            // checked
            $riskcriteria->has_extraordinary_amt = '1';
        } else {//not checked
            $riskcriteria->has_extraordinary_amt = '0';
        }

        if (isset($request->has_check_returned)) {
            // checked
            $riskcriteria->has_check_returned = '1';
        } else {//not checked
            $riskcriteria->has_check_returned = '0';
        }

        $riskcriteria->has_something = 'Something';

        $riskcriteria->save();

        $simulation= new Simulation();
        $simulation->sim_bank_acc_no = $request['sub_bank_acc_no'];
        $simulation->sim_bank_bal_1 = ($request['sub_bank_balance_avg_11']+$request['sub_bank_balance_avg_12']+
                $request['sub_bank_balance_avg_13']+$request['sub_bank_balance_avg_14'])/4;
        $simulation->sim_bank_bal_2 = ($request['sub_bank_balance_avg_21']+$request['sub_bank_balance_avg_22']+
                $request['sub_bank_balance_avg_23']+$request['sub_bank_balance_avg_24'])/4;
        $simulation->sim_bank_bal_3 = ($request['sub_bank_balance_avg_31']+$request['sub_bank_balance_avg_32']+
                $request['sub_bank_balance_avg_33']+$request['sub_bank_balance_avg_34'])/4;
        $simulation->sim_status = 'Pending';
        $simulation->sim_result = 'Empty';

        $plan = $request['plan_id'];

        $simulation->plans()->associate($plan);
        $simulation->subscribers()->associate($subscriber);
        $simulation->riskcriterias()->associate($riskcriteria);
        $simulation->save();

        return redirect()->intended('system-management/department');
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
        $department = Department::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($department == null || count($department) == 0) {
            return redirect()->intended('/system-management/department');
        }

        return view('system-mgmt/department/edit', ['department' => $department]);
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
        $department = Department::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name']
        ];
        Department::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::where('id', $id)->delete();
         return redirect()->intended('system-management/department');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $departments = $this->doSearchingQuery($constraints);
       return view('system-mgmt/department/index', ['departments' => $departments, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = department::query();
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
        'name' => 'required|max:60|unique:department'
    ]);
    }
}
