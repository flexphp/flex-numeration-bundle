<?php declare(strict_types=1);

namespace FlexPHP\Bundle\NumerationBundle\Domain\Numeration\Response;

use FlexPHP\Bundle\NumerationBundle\Domain\Numeration\Numeration;
use FlexPHP\Messages\ResponseInterface;

final class ReadNumerationResponse implements ResponseInterface
{
    public $numeration;

    public function __construct(Numeration $numeration)
    {
        $this->numeration = $numeration;
    }
}
