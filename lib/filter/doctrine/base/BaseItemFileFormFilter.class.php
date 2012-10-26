<?php

/**
 * ItemFile filter form base class.
 *
 * @package    podcastadmin
 * @subpackage filter
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseItemFileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'item_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Item'), 'add_empty' => true)),
      'filename' => new sfWidgetFormFilterInput(),
      'caption'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'item_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Item'), 'column' => 'id')),
      'filename' => new sfValidatorPass(array('required' => false)),
      'caption'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item_file_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemFile';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'item_id'  => 'ForeignKey',
      'filename' => 'Text',
      'caption'  => 'Text',
    );
  }
}
