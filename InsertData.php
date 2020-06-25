<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    body{
        background-color: grey;
        color: white;
    }
    .table{
        top: 50%;
        left: 50%;
        width: 40em;
        height: auto;
        position: relative;
    }
    .li .input .box{
        width: 8em;
        height: 0.5em;
        boder: 1px solid blue;
        border-radius: 1em;
    }
li {
list-style: none;
}
</style>
</head>
<body>
<div class="table">
<h1>INSERT PRODUCT</h1>
<ul>
    <form name="InsertData" action="InsertData.php" method="POST" >
<li>ID:</li><li><input class="box" type="text" name="id" /></li>
<li>Name:</li><li><input class="box" type="text" name="name" /></li>
<li>Price:</li><li><input class="box" type="text" name="price" /></li>
<li><input type="submit" value="Submit" /></li>
</form>
</ul>
</div>
<?php

if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
         "host=ec2-18-214-119-135.compute-1.amazonaws.com;port=5432;user=rfyftldvgpjvof;password=ef434efcc0cc614b7a97861a9d8f128216fe18a48cb8a53d8251d3d81c6a757a;dbname=d7shjko65up6ph",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO student (stuid, fname, email, classname) values (:id, :name, :email, :class)');

//$stmt->bindParam(':id','SV03');
//$stmt->bindParam(':name','Ho Hong Linh');
//$stmt->bindParam(':email', 'Linhhh@fpt.edu.vn');
//$stmt->bindParam(':class', 'GCD018');
//$stmt->execute();
//$sql = "INSERT INTO student(stuid, fname, email, classname) VALUES('SV02', 'Hong Thanh','thanhh@fpt.edu.vn','GCD018')";
$sql = "INSERT INTO product(id, name, price)"
      .  " VALUES('$_POST[id]','$_POST[name]','$_POST[price]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
 if (is_null($_POST[id])) {
   echo "id must be not null";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }
 }
?>
</body>
</html>
