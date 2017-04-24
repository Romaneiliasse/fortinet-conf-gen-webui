<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Fortinet\ConfGenerator\Loader\ExcelLoader;

class MainController extends Controller {

  private function getXlsVersion()
  {
    return "0.0";
  }

  public function index()
  {
    return view('index')->with('version', $this->getXlsVersion());
  }

  public function upload(Request $request)
  {
    $conf = '';
    try {
      if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $importedFile = new ExcelLoader($request->file('file')->path());
        $conf = (string) $importedFile->getFortigate();
      }
      else {
        flash('Le fichier n\'a pas &eacute;t&eacute; correctement envoy&eacute;', 'danger');
      }
    }
    catch(Exception $e) {
      flash($e->getMessage(), 'danger');
    }

    return view('upload')->with('version', $this->getXlsVersion())
                         ->with('conf', $conf);
  }
}