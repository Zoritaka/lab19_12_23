<?php
header("Content-type: application/json; charset=utf-8");
// Выдает ошибку, что не находит $return
echo json_encode($return, JSON_PRETTY_PRINT);