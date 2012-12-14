<?php

require_once dirname(__FILE__).'/../lib/itemGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/itemGeneratorHelper.class.php';
require_once dirname(__FILE__).'/../../../../../lib/vendor/getid3/getid3.php';

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
		$this->item['author'] = $this->getAuthorsAsArray($this->item['author']);
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
		
		$item = $request->getParameter("item");
		$files = $request->getFiles();
		$fileDir = $files['item']['file']['tmp_name'];
		
		$fileProperties = $this->getFileProperties($fileDir);
		
		$item['keywords'] = $fileProperties['keywords'];
		$item['lenght'] = $fileProperties['lenght'];
		$item['duration'] = $fileProperties['duration'];
		$item['type'] = $fileProperties['type'];
		
		$request->setParameter('item', $item);
		
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
		$fileDir = $files['item']['file']['tmp_name'];
		
		$fileProperties = $this->getFileProperties($fileDir);
		
		$item['title'] = $fileProperties['title'];
		$item['subtitle'] = $fileProperties['subtitle'];
		$item['author'] = $fileProperties['author'];
		$item['summary'] = $fileProperties['summary'];
		$item['url'] = $fileProperties['url'];
		$item['lenght'] = $fileProperties['lenght'];
		$item['type'] = $fileProperties['type'];
		$item['pub_date'] = $fileProperties['pub_date'];
		$item['duration'] = $fileProperties['duration'];
		$item['keywords'] = $fileProperties['keywords'];
		
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
	private function getAuthorsAsArray($author)
	{
		if (!$author){
			$author = $this->item['author'];
		}
		
		$authors = str_replace(", ", ",", $author);
		$aAuthors = explode(',', $authors);
		
		return $aAuthors;
	}
	
	protected function getFileProperties($fileDir)
	{
		$is_complete = true;
		
		$getID3 = new getID3;
		$fileInfo = $getID3->analyze($fileDir);
		
		$fileProperties = array();
		
		if (isset($fileInfo['tags']['id3v2']['title'][0])){
			$fileProperties['title'] = $fileInfo['tags']['id3v2']['title'][0];
		}else{
			$fileProperties['title'] = ""; $is_complete = false;
		}
		
		if (isset($fileInfo['tags']['id3v2']['subtitle'][0])){
			$fileProperties['subtitle'] = $fileInfo['tags']['id3v2']['subtitle'][0];
		}else {
			$fileProperties['subtitle'] = ""; $is_complete = false;
		}
		
		if (isset($fileInfo['tags']['id3v2']['artis'][0])){
			$fileProperties['author'] = $fileInfo['tags']['id3v2']['artist'][0];
		}else {
			$fileProperties['author'] = "Dj Agustin, Dj Migue Soria, Dj Matt, Marcela Saiffe";
		}
		
		if (isset($fileInfo['tags']['id3v2']['comment'][0])){
			$fileProperties['summary'] = $fileInfo['tags']['id3v2']['comment'][0];
		}else {
			$fileProperties = ""; $is_complete = false;
		}
		
		if (isset($fileInfo['tags']['id3v2']['url_user'][0])){
			$fileProperties['url'] = $fileInfo['tags']['id3v2']['url_user'][0];
		}
		else {
			$fileProperties['url'] = ""; $is_complete = false;
		}
		
		if (isset($fileInfo['filesize'])){
			$fileProperties['lenght'] = $fileInfo['filesize'];
		}
		else {
			$fileProperties['length'] = ""; $is_complete = false;
		}
		
		if (isset($fileInfo['mime_type'])){
			$fileProperties['type'] = $fileInfo['mime_type'];
		}
		else {
			$fileProperties['type'] = ""; $is_complete = false;
		}
		
		$fileProperties['pub_date'] = date("d/m/Y h:m:s");
		
		if (isset($fileInfo['playtime_string'])){
			$fileProperties['duration'] = $fileInfo['playtime_string'];
		}
		else {
			$fileProperties['duration'] = ""; $is_complete = false;
		}
		
		if (isset($fileInfo['tags']['id3v2']['keyword'][0])){
			$fileProperties['keywords'] = $fileInfo['tags']['id3v2']['keyword'][0];
		}else {
			$fileProperties['keywords'] = "muchobeat, mucho beat, music";
		}
		
		$fileProperties['image'] = "";
		
		if (!$is_complete){
			$fileProperties['author'] = $this->getAuthorsAsArray($fileProperties['author']);
		}
		
		return $fileProperties;
	}
}
