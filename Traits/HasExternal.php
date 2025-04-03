<?php

namespace Modules\Iexternal\Traits;

class HasExternal
{
  public function getInstances()
  {
    return [
      'relations' => ['external', 'externals']
    ];
  }

  /**
   * Get the single external relation
   *
   * @param $model
   * @return mixed
   */
  public function external($model)
  {
    return $model->morphOne('Modules\Iexternal\Entities\External', 'entity');
  }

  /**
   * Get multiple external relations
   *
   * @param $model
   * @return mixed
   */
  public function externals($model)
  {
    return $model->morphMany('Modules\Iexternal\Entities\External', 'entity');
  }
}
