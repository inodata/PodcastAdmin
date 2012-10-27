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
    $subForm = new sfForm();
    $itemFile = new ItemFile();
    $itemFile->Item = $this->getObject();
    $form = new ItemFileForm($itemFile);
    $subForm->embedForm("podcast", $form);
    $this->embedForm('attachment', $subForm);
  }
}
