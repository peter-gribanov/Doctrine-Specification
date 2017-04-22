<?php
/**
 * Doctrine Specification.
 *
 * @author    Tobias Nyholm <tobias@happyr.com>
 * @copyright Copyright (c) 2014, Tobias Nyholm
 * @license   http://opensource.org/licenses/MIT
 */

namespace Happyr\DoctrineSpecification\Transformer\Doctrine\ODM\MongoDB\QueryBuilder;

use Doctrine\ODM\MongoDB\Query\Builder;
use Happyr\DoctrineSpecification\Specification;

interface QueryBuilderTransformer
{
    /**
     * Return a condition string or NULL if the specification is not a filter.
     *
     * @param Specification $specification
     * @param Builder       $qb
     *
     * @return string|null
     */
    public function transform(Specification $specification, Builder $qb);
}
