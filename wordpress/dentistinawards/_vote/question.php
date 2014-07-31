<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "sql/mysql.php";
$posted = false;
$dentistName = null;
$dentistInfo = null;

if (array_key_exists('password', $_POST)) {
    $posted = true;

    $db = new mysql();
    if (!$db->connect()) {
        throw new Exception('Error establishing Database!');
    }

    $id = str_replace("DIA-", "", $_POST['password']);


    $dentistInfo = $db->getDentist($id);

    if ($dentistInfo) {
        $dentistName = str_replace("@@@", " ", $dentistInfo);
    }
} else {
    header('Location:index.php?code=false');
}

if (is_null($dentistName)) {
    header('Location:index.php?code=false');
}
//
//
//var_dump($posted);
//var_dump($dentistInfo);
//var_dump($dentistName);

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8"/>
    <title>Dentist In Awards | Survey Page</title>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="js/star-rating.js" type="text/javascript"></script>
<body>
<h1>Please fill the short survey</h1>
<br/> <br/>

<div class="container">
    <form method="get" action="thankyou.php">


        <div class="form-group">
            <label for="feedback">1. Which category would you put your visit and experience in?</label><br>
            <input type="radio" name="category" value="best-cosmetic-dentist"> Best Cosmetic Dentist </input><br>
            <input type="radio" name="category" value="best-dental-practice"> Best Dental Practice </input><br>
            <input type="radio" name="category" value="best-team"> Best Team </input><br>
            <input type="radio" name="category" value="best-practice-plan"> Best Practice Plan</input><br>
            <input type="radio" name="category" value="best-marketing"> Best Marketing </input><br>
        </div>
        <br>
        <br/> <br/>
        <label for="rating">2. Now how many stars would you give your answer? </label><br/>
        <label for="rating">Rate your Dentist : <?php echo $dentistName ?></php></label>
        <input id="input-21b" name="rating" value="0" type="number" class="rating" data-stars=10 min=0 max=10 step=0.2
               data-size="md">

        <div class="clearfix"></div>
        <br>
        <br/> <br/>
        <label for="details">Please enter your details</label><br/>
        <div class="control-group">
            <label class="control-label" for="name">Name</label>
            <div class="controls">
                <input type="text" name="name" id="name" placeholder="Your name">
            </div>
        </div>
        <br/>
        <div class="control-group">
            <label class="control-label" for="email">Email Address</label>
            <div class="controls">
                <input type="text" name="email" id="email" placeholder="Your email address">
            </div>
        </div>
        <br/> <br/>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Submit</button>
            <button type="reset" class="btn btn-default">Reset</button>
        </div>
    </form>
    <br>
    <script>
        jQuery(document).ready(function () {
            $(".rating-kv").rating();
        });
    </script>

</div>
</body>
</html>
