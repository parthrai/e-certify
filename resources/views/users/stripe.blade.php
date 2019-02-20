
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Certify Education: School of Real Estate</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <script src="js/pace.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:700,400|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>

    <!-- If you're using Stripe for payments -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://js.stripe.com/v1/"></script>


    <script>
        function unapply(){
            document.cookie = "discount=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "code=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            location.reload();

        }
        function apply(){
            var Dcode = document.getElementById('discountcoupon').value

            $.ajax({
                type: "POST",
                url: "/api/admin/coupons/get",
                data: {code: Dcode},
                dataType:'JSON',
                success: function(response){
                    console.log(response);


                    document.cookie = "discount="+response;
                    document.cookie = "code="+Dcode;
                    location.reload();



                }
            });

        }
    </script>

    <script type="text/javascript" src="https://js.stripe.com/v1/"></script>

    <script type="text/javascript">
        Stripe.setPublishableKey('pk_test_hrnFfxX5E0AWQ2yczbNP2FZH');
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


    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #17a2b8;
            height: 100vh;
        }
    </style>

</head>
<body>
<div class="container" id="container" style="display:none;">

    <section id="form" class="animated fadeInDown">
        <div class="container">
            <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel white-alpha-90" >
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-6">
                                <div class="panel-title text-center"><h2><span class="text-primary">Payment</span></h2></div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-xs-6 text-right">
                                <a href="/logout" class="btn btn-danger">Logout</a>
                            </div>
                        </div>

                    </div>
                    <div class="panel-body" >
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <form action="/user/pay" method="POST" role="form" id="payment-form">
                            {{csrf_field()}}



                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Card Number</label>

                                <div class="col-md-6">
                                    <input
                                            type="tel"

                                            name="cardNumber"
                                            placeholder="Valid Card Number"
                                            autocomplete="cc-number"
                                            class="form-control checkout-input checkout-card" size="20" data-stripe="number"
                                            required autofocus
                                    />



                                </div>
                            </div>
                            <br><br>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Expiry</label>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input
                                                    type="tel"
                                                    class="form-control"
                                                    name="cardExpiry"
                                                    placeholder="MM"
                                                    autocomplete="cc-exp"
                                                    data-stripe="exp_month"
                                                    required
                                            />
                                        </div>

                                        <div class="col-md-6">
                                            <input
                                                    type="tel"
                                                    class="form-control"
                                                    name="cardExpiry"
                                                    placeholder="YY"
                                                    autocomplete="cc-exp"
                                                    data-stripe="exp_year"
                                                    required
                                            />

                                        </div>
                                    </div>





                                </div>
                            </div>


                            <br><br>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">CVV</label>

                                <div class="col-md-6">
                                    <input
                                            type="tel"

                                            name="cardCVC"
                                            placeholder="CVC"


                                            class="form-control checkout-input checkout-cvc" placeholder="CVC" size="4" data-stripe="cvc"
                                            required
                                    />


                                </div>
                            </div>


                            <br><br>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Coupon Code</label>

                                <div class="col-md-6">
                                    @if(isset($_COOKIE['discount']) && isset($_COOKIE['code']))


                                        @if($code=='undefined')
                                            <input type="text" class="form-control checkout-input checkout-name" name="coupon" size="11" id="discountcoupon" value="Invalid Code" disabled />

                                        @else
                                            <input type="text" class="form-control checkout-input checkout-name" size="11" id="discountcoupon" name="coupon" value="{{$code}}" disabled>
                                        @endif
                                        &nbsp;&nbsp;<a href="#" onclick="unapply()" class="btn btn-primary btn-xs"> Remove</a>
                                    @else


                                        <input type="text" id="discountcoupon" class="form-control checkout-input checkout-card" name="coupon" placeholder="Referral Code (Optional)">
                                        &nbsp;&nbsp;<a href="#" onclick="apply()" class="btn btn-primary btn-xs"> Apply</a>
                                    @endif



                                </div>
                            </div>



                          <br><br>





                            <input type="hidden" name="amount" value="{{$amount}}">


                            <div class="row">
                                <br><br>
                                <div class="col-xs-12">
                                    <button class="btn btn-success btn-lg btn-block" type="submit"  value="Pay ${{$amount/100}}">Pay ${{$amount/100}}</button>
                                </div>
                            </div>
                            <div class="row" style="display:none;">
                                <div class="col-xs-12">
                                    <p class="payment-errors"></p>
                                </div>
                            </div>




                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>

    </footer>
</div>


<script src="js/bootstrap.min.js"></script>

<script>
    Pace.on('hide', function(){
        $("#container").fadeIn('10');
        $.backstretch([
            "images/login/login_bg_1.jpg",
        ], {duration: 500, fade: 100});
    });

</script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-53918379-1', 'auto');
    ga('send', 'pageview');

</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>







