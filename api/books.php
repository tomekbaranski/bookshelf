<?php
require_once './src/conn.php';
require_once './src/Book.php';

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $newBook = new Book();
    $newBook->setAuthor($_POST['author']);
    $newBook->setDescription($_POST['description']);
    $newBook->setName($_POST['name']);

    $newBook->saveToDB($conn);
}

if($_SERVER["REQUEST_METHOD"] === "GET"){
    if(isset($_GET['deleteid']) && $_GET['deleteid'] > 0){
        $newBook = new Book();
        $newBook->deleteFromDB($conn, $_GET['deleteid']);
        $result = $newBook->loadFromDB($conn, $_GET['deleteid']);
        echo(json_encode($result));
    }else{
        $allBooks = Book::GetAllBooks($conn);
        echo(json_encode($allBooks));
    }
}
?>



