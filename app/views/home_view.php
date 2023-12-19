<?php

$isAdmid = true;
$return = new stdClass;

if($isAdmid) {
    $return->actions = $json;
    $return->status = $code;
}
else {
    $return = $json;
}

