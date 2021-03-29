<?php
    function extract_coins(){
        $url = "https://api.coingecko.com/api/v3/coins/list";
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        $res = curl_exec($curl);
        $arr = json_decode($res,true);
        return $arr;
    }
    function options($a){
        $select = "<select name=\"coin\" class=\"coin\"><option value=\"#\">-Select a Coin-</option>";
        foreach($a as $line){
            $select .= "<option value=\"".$line["id"]."\">".$line["name"]."(".strtoupper($line["symbol"]).")"."</option>";
        }
        $select .= "</select>";
        return $select;
    }
?>