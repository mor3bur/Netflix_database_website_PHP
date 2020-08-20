<html>

<head>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body style="text-align:center">
<h1> Show User Connections </h1>
<hr style="width:450px ;color:white ; border-style:solid">

<h2> Select user ID: </h2>

<br>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    <select name="USER" required>
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
            ?></option>
            <?php
        }
        ?>
    </select>
    <span class="error"> * </span>
    <br><br>
    <input type="submit" name="submit" value="Show Connections">
    <button type="reset" value="Clear"> Reset </button>
</form>


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

if (isset($_POST["submit"]))
{
    $sql = "SELECT F.ID1 AS ID1, U.name as Fname
            FROM Friends F, Users U
            WHERE F.ID2 = U.ID
            ORDER BY Fname asc";
    $result = sqlsrv_query($conn, $sql);
    if (!$result) {
        echo("Failed.<br>");
    }
    $fuser = $_POST['USER'];

    echo "<table border='1' style='border:1px solid black ;margin-left:auto;margin-right:auto'>";
    echo '<tr><th> Friends of User '.$fuser.' :</th></tr>';
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
    {
        if ($row['ID1'] == $fuser)
        {
            echo '<tr><td style ="text-align:center">'.$row['Fname'].'</td></tr>';
        }
    }
    echo "</table>";
    echo '<br><br>';
    $sql1 = "SELECT F.ID1 AS ID1, U.name as Fname
             FROM HalfFriends F, Users U
             WHERE F.ID2 = U.ID
             ORDER BY Fname asc";
    $result1 = sqlsrv_query($conn, $sql1);
    if (!$result1)
    {
        echo("Failed.<br>");
    }

    echo "<table border='1' style='border:1px solid black ;margin-left:auto;margin-right:auto'>";
    echo '<tr><th> Semi-Friends of User '.$fuser.' :</th></tr>';
    while ($row = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC))
    {
        if ($row['ID1'] == $fuser)
        {
            echo '<tr><td style ="text-align:center">'.$row['Fname'].'</td></tr>';
        }
    }
    echo "</table>";
}
?>
</body>
</html>
