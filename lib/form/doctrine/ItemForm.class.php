<?php

/**
 * Item form.
 *
 * @package    podcastadmin
 * @subpackage form
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ItemForm extends BaseItemForm
{
  public function configure()
  {
  	$mime_types = "audio/mpeg, video/mp4";
  	
  	$this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
  			'label' => 'Image',
  			'file_src' => '/uploads/images/'.$this->getObject()->getImage(),
  			'is_image' => true,
  			'edit_mode' => !$this->isNew(),
  			'template' => '<div class="sublabel">%file%<br />%input%<br />%delete% %delete_label%</div>',
  	));
  	
  	$this->validatorSchema['image'] = new sfValidatorFile(array(
  			'required'   => false,
  			'path'       => sfConfig::get('sf_upload_dir').'/images',
  			'mime_types' => 'web_images',
  	));
  	
  	$this->validatorSchema['image_delete'] = new sfValidatorPass();
  	
  	//TODO: Revisar que diferencia hay entre tipos de archivo de imagen y otro, probar con archivos de texto.
  	//TODO: Error retornado: Action "item/1" does not exist.
  	$this->widgetSchema['file'] = new sfWidgetFormInputFileEditable(array(
  			'file_src' => '/uploads/podcasts/'.$this->getObject()->getFile(),
  			'edit_mode' => false,
  			'template' => '<div class="sublabel">%file%<br />%input%<br />%delete% %delete_label%</div>'
  	));
  	
  	$this->validatorSchema['image'] = new sfValidatorFile(array(
  			'required'   => false,
  	    'max_size'	=> 120000000,
  			'path'       => sfConfig::get('sf_upload_dir').'/podcasts',
  			'mime_types' => "audio/mpeg, video/mp4",
  	));
  	
  	$this->validatorSchema['file_delete'] = new sfValidatorPass();
  	
  	unset($this['created_at'], $this['updated_at']);
  	
  }
}
