@extends('layouts.panel')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel-heading">Users </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="panel-heading"><a href="{{asset('/admin/users/export')}}" class="btn btn-primary">Export Current Users</a> </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="panel-heading"><a href="{{asset('/admin/users/exportAll')}}" class="btn btn-primary">Export All Users</a> </div>
                        </div>
                    </div>


                    <div class="panel-body">

                        <users-component></users-component>

                    </div>

                </div>

            </div>
        </div>

@endsection
