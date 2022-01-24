<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace FlexPHP\Bundle\NumerationBundle\Domain\Provider\UseCase;

use FlexPHP\Bundle\NumerationBundle\Domain\Provider\ProviderRepository;
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\Request\CreateProviderRequest;
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\Response\CreateProviderResponse;

final class CreateProviderUseCase
{
    private ProviderRepository $providerRepository;

    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function execute(CreateProviderRequest $request): CreateProviderResponse
    {
        return new CreateProviderResponse($this->providerRepository->add($request));
    }
}
