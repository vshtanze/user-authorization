<?php declare(strict_types=1);

namespace App\Tests;

use Doctrine\ORM\Mapping\Entity;
use PHPUnit\Framework\TestCase;

/**
 * Class EntityTestCase.
 */
abstract class EntityTestCase extends TestCase
{
    /**
     * Entity.
     *
     * @var Entity
     */
    protected $entity;

    /**
     * List of entity parameters.
     *
     * @var array
     */
    protected $params = [];

    /**
     * Test entity.
     */
    public function testEntity(): void
    {
        $this->setParams();
        foreach ($this->params as $method => $param) {
            if (false !== \mb_strpos($method, 'set')) {
                $result = $this->entity->{$method}($param);
                self::assertSame($this->entity, $result);
                $methodGet = 'get' . \mb_substr($method, 3);
                $result    = $this->entity->{$methodGet}();
                self::assertEquals($result, $param);
            }
            if (false !== \mb_strpos($method, 'add')) {
                $result = $this->entity->{$method}($param);
                self::assertSame($this->entity, $result);
                if ('ss' === \mb_substr($method, -2)) {
                    $methodGet = 'get' . \mb_substr($method, 3) . 'es';
                } elseif ('y' === \mb_substr($method, -1)) {
                    $methodGet = 'get' . \mb_substr($method, 3, -1) . 'ies';
                } else {
                    $methodGet = 'get' . \mb_substr($method, 3) . 's';
                }
                $result = $this->entity->{$methodGet}();
                self::assertContains($param, $result);
                $methodRemove = 'remove' . \mb_substr($method, 3);
                $this->entity->{$methodRemove}($param);
                $result = $this->entity->{$methodGet}();
                self::assertEmpty($result);
            }
        }
    }

    /**
     * Initialize parameters.
     */
    protected function setParams(): void
    {
        $this->params = [];
    }

    /**
     * Create mock entity.
     *
     * @param string|string[] $entity
     *
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockEntity($entity)
    {
        return $this->getMockBuilder($entity)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
