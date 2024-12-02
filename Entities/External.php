<?php

namespace Modules\Iexternal\Entities;

use Modules\Core\Icrud\Entities\CrudModel;

class External extends CrudModel
{
  protected $table = 'iexternal__externals';
  public $transformer = 'Modules\Iexternal\Transformers\ExternalTransformer';
  public $repository = 'Modules\Iexternal\Repositories\ExternalRepository';
  public $requestValidation = [
      'create' => 'Modules\Iexternal\Http\Requests\CreateExternalRequest',
      'update' => 'Modules\Iexternal\Http\Requests\UpdateExternalRequest',
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
  public $translatedAttributes = [];
  protected $fillable = ['entity_type', 'entity_id', 'provider_id'];

  public function provider()
  {
    return $this->belongsTo(Provider::class, 'provider_id');
  }

  public function entity()
  {
    return $this->belongsTo($this->entity_type, 'entity_id');
  }
}
