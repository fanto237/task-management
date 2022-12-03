<?php

    $age = 12;

    // if($age >= 18){
    //     echo 'you are already major';
    // }else{
    //     echo 'you are still minor';
    // }

    $time = date('H');

    // echo $time;
    // if ($time < 12) {
    //     echo "Hey it is $time, so good morning !";
    // }elseif ($time < 17) {
    //     echo "It is $time, so Good Afternoon, man !";
    // }else{
    //     echo "Good evening ! it is $time";
    // }

    $frames = ['react', 'vue', 'angular'];

    // if(!empty($frames)){
    //         echo "$frames[0]";
    // }else{
    //     echo 'No Frames';
    // }

    echo !empty($frames) ? $frames[0] : 'No Frames';

    $fav_color = 'green';
    $red_color = 'red';
    $green_color = 'green';

    // if ($age >= 18) {    
        
    switch($fav_color){
        case'red':
            echo "your favorite color is $red_color ";
            break;
        case 'green':
            echo "your favorite color is $green_color";
            break;
        default:
            echo 'your favorite color is neither red nor green';
            break;
    }
    
?>
