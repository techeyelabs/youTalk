 

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <style>
        
    </style>

<head>
    
</head>
<body>

    <div style="text-align:left;">
        <div style="display: inline-block; text-align:left;">
                <span><?php echo $data['buyer_name']; ?> 様</span>
                <br/>
                <br/>
                <span>このたびは、YouTalkをご利用いただきまして、誠にありがとうございます。</span><br/>
                <br>
                <span><?php echo $data['seller_name']; ?> 様とご希望の日程で予約を受付できませんでした。</span><br/>
                <span>お手数ですが、新たに日程を調整して予約申請をお願いします。</span>
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