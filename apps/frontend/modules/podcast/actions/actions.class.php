<?php

/**
 * podcast actions.
 *
 * @package    podcastadmin
 * @subpackage podcast
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class podcastActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  /**
   * Genera el xml para el podcast
   */
  public function executeGenerateXml(sfWebRequest $request){
  	$request->setRequestFormat('xml');
  	
  	$channel = $request->getParameter('channel');
  	
  	$this->channel = $channel;
  	
  	$query = Doctrine_Query::create()
  		->from('Channel c')
  		->where('c.id = ?', $channel);
  	
  	$channel = $query->fetchOne();
  	$this->items = $channel->getItems();
  	
  	//$channel_list[0]->getXml();
  	$this->channel = $channel;
  	$this->setTemplate('podcast');
  }
}
