<?php

namespace Modules\Iexternal\Repositories\Cache;

use Modules\Iexternal\Repositories\ProviderRepository;
use Modules\Core\Icrud\Repositories\Cache\BaseCacheCrudDecorator;

class CacheProviderDecorator extends BaseCacheCrudDecorator implements ProviderRepository
{
    public function __construct(ProviderRepository $provider)
    {
        parent::__construct();
        $this->entityName = 'iexternal.providers';
        $this->repository = $provider;
    }
}
