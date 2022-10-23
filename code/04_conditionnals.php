<?php

    $age = 12;

    if($age >= 18){
        echo 'you are already major';
    }else{
        echo 'you are still minor';
    }

    $time = date('H');
    echo $time;

    if ($time < 12) {
        echo "Hey, good morning !";
    }elseif ($time < 17) {
        echo "Good Afternoon, man !";
    }else{
        echo "Good evening !";
    }
?>
