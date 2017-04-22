<?php
/**
 * Doctrine Specification.
 *
 * @author    Tobias Nyholm <tobias@happyr.com>
 * @copyright Copyright (c) 2014, Tobias Nyholm
 * @license   http://opensource.org/licenses/MIT
 */

namespace Happyr\DoctrineSpecification\Transformer\Doctrine\ORM\QueryBuilder\Logic;

use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\Logic\OrX;
use Happyr\DoctrineSpecification\Specification;
use Happyr\DoctrineSpecification\Transformer\Doctrine\ORM\QueryBuilder\QueryBuilderTransformerCollection;
use Happyr\DoctrineSpecification\Transformer\Doctrine\ORM\QueryBuilder\QueryBuilderTransformerCollectionAware;
use Happyr\DoctrineSpecification\Transformer\Doctrine\ORM\QueryBuilder\QueryBuilderTransformerCollectionAwareTrait;

class OrXTransformer implements QueryBuilderTransformerCollectionAware
{
    use QueryBuilderTransformerCollectionAwareTrait;

    /**
     * @param Specification $specification
     * @param QueryBuilder  $qb
     * @param string        $dqlAlias
     *
     * @return QueryBuilder
     */
    public function transform(Specification $specification, QueryBuilder $qb, $dqlAlias)
    {
        if ($specification instanceof OrX && $this->collection instanceof QueryBuilderTransformerCollection) {
                // FIXME impossible implement in current architecture
//            foreach ($specification->getChildren() as $child) {
//                $qb = $this->collection->transform($child, $qb, $dqlAlias);
//            }
        }

        return $qb;
    }
}
