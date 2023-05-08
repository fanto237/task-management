<?php

    if(isset($_GET["submit"])){
        echo "the name is: ".$_GET["name"]. " and the password is: " .$_GET["age"];
    }

?>

<a href="<?php echo $_SERVER["PHP_SELF"]?>?name=Lucien&password=fanto"> click </a>


<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="get">
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