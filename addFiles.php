<html>

<head>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body style="text-align:center">
<h1> Add Files </h1>
<hr style="width:450px ;color:white ; border-style:solid">
<br>

<h2> Please upload a file for User's table : </h2>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
    <input name="csv" type="file" id="csv" />
    <input type="submit" name="submitUsers" value="Submit">
</form>

<?php
if (isset($_POST["submitUsers"])){
// Connect to the database
    //count rows previously to the file
    $server = "tcp:techniondbcourse01.database.windows.net,1433";
    $user = "emilia0k";
    $pass = "Qwerty12!";
    $database = "emilia0k";
    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $conn = sqlsrv_connect($server, $c);
    if($conn === false)
    {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }

    $countSuc = 0;
    $countFail= 0;
    $file = $_FILES[csv][tmp_name];
    if (($handle = fopen($file, "r")) !== FALSE)
    {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
        {
            $sql="INSERT INTO Users (ID, name, cName) 
            VALUES('".addslashes($data[0])."','".addslashes($data[1])."','" .addslashes($data[2])."');";
       	    $res = sqlsrv_query($conn, $sql);
       	    if ($res)
            {$countSuc = $countSuc + 1; }
       	    else
            {$countFail = $countFail + 1;}
        }
      	  fclose($handle);
    }
    echo "Number of succeeded tuples uploads:  ".$countSuc ."<br><br>";
    echo "Number of failed tuples uploads:  ".$countFail;
}
?>
<br><br>

<h2> Please upload a file for Follows table : </h2>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
    <input name="csv" type="file" id="csv" />
    <input type="submit" name="submitFollows" value="Submit">
</form>

<?php
if (isset($_POST["submitFollows"])){
// Connect to the database
    //count rows previously to the file
    $server = "tcp:techniondbcourse01.database.windows.net,1433";
    $user = "emilia0k";
    $pass = "Qwerty12!";
    $database = "emilia0k";
    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $conn = sqlsrv_connect($server, $c);
    if($conn === false)
    {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }

    $countSuc = 0;
    $countFail= 0;
    $file = $_FILES[csv][tmp_name];
    if (($handle = fopen($file, "r")) !== FALSE)
    {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
        {
            $sql="INSERT INTO Follows (ID1, ID2) 
            VALUES('".addslashes($data[0])."','".addslashes($data[1])."');";
            $res = sqlsrv_query($conn, $sql);
            if ($res)
            {$countSuc = $countSuc + 1; }
            else
            {$countFail = $countFail + 1;}
        }
        fclose($handle);
    }
    echo "Number of succeeded tuples uploads:  ".$countSuc ."<br><br>";
    echo "Number of failed tuples uploads:  ".$countFail;
}
?>
<br><br>
<h2> Please upload a file for Tweets table : </h2>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
    <input name="csv" type="file" id="csv" />
    <input type="submit" name="submitTweets" value="Submit">
</form>

<?php
if (isset($_POST["submitTweets"])){
// Connect to the database
    //count rows previously to the file
    $server = "tcp:techniondbcourse01.database.windows.net,1433";
    $user = "emilia0k";
    $pass = "Qwerty12!";
    $database = "emilia0k";
    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $conn = sqlsrv_connect($server, $c);
    if($conn === false)
    {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }

    $countSuc = 0;
    $countFail= 0;
    $file = $_FILES[csv][tmp_name];
    if (($handle = fopen($file, "r")) !== FALSE)
    {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
        {
            $sql="INSERT INTO Tweets (tID, uID, time) 
            VALUES('".addslashes($data[0])."','".addslashes($data[1])."','".addslashes($data[2])."');";
            $res = sqlsrv_query($conn, $sql);
            if ($res)
            {$countSuc = $countSuc + 1; }
            else
            {$countFail = $countFail + 1;}
        }
        fclose($handle);
    }
    echo "Number of succeeded tuples uploads:  ".$countSuc ."<br><br>";
    echo "Number of failed tuples uploads:  ".$countFail;
}
?>

<br><br>
<h2> Please upload a file for Words table : </h2>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
    <input name="csv" type="file" id="csv" />
    <input type="submit" name="submitWords" value="Submit">
</form>

<?php
if (isset($_POST["submitWords"])){
// Connect to the database
    //count rows previously to the file
    $server = "tcp:techniondbcourse01.database.windows.net,1433";
    $user = "emilia0k";
    $pass = "Qwerty12!";
    $database = "emilia0k";
    $c = array("Database" => $database, "UID" => $user, "PWD" => $pass);
    sqlsrv_configure('WarningsReturnAsErrors', 0);
    $conn = sqlsrv_connect($server, $c);
    if($conn === false)
    {
        echo "error";
        die(print_r(sqlsrv_errors(), true));
    }

    $countSuc = 0;
    $countFail= 0;
    $file = $_FILES[csv][tmp_name];

    if (($handle = fopen($file, "r")) !== FALSE)
    {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
        {
            $sql="INSERT INTO Words(tID, idx, content) 
            VALUES('".addslashes($data[0])."', ".$data[1].", '".addslashes($data[2])."');";
            $res = sqlsrv_query($conn, $sql);
            if ($res)
            {$countSuc = $countSuc + 1; }
            else
            {$countFail = $countFail + 1;}
        }
        fclose($handle);
    }
    echo "Number of succeeded tuples uploads:  ".$countSuc ."<br><br>";
    echo "Number of failed tuples uploads:  ".$countFail;
}
?>
</body>
</html>

