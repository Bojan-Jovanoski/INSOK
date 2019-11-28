<?php
$id = $_GET["comment_id"];
include_once("DbLocal.php");

$approve_comment_sql = "UPDATE comments SET approved=1 WHERE comment_id=:id";
$approve_comment_stmt = $conn->prepare($approve_comment_sql);
$approve_comment_stmt->execute([":id"=>$id]);
header("Location: /AdminNewComment.php");