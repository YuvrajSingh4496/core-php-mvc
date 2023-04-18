<?php
namespace App\Interfaces;

interface Model {
    // For all records
    public function all(): Model;

    // For a single record
    public function find(int $id): Model;

    // Where conditional on query
    public function where(string $column, string $expression, string $value);

    // Count the returned records
    public function limit(int $limit, int $start = 0);

    // Create a new record
    public function create(array $data): int;

    // Execute the query
    public function execute(): Model;

    // Count specific columns
    public function count(string $column): Model;

    // Count the returned records
    public function length(): int;
    
    // Delete a record
    public function delete(string $column, string $value): bool;

    // Get all the records
    public function get();

    // Get the first record
    public function first();

    // Get only result based on limit
    public function take(int $amount, int $offset = 0);

}