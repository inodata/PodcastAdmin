<?php

/**
 * mixtape actions.
 *
 * @package    podcastadmin
 * @subpackage mixtape
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mixtapeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->mixtapes = Doctrine_Core::getTable('Mixtape')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->mixtape = Doctrine_Core::getTable('Mixtape')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->mixtape);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MixtapeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MixtapeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($mixtape = Doctrine_Core::getTable('Mixtape')->find(array($request->getParameter('id'))), sprintf('Object mixtape does not exist (%s).', $request->getParameter('id')));
    $this->form = new MixtapeForm($mixtape);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($mixtape = Doctrine_Core::getTable('Mixtape')->find(array($request->getParameter('id'))), sprintf('Object mixtape does not exist (%s).', $request->getParameter('id')));
    $this->form = new MixtapeForm($mixtape);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($mixtape = Doctrine_Core::getTable('Mixtape')->find(array($request->getParameter('id'))), sprintf('Object mixtape does not exist (%s).', $request->getParameter('id')));
    $mixtape->delete();

    $this->redirect('mixtape/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $mixtape = $form->save();

      $this->redirect('mixtape/edit?id='.$mixtape->getId());
    }
  }
}
