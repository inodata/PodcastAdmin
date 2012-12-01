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
  	
  	$mime_types = array('audio/mpeg', 'audio/mpeg3', 'audio/x-mpeg-3',
  											'video/mpeg', 'video/x-mpeg');
  	
  	/*
  	 * Checa si el objeto es nuevo pone la imagen default
  	 */
  	$file_src = '/uploads/images/'.$this->getObject()->getImage();
  	if ($this->getObject()->isNew())
  	{
  		$file_src = '/assets/default_image.jpg';
  	}
  	
  	//TODO: Implementar datepicker para pubdate.
  	
  	$this->widgetSchema['author'] = new sfWidgetFormChoice(array(
  			'choices'=>array(
  					'Dj Agustin'=>'Dj Agustin',
  					'Dj Migue Soria'=>'Dj Migue Soria',
  					'Dj Matt'=>'Dj Matt',
  					'Marcela Saiffe'=>'Marcela Saiffe'),
  			'expanded'=>true,
  			'multiple'=>true,
  	));
  	
  	/*
  	$this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
  			'label' => 'Image',
  			'file_src' => $file_src,
  			'is_image' => true,
  			'edit_mode' => !$this->isNew(),
  			'template' => '<div class="sublabel">%file%<br />%input%<br />%delete% %delete_label%</div>',
  	));
  	
  	$this->validatorSchema['image'] = new sfValidatorFile(array(
  			'required'   => false,
  			'path'       => sfConfig::get('sf_upload_dir').'/images',
  			'mime_types' => 'web_images',
  	));
  	*/
  	
  	$mime_types_images = array('image/jpeg', 'image/png', 'image/bmp', 'image/gif');
  	$imgSize = $this->getObject()->getImage()!=""? "60px" : "";
  	
  	$this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
  			'file_src' => '/uploads/channels/'.$this->getObject()->getImage(),
  			'with_delete' => false,
  			'template' => '<div><img src="%file%" width="'.$imgSize.'" height="'.$imgSize.'"></img><br><br>%input%</div>'
  	));
  	
  	$required = $this->getObject()->getImage()!="" ? false : true;
  	 
  	$this->validatorSchema['image'] = new sfValidatorFile(array(
  			'required' => $required,
  			'path' => sfConfig::get("sf_upload_dir").'/channels/',
  			'mime_types' => $mime_types_images,
  	));
  	
  	$this->validatorSchema['image_delete'] = new sfValidatorPass();
  	
  	/**
			Cuando se manejan archivos grandes, tanto la opcion max_size en el validator
			como las directivas upload_max_filesize y post_max_size deben ser congruentes.
			En este caso la opcion max_size se deja abierta por depender del hosting.
  	 */
  	$this->widgetSchema['file'] = new sfWidgetFormInputFileEditable(array(
  			'label' => 'File',
  			'file_src' => '/uploads/podcasts/'.$this->getObject()->getFile(),
  			'edit_mode' => !$this->isNew(),
  			'with_delete' => false,
  			'template' => '<div class="sublabel"><audio controls="controls"><source src="%file%" type="audio/mp3">Your browser does not support the audio element.</audio><br />%input%<br />%delete% %delete_label%</div>'
  	));
  	
  	$require = $this->getObject()->getFile()!="" ? false : true;
  	
  	$this->validatorSchema['file'] = new sfValidatorFile(array(
  			'required'   => $require,
  			'path'       => sfConfig::get('sf_upload_dir').'/podcasts',
  			'mime_types' => $mime_types,  			
  	));
  	
  	unset($this['slug'], $this['created_at'], $this['updated_at']);
  	
  }
}
