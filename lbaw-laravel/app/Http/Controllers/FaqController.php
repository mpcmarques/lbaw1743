<?php
namespace App\Http\Controllers;

class FaqController extends Controller
{
    public function show()
    {
      return view('faq.faq');
    }
}