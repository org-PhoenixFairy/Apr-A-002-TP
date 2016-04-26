<html>
<head>
<title>Book-O-Rama Search Results</title>
</head>
<body>
<h1>Book-O-Rama Search Results</h1>
<?php 
//create short var name
$searchtype = $_POST[ 'searchtype'];
$searchterm = trim($_POST[ 'searchterm']);
if(!$searchterm || !$searchtype){
    echo 'You have not entered search details.';
    exit;
}//未受到数据提示
if(!get_magic_quotes_gpc()){
    $searchtype = addslashes($searchtype);
    $searchterm = addslashes($searchterm);
}//字符串转义
@ $db = new mysqli('localhost','bookorama','bookorama123',"books");
if(mysqli_connect_errno()){
    echo 'Could not connect to database.';
    exit;
}
$query = "select * from books where ".$searchtype." like '%".$searchterm."%'";
$result = $db->query($query);

$num_results = $result->num_rows;

echo '<p>Number of book found:'.$num_results.'</p>';
for($i = 0;$i < $num_results;$i++){
    $row = $result->fetch_assoc();
    echo '<p><strong>'.($i+1).".Title: ";
    echo htmlspecialchars(stripslashes($row['title']));
    echo "</strong><br />Author: ";
    echo stripslashes($row['author']);
    echo "<br />ISBN :";
    echo stripslashes($row[ 'isbn']);
    echo "<br />Price :";
    echo stripslashes($row[ 'price']);
    echo '</p>';
    
}
$result->free();
$db->close();
//释放资源并关闭数据库

?>
</body>
</html>