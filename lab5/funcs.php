<?php
$conn = "pgsql:host=localhost;port=5433;dbname=postgres;user=postgres;password=postgres";
$pdo = null;

try {
    $pdo = new PDO($conn);
} catch (PDOException $e) {
    echo "Ощибк: " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action']) && $_POST['action'] === 'fetchTypes') {
        $query = "SELECT DISTINCT type FROM lab5";
        $stmt = $pdo->query($query);

        $brands = '';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $brands .= '<option value="' . $row['type'] . '">' . $row['type'] . '</option>';
        }
        echo $brands;
        exit;
    }

    if (isset($_POST['action']) && $_POST['action'] === 'fetchBrands' && isset($_POST['type'])) {
        $type = $_POST['type'];
        $query = "SELECT DISTINCT brand FROM lab5 WHERE type = :type";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['type' => $type]);

        $brands = '';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $brands .= '<option value="' . $row['brand'] . '">' . $row['brand'] . '</option>';
        }
        echo $brands;
        exit;
    }

    if (isset($_POST['action']) && $_POST['action'] === 'calculateConsumption' && isset($_POST['brand'], $_POST['type'], $_POST['distance'])) {
        $brand = $_POST['brand'];
        $type = $_POST['type'];
        $distance = (float)$_POST['distance'];


        $query = "SELECT consumption FROM lab5 WHERE brand = :brand AND type = :type";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['brand' => $brand, 'type' => $type]);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $oilConsumption = (float)$row['consumption'];
            $totalConsumption = ($oilConsumption * $distance) / 100;
            echo round($totalConsumption, 2);
        } else {
            echo "0";
        }
        exit;
    }
}
