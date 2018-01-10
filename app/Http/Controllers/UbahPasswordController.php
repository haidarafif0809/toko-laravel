<?php

namespace App\Http\Controllers;

class UbahPasswordController extends Controller
{
    public function editPassword()
    {
        return view('settings.edit-password');
    }
}
