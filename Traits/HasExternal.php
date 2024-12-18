<?php

namespace Modules\Iexternal\Traits;

class HasExternal
{
  public function getInstances()
  {
    return [
      'relations' => ['external']
    ];
  }

  /**
   * Relation External
   *
   * @param $model
   * @return mixed
   */
  public function external($model)
  {
    return $model->morphMany('Modules\Iexternal\Entities\External', 'entity');
  }
}
