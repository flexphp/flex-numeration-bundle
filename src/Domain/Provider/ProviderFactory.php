<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace FlexPHP\Bundle\NumerationBundle\Domain\Provider;

use FlexPHP\Bundle\HelperBundle\Domain\Helper\FactoryExtendedTrait;
use FlexPHP\Bundle\UserBundle\Domain\User\UserFactory;

final class ProviderFactory
{
    use FactoryExtendedTrait;

    public function make($data): Provider
    {
        $provider = new Provider();

        if (\is_object($data)) {
            $data = (array)$data;
        }

        if (isset($data['id'])) {
            $provider->setId((string)$data['id']);
        }

        if (isset($data['type'])) {
            $provider->setType((string)$data['type']);
        }

        if (isset($data['name'])) {
            $provider->setName((string)$data['name']);
        }

        if (isset($data['username'])) {
            $provider->setUsername((string)$data['username']);
        }

        if (isset($data['password'])) {
            $provider->setPassword((string)$data['password']);
        }

        if (isset($data['url'])) {
            $provider->setUrl((string)$data['url']);
        }

        if (isset($data['isActive'])) {
            $provider->setIsActive((bool)$data['isActive']);
        }

        if (isset($data['createdAt'])) {
            $provider->setCreatedAt(\is_string($data['createdAt']) ? new \DateTime($data['createdAt']) : $data['createdAt']);
        }

        if (isset($data['updatedAt'])) {
            $provider->setUpdatedAt(\is_string($data['updatedAt']) ? new \DateTime($data['updatedAt']) : $data['updatedAt']);
        }

        if (isset($data['createdBy'])) {
            $provider->setCreatedBy((int)$data['createdBy']);
        }

        if (isset($data['updatedBy'])) {
            $provider->setUpdatedBy((int)$data['updatedBy']);
        }

        if (isset($data['createdBy.id'])) {
            $provider->setCreatedByInstance((new UserFactory())->make($this->getFkEntity('createdBy.', $data)));
        }

        if (isset($data['updatedBy.id'])) {
            $provider->setUpdatedByInstance((new UserFactory())->make($this->getFkEntity('updatedBy.', $data)));
        }

        return $provider;
    }
}
