<?php

/**
 * This file is part of the Happyr Doctrine Specification package.
 *
 * (c) Tobias Nyholm <tobias@happyr.com>
 *     Kacper Gunia <kacper@gunia.me>
 *     Peter Gribanov <info@peter-gribanov.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Happyr\DoctrineSpecification;

use Doctrine\ORM\EntityRepository;

@trigger_error('The '.__NAMESPACE__.'\EntitySpecificationRepository class is deprecated since version 1.1 and will be removed in 2.0, use \Happyr\DoctrineSpecification\Repository\EntitySpecificationRepository instead.', E_USER_DEPRECATED);

/**
 * This class allows you to use a Specification to query entities.
 *
 * @description This class is deprecated since version 1.1 and will be removed in 2.0, use \Happyr\DoctrineSpecification\Repository\EntitySpecificationRepository instead.
 */
class EntitySpecificationRepository extends EntityRepository implements EntitySpecificationRepositoryInterface
{
    use EntitySpecificationRepositoryTrait;
}
