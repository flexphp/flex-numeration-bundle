<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace FlexPHP\Bundle\NumerationBundle\Domain\Numeration\UseCase;

use FlexPHP\Bundle\NumerationBundle\Domain\Numeration\NumerationRepository;
use FlexPHP\Bundle\NumerationBundle\Domain\Numeration\Request\CreateNumerationRequest;
use FlexPHP\Bundle\NumerationBundle\Domain\Numeration\Response\CreateNumerationResponse;

final class CreateNumerationUseCase
{
    private NumerationRepository $numerationRepository;

    public function __construct(NumerationRepository $numerationRepository)
    {
        $this->numerationRepository = $numerationRepository;
    }

    public function execute(CreateNumerationRequest $request): CreateNumerationResponse
    {
        return new CreateNumerationResponse($this->numerationRepository->add($request));
    }
}
