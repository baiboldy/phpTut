<?php
    include('includes/db.php');


    $todo = $_POST['todo'];
    if($todo) {
        $result = pg_query($connection, "INSERT into public.todo(name) VALUES('$todo')");
    }
    // $count = pg_query($connection, "SELECT * from public.users where login = '$login' AND pass = '$pass' ");
    header('Location: http://localhost:3000/HaudiTut/index.php');
    exit();

?>