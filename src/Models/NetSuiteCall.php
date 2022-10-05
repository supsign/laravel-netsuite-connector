<?php

namespace Supsign\NetsuiteConnector\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class NetSuiteCall extends Model
{
    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
