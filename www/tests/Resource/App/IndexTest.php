<?php

declare(strict_types=1);

namespace Fer\Deli\Resource\App;

use BEAR\Resource\ResourceInterface;
use Fer\Deli\Injector;
use Koriym\HttpConstants\StatusCode;
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    private ResourceInterface $resource;

    protected function setUp(): void
    {
        $injector = Injector::getInstance('api-app');
        $this->resource = $injector->getInstance(ResourceInterface::class);
    }

    public function testOnGet(): void
    {
        $ro = $this->resource->get('app://self/index');
        $this->assertSame(StatusCode::OK, $ro->code);
        $this->assertSame(['greeting' => 'Welcome to Fer\'s delivery service api.'], $ro->body);
    }
}
