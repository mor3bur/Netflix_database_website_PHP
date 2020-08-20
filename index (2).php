<html>

<head>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body style="text-align:center">
<h1> Twitter Information Website </h1>
<h2> Welcome to the website were you can edit and view Twitter database </h2>
<img src="Twitter.gif" alt="Twitter" style="width:450px; height: 300px;">
<hr style="width:450px ;color:white ; border-style:solid">

<a href="addFiles.php" target="mainFrame" style="font-size:24px">Add new files</a><br>
<br>
<a href="addTweet.php" target="mainFrame" style="font-size:24px">Add a new tweet</a><br>
<br>
<a href="showConnection.php" target="mainFrame" style="font-size:24px">Show user connections</a><br>
<br>

<br>

<h2> Twitter Statistics </h2>
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
$sql1="SELECT uID as maxTweeter
        FROM Tweets
        GROUP BY uID
        HAVING COUNT (tID)=(SELECT MAX(M.count)
                            FROM (SELECT uID, COUNT(tID) AS count
                                  FROM Tweets
                                  GROUP BY uID) M )" ;
$result1 = sqlsrv_query($conn, $sql1);
$row = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC);
$maxTweeter = $row['maxTweeter'];

$sql2="SELECT cName
      FROM (SELECT cName, COUNT(tID) as numTweets
            FROM Tweets T, Users U
            WHERE T.uID = U.ID
            GROUP BY U.cName) C
      WHERE numTweets >= ALL (SELECT COUNT(tID) as numTweets
                              FROM Tweets T, Users U
                              WHERE T.uID = U.ID
                              GROUP BY U.cName)";
$result2 = sqlsrv_query($conn, $sql2);
$row = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC);
$countryMax= $row['cName'];

$sql3="SELECT convert(varchar(20), Ratio) as Ratio
       FROM (SELECT CAST(1.0*(C1.numCorona)/N1.num as decimal(10,2)) as Ratio
             FROM (SELECT Count(*) as numCorona 
                   FROM(SELECT tID as numCorona
                        FROM Words
                        WHERE content LIKE '%Corona%'
                        GROUP BY tID) C) C1,
                   (SELECT Count(*) as num 
                    FROM(SELECT COUNT(tID) as num
                         FROM Words
                         GROUP BY tID) N) N1) R";
$result3 = sqlsrv_query($conn, $sql3);
$row = sqlsrv_fetch_array($result3, SQLSRV_FETCH_ASSOC);
$coronaRatio= $row['Ratio'];

$sql4="SELECT content
       FROM (SELECT content, COUNT(tID) AS num
             FROM Words
             WHERE content LIKE '#%'
             GROUP BY content) C
       WHERE num >= ALL (SELECT COUNT(tID) AS num
                         FROM Words
                         WHERE content LIKE '#%'
                         GROUP BY content)";
$result4 = sqlsrv_query($conn, $sql4);
$row = sqlsrv_fetch_array($result4, SQLSRV_FETCH_ASSOC);
$hashtag = $row['content'];

echo "<table border='1' style='border:1px solid black ;margin-left:auto;margin-right:auto'>";
echo "<tr><th> Most active tweeter ID </th><th> Most active country </th><th> Ratio of Corona tweets </th><th> Most frequent hashtag word </th></tr>";

echo '<tr><td style ="text-align:center">'.$maxTweeter.'</td>';
echo '<td style ="text-align:center">'.$countryMax.'</td>';
echo '<td style ="text-align:center">'.$coronaRatio.'</td>';
echo '<td style ="text-align:center">'.$hashtag.'</td></tr>';

echo "</table>" ;
?>
</body>
</html>
