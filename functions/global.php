<?php
function escape($db, $string)
{
    $string = htmlspecialchars($string);
    return $string = mysqli_real_escape_string($db, $string);
};
