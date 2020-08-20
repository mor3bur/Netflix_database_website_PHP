<html>
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body  style="text-align:center">
<h1> Add new tweet </h1>
<hr style="width:450px ;color:white ; border-style:solid">
<h2> Please fill the tweet details: </h2>


<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    Content: <textarea rows="4" cols="50" maxlength="280" name="CONTENT" required></textarea>
    <span class="error"> * </span>
    <br><br>
    User ID: <select name="USER" id ="ID" required>
        <option value=""> Choose User ID...</option>
        <?php
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
        $sql1 = "SELECT ID From Users;";
        $result1 = sqlsrv_query($conn, $sql1);
        while($row = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC))
        {
            ?>
            <option><?php
                if($row['ID'] != "ID")
                    {
                        echo $row['ID'];
                    }
                ?>
            </option>
            <?php
        }
        ?>
    </select>
    <span class="error"> * </span>
    <br><br>
    <input type="submit" name="submit" value="Send">
    <button type="reset" value="Clear"> Reset </button>
</form>

<?php
if (isset($_POST["submit"])){
    $sqlnum = "SELECT MAX(tID) FROM Tweets";
    $querynum = sqlsrv_query($conn,$sqlnum);
    $resultnum = sqlsrv_fetch_array($querynum);
    if (!$resultnum)
    {
        echo("Failed.<br>");
    }

    $fuser = $_POST['USER'];
    $fcontent = $_POST['CONTENT'];
    $ftid = $resultnum[0]+1;
    $ftime = date("Y-m-d h:i:s");

    $sqlt = "INSERT INTO Tweets(tID, uID, time) VALUES(".$ftid.",".$fuser.",'".$ftime."')";
    $resultt = sqlsrv_query($conn, $sqlt);

    $words = explode(" ", $fcontent);
    $idx = 1;
    $successw = 1;
    foreach ($words as $word)
    {
        $sqlw = "INSERT INTO Words(tID, idx, content) VALUES(".$ftid.",".$idx.",'".$word."')";
        $resultw = sqlsrv_query($conn, $sqlw);
        $idx = $idx + 1;
        if(!$resultw)
        {
            $successw = 0;
        }
    }
    if (!$resultt or !$successw )
    {
        echo("Couldn't add the tweet specified.<br>");
    }
    else {echo "The tweet has been added to the database successfully.<br><br>";}
}
?>
</body>
</html>

