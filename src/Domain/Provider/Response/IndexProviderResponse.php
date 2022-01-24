<?php declare(strict_types=1);

namespace FlexPHP\Bundle\NumerationBundle\Domain\Provider\Response;

use FlexPHP\Messages\ResponseInterface;

final class IndexProviderResponse implements ResponseInterface
{
    public $providers;

    public function __construct(array $providers)
    {
        $this->providers = $providers;
    }
}
