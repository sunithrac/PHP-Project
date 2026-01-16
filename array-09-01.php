<?php
$arr = array("red", "green", "blue");
print_r($arr);

echo count(["a", "b", "c"]);

var_dump(is_array(["x"]));

$arr = ["Apple"];
array_push($arr, "Banana", "Cherry");
print_r($arr);

$arr = [1, 2, 3];
echo array_pop($arr);
print_r($arr);

$arr = [2,3];
array_unshift($arr, 1);
print_r($arr);
array_shift($arr);
print_r($arr);

var_dump(in_array("green", ["red","green","blue"]));
$key = array_search("green", ["red","green","blue"]);
echo $key;
var_dump(array_key_exists(2, [10,20,30]));

print_r(array_count_values([1, "a", 1, "a", "b"]));

print_r(array_map(fn($n) => $n * 2, [1,2,3]));

print_r(array_filter([1,2,3,4], fn($n) => $n % 2 == 0));

print_r(array_merge([1,2],[3,4]));

print_r(array_slice([1,2,3,4], 1, 2));

$arr = [1,2,3,4];
array_splice($arr, 1, 2, ["x","y"]); 
print_r($arr);

print_r(array_diff([1,2,3], [2]));


print_r(array_intersect([1,2,3],[2,3]));

print_r(array_reverse([1,2,3]));

print_r(array_unique([1,2,2,3]));

print_r(array_flip(["a"=>1,"b"=>2]));


$arr = [3, 1, 4, 2];
sort($arr);
print_r($arr);

$arr = [3, 1, 4, 2];
rsort($arr);
print_r($arr);

$arr = ["a"=>3, "b"=>1, "c"=>2];
asort($arr);
print_r($arr);

$arr = ["a"=>3, "b"=>1, "c"=>2];
arsort($arr);
print_r($arr);

$arr = ["b"=>2, "a"=>1, "c"=>3];
ksort($arr);
print_r($arr);



$arr = ["b"=>2, "a"=>1, "c"=>3];
krsort($arr);
print_r($arr);

$arr = [10, 2, 33, 4];
usort($arr, fn($a, $b) => $a <=> $b);
print_r($arr);


?>