<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class VideosRepository extends BaseRepository
{
    public function __construct(Model $model, array $relationships)
    {
        parent::__construct($model, $relationships);
    }
}
