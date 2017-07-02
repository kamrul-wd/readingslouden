@foreach($page->documents as $media)
    <p>File name : {!! $media->filename !!}<br>
    <a href="{{ asset(config('app.uploads_url').'/'.$media->file_type.'/'.$media->filename) }}">View Document</a></p>
@endforeach
