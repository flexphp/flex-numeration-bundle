<?php declare(strict_types=1);

namespace FlexPHP\Bundle\NumerationBundle\Domain\Numeration\Response;

use FlexPHP\Messages\ResponseInterface;

final class FindNumerationUserResponse implements ResponseInterface
{
    public $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }
}
