<!DOCTYPE html>
    <html>
    <head>



        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome {{Auth::user()->name}}</title>

        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/animate.css') }}" rel="stylesheet">



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



        <script src="{{ URL::asset('js/wow.min.js') }}"></script>

        <script>
            new WOW().init();
        </script>


        <!--[if lt IE 9]>
        <script src="{{ URL::asset('js/html5shiv.js') }}"></script>
        <script src="{{ URL::asset('js/respond.min.js') }}"></script>
        <![endif]-->



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


        <link rel="stylesheet" href="{{asset('checkouts/css/style.css')}}">







        <script src="https://cdnjs.cloudflare.com/ajax/libs/store.js/1.3.17/store.min.js"></script>

        <style>
            .responsive-video {
                max-width: 100%;
                height: auto;
            }
        </style>

        <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
        <script type="text/javascript" src="https://js.stripe.com/v1/"></script>




        <link href="//vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">






    </head>




    <?php
    if(!isset($video))
        $video='1';
    ?>

    <?php

    function VideoNames($num){

        if($num==1)
            return "Broker Responsibility in a Nutshell Part 1";
        else if($num==2)
            return "Broker Responsibility in a Nutshell Part 2";
        else if($num==3)
            return "Disclose, Disclose, Disclose Part 1";
        else if($num==4)
            return "Disclose, Disclose, Disclose Part 2";
        else if($num==5)
            return "Advertising Compliance Part 1";
        else if($num==6)
            return "Advertising Compliance Part 2";
        else if($num==7)
            return "Conflicts of Interest Part 1";
        else if($num==8)
            return "Conflicts of Interest Part 2";
        else if($num==9)
            return "Professional Ethics Part 1";
        else if($num==10)
            return "Professional Ethics Part 2";
        else if($num==11)
            return "Dual Agency Part 1";
        else if($num==12)
            return "Dual Agency Part 2";

    }








    //$video_id = ($uvd->video  ? 'vid0' : 'vid1');


    ?>


    <?php
    if(isset($_COOKIE['discount']) && isset($_COOKIE['code']))
    {

        if($_COOKIE['discount']=='undefined')
            $amount=2900;

        else
            $amount=2900 - $_COOKIE['discount']*100;
        $code=$_COOKIE['code'];
    }

    else
        $amount=2900;

    ?>


<body>

<div id="app">

    <div class="container">



    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="../"><img src="/images/logo3.png"></a>

                <ul class="user-menu">
                    <li class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout  {{Auth::user()->name}}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div><!-- /.container-fluid -->
    </nav>

   <!-- contact support modal -->

         <div class="modal fade" id="contactsupportmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Contact Support</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="post" action="/contactsupport">
                        <input type="hidden" name="_token" value="<?= csrf_token();?>">


                        <div class="form-group">
                            <label for="title" class="white col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Title" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="white col-sm-2 control-label">Message</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" name="message"></textarea>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <! Will be used to display an alert to the user>
                            </div>
                        </div>
                        <input id="submit" name="submit" type="submit" value="Send" class="btn btn-blue">
                    </form>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- contact support modal -->

        <!-- survey modal -->

        <div class="modal fade" id="surveymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Course Survey</h4>
                    </div>
                    <div class="modal-body">
                        <p> Help us improve our school. Please send us your comments and suggestions.</p>

                        <a href="{{URL::asset('docs/board_survey.pdf')}}" target="_blank">Download Board Survey</a>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <input name="submit" type="submit" value="Send" class="btn btn-blue">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!-- survey modal -->


        <!-- certificate modal -->

          <div class="modal fade" id="certificatemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Download Certificate</h4>
                </div>
                <div class="modal-body">
                    <img src="/images/certi/{{Auth::user()->id}}.jpg" class="img-responsive" height="450" width="580">
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- certificate modal  END-->

    <!-- Notes Modal -->

         <div class="modal fade" id="notesmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Notes</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="post" action="/user/savenotes">
                        <input type="hidden" name="_token" value="<?= csrf_token();?>">




                        <div class="form-group">
                            <label for="message" class="white col-sm-2 control-label">Notes</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" name="notes">{{Auth::user()->notes}}</textarea>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <! Will be used to display an alert to the user>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10">
                                <input id="submit" name="submit" type="submit" value="Save" class="btn btn-blue">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Notes Modal End-->

    <!-- User guide --->

          <div class="modal fade" id="helpguide" role="dialog">
        <div class="modal_container">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class=".col-sm-12 modal-header">


                        <h4 class=".col-sm-8 text-left modal-title">User Guide</h4>




                    </div>
                    <div class="modal-body">


                        <p>1. After viewing each video, a checkmark will appear to register course credit.</p><Br>

                        <p>2. Until the checkmark appears, you cannot fast forward the video (state required).</p><Br>

                        <p>3. The video will prompt you to press the resume button at random intervals &nbsp;&nbsp;(state required).</p><Br>

                        <p>4. When you leave a video, you will never lose your place.</p><Br>

                        <p>5. Some out-of-date browsers like internet explorer may not save your place and have other performance issues. We recommend that you use Google Chrome.</p><Br>

                        <p>6. To watch a video and all included power points, select video “Part 1” or “Part 2” on &nbsp;&nbsp; any module.</p><Br>

                        <p>7. Selecting the red "PPT" symbol is only to download power points to view and print.</p><Br>

                        <p>8. You have eight months (240 days) to complete the course or to re-watch the videos.</p><Br>

                        <p>9. To view the course outlines, log out and click the intended course topic on the main &nbsp;&nbsp; menu.</p><Br>

                        <p>10. Once you have completed all 12 videos, your certificate can be downloaded from the &nbsp;&nbsp; course menu.</p><Br>

                        <p>11. After completing the videos, your certificate will automatically be sent to your &nbsp;&nbsp; email.</p><Br>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End user guid modal -->

    <!--- License Number Modal ------->

        <div class="modal fade" id="licenseModal" role="dialog">
        <div class="modal_container">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class=".col-sm-12 modal-header">



                        <h3>Enter  License Number to download Certificate</h3>



                    </div>
                    <div class="modal-body">

                        <form class="form-horizontal" role="form" method="post" action="/user/updateLicense">
                            <input type="hidden" name="_token" value="<?= csrf_token();?>">




                            <div class="form-group">

                                <div class="col-sm-3">
                                    <label for="message" class="white col-sm-12 control-label">License number</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  name="lin">
                                </div>
                            </div>





                            <div class="form-group">
                                <div class="col-sm-10">
                                    <input id="submit" name="submit" type="submit" value="Download Certificate" class="btn btn-primary">
                                </div>
                            </div>
                        </form>


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!----- End License number modal --->

    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <form role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
        </form>
        <ul class="nav menu">
            <li class="active"><a href="#"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
            <li><a href="#contactsupportmodal" data-toggle="modal"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Contact Support</a></li>
            <li><a href="#notesmodal" data-toggle="modal"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Notes</a></li>
            <li><a href="#helpguide" data-toggle="modal"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> User Guide</a></li>



            @if($showCert)

                <li><a href="#surveymodal" data-toggle="modal"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg>Course Survey</a></li>

                @if(Auth::user()->license==NULL  )
                    <li><a href="#licenseModal" data-toggle="modal" class="wow pulse" data-wow-iteration="infinite" data-wow-duration="1000ms"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Download Certificate</a></li>
                @else
                    <li><a href="#certificatemodal" data-toggle="modal" class="wow pulse" data-wow-iteration="infinite" data-wow-duration="1000ms"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Download Certificate</a></li>
                @endif
            @endif

            <li role="presentation" class="divider"></li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1" class="collapsed" aria-expanded="false">
                    <em class="fa fa-navicon">&nbsp;</em> Download Course PPTs <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right collapsed" aria-expanded="false"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1" aria-expanded="false" style="height: 0px;">
                    <li><a href="/PPT/Understanding_Procuring_Cause.ppt" class="">
                            <span class="fa fa-arrow-right">&nbsp;</span> Video 1
                        </a></li>
                    <li><a href="/PPT/Brokerage_in_a_Nutshell.pptx">
                            <span class="fa fa-arrow-right">&nbsp;</span> Video 2
                        </a></li>
                    <li><a href="/PPT/Disclose__Disclose_Disclose_part_1.ppt">
                            <span class="fa fa-arrow-right">&nbsp;</span> Video 3
                        </a></li>

                    <li><a href="/PPT/Disclose__Disclose_Disclose_part_2.ppt">
                            <span class="fa fa-arrow-right">&nbsp;</span> Video 4
                        </a></li>

                    <li><a href="/PPT/Mass_advertising_made_easy.ppt">
                            <span class="fa fa-arrow-right">&nbsp;</span> Video 5
                        </a></li>

                    <li><a href="/PPT/mass_advertising_part_2.pptx">
                            <span class="fa fa-arrow-right">&nbsp;</span> Video 6
                        </a></li>

                    <li><a href="/PPT/conflicts_power_point_with_dual_agency_edit.ppt">&nbsp;
                            <span class="fa fa-arrow-right">&nbsp;</span> Video 7
                        </a></li>

                    <li><a href="/PPT/conflicts_power_point_with_dual_agency-edit2.ppt">&nbsp;
                            <span class="fa fa-arrow-right">&nbsp;</span> Video 8
                        </a></li>

                    <li><a href="/PPT/Mass_Professionalism_Course.pptx">
                            <span class="fa fa-arrow-right">&nbsp;</span> Video 9
                        </a></li>

                    <li><a href="/PPT/Mass_Professionalism_Course_part2.pptx">
                            <span class="fa fa-arrow-right">&nbsp;</span> Video 10
                        </a></li>

                    <li><a href="/PPT/implementing_dual_agency_MASS__Autosaved_.pptx">
                            <span class="fa fa-arrow-right">&nbsp;</span> Video 11
                        </a></li>

                    <li><a href="/PPT/implementing_dual_agency_MASS_pt2_Autosaved_.pptx">
                            <span class="fa fa-arrow-right">&nbsp;</span> Video 12
                        </a></li>
                </ul>
            </li>


        </ul>


    </div><!--/.sidebar-->



    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <br><br>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-md-12">

                <div class="embed-responsive-item panel panel-default chat">
                    <div class="panel-heading" id="accordion"><svg class="glyph stroked two-messages"><use xlink:href="#stroked-two-messages"></use></svg>Welcome {{Auth::user()->name}}  </div>

                    <div class="panel col-md-offset-1">








                        <video id="my-video"
                               class="video-js"
                               controls

                               width="640" height="360"





                        >

                            <source src="{{request()->getSchemeAndHttpHost()}}/videos/1.mp4" type='video/mp4'>

                        </video>
                        <input type="hidden" id="user_id" value="{{Auth::user()->id}}">










                        <br>


                        <?php
                        $heading=VideoNames($video);
                        ?>
                        <h3>{{$heading}}</h3>

                    </div>

                    <div class="panel">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Module</th>
                                <th>Part I</th>
                                <th>Part II</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="success">
                                <td>Broker Responsibility in a Nutshell</td>
                                <td><i class="{{$videoStatus->vid1  ? 'glyphicon glyphicon-ok' : ''}}" ></i> <a class="" href="/home/video/1">Part 1</a></td>
                                <td><i class="{{$videoStatus->vid2  ? 'glyphicon glyphicon-ok' : ''}}" ></i> <a class="" href="/home/video/2">Part 2</a></td>
                            </tr>
                            <tr class="info">
                                <td>Disclose, Disclose, Disclose</td>
                                <td><i class="{{$videoStatus->vid3  ? 'glyphicon glyphicon-ok' : ''}}" ></i><a class="" href="/home/video/3">Part 1</a></td>
                                <td><i class="{{$videoStatus->vid4  ? 'glyphicon glyphicon-ok' : ''}}" ></i> <a class="" href="/home/video/4">Part 2</a></td>
                            </tr>
                            <tr class="success">
                                <td>Advertising Compliance</td>
                                <td><i class="{{$videoStatus->vid5  ? 'glyphicon glyphicon-ok' : ''}}" ></i><a class="" href="/home/video/5">Part 1</a> </td>
                                <td><i class="{{$videoStatus->vid6  ? 'glyphicon glyphicon-ok' : ''}}" ></i><a class="" href="/home/video/6">Part 2</a> </td>
                            </tr>
                            <tr class="info">
                                <td>Conflicts of Interest</td>
                                <td><i class="{{$videoStatus->vid7  ? 'glyphicon glyphicon-ok' : ''}}" ></i><a class="" href="/home/video/7">Part 1</a> </td>
                                <td><i class="{{$videoStatus->vid8  ? 'glyphicon glyphicon-ok' : ''}}" ></i><a  class="" href="/home/video/8">Part 2</a> </td>
                            </tr>
                            <tr class="success">
                                <td>Professional Ethics</td>
                                <td><i class="{{$videoStatus->vid9  ? 'glyphicon glyphicon-ok' : ''}}" ></i><a class="" href="/home/video/9">Part 1</a> </td>
                                <td><i class="{{$videoStatus->vid10  ? 'glyphicon glyphicon-ok' : ''}}" ></i><a class="" href="/home/video/10">Part 2</a> </td>
                            </tr>
                            <tr class="info">
                                <td>Dual Agency</td>
                                <td><i class="{{$videoStatus->vid11  ? 'glyphicon glyphicon-ok' : ''}}" ></i><a class="" href="/home/video/11">Part 1</a> </td>
                                <td><i class="{{$videoStatus->vid12  ? 'glyphicon glyphicon-ok' : ''}}" ></i><a class="" href="/home/video/12">Part 2</a> </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div><!--/.col-->


        </div>

    </div><!--/.col-->
</div>

</div>	<!--/.main-->

<script src="https://vjs.zencdn.net/7.3.0/video.js"></script>
<script src="/new/js/video.js"></script>











</body>

</html>
