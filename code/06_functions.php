<?php

    function registerUser($name){
        $x = 10;
        echo "User $name registered with the id $x <br>";
        echo "successfully registered <br>";
    }

    registerUser("Lucien");

    function sum($a, $b){
        return $a + $b;
    }

    echo "the sum of 12 and 3 is: " .sum(12, 3). "<br>";
    $result = sum(2, 42);

    $mult = fn($a, $b) => $a * $b; // arrow function and anonymous function

    echo $mult(23, 9);

?>