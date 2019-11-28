<?php
include_once ("DbLocal.php");
if(isset($_GET["statija"]))
    {
    $statija_id = $_GET["statija"];
    $sql = 'SELECT * FROM news WHERE news_id=:id';
    $statement = $conn->prepare($sql);
    $statement->execute([':id' => $statija_id ]);
    $data = $statement->fetch(PDO::FETCH_OBJ);
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Public View</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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


    <div >
    <div>
        <div >
            <h2 class="naslov"><?= $data->news_title ?></h2>
            <hr>
                <p class="textot"><?= $data->full_text?></p>
        </div>
    </div>
</div>
</div>
</body>