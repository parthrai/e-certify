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

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal_container">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class=".col-sm-12 modal-header">


                    <h4 class=".col-sm-8 text-left modal-title">ACTIVATE YOUR ACCOUNT</h4>
                    <div class=".col-sm-4 text-right"><a class="fa fa-btn fa-sign-out" href="/logout">Logout</a></div>



                </div>
                <div class="modal-body">
                    <form action="/user/pay" method="POST" id="payment-form" class="checkout">
                        {{csrf_field()}}
                        <span class="payment-errors"></span>
                        <div class="checkout-header">
                            <h1 class="checkout-title">
                                <i class="fa fa-lock"> </i>&nbsp;&nbsp;    SECURE PAYMENT

                            </h1>
                        </div>

                        <p>
                            <input type="text" class="checkout-input checkout-card" size="20" data-stripe="number" placeholder="Card Number">

                        </p>

                        <p>
                            <input type="text" class="checkout-input checkout-exp"  size="2"  data-stripe="exp_month" placeholder="MM">
                            <input type="text" class="checkout-input checkout-exp" size="2" data-stripe="exp_year" placeholder="YY">
                            <input type="text" class="checkout-input checkout-cvc" placeholder="CVC" size="4" data-stripe="cvc" >
                        </p>
                        <p>

                            @if(isset($_COOKIE['discount']) && isset($_COOKIE['code']))


                                @if($code=='undefined')
                                    <input type="text" class="checkout-input checkout-name" size="11"  id="discountcoupon" name="coupon" value="Invalid Code" disabled>
                                @else
                                    <input type="text" class="checkout-input checkout-name" size="11" id="discountcoupon" name="coupon" value="{{$code}}" disabled>
                                @endif
                                &nbsp;&nbsp;<a href="#" onclick="unapply()" class="btn btn-primary btn-xs"> Remove</a>
                            @else


                                <input type="text" id="discountcoupon" class="checkout-input checkout-card" name="coupon" placeholder="Referral Code (Optional)">
                                &nbsp;&nbsp;<a href="#" onclick="apply()" class="btn btn-primary btn-xs"> Apply</a>
                            @endif

                        </p>


                        <p>
                            <input type="submit" class="submit btn btn-primary btn-md" value="Pay ${{$amount/100}}">                            </p>

                        </p>


                        <input type="hidden" name="amount" value="{{$amount}}">


                    </form>




                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .container {
        -webkit-filter: blur(6px) grayscale(80%);
    }

</style>
<script>

    $(document).ready(function(){



        $("#myModal").modal({
            backdrop: 'static',
            keyboard: false
        });



    });


</script>

<div class="container" id="app">
    <div class="row ustify-content-center">
        <!-- You can make it whatever width you want. I'm making it full width
             on <= small devices and 4/12 page width on >= medium devices -->



















    </div>
</div>

</body>
</html>