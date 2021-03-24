<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include 'functions.php';
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
    $endgame = 0;
    $r = $_REQUEST['r'];
    $c = $_REQUEST['c'];
    $next_row_index = $r + 1;
    if ($r == 9 || array_key_exists($next_row_index, $table) && array_key_exists($c, $table[$next_row_index]) && $table[$r + 1] != '' && $endgame !== 1) {
        if (@$table[$r][$c] == 'x' || @$table[$r][$c] == 'O') {
            echo "<h4>Field is reserved</h4>";
        } else {
            (!array_key_exists('count', $entries)) ? $entries['count'] = 1 : $entries['count']++;
            $table[$r][$c] = ($entries['count'] % 2 != 0) ?  'x' : 'O';
            saveEntries($entries);

            
        }
    }

    ////////And the winner is....
    /////Horizontal

    $count_matches = 0;

    checkWinner($count_matches, $table, $r, $c, 0, -1);
    checkWinner($count_matches, $table, $r, $c, 0, 1);

    $count_matches = 0;

    ////// Vertical
    checkWinner($count_matches, $table, $r, $c, 1, 0);
    checkWinner($count_matches, $table, $r, $c, -1, 0);
    $count_matches = 0;

    /////////Diagonal 1 low - up /
    checkWinner($count_matches, $table, $r, $c, 1, -1);
    checkWinner($count_matches, $table, $r, $c, 1, 1);

    $count_matches = 0;

    /////////Diagonal 3  up - down /
    checkWinner($count_matches, $table, $r, $c, -1, 1);
    checkWinner($count_matches, $table, $r, $c, -1, -1);
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