<?php

function getEntries()
{
    $entries = json_decode(file_get_contents('four_line.json'), true);

    if (!is_array($entries)) {
        $entries = [];
    }

    //Проверяем, существует ли массив $entries. Если нет, то создаём.
    return $entries;
}


function &getTable(&$entries)
{
    $entries['table'] = array_key_exists('table', $entries) ? $entries['table'] : [];

    return $entries['table'];
}


function saveEntries($entries)
{
    // Массив $entries шифруется и отправляется в json с применением эстетичного форматирования. 
    file_put_contents('four_line.json', json_encode($entries, JSON_PRETTY_PRINT));
}


function resetEntries()
{
    file_put_contents('four_line.json', json_encode('', true));
}
