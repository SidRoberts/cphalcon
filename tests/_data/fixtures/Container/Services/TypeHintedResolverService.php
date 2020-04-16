<?php

namespace Phalcon\Test\Fixtures\Container\Services;

use Phalcon\Container\Service;

class TypeHintedResolverService extends Service
{
    public function getName() : string
    {
        return 'typeHintedResolver';
    }

    public function isShared() : bool
    {
        return true;
    }

    public function resolve(string $parameter)
    {
        return "The 'parameter' service says: " . $parameter;
    }
}
