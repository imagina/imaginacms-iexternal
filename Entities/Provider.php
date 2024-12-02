<?php

namespace Modules\Iexternal\Entities;

use Astrotomic\Translatable\Translatable;
use Modules\Core\Icrud\Entities\CrudModel;

class Provider extends CrudModel
{
  use Translatable;

  protected $table = 'iexternal__providers';
  public $transformer = 'Modules\Iexternal\Transformers\ProviderTransformer';
  public $repository = 'Modules\Iexternal\Repositories\ProviderRepository';
  public $requestValidation = [
      'create' => 'Modules\Iexternal\Http\Requests\CreateProviderRequest',
      'update' => 'Modules\Iexternal\Http\Requests\UpdateProviderRequest',
    ];
  //Instance external/internal events to dispatch with extraData
  public $dispatchesEventsWithBindings = [
    //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
    'created' => [],
    'creating' => [],
    'updated' => [],
    'updating' => [],
    'deleting' => [],
    'deleted' => []
  ];
  public $translatedAttributes = ['title', 'description'];
  protected $fillable = ['keys', 'options'];

  protected $casts = [
    'options' => 'array',
    'keys' => 'array'
  ];
}
