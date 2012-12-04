<?php

/**
 * Channel form base class.
 *
 * @method Channel getObject() Returns the current form's model object
 *
 * @package    podcastadmin
 * @subpackage form
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseChannelForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'title'       => new sfWidgetFormInputText(),
      'subtitle'    => new sfWidgetFormInputText(),
      'author'      => new sfWidgetFormInputText(),
      'summary'     => new sfWidgetFormTextarea(),
      'description' => new sfWidgetFormTextarea(),
      'category'    => new sfWidgetFormInputText(),
      'image'       => new sfWidgetFormInputText(),
      'link'        => new sfWidgetFormInputText(),
      'language'    => new sfWidgetFormInputText(),
      'copyright'   => new sfWidgetFormInputText(),
      'explicit'    => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 255)),
      'subtitle'    => new sfValidatorString(array('max_length' => 255)),
      'author'      => new sfValidatorString(array('max_length' => 60)),
      'summary'     => new sfValidatorString(array('max_length' => 600)),
      'description' => new sfValidatorString(array('max_length' => 4000)),
      'category'    => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'image'       => new sfValidatorString(array('max_length' => 255)),
      'link'        => new sfValidatorString(array('max_length' => 255)),
      'language'    => new sfValidatorString(array('max_length' => 40)),
      'copyright'   => new sfValidatorString(array('max_length' => 255)),
      'explicit'    => new sfValidatorBoolean(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('channel[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Channel';
  }

}
