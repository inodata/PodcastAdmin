<?php

/**
 * ItemShortcut form.
 *
 * @package    podcastadmin
 * @subpackage form
 * @author     Heriberto Monterrubio <heri185403@gmail.com.mx>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ItemShortcutForm extends BaseItemForm
{
	public function configure()
	{
		unset(
				$this['title'],$this['subtitle'], $this["author"], $this['summary'],
				$this['image'], $this['url'], $this['lenght'], $this['type'],
				$this['pub_date'], $this['duration'], $this['keywords'], $this['slug'],
				$this['created_at'], $this['updated_at']);
		
		$mime_types = array('audio/mpeg', 'audio/mpeg3', 'audio/x-mpeg-3',
				'video/mpeg', 'video/x-mpeg');
		
		$this->widgetSchema['file'] = new sfWidgetFormInputFile();
		
		$this->validatorSchema['file'] = new sfValidatorFile(array(
				'required' 	=> true,
				'path' 		=> sfConfig::get('sf_upload_dir').'/podcasts',
				'mime_types'=> $mime_types,
				));
	}
}
