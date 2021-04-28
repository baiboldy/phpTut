<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Todos</title>
</head>

<?php 
    require 'includes/db.php';
    require 'includes/query.php';
    $data = getData($connection, 1);
    $pagination = getPagination($connection);
    // unset($_SESSION['search']);
    if (isset($_POST['pagination'])){
        $page = $_POST['id'];
        $_SESSION['pageId'] = $page;
        $data = getData($connection, $page);
        $pagination = getPagination($connection);
    }
    
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        deleteTodo($connection, $id);
    }
     
    if (isset($_POST['search']) AND isset($_POST['searchValue'])) {
        $_SESSION['search'] = $_POST['searchValue'];
        $data = getData($connection, 1);
        $pagination = getPagination($connection);
    }
?>

<body>
    <div class="header">
        <div class="container">
            <div class="content">
                <div class="title">
                    <a href="index.php">Todos</a>
                </div>
                <div class="add">
                    <div class="addForm">

                        <form action="./add.php" method="post">
                            <input type="text" name="todo">
                            <input type="submit" value="Добавить">
                        </form>
                    </div>
                    <div class="searchForm">
                        <form method="post">
                            <input type="text" name="searchValue">
                            <input type="submit" value="Поиск" name="search">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container">
            <div class="col">
                <div class="list">
                    <?php 
                        foreach ($data as $key => $value) { ?>
                            <div class="item">
                                <div class="row">
                                    <div class="text">
                                        <?php echo $value['name']?>
                                    </div>
                                    <div class="icon">
                                        <form method="POST">
                                            <?php
                                                echo  "<input type=hidden name=id value=".$value['id'].">";
                                            ?>
                                            <input type="submit" value="X" name="delete">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    ?>
                </div>
            </div>
            <div class="pagination">
                <?php
                for ($i=1; $i < ($pagination/10)+1; $i++) { ?>
                        <form method="POST">
                            <?php
                                echo "<input type=hidden name=id value=".$i.">";
                                echo "<input type=submit name='pagination' value=".$i.">";
                            ?> 
                            <!-- <div class="page">1</div> -->
                        </form>
                   <?php }
                ?>
            </div>
        </div>
    </div>
</body>

</html>