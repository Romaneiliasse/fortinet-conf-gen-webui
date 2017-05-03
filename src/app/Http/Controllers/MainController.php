<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Fortinet\ConfGenerator\Loader\ExcelLoader;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

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

    Redis::set('conf:' . Session::getId(), $conf);
    Redis::expire('conf:' . Session::getId(), 3600);

    return view('upload')->with('version', $this->getXlsVersion())
                         ->with('conf', $conf);
  }

  public function download()
  {
    $conf = Redis::get('conf:' . Session::getId());

    return response($conf, 200)->header('Content-Type', 'text/plain');
  }
}