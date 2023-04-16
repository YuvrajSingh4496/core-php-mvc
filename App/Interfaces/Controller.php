<?php
namespace App\Interfaces;

interface Controller {
    
    // create
    public function create($request);

    // for all records
    public function show($request);
}