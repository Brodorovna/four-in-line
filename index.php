<?php include 'functions.php';
?>

<link rel="stylesheet" href="style.css">

<?php

if (array_key_exists('reset', $_REQUEST)) {
    resetEntries();
}

$entries = getEntries();
$table = &getTable($entries);

if (
    array_key_exists('r', $_REQUEST) &&
    array_key_exists('c', $_REQUEST)
) {
    $r = $_REQUEST['r'];
    $c = $_REQUEST['c'];
    $next_row_index = $r + 1;
    if ($r == 9 || array_key_exists($next_row_index, $table) && array_key_exists($c, $table[$next_row_index]) && $table[$r + 1] != '') {
        if (@$table[$r][$c] == 'x' || @$table[$r][$c] == 'O') {
            echo '<h4>Field is reserved</h4>';
        } else {
            (!array_key_exists('count', $entries)) ? $entries['count'] = 1 : $entries['count']++;
            ($entries['count'] % 2 != 0) ?   $table[$r][$c] = 'x' : $table[$r][$c] = 'O';
        }
        saveEntries($entries);
    }
}

?>

<div class="container">
    <?php
    for ($r = 0; $r <= 9; $r++) {
        for ($c = 0; $c <= 9; $c++) {
            $value = (array_key_exists($r, $table) &&
                array_key_exists($c, $table[$r]))
                ? $table[$r][$c] : '';
            echo "<a href='?r=$r&c=$c'>$value</a>";
        }
    }
    ?>
</div>

<a href="?reset"> Reset </a>