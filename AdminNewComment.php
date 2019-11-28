<?php
include_once("DbLocal.php");
$id = $_GET["news_id"];
if(!empty($id)){
    $not_approved_sql = "SELECT * FROM comments WHERE news_id=$id AND approved=0";
    $not_approved_query=$conn->query($not_approved_sql);
    $not_approved_comments = $not_approved_query->fetchAll(PDO::FETCH_OBJ);
}else{
    header("Location: /AdminViewPost.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin Preview Comments</title>
</head>
<body>
<div class="container">
    <table>
        <tr>
            <th>Comments Id</th>
            <th>News Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Delete</th>
            <th>Approve</th>
        </tr>
        <?php foreach($not_approved_comments as $data):?>
            <tr>
                <td><?= $data->comment_id; ?></td>
                <td><?= $data->news_id ?></td>
                <td><?= $data->author?></td>
                <td><?= $data->comment?></td>
                <td><a href="AdminDeleteComment.php?comment_id=<?=$data->comment_id;?>">Delete Comment</a></td>
                <td><a href="AdminApproveComment.php?comment_id=<?=$data->comment_id;?>">Approve Comment</a></td>
            </tr>
        <?php endforeach;?>
    </table>

    <h2><a href="AdminViewPost.php"><< Back To View News</a></h2>
</div>
</body>
</html>