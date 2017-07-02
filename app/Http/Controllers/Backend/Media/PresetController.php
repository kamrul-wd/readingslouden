<?php

namespace App\Http\Controllers\Backend\Media;

use File;
use App\Models\Media;
use App\Http\Requests;
use App\Models\MediaPreset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Preset Manager';

        $presets = MediaPreset::with('media')->get();
        //return $presets;

        return view('pages.backend.media.presets.index', compact('title', 'presets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Preset';

        return view('pages.backend.media.presets.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\MediaPresetsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\MediaPresetsRequest $request)
    {
        if (! MediaPreset::create($request->all())) {
            return back()
                ->withInput()
                ->with('error', 'Could not save that preset.');
        }

        return redirect()
            ->route('admin.presets.index')
            ->with('success', 'Created that preset.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! $preset = MediaPreset::with('media')->find($id)) {
            return redirect()
                ->route('admin.presets.index')
                ->with('error', 'Could not find preset.');
        }
        //return $preset;

        $title = 'Images For Preset: '.$preset->name;

        return view('pages.backend.media.presets.show', compact('title', 'preset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! $preset = MediaPreset::find($id)) {
            return redirect()
                ->route('admin.presets.index')
                ->with('error', 'Preset not found.');
        }
        //return $preset;

        $title = 'Edit Preset: '.$preset->name;

        return view('pages.backend.media.presets.edit', compact('title', 'preset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! $preset = MediaPreset::find($id)) {
            return redirect()
                ->route('admin.presets.index')
                ->with('error', 'Could not find that preset.');
        }

        if (! $preset->update($request->all())) {
            return back()
                ->withInput()
                ->with('error', 'Failed to edited that preset.');
        }

        return redirect()
            ->route('admin.presets.index')
            ->with('success', 'Edited that preset.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $preset_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($preset_id)
    {
        if (! $media_preset = MediaPreset::find($preset_id)) {
            return back()
                ->with('error', 'Item not found in database.');
        }
        //return $media_preset;

        if (! $files = Media::where('media_preset_id', $media_preset->id)->get()) {
            return back()
                ->with('error', 'Item not found in database.');
        }
        //return $files;

        foreach ($files as $file) {
            $main_file = config('app.uploads_path').'/'.$file->file_type.'/'.$file->filename;
            $thumbnail_file = config('app.uploads_path').'/'.$file->file_type.'/thumbnails/'.$file->filename;

            if (File::exists($main_file)) {
                File::delete($main_file);
            }

            if (File::exists($thumbnail_file)) {
                File::delete($thumbnail_file);
            }
        }

        if (! $media_preset->delete()) {
            return redirect()
                ->route('admin.presets.index')
                ->with('error', 'Failed to remove the database entry for the preset.');
        }

        return redirect()
            ->route('admin.presets.index')
            ->with('success', 'Deleted that item.');
    }
}
