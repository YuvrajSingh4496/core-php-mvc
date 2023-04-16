<?php

namespace App\Interfaces;

interface Action {
    static public function execute($data, Model $model); 
}