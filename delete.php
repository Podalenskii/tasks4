<?php


require 'database/QueryBuilder.php';
$db = new QueryBuilder;
$id = $_GET['id'];
$db->delete($table, $id);


header('Location: http:./');exit;