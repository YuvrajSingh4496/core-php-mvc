<?php
namespace App\Interfaces;

interface Model {
    public function all();
    public function find($id);
    public function where($data, $expression, $value);
    public function count();
    public function get();
    public function first();
}