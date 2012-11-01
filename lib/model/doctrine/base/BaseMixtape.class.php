<?php

/**
 * BaseMixtape
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $title
 * @property string $file
 * @property Doctrine_Collection $Token
 * 
 * @method string              getTitle() Returns the current record's "title" value
 * @method string              getFile()  Returns the current record's "file" value
 * @method Doctrine_Collection getToken() Returns the current record's "Token" collection
 * @method Mixtape             setTitle() Sets the current record's "title" value
 * @method Mixtape             setFile()  Sets the current record's "file" value
 * @method Mixtape             setToken() Sets the current record's "Token" collection
 * 
 * @package    podcastadmin
 * @subpackage model
 * @author     Enrique Garcia <enrique@inodata.com.mx>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMixtape extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('mixtape');
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('file', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));

        $this->option('collate', 'utf8_general_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'InnoDB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Token', array(
             'local' => 'id',
             'foreign' => 'mixtape_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}