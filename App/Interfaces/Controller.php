<?php
namespace App\Interfaces;

interface Controller {
    
    // update 
    public function update($request);
    
    // create
    public function create($request);

    // for all records
    public function index($request);
}