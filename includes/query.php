<?php
    function deleteTodo($connection, $id)
    {
        pg_query($connection, "DELETE from public.todo where id = $id");
        header("Refresh:0");
    }

    function getData($connection, $page) {
        $pageResult = intval(($page - 1) *  10);
        
        $sqlQuery = "SELECT * FROM public.todo";
        if (isset($_SESSION['search'])){
            $search = $_SESSION['search'];
            $sqlQuery = $sqlQuery." WHERE name ilike '%$search%'";
        }
        $sqlQuery = $sqlQuery. " ORDER BY id OFFSET $pageResult ROWS FETCH NEXT 10 ROWS ONLY";
        $query = pg_query($connection, $sqlQuery);
        $result = array();
        while ($val = pg_fetch_assoc($query)) {
            array_push($result, array(
                "id" => $val['id'],
                "name" => $val['name']        
            ));
        }
        $paginationCount = pg_num_rows($query);
        // $_SESSION['data'] = $result;
        // $_SESSION['paginationCount'] = $paginationCount;
        // header("Refresh:0");
        // header('Location: http://localhost:3000/HaudiTut/index.php');
        return $result;
    }

    function getPagination($connection){
        $sqlQuery = "SELECT count(id) as count FROM public.todo";
        if (isset($_SESSION['search'])){
            $search = $_SESSION['search'];
            $sqlQuery = $sqlQuery." WHERE name ilike '%$search%'";
        }

        $query = pg_query($connection, $sqlQuery);
        $result = null;
        while ($val = pg_fetch_assoc($query)) {
            $result = $val['count'];
        }
        return $result;

    }
?>