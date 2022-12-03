<?php

    if(isset($_GET["submit"])){
        // $name = htmlspecialchars($_GET["name"]);
        // $age = htmlspecialchars($_GET["age"]);

        $name = filter_input(INPUT_GET, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        echo $name;
        // echo $age;
    }

?>



<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="get">
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="age">Age:</label>
        <input type="text" name="age" id="age">
    </div>
    <input type="submit" value="submit" name="submit">
</form>