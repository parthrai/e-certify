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
                                <th>Status</th>
                                <th>Skip</th>
                            </tr>
                            </thead>
                            <tbody>


                             <tr>
                                <td>Video 1</td>
                                <td>
                                    @if($videoStatus->vid1)
                                        completed
                                    @else
                                        not completed
                                    @endif

                                </td>

                                <td><a href="/admin/user/{{$user->id}}/video/1" class="btn btn-primary">Skip</a></td>
                             </tr>

                             <tr>
                                 <td>Video 2</td>
                                 <td>
                                     @if($videoStatus->vid2)
                                         completed
                                     @else
                                         not completed
                                     @endif

                                 </td>

                                 <td><a href="/admin/user/{{$user->id}}/video/2" class="btn btn-primary">Skip</a></td>
                             </tr>

                             <tr>
                                 <td>Video 3</td>
                                 <td>
                                     @if($videoStatus->vid3)
                                         completed
                                     @else
                                         not completed
                                     @endif

                                 </td>

                                 <td><a href="/admin/user/{{$user->id}}/video/3" class="btn btn-primary">Skip</a></td>
                             </tr>


                             <tr>
                                 <td>Video 4</td>
                                 <td>
                                     @if($videoStatus->vid4)
                                         completed
                                     @else
                                         not completed
                                     @endif

                                 </td>

                                 <td><a href="/admin/user/{{$user->id}}/video/4" class="btn btn-primary">Skip</a></td>
                             </tr>


                             <tr>
                                 <td>Video 5</td>
                                 <td>
                                     @if($videoStatus->vid5)
                                         completed
                                     @else
                                         not completed
                                     @endif

                                 </td>

                                 <td><a href="/admin/user/{{$user->id}}/video/5" class="btn btn-primary">Skip</a></td>
                             </tr>


                             <tr>
                                 <td>Video 6</td>
                                 <td>
                                     @if($videoStatus->vid6)
                                         completed
                                     @else
                                         not completed
                                     @endif

                                 </td>

                                 <td><a href="/admin/user/{{$user->id}}/video/6" class="btn btn-primary">Skip</a></td>
                             </tr>


                             <tr>
                                 <td>Video 7</td>
                                 <td>
                                     @if($videoStatus->vid7)
                                         completed
                                     @else
                                         not completed
                                     @endif

                                 </td>

                                 <td><a href="/admin/user/{{$user->id}}/video/7" class="btn btn-primary">Skip</a></td>
                             </tr>

                             <tr>
                                 <td>Video 8</td>
                                 <td>
                                     @if($videoStatus->vid8)
                                         completed
                                     @else
                                         not completed
                                     @endif

                                 </td>

                                 <td><a href="/admin/user/{{$user->id}}/video/8" class="btn btn-primary">Skip</a></td>
                             </tr>

                             <tr>
                                 <td>Video 9</td>
                                 <td>
                                     @if($videoStatus->vid9)
                                         completed
                                     @else
                                         not completed
                                     @endif

                                 </td>

                                 <td><a href="/admin/user/{{$user->id}}/video/9" class="btn btn-primary">Skip</a></td>
                             </tr>

                             <tr>
                                 <td>Video 10</td>
                                 <td>
                                     @if($videoStatus->vid10)
                                         completed
                                     @else
                                         not completed
                                     @endif

                                 </td>

                                 <td><a href="/admin/user/{{$user->id}}/video/10" class="btn btn-primary">Skip</a></td>
                             </tr>

                             <tr>
                                 <td>Video 11</td>
                                 <td>
                                     @if($videoStatus->vid11)
                                         completed
                                     @else
                                         not completed
                                     @endif

                                 </td>

                                 <td><a href="/admin/user/{{$user->id}}/video/11" class="btn btn-primary">Skip</a></td>
                             </tr>

                             <tr>
                                 <td>Video 12</td>
                                 <td>
                                     @if($videoStatus->vid12)
                                         completed
                                     @else
                                         not completed
                                     @endif

                                 </td>

                                 <td><a href="/admin/user/{{$user->id}}/video/12" class="btn btn-primary">Skip</a></td>
                             </tr>



                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>

@endsection
