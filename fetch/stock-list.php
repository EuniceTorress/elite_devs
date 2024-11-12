<?php
include '../connection.php';

$query = "SELECT * FROM stock_list";
$result = $conn->query($query);

$products = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $base64Image = base64_encode($row['media']);
        
        $priceDescriptionsArray = array();
        $priceDescriptions = explode('~', $row['price_for_descriptions']);
        
        foreach ($priceDescriptions as $item) {
            $itemPart = explode(',', $item);
            $descPart = strpos($itemPart[0], '-');

            if ($descPart !== false) {
                $descV = substr($itemPart[0], 0, $descPart);
                $descS = preg_split('/\s+/', trim($descV));
                $desc = end($descS);
                
                $endWord = substr($itemPart[0], $descPart + 1);
                $words = preg_split('/\s+/', trim($endWord));
                
                $other = $words[0] ?? null;
            } else {
                $desc = $itemPart[0];
                $other = null; 
            }

            $priceDescriptionsArray[] = array(
                'desc' => $desc, 
                'other' => $other,
                'price' => $itemPart[1] ?? null, 
                'qty' => $itemPart[2] ?? null,  
                'stock_no' => $itemPart[3] ?? null 
            );
        }

        $products[] = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'min_price' => $row['min_unit_price'],
            'max_price' => $row['max_unit_price'],
            'min_qty' => $row['min_quantity'],
            'max_qty' => $row['max_quantity'],
            'descriptions' => $priceDescriptionsArray, 
            'image' => $base64Image,
            'sId' => $row['stock_no'],
        );
    }

    echo json_encode($products);
} else {
    echo json_encode(array('message' => 'No data found.'));
}

$conn->close();
?>
