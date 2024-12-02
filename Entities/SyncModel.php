<?php

namespace Modules\Iexternal\Entities;

use Modules\Core\Icrud\Entities\CrudModel;

class SyncModel extends CrudModel
{
  protected $table = 'iexternal__syncmodels';
  public $transformer = 'Modules\Iexternal\Transformers\SyncModelTransformer';
  public $repository = 'Modules\Iexternal\Repositories\SyncModelRepository';
  public $requestValidation = [
      'create' => 'Modules\Iexternal\Http\Requests\CreateSyncModelRequest',
      'update' => 'Modules\Iexternal\Http\Requests\UpdateSyncModelRequest',
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
  protected $fillable = ['repository_path', 'entity_path', 'status'];
}
