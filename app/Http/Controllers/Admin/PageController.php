<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Pages = Page::all();
        return view("admin.pages.index", compact('Pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.pages.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $status = $request->subscrption == "on" ? 1 : 0;

        $request->validate([
            'name' => 'required|unique:pages,name',
            'content' => 'required'
        ]);

        Page::create([
            'name' => $request->name,
            'content' => $request->content,
            'icon' => $request->icon,
            'location' => $request->location,
            'status' => $status,
        ]);

        return redirect()->back()->with('success', 'تم انشاء الصفحة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Page = Page::where('id', $id)->first();

        return view("admin.pages.edit", compact('Page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:pages,name,' . $id,
            'content' => 'required'
        ]);
        Page::where('id', $id)->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'location' => $request->location,
            'content' => $request->content
        ]);
        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Page::where('id', $id)->delete();
        return redirect()->back()->with('delete', 'تم الحذف بنجاح');
    }
}
