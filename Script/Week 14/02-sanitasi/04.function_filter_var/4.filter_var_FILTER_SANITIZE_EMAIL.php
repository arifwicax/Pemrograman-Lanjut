<?php

echo filter_var("hitungKebalikan@bar.com", FILTER_SANITIZE_EMAIL);
//hitungKebalikan@bar.com

echo filter_var("f0o@b4r$#*?.com", FILTER_SANITIZE_EMAIL);
//f0o@b4r$#?*.com

echo filter_var("(hitungKebalikan)@bar.co.//id", FILTER_SANITIZE_EMAIL);
//hitungKebalikan@bar.co.id
