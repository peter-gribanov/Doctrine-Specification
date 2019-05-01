<?php

namespace Happyr\DoctrineSpecification\Filter;

use Doctrine\ORM\QueryBuilder;
use Happyr\DoctrineSpecification\Operand\ArgumentToOperandConverter;
use Happyr\DoctrineSpecification\Operand\Operand;

class MemberOfX implements Filter
{
    /**
     * @var Operand|string
     */
    private $field;

    /**
     * @var Operand|string
     */
    private $value;

    /**
     * @var string|null
     */
    private $dqlAlias;

    /**
     * @param Operand|string $value
     * @param Operand|string $field
     * @param string|null    $dqlAlias
     */
    public function __construct($value, $field, $dqlAlias = null)
    {
        $this->value = $value;
        $this->field = $field;
        $this->dqlAlias = $dqlAlias;
    }

    /**
     * @param QueryBuilder $qb
     * @param string       $dqlAlias
     *
     * @return string
     */
    public function getFilter(QueryBuilder $qb, $dqlAlias)
    {
        if (null !== $this->dqlAlias) {
            $dqlAlias = $this->dqlAlias;
        }

        $field = ArgumentToOperandConverter::toField($this->field);
        $value = ArgumentToOperandConverter::toValue($this->value);

        return $qb->expr()->isMemberOf(
            $value->transform($qb, $dqlAlias),
            $field->transform($qb, $dqlAlias)
        );
    }
}