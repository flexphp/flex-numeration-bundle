<?php declare(strict_types=1);

namespace FlexPHP\Bundle\NumerationBundle\Domain\Provider\Response;

use FlexPHP\Bundle\NumerationBundle\Domain\Provider\Provider;
use FlexPHP\Messages\ResponseInterface;

final class CreateProviderResponse implements ResponseInterface
{
    public $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }
}
