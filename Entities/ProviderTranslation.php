<?php

namespace Modules\Iexternal\Entities;

use Illuminate\Database\Eloquent\Model;

class ProviderTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description'];
    protected $table = 'iexternal__provider_translations';
}
