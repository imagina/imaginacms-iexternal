<?php

namespace Modules\Iexternal\Transformers;

use Modules\Core\Icrud\Transformers\CrudResource;

class ExternalTransformer extends CrudResource
{
  /**
   * Attribute to exclude relations from transformed data
   * @var array
   */
  protected $excludeRelations = [];

  /**
  * Method to merge values with response
  *
  * @return array
  */
  public function modelAttributes($request)
  {
    return [];
  }
}
