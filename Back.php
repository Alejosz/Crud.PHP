<?php
include('service.php');

$pdo = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $sql = $pdo->prepare("SELECT * FROM users WHERE id=:id");
        $sql->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit;
    } else {
        $sql = $pdo->prepare("SELECT * FROM users");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 OK");
        echo json_encode($sql->fetchAll());
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO users ( name, lastname,  username, password,  email) VALUES (:name, :lastname, :username, :password, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $_POST['name']);
    $stmt->bindValue(':lastname', $_POST['lastname']);
    $stmt->bindValue(':username', $_POST['username']);
    $stmt->bindValue(':password', $_POST['password']);
    $stmt->bindValue(':email', $_POST['email']);
    $stmt->execute();
    $idPost = $pdo->lastInsertId();
    if ($idPost) {
        header("HTTP/1.1 200 OK");
        echo json_encode($idPost);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $sql = "UPDATE users SET name=:name, lastname=:lastname,  username=:username, password=:password,  email=:email WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id',       $_GET['id']);
    $stmt->bindValue(':name',     $_GET['name']);
    $stmt->bindValue(':lastname', $_GET['lastname']);
    $stmt->bindValue(':username', $_GET['username']);
    $stmt->bindValue(':password', $_GET['password']);
    $stmt->bindValue(':email',    $_GET['email']);
    $stmt->execute();

            header("HTTP/1.1 200 OK");
            exit;
    
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $sql = "DELETE FROM users  WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
            header("HTTP/1.1 200 OK");
            exit;
}
?>




