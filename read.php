<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
     
         .btn {
             display: inline-block;
             padding: 10px 20px;
             margin: 5px;
             font-size: 14px;
             font-weight: bold;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
             cursor: pointer;
       }


       .update-btn {
             background-color: #4CAF50; 
             color: white;
             border: 1px solid #4CAF50;
       }

        .update-btn:hover {
             background-color: #45a049; 
             border-color: #45a049;
        }

     
        .delete-btn {
              background-color: #f44336; 
             color: white;
             border: 1px solid #f44336;
        }

        .delete-btn:hover {
             background-color: #e53935; 
             border-color: #e53935;
        }

        body {
            font-family: 'Arial', sans-serif;  
            background-color: #f4f7fc; 
            margin: 0;
            padding: 20px;
        }

        .tb1 {
            width: 80%;  
            margin: 40px auto;  
            border-collapse: collapse;  
            border-radius: 10px; 
            overflow: hidden;  
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);  

        }
        th {
            background-color: #3f72af; 
            color: white;  
            padding: 15px 20px;  
            text-align: left;  
            font-size: 16px; 
            font-weight: bold;  
            text-transform: uppercase; 
        }

        td {
            padding: 12px 20px;  
            text-align: left; 
            border-bottom: 1px solid #e0e0 ;
            font-size: 14px;  
            color: #333;  
        }

        tr:hover {
            background-color: #f1f1f1;  
            cursor: pointer;  
            transform: scale(1.02);  
            transition: transform 0.2s ease, background-color 0.2s ease;  
        }

       
        td, th {
            border: none;  
        }

      
        .no-data {
            font-size: 18px;
            color: #ff6347;  
            text-align: center;
            margin-top: 30px;
        }

    </style>
</head>
<body>
    <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = "crud";
        $tabel = 'tbl1';

        try {
            $dsn = "mysql:host=$host; dbname=$dbname";
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM $tabel";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $rezultati = $stmt->fetchAll();

            if ($rezultati) {
                echo "<table class='tb1'>
                        <tr>
                            <th>Emri</th>
                            <th>Mbiemri</th>
                            <th>Mosha</th>
                            <th>Gjinia</th>
                            <th>Numri personal</th>
                            <th>Update/Delete</th>
                        </tr>";

                foreach ($rezultati as $x) {
                    echo "<tr>
                            <td>{$x['Emri']}</td>
                            <td>{$x['Mbiemri']}</td>
                            <td>{$x['Mosha']}</td>
                            <td>{$x['Gjinia']}</td>
                            <td>{$x['Nrpersonal']}</td>
                             <td>
                                <a href='update.php?ID={$x['ID']}' class='btn update-btn'>Update</a>
                                <a href='delet.php?ID={$x['ID']}' class='btn delete-btn'>Delete</a>
                            </td>
                            </tr>";
                }
 
                echo "</table>";
            } else {
                echo "<div class='no-data'>Nuk ka të dhëna në tabelën $tabel.</div>";
            }

        } catch(PDOException $a) {
            echo "ERROR: " . $a->getMessage(); 
        }
    ?>
</body>
</html>
