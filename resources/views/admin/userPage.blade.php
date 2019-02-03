@extends('layouts.panel')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="row">

                    </div>


                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="well well-sm">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-4">
                                                    <img src="https://www.pngarts.com/files/3/Avatar-PNG-Photo.png" alt="" class="img-rounded img-responsive" />
                                                </div>
                                                <div class="col-sm-6 col-md-8">
                                                    <h2>
                                                        {{$user->name}}</h2>

                                                    <p>
                                                        <i class="glyphicon glyphicon-envelope"></i>{{$user->email}}
                                                        <br />

                                                        <br />
                                                        <i></i>Registered : {{$user->created_at->diffForHumans()}}</p>
                                                    <!-- Split button -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">

                                <div class="col-md-3 col-sm-6">
                                    <div class="progress blue" >
                                              <span class="progress-left">
                                                    <span class="progress-bar"></span>
                                              </span>
                                        <span class="progress-right">
                                                <span class="progress-bar"></span>
                                        </span>

                                        <div class="progress-value" >{{$progress}}%</div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Video</th>

                                <th>Skip</th>
                            </tr>
                            </thead>
                            <tbody>

                            @for($i=1; $i<=12 ; $i++)
                             <tr>
                                <td>Video {{$i}}</td>

                                <td><a href="/admin/user/{{$user->id}}/video/{{$i}}" class="btn btn-primary">Skip</a></td>
                            </tr>

                            @endfor

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>

@endsection
