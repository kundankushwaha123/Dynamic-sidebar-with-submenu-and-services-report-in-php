<!-- Let ‘x’ amount is inclusive of 29% of tax applied on ‘y’, create a function which accepts this x amount and returns the amount before tax applied (y). -->
<?php
function amountBeforeTax($x)
{
    // Since x = y + 0.29y = 1.29y, x by 1.29
    $y = $x / 1.29;
    return $y;
}


$x = 100;     // Amount including tax


$y = amountBeforeTax($x);
echo "Amount before tax: " . round($y, 2); // Outputs: Amount before tax: 100.0
?>

