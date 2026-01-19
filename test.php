<?php

// $conn = new mysqli("localhost", "root", "", "");

// if ($conn->connect_error) {
//     die("Connection failed");
// }
// echo "MySQL connected!";
$value = 'hhhe';
try {
    if (!$value) {
        throw new Exception("Invalid value");
    }
    echo "OK! <br>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    echo "Done";
}

function addOne(&$num) {
    $num++;
}

$a = 3;
addOne($a);
echo $a;
echo "<br>";
// echo "<br"; now 4

function add($a, $b) {
    $c = $a + $b;
    echo "<br>";
    echo gettype($c);
    return $c;
}

echo add(5, "10"); 
?>

