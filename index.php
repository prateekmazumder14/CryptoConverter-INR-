<?php require "options.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CryptoConverter/css/style.css">
    <title>Cryptocurrency Exchange Rates in INR</title>
</head>
<body>
    <div class="header">
    Cryptocurrency Exchange Rates in INR
    </div>
    <br>
    <div class="container">
    <form action="index.php" method="post">
        <?php $data = extract_coins(); echo options($data); ?>
        <br>
        <br>
        <input class="amount" step="any" type="number" name="amount" id="amount" placeholder="Enter Amount">
        <br>
        <br>
        <input class="btn" value="Convert" type="submit" name="done">
        <br>
        <br>
    </form>
    </div>
    <?php 
        if(isset($_POST['done'])){
            $coin = $_POST['coin'];
            $amount = $_POST['amount'];
            $pass = true;
            if($coin == "#" or empty($amount)){
                $pass = false;
            }
            if($pass){
                $url = "https://api.coingecko.com/api/v3/simple/price?ids=".$coin."&vs_currencies=inr";
                $curl = curl_init($url);
                curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
                if(curl_errno($curl)){
                    echo "<div class=\"error\">Error 500 : Internal Server Error</div>";
                }else{
                $res = curl_exec($curl);
                $arr = json_decode($res,true);
                echo "<div class=\"succ\">".$amount." ".strtoupper($coin)." = ".($arr[$coin]['inr']*$amount)." INR"."</div>";
                }
            }else{
                echo "<script>alert(\"Please enter a coin or a value\")</script>";
            }
        }
    ?>
    <footer>
    <div class="cgecko">Powered By <a href="http://www.coingecko.com/" target="_blank"><img class="cpic" src="./images/CoinGecko_Logo_Full-1024x320.png" alt="CoinGecko"></a></div>
    </footer>
</body>
</html>