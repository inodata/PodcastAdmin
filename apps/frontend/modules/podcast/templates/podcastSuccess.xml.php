<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>

<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
	<channel>
		<title><?php echo $channel->getTitle() ?></title>
		<link><?php echo $channel->getLink() ?></link>
		<language><?php echo $channel->getLanguage() ?></language>
		<copyright><?php echo $channel->getCopyright() ?></copyright>
		<itunes:subtitle><?php echo $channel->getSubtitle() ?></itunes:subtitle>
		<itunes:author><?php echo $channel->getAuthor() ?></itunes:author>
		<itunes:summary><?php echo $channel->getSummary() ?></itunes:summary>
		<description><?php echo $channel->getDescription() ?></description>
		<itunes:owner>
			<itunes:name>Agustin Sanchez</itunes:name>
			<itunes:email>info@muchobeat.com</itunes:email>
		</itunes:owner>
		<itunes:explicit><?php echo $channel->getExplicit() ?></itunes:explicit>
		<itunes:image href="http://itunes.muchobeat.com/images/muchobeat_podcast01.jpg" />
		<itunes:category text="<?php echo $channel->getExplicit() ?>" />
		<?php foreach ($items as $item) :?>
			<item>
	      <title><?php echo $item->getTitle()?></title>
	      <itunes:author><?php $item->getAuthor()?></itunes:author>
	      <itunes:subtitle><?php echo $item->getSubtitle()?></itunes:subtitle>
	      <itunes:summary><?php echo $item->getSummary()?></itunes:summary>
	      <itunes:image href="http://itunes.muchobeat.com/images/muchobeat_podcast01.jpg" />
	      <enclosure url="http://muchobeat.com/mp3/91-muchobeat91.mp3" length="<?php echo $item->getLenght()?>" type="<?php echo $item->getType()?>" />
	      <guid>http://muchobeat.com/mp3/91-muchobeat91.mp3</guid>
	      <pubDate><?php echo $item->getFormatedPubDate()?></pubDate>
	      <itunes:duration><?php echo $item->getDuration()?></itunes:duration>
	      <itunes:keywords><?php echo $item->getKeywords()?></itunes:keywords>
			</item>
		<?php endforeach;?>
	</channel>
</rss>