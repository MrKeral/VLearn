<?php
$uid=$_POST['user_id'];
$pwd=$_POST['create_pass'];
$user = 'root';
$password = '';

$database = 'virtual_data';

$servername='localhost:3306';
$mysqli = new mysqli($servername, $user, $password, $database);

if ($mysqli->connect_error) {
	die('Connect Error (' .
	$mysqli->connect_errno . ') '.
	$mysqli->connect_error);
}

// SQL query to select data from database
$sql = "SELECT * FROM register";
$result = $mysqli->query($sql);
for($row_no=$result->num_rows -1;$row_no>0;$row_no--)
{
    $row=$result->fetch_row();
    if($row[4] == $uid && $row[5] == $pwd)
    {
        header('Location: levels.html');
            exit;
    }
}

$mysqli->close();


?>
