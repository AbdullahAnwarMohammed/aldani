<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
  public function index()
  {
    $Sessions = Session::all();

    return view("admin.settings.index",compact('Sessions'));
  }

  public function update(Request $request)
  {

    $request->validate([
      'name_site' => 'required',
      'facebook_site' => 'url|nullable',
      'twitter_site' => 'url|nullable',
      'youtube_site' => 'url|nullable',
      'instgram_site' => 'url|nullable',
      'logo_site' =>  'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'favicon_site' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $logo_small_value_name = $request->logo_small_value;
    $logo_big_value_name = $request->logo_big_value;
    $namefavicon = $request->favicon_hidden;

    if (isset($request->logo_small)) {
      if (File::exists(public_path('uploads/logo/' . $logo_small_value_name))) {
        File::delete(public_path('uploads/logo/' . $logo_small_value_name));
      }

      $logo_small_value_name = time() . '.' . $request->logo_small->getClientOriginalExtension();
      $request->logo_small->move(public_path('uploads/logo'), $logo_small_value_name);
    }

    if (isset($request->logo_big)) {
      if (File::exists(public_path('uploads/logo/' . $logo_big_value_name))) {
        File::delete(public_path('uploads/logo/' . $logo_big_value_name));
      }

      $logo_big_value_name = time() . '.' . $request->logo_big->getClientOriginalExtension();
      $request->logo_big->move(public_path('uploads/logo'), $logo_big_value_name);
    }


    if (isset($request->favicon_site)) {
      if (File::exists(public_path('uploads/favicon/' . $request->favicon_hidden))) {
        File::delete(public_path('uploads/favicon/' . $request->favicon_hidden));
      }
      $namefavicon = time() . '.' . $request->favicon_site->getClientOriginalExtension();
      $request->favicon_site->move(public_path('uploads/favicon'), $namefavicon);
    }
   


    Setting::where('id', 1)->update([
      'name_site' => $request->name_site,
      'email_site' => $request->email_site,
      'logo_small' => $logo_small_value_name,
      'logo_big' => $logo_big_value_name,
      'favicon_site' => $namefavicon,
      'phone' => $request->phone,
      'status_site' => $request->status_site,
      'login_almuhfazin' => $request->login_almuhfazin,
      'facebook_site' => $request->facebook_site,
      'twitter_site' => $request->twitter_site,
      'youtube_site' => $request->youtube_site,
      'instgram_site' => $request->instgram_site,
      'address' => $request->address,
      'maps' => $request->maps,
      'message_close_site' => $request->message_close_site,
      'year' => $request->year,
      'session_id' => $request->session_id
    ]);
    return redirect()->back()->with('success', 'تم التعديل بنجاح');
  }

  public function exportDatabase()
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
 
    $outputFile = storage_path('/app/database/database_dump_'.date("Y-m-d").'.sql');
 
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


  public function createDatabase()
  {
    return view("admin.settings.create_database");
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
}
