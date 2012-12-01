<?php

require_once dirname(__FILE__).'/../lib/itemGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/itemGeneratorHelper.class.php';

/**
 * item actions.
 *
 * @package    podcastadmin
 * @subpackage item
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class itemActions extends autoItemActions
{
	public function executeEdit(sfWebRequest $request)
	{
		$this->item = $this->getRoute()->getObject();
		$this->convertAuthorsStringToArray();
		$this->form = $this->configuration->getForm($this->item);
		
		$this->itemShortcutForm = new ItemShortcutForm();
	}
	
	public function executeNew(sfWebRequest $request)
	{
		$this->itemShortcutForm = new ItemShortcutForm();
	
		parent::executeNew($request);
	}
	
	public function executeCreate(sfWebRequest $request)
	{
		$this->convertAuthorsArrayToString($request);
	
		parent::executeCreate($request);
	}
	
	public function executeUpdate(sfWebRequest $request)
	{
		$this->convertAuthorsArrayToString($request);
	
		parent::executeUpdate($request);
	}
	
	public function executeNewByShortcut(sfWebRequest $request)
	{
		$item = $request->getParameter('item');
		
		/** TODO obtener las propiedades del archivo recibido y llenar los campos
		 */
		
		$item['title']= "Shortcut-title";
		$item['subtitle'] = "Shortcut-subtitle";
		$item['author'] = "Dj Agustin, Dj Migue Soria, Dj Matt";
		$item['summary'] = "Shortcut-summary";
		$item['image'] = "Shortcut-image";
		$item['url'] = "url";
		$item['lenght'] = "99999";
		$item['type'] = "audio/mpeg";
		$item['pub_date'] = "2012-01-01 00:00:00";
		$item['duration'] = "00:03:20";
		$item['keywords'] = "muchobeat, mucho beat, music";
		//$item['slug'] = "mucho-beat-01";
		
		$request->setParameter('item', $item);
		$this->itemShortcutForm = new ItemShortcutForm();
		
		parent::executeCreate($request);
	}
	
	/**
	 * @param sfWebRequest $request
	 * Get the auhtor's array and convert it to string separated by comma,
	 * And replace the authors parameter in the request with the string
	 */
	private function convertAuthorsArrayToString(sfWebRequest $request)
	{
		$formRequest = $request->getParameter($this->getModuleName());
		$authors =  $formRequest['author']; //Authors as array
		
		$sAuthors="";
		foreach ($authors as $i=>$author){
			$sAuthors .= $author;		//Authors as string to save on DB
			if (($i+1)<count($authors)){
				$sAuthors.=", ";
			}
		}
	
		$formRequest['author'] = $sAuthors;
		$request->setParameter($this->getModuleName(), $formRequest);
	}
	
	/**
	 * Get the author parameter as string separated by comma, conver it to an array
	 * then, updates the @var $this->channel in author parameter with the final array
	 */
	private function convertAuthorsStringToArray()
	{
		$authors = str_replace(", ", ",", $this->item['author']);
		$aAuthors = explode(',', $authors);
	
		$this->item['author'] = $aAuthors;
	}
}
