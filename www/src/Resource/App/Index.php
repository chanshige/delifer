<?php

declare(strict_types=1);

namespace Fer\Deli\Resource\App;

use BEAR\Resource\ResourceObject;

class Index extends ResourceObject
{
    public function onGet(): self
    {
        $this->body = ['greeting' => 'Welcome to Fer\'s delivery service api.'];

        return $this;
    }
}
