<?php
// File: main.php
require 'Library/Math/Calculator.php';
require 'Library/Text/Calculator.php';

use Library\Math\Calculator as MathCalc;
use Library\Text\Calculator as TextCalc;

$math = new MathCalc();
echo $math->add(5, 3); // Output: 8

echo "<br>";

$text = new TextCalc();
echo $text->concat("Hello", "World"); // Output: Hello World