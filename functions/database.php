<?php
function query($db, $query, $field)
{
  $result = mysqli_query($db, $query);

  if (!$result) {
    return $error = "Wrong query";
  } else {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $row[$field];
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
