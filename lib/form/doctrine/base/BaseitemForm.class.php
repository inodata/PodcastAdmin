<?php

/**
 * item form base class.
 *
 * @method item getObject() Returns the current form's model object
 *
 * @package    podcastadmin
 * @subpackage form
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseitemForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'title'      => new sfWidgetFormInputText(),
      'subtitle'   => new sfWidgetFormInputText(),
      'author'     => new sfWidgetFormInputText(),
      'summary'    => new sfWidgetFormTextarea(),
      'image'      => new sfWidgetFormInputText(),
      'url'        => new sfWidgetFormInputText(),
      'lenght'     => new sfWidgetFormInputText(),
      'type'       => new sfWidgetFormChoice(array('choices' => array('audio/mpeg' => 'audio/mpeg', 'video/mp4' => 'video/mp4'))),
      'pub_date'   => new sfWidgetFormDateTime(),
      'duration'   => new sfWidgetFormInputText(),
      'keywords'   => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'slug'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'      => new sfValidatorString(array('max_length' => 255)),
      'subtitle'   => new sfValidatorString(array('max_length' => 255)),
      'author'     => new sfValidatorString(array('max_length' => 60)),
      'summary'    => new sfValidatorString(array('max_length' => 600)),
      'image'      => new sfValidatorString(array('max_length' => 255)),
      'url'        => new sfValidatorString(array('max_length' => 255)),
      'lenght'     => new sfValidatorInteger(),
      'type'       => new sfValidatorChoice(array('choices' => array(0 => 'audio/mpeg', 1 => 'video/mp4'), 'required' => false)),
      'pub_date'   => new sfValidatorDateTime(),
      'duration'   => new sfValidatorString(array('max_length' => 16)),
      'keywords'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
      'slug'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'item', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'item';
  }

}
