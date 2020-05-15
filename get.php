<?php 
$dsn        = 'mysql:host=localhost;dbname=go;charset=utf8;';
$user       = 'username';
$password   = 'password';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$post   = json_decode(file_get_contents('php://input'));

$search = isset($post->search) ? $post->search : '';

$sql    = 'SELECT  name, surname,  gsmno,  code FROM users ';
if(!empty($search))
{
    if(is_numeric($search))
    {
        $sql .=  " WHERE gsmno LIKE '%{$search}%' ";
    }
    else 
    {
        $sql .= " WHERE CONCAT_WS(' ', name, name)  LIKE '%{$search}%' ";
    }
}

$sql .= ' ORDER BY id DESC LIMIT 50';
$sth    = $dbh->prepare($sql);
$sth->execute();
echo json_encode($sth->fetchAll(PDO::FETCH_OBJ));