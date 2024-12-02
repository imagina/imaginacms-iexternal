<?php

namespace Modules\Iexternal\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Iexternal\Entities\Provider;
use Modules\Iexternal\Repositories\ProviderRepository;

class ProviderApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(Provider $model, ProviderRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
