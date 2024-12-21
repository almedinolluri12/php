<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
         $host = 'localhost';
         $username = 'root';
         $password = '';
         $dbname = "crud";
         $tabel = 'tbl1';    


         if(isset($_GET['ID'])){
            $ID=$_GET ['ID'];

            $dsn="mysql:host=$host; dbname=$dbname";
            $conn=new PDO ($dsn,$username,$password);


            $sql="DELETE FROM $tabel WHERE ID=:id";
            $stmt=$conn->prepare($sql);
            $stmt->execute([':id'=>$ID]);
            header("Location:read.php");
            exit;
         }
    ?>
</body>
</html>