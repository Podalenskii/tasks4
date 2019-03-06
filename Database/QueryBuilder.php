<?php

class QueryBuilder
{
    public $pdo;
    function __construct()
{
    $this->pdo = new PDO("mysql:host=localhost; dbname=test", "root", "");
}
function all($table)
{
$sql = "SELECT * FROM $table";
$statement = $this->pdo->prepare($sql);//подготовить
$statement->execute(); //true||false
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
return $results;
    
}
function getOne($table, $id)
{
 $sql = "SELECT * FROM $table WHERE id=:id";
$statement = $this->pdo->prepare($sql);//подготовить
$statement->bindParam(":id",$id);
$statement->execute(); //true||false
$result = $statement->fetch(PDO::FETCH_ASSOC);

return $result; 
}
//Вывод новой задачи
function store($table, $data)
{
    $keys = array_keys($data);
    $stringOfKeys = implode(',', $keys);
    $planceholders = ":" .implode(', :', $keys);
    $sql = "INSERT INTO $table ($stringOfKeys) VALUES ($planceholders)";
    $statement = $this->pdo->prepare($sql);
    $statement->execute($data);  
}
//Изменение/обновление существующей задачи
function update($table, $data)
{
    $fields = '';
    foreach ($data as $key => $value){
        $fields .=$key . "=;" . $key . ",";
    }
    $fields = rtrim($fields,',');
$sql = "UPDATE $table SET $fields WHERE id=:id";
$statement = $this->pdo->prepare($sql);
$statement->execute($data);
}
//Удаление задачи
function delete($table, $id)
{
$sql = "DELETE FROM tasks WHERE id=:id";
$statement = $this->pdo->prepare($sql);
$statement->bindParam(":id", $id);
$statement->execute();
}
}
