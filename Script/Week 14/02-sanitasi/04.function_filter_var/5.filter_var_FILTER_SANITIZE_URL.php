<?php

echo filter_var("https://www.kelasprogram.id", FILTER_SANITIZE_URL);
// Output: https://www.kelasprogram.id

echo filter_var("https://www. kelasprogram. id?s=oop", FILTER_SANITIZE_URL);
// Output: https://www.kelasprogram.id?s=oop

echo filter_var("https://www. kelasprogram. id?s='kôde'^&*()", FILTER_SANITIZE_URL);
// Output: https://www.kelasprogram.id?s='kde'^&*()

echo filter_var("https://www. kelasprogram. id?s=<script>uji<script>", FILTER_SANITIZE_URL);
// Output: https://www.kelasprogram.id?s=<script>uji<script>

?>
