<?php
header('Content-Type: application/json');

include '../connection.php';

$sql = "SELECT  f.name, IFNULL(SUM(r.rate), 0) / MAX(r.rate) * 100 AS `usage_percentage`
    FROM facilities f LEFT JOIN rental_details r ON f.id = r.foreign_id GROUP BY f.name ";
$result = $conn->query($sql);

$data = [
    "labels" => [],
    "datasets" => [
        [
            "label" => "Usage %",
            "data" => [],
            "backgroundColor" => "rgba(54, 162, 235, 0.6)",
            "borderColor" => "rgba(54, 162, 235, 1)",
            "borderWidth" => 1
        ]
    ]
];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data["labels"][] = $row["name"];
        $data["datasets"][0]["data"][] = (float) $row["usage_percentage"];
    }
}

echo json_encode($data);

$conn->close();
?>
