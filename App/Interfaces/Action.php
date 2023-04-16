<?php

namespace App\Interfaces;

interface Action {

    // Handles actual logic of the action
    static public function execute($data, Model $model); 
}