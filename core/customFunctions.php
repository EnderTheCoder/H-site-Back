<?php
function emptyCheck($str) {
    return (!empty($str) && isset($str));
}

function stdJqReturn($conn, $res) {
    mysqli_close($conn);
    $callback = $_GET['callback'];
    echo $callback.'('.json_encode($res).')';
    exit;
}
