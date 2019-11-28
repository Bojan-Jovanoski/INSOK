<?php
include_once("DbLocal.php");
$id = $_GET["comment_id"];
$delete_comment_sql = "DELETE FROM comments WHERE comment_id=:comment_id";
$delete_stmt=$conn->prepare($delete_comment_sql);
$delete_stmt->execute([":comment_id"=>$id]);

header("Location: /AdminNewComment.php");

