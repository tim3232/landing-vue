<?php
$data = json_decode(file_get_contents("php://input"), TRUE);
$action = $data['action'];
$mysqli = new mysqli("localhost", "root", "", "online"); // створюємо об'єкт mysqli
$mysqli->query("SET NAMES 'utf8' ");

if(($action == 'loadAllPosts')){

    $redirect = $mysqli->query("SELECT * FROM `cars` ");

    while ($row = $redirect->fetch_assoc()){
        $cars[] = $row;
    }

    echo json_encode($cars, true);
}

if(($action == 'delete')){
    $idDeletedPost = $data['id'];
    $mysqli->query("DELETE FROM `cars` WHERE id= $idDeletedPost");
    echo $idDeletedPost;
}


if($_POST['action'] == 'addNewPosts'){
    $title = $_POST['title'];
    $text = $_POST['text'];
    $price = $_POST['price'];

    $nameFile = basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], "img/".$_FILES['image']['name']);

    if(!$nameFile){
       $mysqli->query("INSERT INTO `cars` (title, text, price , src) VALUES ('$title', '$text', '$price' , 'default.jpg')");
    }
    else{
        $mysqli->query("INSERT INTO `cars` (title, text, price, src) VALUES ('$title', '$text', '$price' ,'$nameFile')");
    }

   $lastRow =  $mysqli->query("SELECT * FROM `cars` ORDER BY id DESC LIMIT 1");
   echo json_encode($lastRow->fetch_assoc());

}

if($_POST['action'] == 'changeNewPost'){

    $nameFile = basename($_FILES["image"]["name"]);
    $id = $_POST['id'];
    if(!empty($_FILES['image']['tmp_name'])){
        move_uploaded_file($_FILES["image"]["tmp_name"], "img/".$_FILES['image']['name']);
        $mysqli->query("UPDATE `cars` SET src='$nameFile' WHERE id= $id");
    }


    echo 500;
}
