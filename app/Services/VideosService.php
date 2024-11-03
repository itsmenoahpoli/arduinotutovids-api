<?php

namespace App\Services;

use App\Repositories\VideosRepository;
use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VideosService extends VideosRepository
{
    private string $uploadsFolderDir = '/uploads';

    public function __construct(Video $model)
    {
        parent::__construct($model, []);
    }

    public function create($data)
    {
        $data['video_uid'] = Str::uuid();
        $data['title_slug'] = Str::slug($data['title']);
        $videoFile = $data['video_file'] ?? null;
        $videoThumbnailFile = $data['video_thumbnail'] ?? null;

        if ($videoFile && $videoFile->isValid())
        {
            unset($data['video_file']);

            $filename = time().'.'.$videoFile->getClientOriginalExtension();
            $filepath = $this->uploadsFolderDir.'/videos/'.$filename;

            Storage::disk('public')->put($filepath, file_get_contents($videoFile));

            $data['video_src'] = config('app.url').'/storage'.$filepath;
        }

        if ($videoThumbnailFile && $videoThumbnailFile->isValid())
        {
            unset($data['video_thumbnail']);

            $filename = time().'.'.$videoThumbnailFile->getClientOriginalExtension();
            $filepath = $this->uploadsFolderDir.'/video-thumbnails/'.$filename;

            Storage::disk('public')->put($filepath, file_get_contents($videoThumbnailFile));

            $data['video_thumbnail_src'] = config('app.url').'/storage'.$filepath;
        }

        return parent::create($data);
    }
}
