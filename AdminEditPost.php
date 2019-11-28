<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("DbLocal.php");
$naslov = "";
$statija = "";
$id = $_GET["news_id"];
$sql = 'SELECT * FROM news WHERE news_id=:id';
$statement = $conn->prepare($sql);
$statement->execute([':id' => $id ]);
$data = $statement->fetch(PDO::FETCH_ASSOC);
if(!empty($_POST["submitted"])){
    if(!empty($_POST["naslov"]) && !empty($_POST["statija"])){
        $naslov=$_POST["naslov"];
        $statija=$_POST["statija"];
        $edit_sql = "UPDATE news SET news_title = :naslov, full_text = :statija WHERE news_id = :id";
        $stmt=$conn->prepare($edit_sql);
        $stmt->execute([':naslov'=>$naslov,':statija'=>$statija,':id'=>$id]);
        header("Location: /AdminViewPost.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Promeni Statija</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<h1>Edit POST</h1>
<form action="" method="POST">
    <div class="input-group">
        <label for="naslov">Naslov na novosta</label>
        <input type="text" id="naslov" name="naslov" value="<?= $data["news_title"]; ?>">
    </div>
    <div class="input-group">
        <label for="statija">Celosen text na novosta</label>
        <textarea type="text" id="statija" name="statija"><?= $data["full_text"]; ?></textarea>
    </div>
    <input type="hidden" name="submitted" value="submitted">
    <input type="submit">
</form>
</body>
</html>