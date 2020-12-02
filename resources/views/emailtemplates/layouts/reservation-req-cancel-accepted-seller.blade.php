 

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <style>
        
    </style>

<head>
    
</head>
<body>

    <div style="text-align:left;">
        <div style="display: inline-block; text-align:left;">
                <span><?php echo $data['buyer_name']; ?> 様</span><br/>
                <br/>
                <span>このたびは、YouTalkをご利用いただきまして、誠にありがとうございます。</span><br/>
                <br>
                <span><?php echo $data['seller_name']; ?>様のご都合で<?php echo $data['date_time']; ?>の予約をキャンセルにされました。</span><br/>
                <span>ご了承をお願い致します。</span>
                <br>
                <br> 
            <footer style="text-align: left;">
                ----------------------------------------------------------<br/>
                https://YouTalk.tel
            </footer>
        </div>
    </div>      
</body>
</html>