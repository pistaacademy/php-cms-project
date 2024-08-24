<?php 

function users_online() {
    if(isset($_GET['onlineusers'])){
    global $connection;
    if(!$connection){
        session_start();
        include("../includes/db.php");

        $session = session_id();
        $time = time();
        $time_out_in_seconds = 20;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);
        if($count == NULL){
            $query = "INSERT INTO users_online(session, time) VALUES('$session','$time')";
            $insert_query = mysqli_query($connection, $query);
        } else {
            $query = "UPDATE users_online SET time = '$time' WHERE session = '$session'";
            $update_query = mysqli_query($connection, $query);
        }

        $query = "SELECT * FROM users_online WHERE time > '$time_out'";
        $users_online_query = mysqli_query($connection, $query);
        echo mysqli_num_rows($users_online_query);
    }
    
    }
}

users_online();

function confirmQuery($result) {
    global $connection;
    if(!$result){
        die("Query Faild" . mysqli_error($connection));
    }
}

function insert_categories() {
    global $connection;

    if(isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";
            $create_category_query = mysqli_query($connection, $query);
            if(!$create_category_query) {
                die('Query Failed' . mysqli_error($connection));
            }
            header("Location: categories.php");
        }
    }
}

function findAllCategories() {
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    }
}

function deleteCategories() {
    global $connection;

    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

?>