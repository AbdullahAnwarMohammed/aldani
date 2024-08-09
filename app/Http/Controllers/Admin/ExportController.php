<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AdminExport;
use App\Exports\AdminExportSQL;
use App\Exports\AlaikhtibaratExport;
use App\Exports\AlaikhtibaratExportSQL;
use App\Exports\AlhalaqaExport;
use App\Exports\AlhalaqatExportSQL;
use App\Exports\AlmustawayatExport;
use App\Exports\AlmustawayatExportSQL;
use App\Exports\TalibExport;
use App\Exports\TalibExportSQL;
use App\Exports\TasmieExport;
use App\Exports\TasmieExportSQL;
use App\Exports\UsersExport;
use App\Exports\UsersExportSQL;
use App\Http\Controllers\Controller;
use App\Models\Almustawayat;
use App\Models\Part;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function database()
    {
        
        return view("admin.export.database");
    }
    public function AllDatabase()
    {
        // Run the db:export command
        //  Artisan::call('db:export');

        //  $output = Artisan::output();

        //  return redirect()->back()->with('success', 'تم تصدير الملف بنجاح');


        // Run the db:export command
        $host = config('database.connections.mysql.host');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $database = config('database.connections.mysql.database');

        $outputFile = storage_path('/app/database/database_dump_' . date("Y-m-d") . '.sql');

        // Build the mysqldump command
        $command = "mysqldump --host={$host} --user={$username} --password={$password} {$database} > {$outputFile}";

        // Execute the command
        exec($command, $output, $returnValue);

        // Check the command execution result
        if ($returnValue !== 0) {
            return response()->json(['error' => "Database export failed: " . implode("\n", $output)], 500);
        }

        // return response()->download($outputFile)->deleteFileAfterSend(true);
        return response()->download($outputFile);
    }

    public function ExportFile(Request $request)
    {
        $tableName = $this->tableName($request->type);
        if ($request->file == 'sql') {
            return $this->sqlFile($tableName);
        } else if($request->file == 'excel') {
            switch ($request->type) {
                case 1:
                    return Excel::download(new TalibExportSQL, $tableName . '.xlsx');
                    break;
                case 2:
                    return Excel::download(new UsersExportSQL, $tableName . '.xlsx');
                    break;
                case 3:
                    return Excel::download(new AdminExportSQL, $tableName . '.xlsx');
                    break;
                case 4:
                    return Excel::download(new AlhalaqatExportSQL, $tableName . '.xlsx');
                    break;
                case 5:
                    return Excel::download(new AlmustawayatExportSQL, $tableName . '.xlsx');
                    break;
                case 6:
                    return Excel::download(new TasmieExportSQL, $tableName . '.xlsx');
                    break;
                default:
                    return Excel::download(new AlaikhtibaratExportSQL, $tableName . '.xlsx');
                    break;
            } 
        }
        else{
            switch ($request->type) {
                case 1:
                    return Excel::download(new TalibExport, $tableName . '.xlsx');
                    break;
                case 2:
                    return Excel::download(new UsersExport, $tableName . '.xlsx');
                    break;
                case 3:
                    return Excel::download(new AdminExport, $tableName . '.xlsx');
                    break;
                case 4:
                    return Excel::download(new AlhalaqaExport, $tableName . '.xlsx');
                    break;
                case 5:
                    return Excel::download(new AlmustawayatExport, $tableName . '.xlsx');
                    break;
                case 6:
                    return Excel::download(new TasmieExport, $tableName . '.xlsx');
                    break;
                default:
                    return Excel::download(new AlaikhtibaratExport, $tableName . '.xlsx');
                    break;
            }
        }
             
              
            
        
    }

    private function  tableName($case)
    {
        if ($case == 1) {
            return "talibs";
        }
        if ($case == 2) {
            return "users";
        }
        if ($case == 3) {
            return "admins";
        }
        if ($case == 4) {
            return "alhalaqats";
        }
        if ($case == 5) {
            return "almustawayats";
        }
        if ($case == 6) {
            return "tasmies";
        }
        if ($case == 7) {
            return "alaikhtibarats";
        }
    }
    private function sqlFile($table)
    {
        // Define the filename
        $fileName = $table . '_export.sql';

        // Use mysqldump to export the table
        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s %s %s > %s',
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_HOST'),
            env('DB_DATABASE'),
            $table,
            storage_path($fileName)
        );

        exec($command);

        // Return the file as a response
        return response()->download(storage_path($fileName))->deleteFileAfterSend(true);
    }

    private function excelFile()
    {
    }
}
