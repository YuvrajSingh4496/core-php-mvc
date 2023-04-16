<?php
namespace App\Interfaces;

interface Model {
    // For all records
    public function all();

    // For a single record
    public function find($id);

    // Where conditional on query
    public function where($data, $expression, $value);

    // Count the returned records
    public function count();
    
    // Delete a record
    public function delete($data, $value);

    // Get all the records
    public function get();

    // Get the first record
    public function first();

    // Get 
    public function take($limit, $start = 0);

}