<?php
    require_once __DIR__."/../../../config.php";
    header("Content-Type: application/json; charset=UTF-8");
    
    if(isset($_GET["id"])){
        $id = htmlspecialchars($_GET["id"]);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"https://discord.com/api/v10/users/".$id); 
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array(
            "Authorization: Bot ".$token,
            "Content-type: application/json"
        ));
        $results =  curl_exec($ch);
        curl_close($ch);
        $user = json_decode($results,true);

        $user["avatar"] = "https://cdn.discordapp.com/avatars/".$user["id"]."/".$user["avatar"].is_animated($user["avatar"])."?size=1024";

        $res["success"] = true;
        $res["message"] = null;
        $res["data"] = $user;
    }else{
        $res["success"] = false;
        $res["message"] = "Parameter not found";
        $res["data"] = null;
    }
    
    print json_encode($res,JSON_UNESCAPED_SLASHES|JSON_PARTIAL_OUTPUT_ON_ERROR|JSON_UNESCAPED_UNICODE);

    function is_animated($image){
        $ext = substr($image,0,2);
        if($ext == "a_"){
            return ".gif";
        }else{
            return ".png";
        }
    }
?>