<?php
    header("Content-Type: application/json; charset=UTF-8");
    
    $res["status"] = "success";
    $res["message"] = null;
    $res["data"] = "Hello";
    
    print json_encode($res,JSON_UNESCAPED_SLASHES|JSON_PARTIAL_OUTPUT_ON_ERROR);
?>