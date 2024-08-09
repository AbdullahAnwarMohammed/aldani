<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExportSQL;
use App\Http\Controllers\Controller;
use App\Imports\AdminImport;
use App\Imports\AlhalaqatImport;
use App\Imports\AlmustawayayImport;
use App\Imports\TalibImport;
use App\Imports\TasmieImport;
use App\Imports\UserImport;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDOException;

class ImportController extends Controller
{
    public function database()
    {
        return view("admin.import.database");
    }

    public function storeDatabase(Request $request)
    {

      $file = $request->file('sql_file'); // Assuming file input name is 'sql_file'
  
      if ($file) {
          $filePath = $file->getRealPath();
          // Read SQL statements from the file
          $sql = file_get_contents($filePath);
  
          // Execute SQL statements
          DB::unprepared($sql);
  
          return redirect()->back()->with('success', 'Database imported successfully!');
      }
  
      return redirect()->back()->withErrors(['error', 'Error: File not found or empty.']);
  
    }

    public function storeDatabaseExcel(Request $request){
        $request->validate([
            'sql_file' => 'required|mimes:xlsx,xls,csv'
        ]);
        $file = $request->file('sql_file');

        if($request->type == 1)
        {
            try {
                Excel::import(new TalibImport, $request->file('sql_file'));
    
                return back()->with('success', 'File imported successfully!');
            } catch (ValidationException $e) {
                // Collect validation errors
                $errors = $e->errors();
                return back()->withErrors($errors);
            }
        }
        else if($request->type == 2){
            try {
                Excel::import(new UserImport, $file);
                return back()->with('success', 'File imported successfully!');
            } catch (ValidationException $e) {
                // Collect validation errors
                $errors = $e->errors();
                return back()->withErrors($errors);
            }
            
        }
        else if($request->type == 3){
            try {
                Excel::import(new AdminImport, $file);
                return back()->with('success', 'File imported successfully!');
            } catch (ValidationException $e) {
                // Collect validation errors
                $errors = $e->errors();
                return back()->withErrors($errors);
            }
            
        }

        else if($request->type == 4){
            try {
                Excel::import(new AlhalaqatImport, $file);
                return back()->with('success', 'File imported successfully!');
            } catch (ValidationException $e) {
                // Collect validation errors
                $errors = $e->errors();
                return back()->withErrors($errors);
            }
            
        }
        else if($request->type == 5){
            try {
                Excel::import(new AlmustawayayImport, $file);
                return back()->with('success', 'File imported successfully!');
            } catch (ValidationException $e) {
                // Collect validation errors
                $errors = $e->errors();
                return back()->withErrors($errors);
            }
            
        }
        else if($request->type == 6){
            try {
                Excel::import(new TasmieImport, $file);
                return back()->with('success', 'File imported successfully!');
            } catch (ValidationException $e) {
                // Collect validation errors
                $errors = $e->errors();
                return back()->withErrors($errors);
            }
            
        }

        return redirect()->back()->with('success', 'File imported successfully.');
    }

   
}
