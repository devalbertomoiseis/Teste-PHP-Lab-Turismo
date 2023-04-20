<?php
 $numeros = array(3, 1, 8, 8, 2, 2, 4);
 echo "___________________________________<br>";
  sort($numeros, SORT_NATURAL);
  foreach ($numeros as $num) {
    echo "$num<br>";
  }
 echo "___________________________________<br>";
?>