<?php

namespace Kunstmaan\AdminListBundle\Tests\AdminList\FilterType\DBAL;

use Kunstmaan\AdminListBundle\AdminList\FilterType\DBAL\EnumerationFilterType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-02-26 at 15:06:04.
 */
class EnumerationFilterTypeTest extends BaseDbalFilterTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var EnumerationFilterType
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new EnumerationFilterType('enumeration', 'e');
    }

    public function testBindRequest()
    {
        $request = new Request(array('filter_comparator_enumeration' => 'in', 'filter_value_enumeration' => array(1, 2)));

        $data = array();
        $uniqueId = 'enumeration';
        $this->object->bindRequest($request, $data, $uniqueId);

        $this->assertEquals(array('comparator' => 'in', 'value' => array(1, 2)), $data);
    }

    /**
     * @param string $comparator  The comparator
     * @param string $whereClause The where clause
     * @param mixed  $value       The value
     * @param mixed  $testValue   The test value
     *
     * @dataProvider applyDataProvider
     */
    public function testApply($comparator, $whereClause, $value, $testValue)
    {
        $qb = $this->getQueryBuilder();
        $qb->select('*')
          ->from('entity', 'e');
        $this->object->setQueryBuilder($qb);
        $this->object->apply(array('comparator' => $comparator, 'value' => $value), 'enumeration');

        $this->assertEquals("SELECT * FROM entity e WHERE e.enumeration $whereClause", $qb->getSQL());
        if ($testValue) {
            $this->assertEquals($value, $qb->getParameter('var_enumeration'));
        }
    }

    /**
     * @return array
     */
    public static function applyDataProvider()
    {
        return array(
          array('in', 'IN (:var_enumeration)', array(1, 2), true),
          array('notin', 'NOT IN (:var_enumeration)', array(1, 2), true),
        );
    }

    public function testGetComparator()
    {
        $request = new Request(array('filter_comparator_enumeration' => 'in', 'filter_value_enumeration' => array(1, 2)));
        $data = array();
        $uniqueId = 'enumeration';
        $this->object->bindRequest($request, $data, $uniqueId);
        $this->assertEquals($this->object->getComparator(), 'in');
    }

    public function testGetValue()
    {
        $request = new Request(array('filter_comparator_enumeration' => 'in', 'filter_value_enumeration' => array(1, 2)));
        $data = array();
        $uniqueId = 'enumeration';
        $this->object->bindRequest($request, $data, $uniqueId);
        $this->assertEquals($this->object->getValue(), array(1, 2));
    }

    public function testGetTemplate()
    {
        $this->assertEquals('@KunstmaanAdminList/FilterType/enumerationFilter.html.twig', $this->object->getTemplate());
    }
}
