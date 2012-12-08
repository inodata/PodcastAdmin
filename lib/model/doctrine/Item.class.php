<?php

/**
 * Item
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    podcastadmin
 * @subpackage model
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Item extends BaseItem
{
	public function getXml(){
		$xml = <<<XML
			<item>
      <title>$this->getTitle()</title>
      <itunes:author>$this->getAuthor()</itunes:author>
      <itunes:subtitle>$this->getSubtitle()</itunes:subtitle>
      <itunes:summary>$this->getSummary()</itunes:summary>
      <itunes:image href="http://itunes.muchobeat.com/images/muchobeat_podcast01.jpg" />
      <enclosure url="http://muchobeat.com/mp3/91-muchobeat91.mp3" length="$this->getLenght()" type="$this->getType()" />
      <guid>http://muchobeat.com/mp3/91-muchobeat91.mp3</guid>
      <pubDate>$this->getFormatedPubDate()</pubDate>
      <itunes:duration>$this->getDuration()</itunes:duration>
      <itunes:keywords>$this->getKeywords()</itunes:keywords>
    </item>
XML;
		return $xml;
	}
	
	public function getFormatedPubDate(){
		return $date = $this->getPubDate();
		
		//$format = new sfDateFormat();
		
		//$date->format("Thu, 15 Nov 2012 22:00:00 -0600")
		
	}
}
