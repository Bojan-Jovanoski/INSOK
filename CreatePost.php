<?php
include_once("DbLocal.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$naslov="";
$statija="";
if(!empty($_POST["submitted"])){
    if(!empty($_POST["naslov"]) && !empty($_POST["statija"])){
        $naslov = $_POST["naslov"];
        $statija = $_POST["statija"];
        $date = date_create();
        $finalDate=date_format($date, 'Y-m-d H:i:s');
        $sql = 'INSERT INTO news (news_id,date ,news_title, full_text) VALUES (NULL,:newsDate,:naslov, :statija)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([':naslov'=>$naslov,':statija'=>$statija,':newsDate'=>$finalDate]);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Kreiraj Statija</title>
</head>
<body>
<div class="container">
    <div class="nav">
        <ul>
            <li><a href="index.php">Public View</a></li>
            <li><a href="AdminViewPost.php">Admin View</a></li>
            <li><a href="CreatePost.php">Create-Post</a></li>
        </ul>
    </div>
    <h1>News Admin Panel</h1>
    <form action="" method="POST">
        <div class="input-group">
            <label for="naslov">Naslov na novosta</label>
            <input type="text" id="naslov" name="naslov">
        </div>
        <div class="input-group">
            <label for="statija">Celosen text na novosta</label>
            <textarea rows = "5" cols = "103" type="text" id="statija" name="statija"></textarea>
        </div>
        <input type="hidden" name="submitted" value="submitted">
        <input type="submit">
    </form>
</div>
</body>
</html>
