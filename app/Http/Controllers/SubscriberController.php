<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use App\Simulation;
use App\RiskCriteria;
use App\Plans;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subscribers = Subscriber::paginate(4);
         return view('subscriber.index')->with('subscribers', Subscriber::paginate(8));

      //  return view('subscriber.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = Plans::all();
        return view('request.wizzard')->with('plans', $plans);
    }


    public function create2()
    {
        $plans = Plans::all();
        return view('request.wizzard2')->with('plans', $plans);
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

        ]);

        $subscriber= new Subscribers();
        $subscriber->sub_name = $request['sub_name'];
        $subscriber->sub_doc_id = $request['sub_doc_id'];
        $subscriber->sub_vendor = $request['sub_vendor'];
        $subscriber->sub_agent = $request['sub_agent'];
        $subscriber->sub_account_type = $request['sub_account_type'];
        $subscriber->sub_contract_no = $request['sub_contract_no'];
        // add other fields
        $subscriber->save();

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
        $subscribers = \DB::table('subscribers')->where('sub_name','like', '%'.$search.'%')->paginate(1);
        return view('subscriber.index', ['subscribers' => $subscribers]);
    }

    public function action (request $request){

        if($request->ajax()){
            $query = $request->get('query');
            if($query != ''){
                $data = DB::table('subscribers')
                    ->where('sub_name', 'like', '%'.$query.'%' )
                    ->orWhere('sub_doc_id', 'like', '%'.$query.'%' )
                    ->orWhere('sub_vendor', 'like', '%'.$query.'%' )
                    ->orWhere('sub_agent', 'like', '%'.$query.'%' )
                    ->orWhere('sub_account_type', 'like', '%'.$query.'%' )
                    ->orWhere('sub_contract_no', 'like', '%'.$query.'%' )
                    ->orderBy('sub_id','desc')
                    ->get();
            }
            else {
                $data = DB::table('subscribers')
                    ->orderBy('sub_id','desc')
                    ->get();
            }
            $total_row = $data->count();
            if($total_row > 0){


                foreach($data as $subscriber) {
                    $output = '
                      

                        <tr>
                                <td>'.$subscriber->sub_name.'</td>

                                <td>'.$subscriber->sub_doc_id.'</td>

                                <td>'.$subscriber->sub_vendor.'</td>

                                <td>'.$subscriber->sub_agent.'</td>

                                <td>'.$subscriber->sub_account_type.'</td>
                        </tr>                                     
                ';}

            }
            else {
                $output = '
                    <tr>
                        <td align="center" colspan="5"> No Data Found </td>
                    </tr>
                ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );

            echo json_encode($data);
        }
    }

}
