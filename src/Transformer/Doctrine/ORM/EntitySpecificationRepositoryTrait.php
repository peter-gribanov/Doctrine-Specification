<?php
/**
 * Doctrine Specification.
 *
 * @author    Tobias Nyholm
 * @copyright Copyright (c) 2014, Tobias Nyholm
 * @license   http://opensource.org/licenses/MIT
 */

namespace Happyr\DoctrineSpecification\Transformer\Doctrine\ORM;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\Exception\NonUniqueResultException as HappyrNonUniqueResultException;
use Happyr\DoctrineSpecification\Exception\NoResultException as HappyrNoResultException;
use Happyr\DoctrineSpecification\ResultModifier\ResultModifier;
use Happyr\DoctrineSpecification\Specification;

/**
 * This trait should be used by a class extending \Doctrine\ORM\EntityRepository.
 */
trait EntitySpecificationRepositoryTrait
{
    /**
     * @var string alias
     */
    private $alias = 'e';

    /**
     * @var DoctrineORMTransformer
     */
    private $transformer;

    /**
     * Get results when you match with a Specification.
     *
     * @param Specification  $specification
     * @param ResultModifier $modifier
     *
     * @return mixed[]
     */
    public function match(Specification $specification, ResultModifier $modifier = null)
    {
        return $this->getQuery($specification, $modifier)->execute();
    }

    /**
     * Get single result when you match with a Specification.
     *
     * @param Specification  $specification
     * @param ResultModifier $modifier
     *
     * @throw HappyrNonUniqueResultException If more than one result is found
     * @throw HappyrNoResultException        If no results found
     *
     * @return mixed
     */
    public function matchSingleResult(Specification $specification, ResultModifier $modifier = null)
    {
        try {
            return $this->getQuery($specification, $modifier)->getSingleResult();
        } catch (NonUniqueResultException $e) {
            throw new HappyrNonUniqueResultException($e->getMessage(), $e->getCode(), $e);
        } catch (NoResultException $e) {
            throw new HappyrNoResultException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get single result or null when you match with a Specification.
     *
     * @param Specification  $specification
     * @param ResultModifier $modifier
     *
     * @throw HappyrNonUniqueResultException If more than one result is found
     *
     * @return mixed|null
     */
    public function matchOneOrNullResult(Specification $specification, ResultModifier $modifier = null)
    {
        try {
            return $this->matchSingleResult($specification, $modifier);
        } catch (HappyrNoResultException $e) {
            return null;
        }
    }

    /**
     * Prepare a Query with a Specification.
     *
     * @param Specification  $specification
     * @param ResultModifier $modifier
     *
     * @return Query
     */
    public function getQuery(Specification $specification, ResultModifier $modifier = null)
    {
        /* @var $qb QueryBuilder */
        $qb = $this->createQueryBuilder($this->alias);

        // apply specification
        if ($this->transformer instanceof DoctrineORMTransformer) {
            return $this->transformer->transform($specification, $modifier, $qb, $this->alias);
        } else {
            return $qb->getQuery();
        }
    }

    /**
     * @param string $alias
     *
     * @return self
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * @param DoctrineORMTransformer $transformer
     *
     * @return self
     */
    public function setTransformer(DoctrineORMTransformer $transformer)
    {
        $this->transformer = $transformer;

        return $this;
    }
}