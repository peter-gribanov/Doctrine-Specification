<?php
/**
 * Doctrine Specification.
 *
 * @author    Tobias Nyholm
 * @copyright Copyright (c) 2014, Tobias Nyholm
 * @license   http://opensource.org/licenses/MIT
 */

namespace Happyr\DoctrineSpecification\Transformer\Doctrine\ORM\QueryBuilder;

use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\Specification;

class QueryBuilderTransformerCollection implements QueryBuilderTransformer
{
    /**
     * @var QueryBuilderTransformer[]
     */
    private $transformers = [];

    /**
     * @param Specification $specification
     * @param QueryBuilder $qb
     * @param string $dqlAlias
     *
     * @return QueryBuilder
     */
    public function transform(Specification $specification, QueryBuilder $qb, $dqlAlias)
    {
        foreach ($this->transformers as $transformer) {
            $qb = $transformer->transform($specification, $qb, $dqlAlias);
        }
    }
}