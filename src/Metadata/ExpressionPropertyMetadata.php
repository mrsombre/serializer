<?php

declare(strict_types=1);

namespace JMS\Serializer\Metadata;

/**
 * @Annotation
 * @Target("METHOD")
 *
 * @author Asmir Mustafic <goetas@gmail.com>
 */
class ExpressionPropertyMetadata extends PropertyMetadata
{
    /**
     * @var string
     */
    public $expression;

    public function __construct(string $class, string $fieldName, string $expression)
    {
        $this->class = $class;
        $this->name = $fieldName;
        $this->expression = $expression;
        $this->readOnly = true;
    }

    public function setAccessor(string $type, ?string $getter = null, ?string $setter = null): void
    {
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize([
            $this->expression,
            parent::serialize(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($str)
    {
        $parentStr = $this->unserializeProperties($str);
        list($this->class, $this->name) = unserialize($parentStr);
    }

    protected function unserializeProperties(string $str): string
    {
        list(
            $this->expression,
            $parentStr
            ) = unserialize($str);
        return parent::unserializeProperties($parentStr);
    }
}
