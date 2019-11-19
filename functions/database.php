<?php
function query($db, $query, $field)
{
    $result = mysqli_query($db, $query);

    if (!$result) {
        $error = "Fout in query";
    } else {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return  $row[$field];
    }
}

function escapeString($db, $string)
{
    return $string = mysqli_real_escape_string($db, $string);
};
