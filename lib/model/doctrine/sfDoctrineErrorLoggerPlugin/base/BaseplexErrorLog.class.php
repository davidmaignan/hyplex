<?php

/**
 * BaseplexErrorLog
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $type
 * @property string $class_name
 * @property string $message
 * @property string $file
 * @property clob $parameters
 * @property clob $plex_response
 * 
 * @method integer      getId()            Returns the current record's "id" value
 * @method string       getType()          Returns the current record's "type" value
 * @method string       getClassName()     Returns the current record's "class_name" value
 * @method string       getMessage()       Returns the current record's "message" value
 * @method string       getFile()          Returns the current record's "file" value
 * @method clob         getParameters()    Returns the current record's "parameters" value
 * @method clob         getPlexResponse()  Returns the current record's "plex_response" value
 * @method plexErrorLog setId()            Sets the current record's "id" value
 * @method plexErrorLog setType()          Sets the current record's "type" value
 * @method plexErrorLog setClassName()     Sets the current record's "class_name" value
 * @method plexErrorLog setMessage()       Sets the current record's "message" value
 * @method plexErrorLog setFile()          Sets the current record's "file" value
 * @method plexErrorLog setParameters()    Sets the current record's "parameters" value
 * @method plexErrorLog setPlexResponse()  Sets the current record's "plex_response" value
 * 
 * @package    hyplexdemo
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseplexErrorLog extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('plex_error_log');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('type', 'string', 3, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 3,
             ));
        $this->hasColumn('class_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('message', 'string', 1000000, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 1000000,
             ));
        $this->hasColumn('file', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('parameters', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));
        $this->hasColumn('plex_response', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}