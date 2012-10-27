<?php

/**
 * ItemFile form.
 *
 * @package    podcastadmin
 * @subpackage form
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ItemFileForm extends BaseItemFileForm
{
  public function configure()
  {
    $mime_types = "audio/mpeg, video/mp4";
    $this->useFields(array('filename', 'caption'));
    $this->setWidget('filename', new sfWidgetFormInputFile());
    $this->setValidator('filename', new sfValidatorFile(array(
    	'mime_types' => $mime_types,
    	'path' => sfConfig::get('sf_upload_dir').'/podcasts',
    )));
  }
}
