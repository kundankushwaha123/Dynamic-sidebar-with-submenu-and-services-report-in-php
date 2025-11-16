<!-- 
Create a dynamic function for distributing ‘x’ amount of Rupees to ‘y’ number of people where maximum ‘z’ amount of rupees can be received by each person- The function should display the amount each person will get  along with that it should also return the remaining amount that will be left (if any) after distributing it with the people. -->

<?php


function distributeXRupeesInY($x, $y, $z)
{
    $amount_y_person = min($z, $x / $y);
    for ($i = 0; $i < $y; $i++) {
        $distributed = min($amount_y_person, $x);
        echo "Person " . ($i + 1) . " ko : " . $distributed . "<br>";
        $x -= $distributed;
    }
    return $x;
}

$x=100;
$y=9;
$z=11;

// Example
$remaining_amount = distributeXRupeesInY($x, $y, $z);
echo "Remaining Amount is :" . $remaining_amount . "<br>";
?>