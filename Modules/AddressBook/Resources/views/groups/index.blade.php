@extends('layouts.app')
@section('title',trans('strings.groups.name'))


@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{!! trans('strings.groups.name') !!}</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{url('/')}}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('groups')}}">{!! trans('strings.groups.name') !!}</a>
                    </li>


                </ul>
            </div>

            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif


            @include('addressbook::groups.partials.add_modal')
            @include('addressbook::groups.partials.edit_modal')

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{!! trans('strings.groups.list') !!}</h4>

                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#createGroupModal" >
                                    <i class="fa fa-plus mr-1"></i>
                                    {!! trans('strings.groups.create') !!}
                                </button>
                            </div>

                        </div>



                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="groups_table" class="display table  table-hover  table-striped dataTable"
                                       role="grid" aria-describedby="">
                                    <thead>
                                    <tr>
                                        <th>{!! trans('strings.groups.table.name') !!}</th>
                                        <th>{!! trans('strings.description') !!}</th>
                                        <th>{!! trans('strings.groups.table.nb_contacts') !!}</th>
                                        <th>{!! trans('strings.groups.table.actions') !!}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{url('js/vendor/noitify.js')}}"></script>
@endsection
@section('custom-js')
    <script>
        var groups_index = new groupsIndex();
        groups_index.init();
    </script>
@endsection
