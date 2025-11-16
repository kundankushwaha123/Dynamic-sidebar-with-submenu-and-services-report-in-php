<?php
require '../db/config.php';

$from_date = $_POST['from_date'];
$to_date   = $_POST['to_date'];

// Get unique service names for header
$serviceRes   = mysqli_query($conn, "SELECT DISTINCT servicename 
                 FROM assdt_service_consumption_table 
                 WHERE DATE(req_dt) BETWEEN '$from_date' AND '$to_date'");

$services = [];
while ($row = mysqli_fetch_assoc($serviceRes)) {
    $services[] = $row['servicename'];
}

// Header: "User ID" + all services
$headers = array_merge(["User ID"], $services);

// Get user-wise service totals
$result = mysqli_query($conn, "SELECT user_id, servicename, SUM(transamt) AS total 
          FROM assdt_service_consumption_table 
          WHERE DATE(req_dt) BETWEEN '$from_date' AND '$to_date' 
          GROUP BY user_id, servicename");

// Prepare data in user → service format
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $user = $row['user_id'];
    $service = $row['servicename'];
    $total = $row['total'];

    if (!isset($data[$user])) {
        $data[$user] = ["User ID" => $user];
        foreach ($services as $s) {
            $data[$user][$s] = 0;
        }
    }
    $data[$user][$service] = $total;
}

// Convert to array of arrays matching header order
$rows = array_values(array_map(function ($r) use ($headers) {
    return array_map(function ($h) use ($r) {
        return $r[$h] ?? 0;
    }, $headers);
}, $data));

// Output as JSON
echo json_encode([
    "headers" => $headers,
    "data"    => $rows
]);
