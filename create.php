<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="number"],
        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #0078D7;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 120, 215, 0.5);
        }

        input[type="submit"] {
            background-color: #0078D7;
            color: #fff;
            font-weight: bold;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #005BBB;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <input type="text" placeholder="Emri" name="emri" required>
        <input type="text" placeholder="Mbiemri" name="mbiemri" required>
        <input type="number" placeholder="Mosha" name="mosha" required>
        <input type="text" placeholder="Gjinia" name="gjinia" required>
        <input type="text" placeholder="Nr. Personal" name="nrpersonal" required>
        <input type="submit" value="Create Record" name="create">
    </form>

    <?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'crud';
    $table = 'tbl1';

    if (isset($_POST['create'])) {
        $emri = $_POST['emri'];
        $mbiemri = $_POST['mbiemri'];
        $mosha = $_POST['mosha'];
        $gjinia = $_POST['gjinia'];
        $nrpersonal = $_POST['nrpersonal'];

        // Kontrolli nëse fushat janë të plota
        if (empty($emri) || empty($mbiemri) || empty($mosha) || empty($gjinia) || empty($nrpersonal)) {
            die("Ju lutem plotësoni të gjitha fushat!");
        }

        try {
            $dsn = "mysql:host=$host;dbname=$dbname";
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO $table (emri, mbiemri, mosha, gjinia, nrpersonal) 
                    VALUES (:emri, :mbiemri, :mosha, :gjinia, :nrpersonal)";
            $stmt = $conn->prepare($sql);

            $stmt->execute([
                ':emri' => $emri,
                ':mbiemri' => $mbiemri,
                ':mosha' => $mosha,
                ':gjinia' => $gjinia,
                ':nrpersonal' => $nrpersonal,
            ]);

            echo "<p>Regjistrimi u krye me sukses!</p>";
            header("Location: read.php");
        } catch (PDOException $e) {
            echo "Gabim: " . $e->getMessage();
        }
    }
    ?>
</body>
</html>
