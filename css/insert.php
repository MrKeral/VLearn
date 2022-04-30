<?php

$namee=$_POST['namee'];
$uname=$_POST['uname'];
$email=$_POST['email'];
$pho=$_POST['num'];
$pwd=$_POST['pwd'];
$sc=$_POST['secque'];

if (!empty($namee) || !empty($uname) || !empty($email) || !empty($pho) || !empty($pwd) || !empty($sc)) {
    $host = "localhost";
    $dbun="root";
    $dbp="";
    $dbn="virtual_data";

    $con=new mysqli($host, $dbun , $dbp , $dbn);
    if (mysqli_connect_error()) {
        die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
    } else {
        $SELECT="SELECT email From info where email = ? Limit 1";
        $INSERT="INSERT INTO info (namee,uname,email,pho,pwd,sc) values(?,?,?,?,?,?)";

        $stmt=$con->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum=$stmt->num_rows;

        if ($rnum==0) {
            $stmt->close();

            $stmt=$con->prepare($INSERT);
            $stmt->bind_param("sssiss",$namee,$uname,$email,$pho,$pwd,$sc);
            $stmt->execute();
            echo "New record inserted sucessfully";
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
