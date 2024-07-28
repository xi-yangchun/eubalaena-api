<?php
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', FALSE );
header('Pragma:no-cache');
exec("date >> eubalaena-call-log.txt");
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    //  get raw data from the request 
    $json = file_get_contents('php://input');
    // Converts json data into a PHP object 
    $data = json_decode($json, true);

    if(isset($data["create_thread"])){
        exec("cd ~/Eubalaena; "
        ."python3 create_thread.py "
        ."'{$data["title"]}' '{$data["name"]}' '{$data["content"]}'");
    }else if(isset($data["add_post"])){
        exec("cd ~/Eubalaena; ".
        "python3 add_post.py "
        ."'{$data["thread_id"]}' '{$data["name"]}' '{$data["content"]}'");      
    }else if(isset($data["get_thread"])){
        //file_get_contentsは相対パスなので、../Eubalaenaから始める。~/が使えない。
        $jsont = file_get_contents("../Eubalaena/threads/{$data["thread_id"]}.json");
        // 文字エンコーディングの変換（文字化け対策）
        $jsont = mb_convert_encoding($jsont, "UTF-8", "ASCII, JIS, UTF-8, EUC-JP, SJIS-WIN");
        exec("echo ".'"'.$jsont.'"'.">>posts.txt");
        // JSONデータを連想配列に変換
        $arr = json_decode($jsont, true);
        $json_ret=json_encode($arr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        echo $json_ret;
    }else if(isset($data["get_index"])){
        exec("cd ~/Eubalaena; ".
        "python3 get_index.py");
        //file_get_contentsは相対パスなので、../Eubalaenaから始める。~/が使えない。
        $jsont = file_get_contents("../Eubalaena/index.json");
        // 文字エンコーディングの変換（文字化け対策）
        $jsont = mb_convert_encoding($jsont, "UTF-8", "ASCII, JIS, UTF-8, EUC-JP, SJIS-WIN");
        // JSONデータを連想配列に変換
        $arr = json_decode($jsont, true);
        $json_ret=json_encode($arr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        echo $json_ret;
    }
}

?>