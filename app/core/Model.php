<?php
interface Model {
    public function getData();
    public function connect();
    public function getRow($sql, ...$params);
    public function getAll($sql, ...$params);
    public function insert($sql, ...$params);
}