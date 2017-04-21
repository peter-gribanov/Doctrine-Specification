<?php
/**
 * Doctrine Specification.
 *
 * @author    Tobias Nyholm
 * @copyright Copyright (c) 2014, Tobias Nyholm
 * @license   http://opensource.org/licenses/MIT
 */

namespace Happyr\DoctrineSpecification\Transformer\Doctrine\ORM\QueryBuilder\Filter;

use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\Filter\InstanceOfX;
use Happyr\DoctrineSpecification\Specification;
use Happyr\DoctrineSpecification\Transformer\Doctrine\ORM\QueryBuilder\QueryBuilderTransformer;

class InstanceOfXTransformer implements QueryBuilderTransformer
{
    /**
     * @param Specification $specification
     * @param QueryBuilder  $qb
     * @param string        $dqlAlias
     *
     * @return QueryBuilder
     */
    public function transform(Specification $specification, QueryBuilder $qb, $dqlAlias)
    {
        if ($specification instanceof InstanceOfX) {
            $qb->andWhere(sprintf('%s INSTANCE OF %s', $dqlAlias, $specification->getValue()));
        }

        return $qb;
    }
}