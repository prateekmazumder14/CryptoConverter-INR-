<?php require "options.php" ?> //add the options.php script to the index.php
<!DOCTYPE html> //basic html boilerplate
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CryptoConverter/css/style.css">
    <title>Cryptocurrency Exchange Rates in INR</title>
</head>
<body>
    <div class="header">
    Cryptocurrency Exchange Rates in INR #Website header
    </div>
    <br>
    <div class="container">
    <form action="index.php" method="post">
        <?php $data = extract_coins(); echo options($data); ?> // the extract_coins() and options() functions are in options.php
        <br>
        <br>
        <input class="amount" step="any" type="number" name="amount" id="amount" placeholder="Enter Amount"> //amount input
        <br>
        <br>
        <input class="btn" value="Convert" type="submit" name="done"> //submit button
        <br>
        <br>
    </form>
    </div>
    <?php 
        //check if the values are submitted or not
        if(isset($_POST['done'])){
            $coin = $_POST['coin']; //store the coin input from html
            $amount = $_POST['amount']; //store the amount input from html
            $pass = true; //set a boolean 'pass' as false
            #if the amount is empty or coin is not selected
            if($coin == "#" or empty($amount)){
                $pass = false; //set 'pass as false
            }
            //if correct input is given
            if($pass){
                //store the API URL with the coin value
                $url = "https://api.coingecko.com/api/v3/simple/price?ids=".$coin."&vs_currencies=inr";
                //Initiate cURL to operate on url
                $curl = curl_init($url);
                //set return transfer option to fetch data from api
                curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
                //Show error if API is not connected
                if(curl_errno($curl)){
                    echo "<div class=\"error\">Error 500 : Internal Server Error</div>";
                }else{
                //Execute the URL through cURL
                $res = curl_exec($curl);
                //decode the JSON data sent from API to an Associative Array
                $arr = json_decode($res,true);
                //Show the output in the page
                echo "<div class=\"succ\">".$amount." ".strtoupper($coin)." = ".($arr[$coin]['inr']*$amount)." INR"."</div>";
                }
            }else{
                //if incorrect input is given alert the user
                echo "<script>alert(\"Please enter a coin or a value\")</script>";
            }
        }
    ?>
    <footer> //footer for the API website
    <div class="cgecko">Powered By <a href="http://www.coingecko.com/" target="_blank"><img class="cpic" src="./images/CoinGecko_Logo_Full-1024x320.png" alt="CoinGecko"></a></div>
    </footer>
</body>
</html>
