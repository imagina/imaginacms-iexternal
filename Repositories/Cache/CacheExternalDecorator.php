<?php

namespace Modules\Iexternal\Repositories\Cache;

use Modules\Iexternal\Repositories\ExternalRepository;
use Modules\Core\Icrud\Repositories\Cache\BaseCacheCrudDecorator;

class CacheExternalDecorator extends BaseCacheCrudDecorator implements ExternalRepository
{
    public function __construct(ExternalRepository $external)
    {
        parent::__construct();
        $this->entityName = 'iexternal.externals';
        $this->repository = $external;
    }
}
