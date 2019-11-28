<?php
include_once("DbLocal.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin Preview Post</title>
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
    <h1>Admin Preview Posts</h1>
    <table id="mojatabela">
        <tr>
            <th>News id</th>
            <th>Date</th>
            <th>News title</th>
            <th>News Article</th>
            <th>Comments</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        $view_sql = "SELECT * FROM news";
        $q = $conn->query($view_sql);
        $row = $q->fetchAll(PDO::FETCH_OBJ);

        foreach($row as $data):
            ?>
            <?php
            $search_id = $data->news_id;
            $comments_sql = "SELECT * FROM comments WHERE news_id=$search_id AND approved=0";
            $comments_query = $conn->query($comments_sql);
            $num_comments = $comments_query->rowCount();
            ?>
            <tr>
                <td><?= $data->news_id; ?></td>
                <td><?= $data->date;?></td>
                <td><?= $data->news_title;?></td>
                <td><?= $data->full_text;?></td>
                <td><a href="AdminNewComment.php?news_id=<?=$data->news_id;?>">New Comments(<?= $num_comments;?>)</a></td>
                <td><a href="AdminEditPost.php?news_id=<?=$data->news_id;?>">Edit<a></td>
                <td><a href="AdminDeletePost.php?news_id=<?=$data->news_id;?>">Delete<a></td>

            </tr>
        <?php endforeach;?>
    </table>
</div>
</body>
</html>