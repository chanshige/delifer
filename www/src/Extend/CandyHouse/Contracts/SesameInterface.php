<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\CandyHouse\Contracts;

use Fer\Deli\Extend\CandyHouse\Exception\SesameException;

interface SesameInterface
{
    /**
     * @throws SesameException
     */
    public function __invoke(ActionInterface $action): ResponseInterface;
}
