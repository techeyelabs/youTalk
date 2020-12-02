<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <?php

        date_default_timezone_set('Asia/Dhaka');
        // $SiteID         = "tsite00028226";
        $SiteID         = "mst2000009679";
        // $ShopID         = "tshop00031453";
        $ShopID =  '9101225942865';
        // $ShopPassWord   = "xup3mw85";
        $ShopPassWord = 'k555429a';
        $OrderID        =  $orderNo;
        $Amount         =  $amount;
        $Tax            = "";
        $DateTime       =  $date;
        $values         = array( $ShopID,$OrderID,$Amount,$Tax,$ShopPassWord,$DateTime);
        $ShopPassString = md5( implode( "|", $values ) );
        $RetURL         = $retUrl;
        $CancelURL         = $cancelUrl;

        // $url = 'https://p01.mul-pay.jp/link/9101225942865/Multi/Entry'; //gateway, open later
        // $url = 'https://pt01.mul-pay.jp/link/tshop00031453/Multi/Entry';


        $url = $retUrl; //temporary closed gateway
    ?>

    <form  method="POST" action="<?php echo $url; ?>" name="payment-closed-gateway">
        <input type="hidden" name="ShopID"         value="<?php echo $ShopID; ?>" />
        <input type="hidden" name="OrderID"        value="<?php echo $OrderID; ?>" />
        <input type="hidden" name="DateTime"       value="<?php echo $DateTime; ?>" />
        <input type="hidden" name="Amount"       value="<?php echo $Amount; ?>" />
        <input type="hidden" name="Tax"            value="<?php echo $Tax; ?>" />
        <input type="hidden" name="ShopPassString" value="<?php echo $ShopPassString; ?>" />
        <input type="hidden" name="RetURL"         value="<?php echo $RetURL; ?>" />
        <input type="hidden" name="CancelURL"         value="<?php echo $CancelURL; ?>" />
        <input type="hidden" name="UseCredit"      value="1" />
        <input type="hidden" name="JobCd"          value="CAPTURE" />--}}

        {{-- <input type="hidden" name="UseJcbPreca"      value="1" />
        <input type="hidden" name="JobCd"          value="CAPTURE" /> --}}

        {{--<input type="hidden" name="SiteID"         value="<?php echo $SiteID; ?>" />
        <!-- <input type="submit" name="submit"         value="送信" /> -->
    </form>
    <form  method="POST" action="<?php echo $url; ?>" name="payment">
        <input type="hidden" name="Approve" value="Yes" />
        <input type="hidden" name="OrderID" value="<?php echo $OrderID; ?>" />
        <!-- <input type="submit" name="submit"         value="送信" /> -->
    </form>

    <script>
        document.forms["payment"].submit();
    </script>
</body>
</html>