<?php

namespace devprojoh\Press;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function extra($field)
    {
        return json_decode($this->extra)->$field ?? null;
    }
}
