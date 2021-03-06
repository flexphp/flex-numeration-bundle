<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace FlexPHP\Bundle\NumerationBundle\Domain\Provider\Request;

use FlexPHP\Messages\RequestInterface;

final class ReadProviderRequest implements RequestInterface
{
    public $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
