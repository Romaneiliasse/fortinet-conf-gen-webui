<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller {

  public function index()
  {
    $version = "0.0";
    return view('index')->with('version', $version);
  }

  public function upload(Request $request)
  {

  }
}