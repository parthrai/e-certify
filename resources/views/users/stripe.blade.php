<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <!--
    The MIT License (MIT)

    Copyright (c) 2015 William Hilton

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    THE SOFTWARE.
    -->
    <!-- Vendor libraries -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>

    <!-- If you're using Stripe for payments -->

    <script type="text/javascript" src="https://js.stripe.com/v1/"></script>

<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #17a2b8;
        height: 100vh;
    }
    #login .container #login-row #login-column #login-box {
        margin-top: 120px;
        max-width: 600px;
        height: 320px;
        border: 1px solid #9C9C9C;
        background-color: #EAEAEA;
    }
    #login .container #login-row #login-column #login-box #login-form {
        padding: 20px;
    }
    #login .container #login-row #login-column #login-box #login-form #register-link {
        margin-top: -85px;
    }
</style>


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





</head>
<body>
<div id="login">

    <div class="container">


        <br><br>

        <div class="col-xs-12 col-md-6 col-md-offset-3">


            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >

                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <h2 > Payment Details</h2>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="display-td" >
                                    <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="panel-body">
                    <form action="/user/pay" method="POST" role="form" id="payment-form">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber">CARD NUMBER</label>
                                    <div class="input-group">
                                        <input
                                                type="tel"

                                                name="cardNumber"
                                                placeholder="Valid Card Number"
                                                autocomplete="cc-number"
                                                class="form-control checkout-input checkout-card" size="20" data-stripe="number"
                                                required autofocus
                                        />
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-md-4">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs">MM</span><span class="visible-xs-inline"></span> </label>
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
                            </div>


                            <div class="col-xs-4 col-md-4">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs">YY</span><span class="visible-xs-inline"></span> </label>
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


                            <div class="col-xs-4 col-md-4 pull-right">
                                <div class="form-group">
                                    <label for="cardCVC">CVV CODE</label>
                                    <input
                                            type="tel"

                                            name="cardCVC"
                                            placeholder="CVC"


                                            class="form-control checkout-input checkout-cvc" placeholder="CVC" size="4" data-stripe="cvc"
                                            required
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="couponCode">COUPON CODE</label>

                                    <p>

                                        @if(isset($_COOKIE['discount']) && isset($_COOKIE['code']))


                                            @if($code=='undefined')
                                                <input type="text" class="form-control checkout-input checkout-name" name="coupon" size="11" id="discountcoupon" value="Invalid Code" disabled />

                                            @else
                                                <input type="text" class="form-control checkout-input checkout-name" size="11" id="discountcoupon" name="coupon" value="{{$code}}" disabled>
                                            @endif
                                            &nbsp;&nbsp;<a href="#" onclick="unapply()" class="btn btn-primary btn-xs"> Remove</a>
                                        @else


                                            <input type="text" id="discountcoupon" class="checkout-input checkout-card" name="coupon" placeholder="Referral Code (Optional)">
                                            &nbsp;&nbsp;<a href="#" onclick="apply()" class="btn btn-primary btn-xs"> Apply</a>
                                        @endif

                                    </p>






                                </div>
                            </div>
                        </div>





                        <input type="hidden" name="amount" value="{{$amount}}">


                        <div class="row">
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
            <!-- CREDIT CARD FORM ENDS HERE -->




        </div>
    </div>
</div>
</body>


</html>