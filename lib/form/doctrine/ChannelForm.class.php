<?php

/**
 * Channel form.
 *
 * @package    podcastadmin
 * @subpackage form
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ChannelForm extends BaseChannelForm
{
  public function configure()
  {
  	
  	$this->widgetSchema['author'] = new sfWidgetFormChoice(array(
  			'choices'=>array(
  					'Dj Agustin'=>'Dj Agustin', 
  					'Dj Migue Soria'=>'Dj Migue Soria', 
  					'Dj Matt'=>'Dj Matt', 
  					'Marcela Saiffe'=>'Marcela Saiffe'),
  			'expanded'=>true, 
  			'multiple'=>true,
  	));
  	
  	$this->widgetSchema['language'] = new sfWidgetFormChoice(array(
  			'choices' => array(
  					'es-mx' => 'Spanish',
  					'en-us' => 'English',
  			)
  	));
  	
  	$mime_types = array('image/jpeg', 'image/png', 'image/bmp', 'image/gif');
  	$imgSize = $this->getObject()->getImage()!=""? "60px" : "";
  	
  	$this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
  			'file_src' => '/uploads/channels/'.$this->getObject()->getImage(),
  			'with_delete' => false,
  			'template' => '<div><img src="%file%" width="'.$imgSize.'" height="'.$imgSize.'"></img><br><br>%input%</div>'
  	));
  	
  	$required = $this->getObject()->getImage()!="" ? false : true;
  	
  	$this->validatorSchema['image'] = new sfImageFileValidator(array(
  			'required' => $required,
  			'path' => sfConfig::get("sf_upload_dir").'/channels/',
  			'mime_types' => $mime_types,
  			'min_height' => 1400,
  			'max_height' => 1400,
  			'min_width'  =>	1400,
  			'max_width'	 => 1400,
  	));
  	  	
  	$this->validatorSchema['link'] = new sfValidatorUrl();  	
  	
  	unset(
  		$this['category'], $this['created_at'], $this['updated_at']
  	);
  }
}
