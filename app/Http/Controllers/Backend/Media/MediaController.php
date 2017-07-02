<?php

namespace App\Http\Controllers\Backend\Media;

use File;
use App\Models\Media;
use App\Models\Banner;
use App\Models\MediaPreset;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Media Manager';

        $presets = MediaPreset::with('media.banner')->get();
        //return $presets;

        return view('pages.backend.media.index', compact('title', 'presets'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showImages()
    {
        $title = 'Images - Media Manager';

        $images = Media::isOriginal()->where('file_type', 'images')->get();
        //return $images;

        $presets = MediaPreset::all();
        //return $presets;

        return view('pages.backend.media.index', compact('title', 'images', 'presets'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDocuments()
    {
        $title = 'Documents - Media Manager';

        $documents = Media::where('file_type', 'documents')->get();
        //return $documents;

        return view('pages.backend.media.index', compact('title', 'documents'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $title = 'All - Media Manager';

        $images = Media::isOriginal()->where('file_type', 'images')->get();
        //return $images;

        $documents = Media::where('file_type', 'documents')->get();
        //return $documents;

        $presets = MediaPreset::with('media.banner')->get();
        //return $presets;

        return view('pages.backend.media.index', compact('title', 'images', 'documents', 'presets'));
    }

    /**
     * Store new uploaded files.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $file = $request->file('file');

        $destination_path = config('app.uploads_path');
        $original_filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $original_name = substr($original_filename, 0, - strlen($extension) - 1);

        // Generate final filename for image into database
        $filename = str_slug($original_name).'-'.str_random(12).'.'.$extension;

        $file_size = $file->getSize();
        $dimensions = getimagesize($file);

        if ($dimensions > 0) {
            $file_type = 'images';
            $dimensions = $dimensions[0].','.$dimensions[1];
        } else {
            $file_type = 'documents';
            $dimensions = '';
        }

        if ($file_type == 'images') {
            $img = Image::make($file);

            if (! $img->save($destination_path.'/'.$file_type.'/'.$filename)) {
                return response()->json('Could not save file', 400);
            }

            $img->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            if (! $img->save($destination_path.'/'.$file_type.'/thumbnails/'.$filename)) {
                return response()->json('Could not save thumbnail file', 400);
            }
        } else {
            if (! $request->file('file')->move($destination_path.'/'.$file_type, $filename)) {
                return response()->json('error', 400);
            }
        }

        $media = new Media();
        $media->label = $original_name;
        $media->filename = $filename;
        $media->size = $file_size;
        $media->extension = $extension;
        $media->dimensions = $dimensions;
        $media->file_type = $file_type;

        if (! $media->save()) {
            return response()->json('Error saving image to database', 400);
        }

        return response()->json('success', 200);
    }

    /**
     * Store new uploaded files.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function crop(Request $request)
    {
        if (! $original_file = Media::find($request->crop_image_id)) {
            return back()->with('error', 'Image not found.');
        }

        if (! $preset = MediaPreset::find($request->media_preset_id)) {
            return back()->with('error', 'Preset not found.');
        }

        $uploads_path = config('app.uploads_path');

        $x_axis = round($request->crop_x_axis);
        $y_axis = round($request->crop_y_axis);
        $width = round($request->crop_width);
        $height = round($request->crop_height);

        // Load the original file for cropping
        $img = Image::make($uploads_path.'/'.$original_file->file_type.'/'.$original_file->filename);

        // Crop image
        $img->crop($width, $height, $x_axis, $y_axis);

        if ($preset->width != 0 && $preset->height != 0) {
            if ($preset->width == 0) {
                $img->resize(null, $preset->height);
            } else {
                $img->resize($preset->width, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
        }

        // Generate final filename for image into database
        $filename = str_slug($original_file->label).'-'.str_random(12).'.'.$original_file->extension;

        // Save new cropped image into same directory
        if (! $img->save($uploads_path.'/'.$original_file->file_type.'/'.$filename)) {
            return back()->with('error', 'Could not save image.');
        }

        $new_file = $uploads_path.'/'.$original_file->file_type.'/'.$filename;

        $file_size = filesize($new_file);
        $dimensions_array = getimagesize($new_file);
        $dimensions = $dimensions_array[0].','.$dimensions_array[1];

        $img->resize(null, round($dimensions_array[1] / 2), function ($constraint) {
            $constraint->aspectRatio();
        });

        if (! $img->save($uploads_path.'/'.$original_file->file_type.'/thumbnails/'.$filename)) {
            return back()->with('error', 'Could not save thumbnail image.');
        }

        $media = new Media();
        $media->label = $original_file->label;
        $media->filename = $filename;
        $media->size = $file_size;
        $media->extension = $original_file->extension;
        $media->dimensions = $dimensions;
        $media->file_type = $original_file->file_type;
        $media->original_id = $original_file->id;
        $media->media_preset_id = $preset->id;

        if (! $media->save()) {
            return back()->with('error', 'Error saving image to database');
        }

        if ($request->media_preset_id == 2) {
            $banner = new Banner();
            $banner->media()->associate($media);

            if (! $banner->save()) {
                return back()->with('error', 'Failed to save a banner.');
            }
        }

        return back()->with('success', 'Cropped that image and saved a thumbnail.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if (! $media = Media::find($request->media_id)) {
            return back()->with('error', 'Image not found.');
        }

        if (! $media->update($request->all())) {
            return back()
                ->withInput()
                ->with('error', 'Could not update media info.');
        }

        if ($request->preset == 2) {
            $banner = Banner::where('media_id', $request->media_id)->first();

            if (! $banner->update($request->all())) {
                return back()
                    ->withInput()
                    ->with('error', 'Could not update banner info.');
            }
        }

        return back()
            ->with('success', 'Updated the info for that image.');
    }

    /**
     * Show resources via inline link on ckeditor
     *
     * @return \Illuminate\Http\Response
     */
    public function imageInline()
    {
        $title = 'Inline Media';

        $images = Media::images()->get();
        //return $images;

        return view('pages.backend.media.image_inline', compact('title', 'images'));
    }

    /**
     * Show resources via inline link on ckeditor
     *
     * @return \Illuminate\Http\Response
     */
    public function docInline()
    {
        $title = 'Inline Media';

        $documents = Media::documents()->get();
        //return $documents;

        return view('pages.backend.media.doc_inline', compact('title', 'documents'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Requests\MediaDeleteRequest $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Requests\MediaDeleteRequest $request)
    {
        foreach ($request->media_files as $id) {
            if (! $file = Media::find($id)) {
                return back()->with('error', 'Item not found in database.');
            }

            $main_file = config('app.uploads_path').'/'.$file->file_type.'/'.$file->filename;
            $thumbnail_file = config('app.uploads_path').'/'.$file->file_type.'/thumbnails/'.$file->filename;

            if (File::exists($main_file)) {
                File::delete($main_file);
            }

            if ($file->file_type == 'images' && File::exists($thumbnail_file)) {
                File::delete($thumbnail_file);
            }

            if (! $file->delete()) {
                return back()->with('error', 'failed to remove the database entry for that file.');
            }
        }

        return back()->with('success', 'Deleted the item(s).');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $file_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($file_id)
    {
        if (! $file = Media::find($file_id)) {
            return back()->with('error', 'Item not found in database.');
        }

        $main_file = config('app.uploads_path').'/'.$file->file_type.'/'.$file->filename;
        $thumbnail_file = config('app.uploads_path').'/'.$file->file_type.'/thumbnails/'.$file->filename;

        if (File::exists($main_file)) {
            File::delete($main_file);
        }

        if ($file->file_type == 'images' && File::exists($thumbnail_file)) {
            File::delete($thumbnail_file);
        }

        if (! $file->delete()) {
            return back()->with('error', 'failed to remove the database entry for that file.');
        }

        return back()->with('success', 'Deleted that item.');
    }

    public function search(Request $request)
    {
        $title = 'Search Results';
        $search_term = $request->q;

        if ($request->has('q')) {
            $results = Media::with('banner.pages', 'pageDocuments.page', 'pageImages.page')
                           ->where('label', 'LIKE', '%' . $search_term . '%')
                           ->orWhere('filename', 'LIKE', '%' . $search_term . '%')
                           ->paginate(10);
            //return $results;

            if (! $results->count()) {
                return back()
                    ->with('error', 'No results found for that search term.');
            }

            $results_pagination = $results->appends(['q' => $search_term]);

            return view('pages.backend.media.search_results', compact(
                'title',
                'results',
                'search_term',
                'results_pagination'
            ))
                ->with('success', 'Here\'s your search results');
        }

        return redirect()->route('admin.media.index')->with('error', 'No search term entered.');
    }

    public function getAllMedia()
    {
        $media = Media::select('filename')->where('file_type', 'images')->get();
        return response()->json($media);
    }
}
