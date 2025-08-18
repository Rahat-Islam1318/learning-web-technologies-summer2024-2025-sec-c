<?php
for ($i = 1; $i < 4; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}
echo "<br>";
    for ($i = 1; $i < 4; $i++) {
    for ($j = 1; $j <= (4 - $i); $j++) {
        echo $j;
    }
    echo "<br>";
}


$arr = [
    [1, 2, 3, 'A'],
    [1, 2, 'B', 'C'],
    [1, 'D', 'E', 'F']
];
echo "<br>";
for ($i = 0; $i < 3; $i++) {
    for ($j = 3 - $i; $j < 4; $j++) {
        echo $arr[$i][$j] . " ";
    }
    echo "<br>";
}


?>
