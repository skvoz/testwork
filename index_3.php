<?php

$data = $data1 = array(
    array('id' => 12345, 'topic' => 'text1', 'message' => 'text2'),
    array('id' => 23456, 'topic' => 'text3', 'message' => 'text4'),
    array('id' => 34567, 'topic' => 'text1', 'message' => 'text2'),
);
var_dump($data);

foreach ($data as $idx => $row) {
    foreach ($data as $dbx => $dbl)
        if ($idx != $dbx && $dbl['topic'] == $row['topic'] && $dbl['message'] == $row['message'])
            unset($data[$dbx]);
}
echo 'first solution';
var_dump($data);
echo 'second solution';

/**
 * convention id unique
 */
foreach ($data1 as $idx => $row) {
    foreach ($data1 as $dbx => $dbl)
        if (count(array_intersect($row, $dbl)) == 2) {
            unset($data1[$dbx]);
        }
}

var_dump($data1);