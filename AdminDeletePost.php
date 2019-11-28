<?php
include_once("DbLocal.php");

$id = $_GET["news_id"];
$delete_sql = "DELETE FROM news WHERE news_id=:id";
$stmt = $conn->prepare($delete_sql);
$stmt->execute([':id' => $id ]);

header("Location: /AdminViewPost.php");