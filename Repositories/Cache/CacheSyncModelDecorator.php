<?php

namespace Modules\Iexternal\Repositories\Cache;

use Modules\Iexternal\Repositories\SyncModelRepository;
use Modules\Core\Icrud\Repositories\Cache\BaseCacheCrudDecorator;

class CacheSyncModelDecorator extends BaseCacheCrudDecorator implements SyncModelRepository
{
    public function __construct(SyncModelRepository $syncmodel)
    {
        parent::__construct();
        $this->entityName = 'iexternal.syncmodels';
        $this->repository = $syncmodel;
    }
}
