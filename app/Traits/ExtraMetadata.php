<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait ExtraMetadata
{
    public static function bootExtraMetadata()
    {
        static::creating(function (Model $model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });

        static::updating(function (Model $model) {
            $model->updated_by = Auth::id();
        });

        static::deleting(function (Model $model) {
            $model->deleted_by = Auth::id();
        });
    }
}
