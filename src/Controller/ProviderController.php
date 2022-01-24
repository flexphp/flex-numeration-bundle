<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace FlexPHP\Bundle\NumerationBundle\Controller;

use FlexPHP\Bundle\NumerationBundle\Domain\Provider\ProviderFormType;
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\Request\CreateProviderRequest;
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\Request\DeleteProviderRequest;
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\Request\IndexProviderRequest;
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\Request\ReadProviderRequest;
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\Request\UpdateProviderRequest;
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\UseCase\CreateProviderUseCase;
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\UseCase\DeleteProviderUseCase;
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\UseCase\IndexProviderUseCase;
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\UseCase\ReadProviderUseCase;
use FlexPHP\Bundle\NumerationBundle\Domain\Provider\UseCase\UpdateProviderUseCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ProviderController extends AbstractController
{
    /**
     * @Cache(smaxage="3600")
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER_PROVIDER_INDEX')", statusCode=401)
     */
    public function index(Request $request, IndexProviderUseCase $useCase): Response
    {
        $template = $request->isXmlHttpRequest()
            ? '@FlexPHPNumeration/provider/_ajax.html.twig'
            : '@FlexPHPNumeration/provider/index.html.twig';

        $request = new IndexProviderRequest($request->request->all(), (int)$request->query->get('page', 1));

        $response = $useCase->execute($request);

        return $this->render($template, [
            'providers' => $response->providers,
        ]);
    }

    /**
     * @Cache(smaxage="3600")
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER_PROVIDER_CREATE')", statusCode=401)
     */
    public function new(): Response
    {
        $form = $this->createForm(ProviderFormType::class);

        return $this->render('@FlexPHPNumeration/provider/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER_PROVIDER_CREATE')", statusCode=401)
     */
    public function create(Request $request, CreateProviderUseCase $useCase, TranslatorInterface $trans): Response
    {
        $form = $this->createForm(ProviderFormType::class);
        $form->handleRequest($request);

        $request = new CreateProviderRequest($form->getData(), $this->getUser()->id());

        $useCase->execute($request);

        $this->addFlash('success', $trans->trans('message.created', [], 'provider'));

        return $this->redirectToRoute('flexphp.numeration.providers.index');
    }

    /**
     * @Cache(smaxage="3600")
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER_PROVIDER_READ')", statusCode=401)
     */
    public function read(ReadProviderUseCase $useCase, string $id): Response
    {
        $request = new ReadProviderRequest($id);

        $response = $useCase->execute($request);

        if (!$response->provider->id()) {
            throw $this->createNotFoundException();
        }

        return $this->render('@FlexPHPNumeration/provider/show.html.twig', [
            'provider' => $response->provider,
        ]);
    }

    /**
     * @Cache(smaxage="3600")
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER_PROVIDER_UPDATE')", statusCode=401)
     */
    public function edit(ReadProviderUseCase $useCase, string $id): Response
    {
        $request = new ReadProviderRequest($id);

        $response = $useCase->execute($request);

        if (!$response->provider->id()) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(ProviderFormType::class, $response->provider);

        return $this->render('@FlexPHPNumeration/provider/edit.html.twig', [
            'provider' => $response->provider,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER_PROVIDER_UPDATE')", statusCode=401)
     */
    public function update(Request $request, UpdateProviderUseCase $useCase, TranslatorInterface $trans, string $id): Response
    {
        $form = $this->createForm(ProviderFormType::class);
        $form->submit($request->request->get($form->getName()));
        $form->handleRequest($request);

        $request = new UpdateProviderRequest($id, $form->getData(), $this->getUser()->id());

        $useCase->execute($request);

        $this->addFlash('success', $trans->trans('message.updated', [], 'provider'));

        return $this->redirectToRoute('flexphp.numeration.providers.index');
    }

    /**
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER_PROVIDER_DELETE')", statusCode=401)
     */
    public function delete(DeleteProviderUseCase $useCase, TranslatorInterface $trans, string $id): Response
    {
        $request = new DeleteProviderRequest($id);

        $useCase->execute($request);

        $this->addFlash('success', $trans->trans('message.deleted', [], 'provider'));

        return $this->redirectToRoute('flexphp.numeration.providers.index');
    }
}
