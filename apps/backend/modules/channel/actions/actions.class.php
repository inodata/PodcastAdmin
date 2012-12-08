<?php

require_once dirname(__FILE__).'/../lib/channelGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/channelGeneratorHelper.class.php';

/**
 * channel actions.
 *
 * @package    podcastadmin
 * @subpackage channel
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class channelActions extends autoChannelActions
{
	public function executeEdit(sfWebRequest $request)
	{
		$this->channel = $this->getRoute()->getObject();
		$this->convertAuthorsStringToArray();
		$this->form = $this->configuration->getForm($this->channel);
		
		$this->itemShortcutForm = new ItemForm();
	}
	
	public function executeNew(sfWebRequest $request)
	{
		$this->itemShortcutForm = new ItemForm();
		
		parent::executeNew($request);
	}
	
	public function executeCreate(sfWebRequest $request)
	{
		$this->convertAuthorsArrayToString($request);
		$this->itemShortcutForm = new ItemForm();
		
		parent::executeCreate($request);
	}
	
	public function executeUpdate(sfWebRequest $request)
	{
		$this->convertAuthorsArrayToString($request);
		$this->itemShortcutForm = new ItemForm();
		
		parent::executeUpdate($request);
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
		$authors = str_replace(", ", ",", $this->channel['author']);
		$aAuthors = explode(',', $authors);
		
		$this->channel['author'] = $aAuthors;
	}
}
