<html>
<head>
    <title></title>

    <?php

    $today= date('m-d-Y');


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

Dear {{Auth::user()->name}},

<p>Thank you for choosing E-Certify Education School of Real Estate to renew your real estate license. We appreciate your business.<br>
<br>
<b>PURCHASE INFORMATION</b><br>
<br>
Description: 12-hour Massachusetts real estate continuing education course.<br>
Order Date:{{$today}}<br>
Purchaser Email: {{Auth::user()->email}}<br>
Amount Paid: ${{$amount/100}} USD<br>
<br>
Please contact us if you have any questions.<br>
<br>
Thanks again,<br>
<br>

<p>E-Certify Education, LLC<br>
    Address: PO Box 140368 Boston, MA 02114<br>
    Toll Free: 800-490-8992<br>
    Office: 617-835-9748<br>
    support@ecertifyeducation.com</p>

</p>
</body>
</html>