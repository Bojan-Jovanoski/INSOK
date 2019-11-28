<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("DbLocal.php");
$view_sql = "SELECT * FROM news";
$q = $conn->query($view_sql);
$row = $q->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
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
    <div>
        <?php foreach($row as $data): ?>
            <div >
                <div>
                    <div >
                        <h2 class="naslov"><?= $data->news_title ?></h2>
                        <hr>
                        <?php if (strlen($data->full_text)>100): ?>
                          <div class="textot"><a href="/DetailedView.php?statija=<?php echo $data->news_id; ?>">Link do statijata</a></div>
                        <?php else: ?>
                        <p class="textot"><?= $data->full_text?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
            $comments_id=$data->news_id;
            $comments_sql = "SELECT * FROM comments WHERE news_id=$comments_id AND approved=1";
            $comments_query = $conn->query($comments_sql);
            $comments_row = $comments_query->fetchAll(PDO::FETCH_OBJ);
            ?>
            <div class="comments">
                <h3>Comments:</h3>
                <?php foreach($comments_row as $comment): ?>
                    <div class="comment">
                        <h4>Author: <?= $comment->author; ?></h4>
                        <p>Comment: <?= $comment->comment;?></p>
                    </div>

                <?php endforeach; ?>
            </div>
            <form action="" method="POST">
                <div class="input-group">
                    <label for="naslov">Avtor</label>
                    <input type="text" id="author" name="author">
                </div>
                <div class="input-group">
                    <label for="comment">Komentar</label>
                    <textarea type="text" id="comment" name="comment"></textarea>
                </div>
                <input type="hidden" name="submitted" value="submitted">
                <input type="submit">
                <hr style=" border: 3px solid #45a049;">

            </form>
            <?php
            $author = "";
            $comment = "";

            if(!empty($_POST["submitted"])){
                if(!empty($_POST["author"]) && !empty($_POST["comment"])){
                    $author = $_POST["author"];
                    $comment = $_POST["comment"];
                    $insert_comment = 'INSERT INTO comments (comment_id, news_id, author, comment, approved) VALUES (NULL,:news_id,:author,:comment,:approved)';
                    $insert_stmt = $conn->prepare($insert_comment);
                    $insert_stmt->execute([':news_id'=>$comments_id,':author'=>$author,':comment'=>$comment,":approved"=>0]);
                }
            }

            ?>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>

