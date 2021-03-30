<?php
    //this function extracts the coin data from the API
    function extract_coins(){
        //Store the URL
        $url = "https://api.coingecko.com/api/v3/coins/list";
        //Initiate cURL to operate on API
        $curl = curl_init($url);
        //Set the Option to RETURNTRANSFER to fetch data from the API
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        //Execute the URl thorugh cURL
        $res = curl_exec($curl);
        //If any Error occurs from the API send the error DATA
        if(curl_errno($curl)){
            return array("id"=> "NULL","name" => "Error : Could not find any coin","symbol"=>"NULL");
        }
        //Decode the JSON data sent from the API to an Associative Array
        $arr = json_decode($res,true);
        //Return the array
        return $arr;
    }
    function options($a){
        //Initiate a Select tag for the coins with no value in the first option
        $select = "<select name=\"coin\" class=\"coin\"><option value=\"#\">-Select a Coin-</option>";
        //Add all the coins to the Select tag as options with id's of the coins as value for the options
        foreach($a as $line){
            $select .= "<option value=\"".$line["id"]."\">".$line["name"]."(".strtoupper($line["symbol"]).")"."</option>";
        }
        //End the select tag
        $select .= "</select>";
        //Return the tag
        return $select;
    }
?>
