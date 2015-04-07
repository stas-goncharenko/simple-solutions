<?php
$params = array(
    'param1' => array(
        0 => 'aaa',
        1 => 'bbb',
    ),
    'param2' => array(
        0 => 'ccc',
        1 => 'ddd',
    )
);
$params = json_encode($params);
$params = base64_encode($params);
$params = urlencode($params);

header('Location: ' . 'http://example.loc/JsGetArrayFromUrl.html?params=' . $params);
