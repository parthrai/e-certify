<!DOCTYPE html>
    <html>
    <head>



        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome {{Auth::user()->name}}</title>

        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/datepicker3.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/animate.css') }}" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <script src="{{ URL::asset('js/wow.min.js') }}"></script>

        <script>
            new WOW().init();
        </script>

        <!--Icons-->
        <script src="{{ URL::asset('js/lumino.glyphs.js') }}"></script>

        <!--[if lt IE 9]>
        <script src="{{ URL::asset('js/html5shiv.js') }}"></script>
        <script src="{{ URL::asset('js/respond.min.js') }}"></script>
        <![endif]-->


        <link rel="stylesheet" href="{{asset('checkouts/css/style.css')}}">







        <script src="https://cdnjs.cloudflare.com/ajax/libs/store.js/1.3.17/store.min.js"></script>

        <style>
            .responsive-video {
                max-width: 100%;
                height: auto;
            }
        </style>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
        <script type="text/javascript" src="https://js.stripe.com/v1/"></script>

        <script src="{{ asset('js/app.js') }}" defer></script>


        <link href="//vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
        <script src="//vjs.zencdn.net/7.3.0/video.min.js"></script>




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

<div>

<div id="app">






<div class="container" id="app">



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

    <!-- video modal -->

    <div class="modal fade" id="videomodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <p>Please click the "Resume" button to continue playing the course video.</p>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Resume</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- video modal -->

    <!-- certificate modal -->




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


    <!-- contact support modal -->




    <!-- contact support modal -->

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


    <!-- survey modal -->




    <!-- survey modal -->

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

                <li><a href="#certificatemodal" data-toggle="modal" class="wow pulse" data-wow-iteration="infinite" data-wow-duration="1000ms"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Download Certificate</a></li>
            @endif

            <li role="presentation" class="divider"></li>

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

                       <video-component user_id="{{Auth::user()->id}}"></video-component>











                        <br>


                        <?php
                        $heading=VideoNames($video);
                        ?>
                        <h3>{{$heading}}</h3>

                    </div>

                    <table-component></table-component>

                </div>

            </div><!--/.col-->


        </div>

    </div><!--/.col-->
</div><!--/.row-->
</div>	<!--/.main-->
</div>

<script src="{{URL::asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>



</div>
</body>

</html>
