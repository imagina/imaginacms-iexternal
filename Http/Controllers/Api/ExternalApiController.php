<?php

namespace Modules\Iexternal\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Iexternal\Entities\External;
use Modules\Iexternal\Repositories\ExternalRepository;

class ExternalApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(External $model, ExternalRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
