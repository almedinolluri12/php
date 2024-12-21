<?php
// Konfigurimi i bazës së të dhënave
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'crud';
$table = 'tbl1';

// Lidhja me bazën e të dhënave dhe marrja e të dhënave
if (isset($_GET['ID'])) {
    $id = $_GET['ID'];
    try {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM $table WHERE ID = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $rez = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$rez) {
            die("Rekordi nuk u gjet.");
        }
    } catch (PDOException $e) {
        die("Gabim: " . $e->getMessage());
    }
}

// Përpunimi i formularit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['ID'];
    $emri = $_POST['emri'];
    $mbiemri = $_POST['mbiemri'];
    $mosha = $_POST['mosha'];
    $gjinia = $_POST['gjinia'];
    $nrpersonal = $_POST['nrpersonal'];

    try {
        $sql = "UPDATE $table SET 
                emri = :emri, 
                mbiemri = :mbiemri, 
                mosha = :mosha, 
                gjinia = :gjinia, 
                nrpersonal = :nrpersonal 
                WHERE ID = :id";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':emri' => $emri,
            ':mbiemri' => $mbiemri,
            ':mosha' => $mosha,
            ':gjinia' => $gjinia,
            ':nrpersonal' => $nrpersonal,
            ':id' => $id
        ]);

        header("Location: read.php?message=Record updated successfully");
        exit();
    } catch (PDOException $e) {
        echo "Gabim: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
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

        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #0078D7;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <input type="hidden" name="ID" value="<?php echo htmlspecialchars($rez['ID'] ?? ''); ?>">
        <h2>Update Record</h2>
        <input type="text" name="emri" value="<?php echo htmlspecialchars($rez['emri'] ?? ''); ?>" required>
        <input type="text" name="mbiemri" value="<?php echo htmlspecialchars($rez['mbiemri'] ?? ''); ?>" required>
        <input type="number" name="mosha" value="<?php echo htmlspecialchars($rez['mosha'] ?? ''); ?>" required>
        <input type="text" name="gjinia" value="<?php echo htmlspecialchars($rez['gjinia'] ?? ''); ?>" required>
        <input type="text" name="nrpersonal" value="<?php echo htmlspecialchars($rez['nrpersonal'] ?? ''); ?>" required>
        <input type="submit" value="Update Record" name="update">
        <a href="read.php" style="text-decoration:none; text-align: center; display: block; margin-top: 10px;">Go back to dashboard</a>
    </form>
</body>
</html>