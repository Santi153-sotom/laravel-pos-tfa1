<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('about:pos', function () {
    $this->comment('POS Accounts Laravel TFA1 project.');
})->purpose('Display a short description of this project');
