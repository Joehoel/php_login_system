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

function insert($db, $query)
{
  mysqli_query($db, $query);
}

function update($db, $query)
{
  mysqli_query($db, $query);
}

function delete($db, $query)
{
  mysqli_query($db, $query);
}



function escapeString($db, $string)
{
  return $string = mysqli_real_escape_string($db, $string);
};
