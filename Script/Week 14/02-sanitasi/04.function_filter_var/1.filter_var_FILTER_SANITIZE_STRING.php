<?php

echo filter_var("<b>KelasKode</b>", FILTER_SANITIZE_SPECIAL_CHARS);
// Output: &lt;b&gt;KelasKode&lt;/b&gt;

echo filter_var("<script onclick='danger()'>KelasKode</script>", FILTER_SANITIZE_SPECIAL_CHARS);
// Output: &lt;script onclick=&#039;danger()&#039;&gt;KelasKode&lt;/script&gt;

echo filter_var("   FooBar__  _  ", FILTER_SANITIZE_SPECIAL_CHARS);
// Output:    FooBar__  _  

echo filter_var("&Foo'Bar câfè", FILTER_SANITIZE_SPECIAL_CHARS);
// Output: &amp;Foo&#039;Bar câfè

?>
