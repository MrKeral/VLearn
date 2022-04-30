<?php

$f_name=$_POST['f_name'];
$l_name=$_POST['l_name'];
$email=$_POST['email'];
$pho_no=$_POST['pho_no'];
$user_id=$_POST['user_id'];
$create_pass=$_POST['create_pass'];
$conform_pass=$_POST['conform_pass'];

if (!empty($f_name) || !empty($l_name) || !empty($email) || !empty($pho_no) || !empty($user_id) || !empty($create_pass) || !empty($confirm_pass)) {
    $host = "localhost";
    $dbun="root";
    $dbp="";
    $dbn="virtual_data";

    $con=new mysqli($host, $dbun , $dbp , $dbn);
    if (mysqli_connect_error()) {
        die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
    } else {
        $SELECT="SELECT email From register where email = ? Limit 1";
        $INSERT="INSERT INTO register (f_name, l_name , email , pho_no , user_id , create_pass , conform_pass) values(?,?,?,?,?,?,?)";

        $stmt=$con->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum=$stmt->num_rows;

        if ($rnum==0) {
            $stmt->close();

            $stmt=$con->prepare($INSERT);
            $stmt->bind_param("sssisss", $f_name, $l_name, $email, $pho_no, $user_id, $create_pass, $conform_pass);
            $stmt->execute();
            header('Location: user page.html');
            exit;
            #echo '<a href="user page.html">Click here</a>';
        } else {
            echo "Someone already registerd using this email";
        }
        $stmt->close();
        $con->close();
    }
} else {
    echo "all filed are required";
    die();
}

?>