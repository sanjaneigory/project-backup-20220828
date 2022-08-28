@extends('system-mgmt.city.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">List of Simulations</h3>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>
                </div>
                <form method="POST" action="{{ route('division.search') }}">
                    {{ csrf_field() }}
                    @component('layouts.search', ['title' => 'Search'])
                        @component('layouts.two-cols-search-row', ['items' => ['Name'],
                        'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
                        @endcomponent
                    @endcomponent
                </form>
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="division: activate to sort column ascending">Subscriber name</th>
                                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="division: activate to sort column ascending">Plan name </th>
                                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="division: activate to sort column ascending">Subscription </th>
                                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="division: activate to sort column ascending">First month balance </th>
                                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="division: activate to sort column ascending">Second month balance </th>
                                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="division: activate to sort column ascending">Third month balance </th>
                                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="division: activate to sort column ascending">Status </th>
                                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="division: activate to sort column ascending">Result </th>
                                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="division: activate to sort column ascending">Recom. </th>

                 <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($simresult as $simulation)
                                    <tr role="row" class="odd">
                                        <td> {{ $simulation->sub_name}} </td>

                                        <td> {{ $simulation->plan_name }} </td>

                                        <td>  {{ $simulation->plan_price  }}</td>

                                        <td> {{ $simulation->sim_bank_bal_1 }} </td>

                                        <td> {{ $simulation->sim_bank_bal_2 }} </td>

                                        <td> {{ $simulation->sim_bank_bal_3 }} </td>

                                        <td> {{ $simulation->sim_status }} </td>

                                        <td> {{ $simulation->sim_result }} </td>

                                        <td> {{ $simulation->sim_recommendation }} </td>

                                        <td class="text-center">
                                            @if($simulation->sim_status != 'Pending')
                                                <button class="btn btn-success has-spinner"

                                                        onclick="window.location='{{url('/request/simulator')}}/{{$simulation->sim_id}}'"
                                                >
                                                    Approve
                                                </button>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th width="20%" rowspan="1" colspan="1">Subscriber Name</th>
                                    <th width="20%" rowspan="1" colspan="1">Plan Name</th>
                                    <th width="20%" rowspan="1" colspan="1">Subscription</th>
                                    <th width="20%" rowspan="1" colspan="1">First month balance </th>
                                    <th width="20%" rowspan="1" colspan="1">Second month balance </th>
                                    <th width="20%" rowspan="1" colspan="1">Third month balance </th>
                                    <th width="20%" rowspan="1" colspan="1">Status </th>
                                    <th width="20%" rowspan="1" colspan="1">Result </th>
                                    <th width="20%" rowspan="1" colspan="1">Recom. </th>

                                    <th rowspan="1" colspan="2">Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($simulation)}} of {{count($simulation)}} entries</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
    </div>
@endsection