@extends('system-mgmt.department.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of client details</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('department.create') }}"> <i class="icon-fa icon-fa-plus"></i> Add new client</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('department.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Name'], 
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-10">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                  <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Name</th>
                  <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Document ID</th>
                  <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Vendor</th>
                  <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Store agent</th>
                  <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Account type</th>
                  <th width="60%" class="sorting" tabindex="0" aria-controls="example2" rowspan="2" colspan="2" aria-label="Department: activate to sort column ascending">Action</th>

              </tr>
            </thead>
            <tbody>
            @foreach ($subscribers as $subscriber)
                <tr role="row" class="odd">
                  <td>{{ $subscriber->sub_name }}</td>
                    <td>{{ $subscriber->sub_doc_id }}</td>
                    <td>{{ $subscriber->sub_vendor }}</td>
                    <td>{{ $subscriber->sub_agent }}</td>
                    <td>{{ $subscriber->sub_account_type }}</td>

                    <td>
                    <form class="row" method="POST" action="{{ route('department.destroy', ['id' => $subscriber->id]) }}" onsubmit = "return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('department.edit', ['id' => $subscriber->id]) }}" class="btn btn-warning col-sm-8 col-xs-15 btn-margin">
                        Update
                        </a>
                    </form>
                  </td>
                    <td>
                        <form class="row" method="POST" action="{{ route('department.destroy', ['id' => $subscriber->id]) }}" onsubmit = "return confirm('Are you sure you want to delete this subscriber?')">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-danger col-sm-12s col-xs-15 btn-margin">

                                Delete
                                <i class="icon-fa icon-fa-trash"></i>
                            </button>
                        </form>
                    </td>

              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($subscribers)}} of {{count($subscribers)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $subscribers->links() }}
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