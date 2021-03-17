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
            ($entries['count'] % 2 != 0) ?   $table[$r][$c] = 'x' : $table[$r][$c] = 'O';
        }

        saveEntries($entries);
    }

    ////////And the winner is....
    /////Horizontal
    if (@$table[$r][$c] == @$table[$r][($c - 1)]) {
        if (@$table[$r][($c - 1)] == @$table[$r][($c - 2)]) {
            if (@$table[$r][($c - 2)] == @$table[$r][($c - 3)]) {
                echo "<h5>Game over, " . $table[$r][$c] . " WON!</h5>";
                $endgame == 1;
            }
        }
    }

    if (@$table[$r][$c] == @$table[$r][($c + 1)]) {
        if (@$table[$r][($c + 1)] == @$table[$r][($c + 2)]) {
            if (@$table[$r][($c + 2)] == @$table[$r][($c + 3)]) {
                echo "<h5>Game over, " . $table[$r][$c] . " WON!</h5>";
                $endgame == 1;
            }
        }
    }

    ////// Vertical
    if (@$table[$r][$c] == @$table[($r + 1)][$c]) {
        if (@$table[($r + 1)][($c)] == @$table[($r + 2)][$c]) {
            if (@$table[($r + 2)][$c] == @$table[($r + 3)][$c]) {
                echo "<h5>Game over, " . $table[$r][$c] . " WON!</h5>";
                $endgame == 1;
            }
        }
    }

    /////////Diagonal 1 low - up /
    if (@$table[$r][$c] == @$table[($r + 1)][($c - 1)]) {
        if (@$table[($r + 1)][($c - 1)] == @$table[($r + 2)][($c - 2)]) {
            if (@$table[($r + 2)][($c - 2)] == @$table[($r + 3)][($c - 3)]) {
                echo "<h5>Game over, " . $table[$r][$c] . " WON!</h5>";
                $endgame == 1;
            }
        }
    }

    /////////Diagonal 2 low - up \
    if (@$table[$r][$c] == @$table[($r + 1)][($c + 1)]) {
        if (@$table[($r + 1)][($c + 1)] == @$table[($r + 2)][($c + 2)]) {
            if (@$table[($r + 2)][($c + 2)] == @$table[($r + 3)][($c + 3)]) {
                echo "<h5>Game over, " . $table[$r][$c] . " WON!</h5>";
                $endgame == 1;
            }
        }
    }

    /////////Diagonal 3  up - down /
    if (@$table[$r][$c] == @$table[($r - 1)][($c + 1)]) {
        if (@$table[($r - 1)][($c + 1)] == @$table[($r - 2)][($c + 2)]) {
            if (@$table[($r - 2)][($c + 2)] == @$table[($r - 3)][($c + 3)]) {
                echo "<h5>Game over, " . $table[$r][$c] . " WON!</h5>";
                $endgame == 1;
            }
        }
    }

    /////////Diagonal 4  up - down \
    if (@$table[$r][$c] == @$table[($r - 1)][($c - 1)]) {
        if (@$table[($r - 1)][($c - 1)] == @$table[($r - 2)][($c - 2)]) {
            if (@$table[($r - 2)][($c - 2)] == @$table[($r - 3)][($c - 3)]) {
                echo "<h5>Game over, " . $table[$r][$c] . " WON!</h5>";
                $endgame == 1;
            }
        }
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