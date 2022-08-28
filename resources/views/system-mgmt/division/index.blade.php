@extends('system-mgmt.division.base')
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
                <br>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table id="example2"
                                               class="table table-striped table-bordered table-hover dataTables-example"
                                               role="grid" aria-describedby="example2_info">
                                            <thead>
                                            <tr role="row">
                                                <th width="20%" class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1"
                                                    aria-label="division: activate to sort column ascending">Subscriber
                                                    name
                                                </th>
                                                <th width="20%" class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1"
                                                    aria-label="division: activate to sort column ascending">Plan name
                                                </th>
                                                <th width="20%" class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1"
                                                    aria-label="division: activate to sort column ascending">
                                                    Subscription
                                                </th>
                                                <th width="20%" class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1"
                                                    aria-label="division: activate to sort column ascending">Balance Avg.
                                                </th>
                                                <th width="10%" class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1"
                                                    aria-label="division: activate to sort column ascending">Status
                                                </th>
                                                <th width="20%" class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1"
                                                    aria-label="division: activate to sort column ascending">Result
                                                </th>
                                                <th width="20%" class="sorting" tabindex="0" aria-controls="example2"
                                                    rowspan="1" colspan="1"
                                                    aria-label="division: activate to sort column ascending">Recom.
                                                </th>

                                                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2"
                                                    aria-label="Action: activate to sort column ascending">Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($simresult as $simulation)
                                                <tr role="row" class="odd">
                                                    <td> {{ $simulation->sub_name}} </td>

                                                    <td> {{ $simulation->plan_name }} </td>

                                                    <td>  {{ $simulation->plan_price  }}</td>

                                                    <td> {{ round(($simulation->sim_bank_bal_1 + $simulation->sim_bank_bal_2  + $simulation->sim_bank_bal_3)/3,2) }} </td>

                                                    <td class="text-center">
                                                        @if( $simulation->sim_status == 'Pending')
                                                            <span class="label label-info">Pending</span>
                                                        @endif

                                                        @if ( $simulation->sim_status == 'Completed')
                                                            <span class="label label-warning">Simulated</span>
                                                        @endif

                                                        @if ( $simulation->sim_status == 'Finished')
                                                            <span class="label label-success">Finished</span>
                                                        @endif
                                                    </td>

                                                    <td class="text-center">

                                                        @if( $simulation->sim_result == 'Eligible' )
                                                            <span class="label label-success">Elegible</span>
                                                        @endif

                                                        @if( $simulation->sim_result == 'Not Eligible' )
                                                             <span class="label label-danger">Ineligible</span>
                                                        @endif

                                                            @if( $simulation->sim_result == 'Not Simulated' )
                                                                <span class="label label-warning">Ineligible</span>
                                                            @endif

                                                    </td>

                                                    <td> {{ $simulation->sim_recommendation }} </td>

                                                    <td class="text-center">
                                                        @if($simulation->sim_result == 'Empty')
                                                            <button class="btn btn-success has-spinner"

                                                                    onclick="window.location='{{url('/request/simulator')}}/{{$simulation->sim_id}}'"
                                                            >
                                                                Simulate
                                                            </button>
                                                        @endif

                                                            @if($simulation->sim_result == 'Not Eligible' and $simulation->sim_status == 'Finished')
                                                                <button class="btn btn-warning has-spinner btn-sm"

                                                                        onclick="window.location='{{url('/request/simulator')}}/{{$simulation->sim_id}}'"
                                                                >
                                                                    Re-Simulate
                                                                </button>
                                                            @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">

                                        <div class="dataTables_info" id="example2_info" role="status"
                                             aria-live="polite">   Showing 1 to {{count($simulation)}}
                                            of {{count($simulation)}} entries
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>


        </body>
    </section>
    <!-- /.content -->
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="js/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });

        });

    </script>
@endsection