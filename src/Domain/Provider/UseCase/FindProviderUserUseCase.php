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
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\Request\FindProviderUserRequest;
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\Response\FindProviderUserResponse;

final class FindProviderUserUseCase
{
    private ProviderRepository $providerRepository;

    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function execute(FindProviderUserRequest $request): FindProviderUserResponse
    {
        $users = $this->providerRepository->findUsersBy($request);

        return new FindProviderUserResponse($users);
    }
}
