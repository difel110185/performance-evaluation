<?php

namespace App\Models;

use App\Traits\ExtraMetadata;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Eloquent {

    use SoftDeletes;
    use ExtraMetadata;

}