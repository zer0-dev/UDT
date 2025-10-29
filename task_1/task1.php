<?php
$filename = "mock_data.json";
$file = fopen($filename, "r");
if($file){
    $data = json_decode(fread($file, filesize($filename)));
    fclose($file);

    echo "Users\n-------------------\n";
    foreach ($data->users as $user){
        foreach ($user as $k => $v){
            echo "$k: $v\n";
        }
        echo "-------------------\n";
    }

    echo "\nDeals\n-------------------\n";
    foreach ($data->deals as $deal){
        if($deal->STATUS == "WON"){
            foreach ($deal as $k => $v){
                echo "$k: $v\n";
            }
            echo "-------------------\n";
        }
    }
} else {
    echo "Error opening file";
}