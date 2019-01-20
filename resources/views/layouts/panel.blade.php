<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Certify Education: School of Real Estate</title>

    <link href="/css/admin/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin/datepicker3.css" rel="stylesheet">
    <link href="/css/admin/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="/js/admin/lumino.glyphs.js"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->


    <!--[if lt IE 9]>
    <script src="/js/admin/html5shiv.js"></script>
    <script src="/js/admin/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>




    <![endif]-->







</head>


<body>

<div id="app">
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-transform:uppercase;"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> {{Auth::user()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">


                        <li><a href="{{ url('/logout') }}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>




    </div><!-- /.container-fluid -->
</nav>

<!-- change password modal -->
<div class="modal fade" id="changepass" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <form role="form" action="/changepass">
                    <div class="form-group">
                        <label for="email">Current Password:</label>
                        <input type="email" class="form-control" id="current_pass" >
                    </div>
                    <div class="form-group">
                        <label for="pwd">New Password:</label>
                        <input type="password" class="form-control" id=new_pass">
                    </div>

                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- change password modal -->



<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li class="active"><a href="/home"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
        <li><a href="/admin/coupons/list"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Manage Coupons</a></li>

        <li><a href="/admin/users/list"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>All Users</a></li>







        <li role="presentation" class="divider"></li>
        <li><a href="{{ url('/logout') }}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Logout</a></li>
    </ul>

</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div><!--/.row-->






    <div class="row">

        @yield('content')

    </div>



    <!--/.row-->
</div>	<!--/.main-->

<!-- section for video completion status -->



<!-- section for video completion status -->






<!--- email all users modal -->

<div class="modal fade" id="EmailAllUsers" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Email All Users</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" action="emailall">
                    <input type="hidden" name="_token" value="<?= csrf_token();?>">

                    <div class="form-group">
                        <label for="message" class="white col-sm-2 control-label">Subject</label>
                        <div class="col-sm-10">
                            <input type="text" name="subject" class="form-control">
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
        </div>

    </div>
</div>

<!-- email all user modal -->

<!-- email single user modal -->

<div class="modal fade" id="EmailSingleUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Email User</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" action="emailuser">
                    <input type="hidden" name="_token" value="<?= csrf_token();?>">


                    <div class="form-group">
                        <label for="email" class="white col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="white col-sm-2 control-label">Subject</label>
                        <div class="col-sm-10">
                            <input type="text" name="subject" class="form-control">
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
<div class="row">
    @if (Session::has('flash_message'))
        <script>
            alert('{{ Session::get('flash_message') }}');
        </script>


    @endif


</div>

<!-- email single user modal -->

<script src="{{asset('js/admin/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('js/admin/bootstrap.min.js')}}"></script>
<script src="{{asset('js/admin/chart.min.js')}}"></script>
<script src="{{asset('js/admin/chart-data.js')}}"></script>
<script src="{{asset('js/admin/easypiechart.js')}}"></script>
<script src="{{asset('js/admin/easypiechart-data.js')}}"></script>
<script src="{{asset('js/admin/bootstrap-datepicker.js')}}"></script>
</div>
</body>

</html>
