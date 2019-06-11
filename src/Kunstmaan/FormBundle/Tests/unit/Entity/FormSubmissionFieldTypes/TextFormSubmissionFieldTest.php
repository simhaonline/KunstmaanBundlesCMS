<?php

namespace Kunstmaan\FormBundle\Tests\Entity\FormSubmissionFieldTypes;

use Kunstmaan\FormBundle\Entity\FormSubmissionFieldTypes\TextFormSubmissionField;
use Kunstmaan\FormBundle\Form\TextFormSubmissionType;
use PHPUnit\Framework\TestCase;

/**
 * Tests for TextFormSubmissionField
 */
class TextFormSubmissionFieldTest extends TestCase
{
    /**
     * @var TextFormSubmissionField
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new TextFormSubmissionField();
    }

    /**
     * @covers \Kunstmaan\FormBundle\Entity\FormSubmissionFieldTypes\TextFormSubmissionField::getValue
     * @covers \Kunstmaan\FormBundle\Entity\FormSubmissionFieldTypes\TextFormSubmissionField::setValue
     */
    public function testGetSetValue()
    {
        $object = $this->object;
        $value = 'test';
        $object->setValue($value);
        $this->assertEquals($value, $object->getValue());
    }

    /**
     * @covers \Kunstmaan\FormBundle\Entity\FormSubmissionFieldTypes\TextFormSubmissionField::getDefaultAdminType
     */
    public function testGetDefaultAdminType()
    {
        $this->assertEquals(TextFormSubmissionType::class, $this->object->getDefaultAdminType());
    }

    /**
     * @covers \Kunstmaan\FormBundle\Entity\FormSubmissionFieldTypes\TextFormSubmissionField::__toString
     */
    public function testToString()
    {
        $stringValue = $this->object->__toString();
        $this->assertNotNull($stringValue);
        $this->assertInternalType('string', $stringValue);
    }
}
