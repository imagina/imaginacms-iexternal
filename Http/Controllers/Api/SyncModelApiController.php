<?php

namespace Modules\Iexternal\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Iexternal\Entities\SyncModel;
use Modules\Iexternal\Repositories\SyncModelRepository;

class SyncModelApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(SyncModel $model, SyncModelRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
