<?php

/**
 * Mixtape form.
 *
 * @package    podcastadmin
 * @subpackage form
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MixtapeForm extends BaseMixtapeForm
{
  public function configure()
  {
  	/*
  	 * Checa si el objeto es nuevo pone la imagen default
  	*/
  	$banner = $this->getObject()->getBanner();
  	$file_src = '/uploads/images/'.$this->getObject()->getBanner();
  	$hasBanner = empty($banner);
  	if ($this->getObject()->isNew() || $hasBanner)
  	{
  		$file_src = '/assets/default_image.jpg';
  	}
  	 
  	$this->widgetSchema['banner'] = new sfWidgetFormInputFileEditable(array(
  			'label' => 'Banner',
  			'file_src' => $file_src,
  			'is_image' => true,
  			'edit_mode' => true,
  			'template' => '<div class="sublabel">%file%<br />%input%<br />%delete% %delete_label%</div>',
  	));
  	 
  	$this->validatorSchema['banner'] = new sfValidatorFile(array(
  			'required'   => false,
  			'path'       => sfConfig::get('sf_upload_dir').'/images',
  			'mime_types' => 'web_images',
  	));
  	 
  	$this->validatorSchema['banner_delete'] = new sfValidatorPass();
  	
  	$mime_types = array('audio/mpeg', 'audio/mpeg3', 'audio/x-mpeg-3',
  			'video/mpeg', 'video/x-mpeg');
  	
  	$this->widgetSchema['file'] = new sfWidgetFormInputFileEditable(array(
  			'label' => 'File',
  			'file_src' => '/uploads/mixtapes/'.$this->getObject()->getFile(),
  			'edit_mode' => !$this->isNew(),
  			'with_delete' => false,
  			'template' => '<div class="sublabel"><audio controls="controls"><source src="%file%" type="audio/mp3">Your browser does not support the audio element.</audio><br />%input%<br />%delete% %delete_label%</div>'
  	));
  	 
  	$this->validatorSchema['file'] = new sfValidatorFile(array(
  			'required'   => true,
  			'path'       => sfConfig::get('sf_upload_dir').'/mixtapes',
  			'mime_types' => $mime_types,
  	));
  	
  	unset($this['created_at'], $this['updated_at']);
  	 
  	
  }
}
