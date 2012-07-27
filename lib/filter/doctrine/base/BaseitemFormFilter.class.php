<?php

/**
 * item filter form base class.
 *
 * @package    podcastadmin
 * @subpackage filter
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseitemFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'subtitle'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'author'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'summary'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'image'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lenght'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'audio/mpeg' => 'audio/mpeg', 'video/mp4' => 'video/mp4'))),
      'pub_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'duration'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'keywords'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'      => new sfValidatorPass(array('required' => false)),
      'subtitle'   => new sfValidatorPass(array('required' => false)),
      'author'     => new sfValidatorPass(array('required' => false)),
      'summary'    => new sfValidatorPass(array('required' => false)),
      'image'      => new sfValidatorPass(array('required' => false)),
      'url'        => new sfValidatorPass(array('required' => false)),
      'lenght'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type'       => new sfValidatorChoice(array('required' => false, 'choices' => array('audio/mpeg' => 'audio/mpeg', 'video/mp4' => 'video/mp4'))),
      'pub_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'duration'   => new sfValidatorPass(array('required' => false)),
      'keywords'   => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'item';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'title'      => 'Text',
      'subtitle'   => 'Text',
      'author'     => 'Text',
      'summary'    => 'Text',
      'image'      => 'Text',
      'url'        => 'Text',
      'lenght'     => 'Number',
      'type'       => 'Enum',
      'pub_date'   => 'Date',
      'duration'   => 'Text',
      'keywords'   => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
      'slug'       => 'Text',
    );
  }
}
