<?php

namespace App\Http\Controllers\Backend\Settings;

use File;
use App\Http\Requests;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Settings';

        $settings = Setting::general()->orderBy('name')->get();
        //return $settings;

        return view('pages.backend.settings.index', compact('title', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'New Setting';

        return view('pages.backend.settings.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\SettingRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\SettingRequest $request)
    {
        if (! Setting::create($request->all())) {
            return back()
                ->with('error', 'Could not create that setting.');
        }

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Created that setting.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! $setting = Setting::general()->find($id)) {
            return redirect()
                ->route('admin.settings.index')
                ->with('error', 'Could not find that setting.');
        }
        //return $setting;

        $title = 'Edit Setting: '.$setting->label;

        return view('pages.backend.settings.edit', compact('title', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\SettingRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\SettingRequest $request, $id)
    {
        if (! $setting = Setting::general()->find($id)) {
            return redirect()
                ->route('admin.settings.index')
                ->with('error', 'Could not find that setting.');
        }

        // Set checkboxes that aren't checked (default value), if it's not set in the form.
        //if (! $request->active) {
        //    $request->merge(['active' => 0]);
        //}

        if (! $setting->update($request->all())) {
            return back()
                ->withInput()
                ->with('error', 'Failed to edited that setting.');
        }
        
        if (Cache::has('setting_' . $request->name)) {
            Cache::forever('setting_' . $request->name, $request->value);
        }

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Edited that setting.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! $setting = Setting::general()->find($id)) {
            return back()
                ->with('error', 'Could not find that setting.');
        }

        if ($setting->protected) {
            return back()
                ->with('error', 'Could not delete that setting as it is protected.');
        }

        if (! $setting->delete()) {
            return back()
                ->with('error', 'Could not delete that setting.');
        }

        return back()
            ->with('success', 'Deleted that setting.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAdvanced()
    {
        $title = 'List Advanced Settings';

        $settings = Setting::advanced()->get();
        //return $settings;

        return view('pages.backend.settings.advanced', compact('title', 'settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateAdvanced(Request $request)
    {
        foreach ($request->value as $key => $value) {
            if (! $setting = Setting::advanced()->find($key)) {
                return back()
                    ->withInput()
                    ->with('error', 'Could not find one of the items.');
            }

            $setting->value = $value;

            if (! $setting->save()) {
                return back()
                    ->withInput()
                    ->with('error', 'Failed to save that setting.');
            }

            if ($key == 3) {
                File::put(public_path('robots.txt'), $value);
            }
        }

        return redirect()
            ->route('admin.settings.advanced.index')
            ->with('success', 'Edited the advanced settings.');
    }
}
