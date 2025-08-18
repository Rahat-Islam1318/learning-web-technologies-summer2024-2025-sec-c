<?php

$length = 5;
$width = 10;
$amount = 20;
$number = 5;

$area = $length * $width;
$perimeter = 2 * ($length + $width);

echo "Length: " . $length . "<br>";
echo "Width: " . $width . "<br>";

echo "Area of Rectangle: " . $area . "<br>";
echo "Perimeter: " . $perimeter . "<br>";
echo "<br>";

echo "Amount: " . $amount . "<br>";
$vat = 0.15 * $amount;
echo "VAT: " . $vat . "<br>";
echo "<br>";

echo "Number: " . $number . "<br>";
if ($number % 2 == 0) {
    echo "The number is EVEN" . "<br>";
} else {
    echo "The number is ODD" . "<br>";
}

echo "<br>";

$a = 2;
$b = 5;
$c = 3;

echo "Numbers are: " . $a . ", " . $b . ", " . $c . "<br>";

if ($a > $b && $a > $c) {
    echo "The a is greater" . "<br>";
} elseif ($b > $a && $b > $c) {
    echo "The b is greater" . "<br>";
} else {
    echo "The c is greater" . "<br>";
}

echo "<br>";

for ($i = 10; $i < 100; $i++) {
    if ($i % 2 !== 0) {
        echo "$i ";
    }
}

echo "<br>";

$array = [10, 20, 30, 40, 50];
$search = 30;
$found = false;

foreach ($array as $num) {
    if ($num == $search) {
        $found = true;
        break;
    }
}
echo "<br>";
echo "The array:";
for($i=0;$i<5;$i++){
    echo $array[$i] . ",";
}
echo "<br>";
if ($found) {
    echo "$search is in the array";
} else {
    echo "$search is not in the array";
}






?>
