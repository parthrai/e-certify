




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

        <script>
            function unapply(){
                document.cookie = "discount=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                document.cookie = "code=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                location.reload();

            }
            function apply(){
                var Dcode = document.getElementById('discountcoupon').value

                $.ajax({
                    type: "GET",
                    url: "/applycoupons",
                    data: {code: Dcode},
                    dataType:'JSON',
                    success: function(response){
                        //console.log(response.amount.Amount);
                        document.cookie = "discount="+response.amount.Amount;
                        document.cookie = "code="+response.amount.Code;
                        location.reload();



                    }
                });

            }
        </script>




        <script src="//vjs.zencdn.net/ie8/1.1.1/videojs-ie8.min.js"></script>
        <link rel='stylesheet prefetch' href='https://vjs.zencdn.net/4.12/video-js.css'>
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

        <script type="text/javascript">
            Stripe.setPublishableKey('pk_live_zikzNkhhxgUVM1ojObgr9XPx');
            $(function() {
                var $form = $('#payment-form');
                $form.submit(function(event) {
                    // Disable the submit button to prevent repeated clicks:
                    $form.find('.submit').prop('disabled', true);

                    // Request a token from Stripe:
                    Stripe.card.createToken($form, stripeResponseHandler);

                    // Prevent the form from being submitted:
                    return false;
                });
            });

            function stripeResponseHandler(status, response) {
                // Grab the form:
                var $form = $('#payment-form');

                if (response.error) { // Problem!

                    // Show the errors on the form:
                    $form.find('.payment-errors').text(response.error.message);
                    $form.find('.submit').prop('disabled', false); // Re-enable submission

                } else { // Token was created!

                    // Get the token ID:
                    var token = response.id;

                    // Insert the token ID into the form so it gets submitted to the server:
                    $form.append($('<input type="hidden" name="stripeToken">').val(token));

                    // Submit the form:
                    $form.get(0).submit();
                }
            };
        </script>




    </head>





    <body>

        <div id="app">

            @if(!Auth::user()->account_status)
                <stripe-component></stripe-component>
            @else
            <div>



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


                    <!-- certificate modal -->


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

                    <!-- Notes Modal -->

                    <div class="modal fade" id="notesmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Notes</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" role="form" method="post" action="/savenotes">
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

                    <div class="modal fade" id="surveymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Course Survey</h4>
                                </div>
                                <div class="modal-body">
                                    <p> Help us improve our school. Please send us your comments and suggestions.</p>
                                    <form class="form-horizontal" role="form" method="post" action="/survey">
                                        <input type="hidden" name="_token" value="<?= csrf_token();?>">



                                        <br>



                                        <div class="form-group">

                                            <div class="col-sm-10">
                                                <textarea rows="5" cols="60" name="msg" placeholder = "Feedback" id="msg" class="form-control" ></textarea>



                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <! Will be used to display an alert to the user>
                                            </div>
                                        </div>


                                        <hr>
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









                                        <script src='https://vjs.zencdn.net/4.12/video.js'></script>

                                        <script src="../../js/index.js"></script>

                                        <br>



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

                                        </table>
                                    </div>

                                </div>

                            </div><!--/.col-->


                        </div>

                    </div><!--/.col-->
                </div><!--/.row-->
            </div>	<!--/.main-->


            @endif
        </div>

        <script src="{{URL::asset('js/jquery-1.11.1.min.js')}}"></script>
        <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>


        </div>


        </div>




</body>

</html>



