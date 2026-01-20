<?php
echo strlen("Hello");
echo "<br>";


echo strtolower("HELLO");
echo "<br>";

echo strtoupper("hello");
echo "<br>";

echo ucfirst("php");
echo "<br>";

echo lcfirst("PHP");
echo "<br>";

echo ucwords("hello world");
echo "<br>";

echo trim(" hello ");
echo "<br>";

echo ltrim(" hello");
echo "<br>";

echo rtrim("hello 3 ");
echo "<br>";

echo str_replace("hello", "hello 1", "hello word");;
// echo nl2br(\n);

// echo str_ireplace("php", "PHP", "Php");
// echo nl2br(str_ireplace("php", "PHP", "Php") \n);

echo str_ireplace("php", "php", "PHP ");

echo "<pre>";
echo wordwrap("long text displaying", 5);
echo "</pre>";

echo substr("Hello World", 0, 5); 

echo substr_replace("Hello World", "PHP", 6);
echo "<br>";

strcmp("a", "a");
echo "<br>";

strcmp("a", "ab");
echo "<br>";

$arr = explode(",", "a,b,c");
print_r($arr);

echo implode("-", ["a","b","c"]); // a-b-c
sprintf("hello %d", 45);


echo htmlspecialchars("<script>");

echo str_shuffle("abc");
echo "<br>";

echo str_repeat("Hi ", 3);
echo "<br>";

echo str_word_count("Hello world"); // 2
echo "<br>";






?>