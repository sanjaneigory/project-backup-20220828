@extends('system-mgmt.department.base')


@section('action-content')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-2">
                    <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                    <p class="mr-5">Basic Details</p>
                </div>
                <div class="stepwizard-step col-xs-2">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p>Bank Details</p>
                </div>
                <div class="stepwizard-step col-xs-2">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p>Contract Details</p>
                </div>

            </div>
        </div>

        <form role="form" action="/products" method="post">
            {{ csrf_field() }}
            <div class="panel panel-primary setup-content" id="step-1">
                <div class="panel-heading">
                    <h3 class="panel-title">Subscriber</h3>
                </div>

                <div class="panel-body">
                    <div class="panel-body">
                        <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Subscriber Name" id="sub_name" name="sub_name" />
                        </div>
                        </div>
                        <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">Document No2.</label>
                                    <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Subscriber Document ID" id="sub_doc_id" name="sub_doc_id" />
                                </div>
                        </div>
                    </div>
                    <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                </div>
            </div>

            <div class="panel panel-primary setup-content" id="step-2">
                <div class="panel-heading">
                    <h3 class="panel-title">Bank</h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Bank Account No.</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Bank ID" name="sub_bank_acc_no" id="sub_bank_acc_no"/>
                        </div>
                        <br>
                        <h4 class="control-label">1st Month: </h4>
                        <br>
                        <div class="form-group">
                            <label class="control-label">Day: 5th</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Subscriber Document ID" id="sub_bank_balance_avg_11" name="sub_bank_balance_avg_11"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Day: 15th</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Subscriber Document ID" id="sub_bank_balance_avg_12" name="sub_bank_balance_avg_12" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Day: 25th</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Subscriber Document ID" id="sub_bank_balance_avg_13" name="sub_bank_balance_avg_13"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Day: 28/30/31th</label>
                            <input maxlength="50" type="text" required="required" class="form-control" placeholder="Enter Subscriber Document ID" id="sub_bank_balance_avg_14" name="sub_bank_balance_avg_14" />
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="col-md-6 control-label" for="checkboxes">Client bank conditions</label>
                            <div class="col-md-8">
                                <label class="checkbox-inline" for="checkboxes-0">
                                    <input type="checkbox" name="has_check_returned" id="has_check_returned" value="1">
                                    Has Returned Check
                                </label> <br>
                                <label class="checkbox-inline" for="checkboxes-1">
                                    <input type="checkbox" name="has_bank_debt" id="has_bank_debt" value="2">
                                    Has a Loan
                                </label> <br>
                                <label class="checkbox-inline" for="checkboxes-2">
                                    <input type="checkbox" name="has_extraordinary_amt" id="has_extraordinary_amt" value="3">
                                    Has a Extraordinary Amount
                                </label>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <h4 class="control-label">2nd Month: </h4>
                        <br>
                        <div class="form-group">
                            <label class="control-label">Day: 5th</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Subscriber Document ID" name="sub_bank_balance_avg_21" id="sub_bank_balance_avg_21"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Day: 15th</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Subscriber Document ID" name="sub_bank_balance_avg_22" id="sub_bank_balance_avg_22"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Day: 25th</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Subscriber Document ID" name="sub_bank_balance_avg_23" id="sub_bank_balance_avg_23"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Day: 29/30/31th</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Subscriber Document ID" name="sub_bank_balance_avg_24" id="sub_bank_balance_avg_24"/>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <br><br><br><br><br><br>

                        <h4 class="control-label">3rd Month: </h4>
                        <br>
                        <div class="form-group">
                            <label class="control-label">Day: 5th</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Subscriber Document ID" name="sub_bank_balance_avg_31" id="sub_bank_balance_avg_31"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Day: 15th</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Subscriber Document ID" name="sub_bank_balance_avg_32" id="sub_bank_balance_avg_32"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Day: 25th</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Subscriber Document ID" name="sub_bank_balance_avg_33" id="sub_bank_balance_avg_33"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Day: 28/30/31th</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Subscriber Document ID" name="sub_bank_balance_avg_34" id="sub_bank_balance_avg_34"/>
                        </div>
                        <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>

                    </div>

                </div>
            </div>

            <div class="panel panel-primary setup-content" id="step-3">



                <div class="panel-heading">
                    <h3 class="panel-title">Contract</h3>
                </div>


                <div class="panel-body">

                        <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">Contract No.</label>
                                    <input maxlength="200" type="text" required="required" class="form-control" id="sub_contract_no" name="sub_contract_no" placeholder="Enter Company Name" />
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="sub_account_type">Account type</label>
                                        <select name="sub_account_type" class="form-control form-control-lg">
                                            <option value="">Default (Individual)</option>
                                            <option value="Corp-Medium">Individual</option>
                                            <option value="Corp-High">Corp-High</option>
                                            <option value="Corp-High">Corp-Medium</option>
                                            <option value="Corp-Small">Corp-Small</option>
                                        </select>
                                    </div>
                                </div>

                        </div>
                        <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="sub_vendor">Vodacom vendor</label>
                                    <select name="sub_vendor" class="form-control form-control-lg">
                                        <option value="Vodacom Sede">Default (Vodacom Sede)</option>
                                        <option value="Vodacom Nampula">Vodacom Nampula</option>
                                        <option value="Vodacom Quelimane">Vodacom Quelimane</option>
                                        <option value="Vodacom Super Mares">Vodacom Super Mares</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_agent">Vodacom agent</label><br>
                                    <select name="sub_agent" class="form-control form-control-lg">
                                        <option value="Billing ServiceDesk">Default (Billing ServiceDesk)</option>
                                        <option value="Antonio Plinio Tivane">Antonio Plinio Tivane</option>
                                        <option value="Isaura Muianga">Isaura Muianga</option>
                                        <option value="Salvador Mondlane">Salvador Mondlane</option>
                                        <option value="Benedita Sevene">Benedita Sevene</option>
                                    </select>
                                </div>
                        </div>
                        <div class="col-lg-4">

                            <div class="form-group">
                                <label for="sub_account_type">Plan</label>
                                <select action="PlansController.php" name="plan_id" id="plan_id" method = "GET" class="form-control form-control-lg">
                                    @foreach($plans as $dt)
                                        <option value="{{ $dt->id }}"> {{ $dt->plan_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <br><br><br><br><br><br><br><br>
                            <input type="submit" class="submit btn btn-success"> </input>
                        </div>



                </div>
            </div>


        </form>
    </div>


    <script language="JavaScript">
                        $(document).ready(function () {

                            var navListItems = $('div.setup-panel div a'),
                                allWells = $('.setup-content'),
                                allNextBtn = $('.nextBtn');

                            allWells.hide();

                            navListItems.click(function (e) {
                                e.preventDefault();
                                var $target = $($(this).attr('href')),
                                    $item = $(this);

                                if (!$item.hasClass('disabled')) {
                                    navListItems.removeClass('btn-success').addClass('btn-default');
                                    $item.addClass('btn-success');
                                    allWells.hide();
                                    $target.show();
                                    $target.find('input:eq(0)').focus();
                                }
                            });

                            allNextBtn.click(function () {
                                var curStep = $(this).closest(".setup-content"),
                                    curStepBtn = curStep.attr("id"),
                                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                                    isValid = true;

                                $(".form-group").removeClass("has-error");
                                for (var i = 0; i < curInputs.length; i++) {
                                    if (!curInputs[i].validity.valid) {
                                        isValid = false;
                                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                                    }
                                }

                                if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
                            });

                            $('div.setup-panel div a.btn-success').trigger('click');
                        });
    </script>

@endsection
