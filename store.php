<?php
require 'database/QueryBuilder.php';
$db = new QueryBuilder;
$data = [
    "title" => $_POST['title'],
    "content" => $_POST['content']
];
$tasks = $db->store("tasks", $data);
header('Location: http:./'); exit;