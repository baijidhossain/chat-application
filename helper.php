<?php


function getData($peram)
{

    $data = [];
    

    if (!empty($peram) &&  $peram->num_rows > 0) {

        while ($row = mysqli_fetch_assoc($peram)) {
            $data[] = $row;
        }

        return $data;
    }

    return $data;
}
