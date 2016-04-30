<?php

/**
 * @file
 * Contains PrimitiveElementTest
 */

namespace Drupal\Tests\typed_widget\Unit;

use Drupal\typed_widget\Form\TypedElementBuilder;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Tests that primitive data types can have elements.
 *
 * @group typed_widget
 */
class PrimitiveElementTest extends TypedElementTestBase {

  /**
   * Assert that a checkbox element is provided for a boolean.
   */
  public function testBoolean() {
    $expected = [
      '#type' => 'checkbox',
      '#title' => $this->getRandomGenerator()->name(),
      '#description' => '',
    ];

    $booleanDefinition = DataDefinition::create('boolean');
    $booleanDefinition->setLabel($expected['#title']);
    $typedDataManager = $this->getTypedDataMock($booleanDefinition);

    // Set the container
    $this->setContainer($typedDataManager);

    $elementBuilder = new TypedElementBuilder(
      $typedDataManager,
      $this->getLogger(),
      $this->getModuleHandlerMock()
    );

    $element = $elementBuilder->getElementFor('boolean');
    $this->assertEquals($expected, $element);
  }

  /**
   * Assert that a textfield element is provided for a string.
   */
  public function testString() {
    $expected = [
      '#type' => 'textfield',
      '#title' => $this->getRandomGenerator()->name(),
      '#description' => $this->getRandomGenerator()->sentences(10, TRUE),
      '#required' => TRUE,
    ];

    $stringDefinition = DataDefinition::create('string');
    $stringDefinition
      ->setLabel($expected['#title'])
      ->setDescription($expected['#description'])
      ->setRequired(TRUE);
    $typedDataManager = $this->getTypedDataMock($stringDefinition);

    // Set the container
    $this->setContainer($typedDataManager);

    $elementBuilder = new TypedElementBuilder(
      $typedDataManager,
      $this->getLogger(),
      $this->getModuleHandlerMock()
    );

    $element = $elementBuilder->getElementFor('string');
    $this->assertEquals($expected, $element);
  }

}
