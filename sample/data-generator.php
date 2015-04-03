<?php

$headers = array(
    'id',
    'code',
    'number',
    'text',
    'date',
    'datetime',
    'select'
);

$data = array();
for ($i=0; $i<50; $i++) {
    $id = $i;
    $code = uniqid();

    $number = mt_rand(0, 100);

    $text = '';
    for ($j=0; $j<mt_rand(5, 10); $j++) {
        if (mt_rand(0, 1)) {
            $text.=chr(mt_rand(65, 90));
        } else {
            $text.=strtolower(chr(mt_rand(65, 90)));
        }
    }

    $date = date("Y-m-d", mt_rand(1420070400, 1451606400));
    $dateTime = date("Y-m-d H:i:s", mt_rand(1420070400, 1451606400));

    $select = chr(mt_rand(65, 75));

    $data[] = array(
        $id,
        $code,
        $number,
        $text,
        $date,
        $dateTime,
        $select
    );
}

shuffle($data);

$fp = fopen('data.csv', 'w');

fputcsv($fp, $headers);

foreach ($data as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);

