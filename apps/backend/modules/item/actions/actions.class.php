<?php

require_once dirname(__FILE__).'/../lib/itemGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/itemGeneratorHelper.class.php';
require_once '/home/heriberto/workspace/PodcastAdmin/lib/vendor/getid3/getid3.php';

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
		$this->itemShortcutForm = $this->configuration->getForm();
		
		$this->item = $this->getRoute()->getObject();
		$this->convertAuthorsStringToArray();
		$this->form = $this->configuration->getForm($this->item);
	}
	
	public function executeNew(sfWebRequest $request)
	{
		$this->itemShortcutForm = $this->configuration->getForm();
	
		parent::executeNew($request);
	}
	
	public function executeCreate(sfWebRequest $request)
	{
		$this->itemShortcutForm = $this->configuration->getForm();
		
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
		$item = $request->getParameter("item");
		
		$files = $request->getFiles();
		$file = $files['item']['file']['tmp_name'];
		
		$getID3 = new getID3;
		$fileInfo = $getID3->analyze($file);
		
		$item['title'] = $fileInfo['tags']['id3v1']['title'][0];
		$item['subtitle'] = "Falta por encontrar";
		$item['author'] = "Dj Agustin, Dj Migue Soria, Dj Matt"; //$fileInfo['tags']['artis'][0];
		$item['summary'] = $fileInfo['tags']['id3v1']['comment'][0];
		$item['url'] = $fileInfo['tags']['id3v2']['url_user'][0];
		$item['lenght'] = $fileInfo['filesize'];
		$item['type'] = $fileInfo['mime_type'];
		$item['pub_date'] = "01/01/2012 01:01:01";//$fileInfo['tags']['year'];
		$item['duration'] = $fileInfo['playtime_string'];
		$item['keywords'] = "muchobeat, mucho beat, music";
		
		$request->setParameter('item', $item);
		$this->itemShortcutForm = $this->configuration->getForm();
		
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
		
		if(isset($formRequest['author']))
		{ 
			$authors =  $formRequest['author'];
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
