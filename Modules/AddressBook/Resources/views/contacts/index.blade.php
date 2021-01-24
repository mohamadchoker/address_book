@extends('layouts.app')
@section('title',trans('strings.contacts.list'))

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{!! trans('strings.contacts.name') !!}</h4>
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
                        <a href="#">{!! trans('strings.contacts.list') !!}</a>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{!! trans('strings.contacts.list') !!}</h4>
                                <button class="btn btn-primary btn-round ml-auto" onclick="window.location.href='{{url('contacts/create')}}'">
                                    <i class="fa fa-plus mr-2"></i>
                                    {!! trans('strings.contacts.create') !!}
                                </button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="contacts_table" class="display table table-striped table-hover dataTable"
                                       role="grid" aria-describedby="">
                                    <thead>
                                    <tr>
                                        <th>{!! trans('strings.contacts.table.full_name') !!}</th>
                                        <th>{!! trans('strings.contacts.table.email') !!}</th>
                                        <th>{!! trans('strings.contacts.table.phone_number') !!}</th>
                                        <th>{!! trans('strings.contacts.table.location') !!}</th>
                                        <th>{!! trans('strings.contacts.table.actions') !!}</th>

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
@endsection

@section('custom-js')
    <script>
        var contacts = new ContactsIndex();
        contacts.init();
    </script>
@endsection
