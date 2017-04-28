<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Fortinet\ConfGenerator\Loader\ExcelLoader;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MainController extends Controller {

  const TAB_INFOS = "Suivi";
  const XLS_FILE= "collect_file.xlsx";

  private function getXlsVersion()
  {
    $file = public_path() . "/" . self::XLS_FILE;
    $sheet = IOFactory::load($file)->getSheetByName(self::TAB_INFOS);
    $version = $sheet->getCell("E5")->getValue();

    return $version;
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
    catch(\Exception $e) {
      flash($e->getMessage(), 'danger');
    }

    return view('upload')->with('version', $this->getXlsVersion())
                         ->with('conf', $conf);
  }
}