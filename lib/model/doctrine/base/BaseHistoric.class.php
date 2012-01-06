<?php

/**
 * BaseHistoric
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property timestamp $date
 * @property integer $tsop
 * @property string $ip
 * @property integer $country_id
 * @property string $folder
 * @property string $language
 * @property string $sTId
 * @property string $agent
 * @property string $os
 * @property string $browser
 * @property string $version
 * @property string $uri
 * @property string $module
 * @property string $action
 * @property string $filename
 * @property array $parameters
 * @property boolean $scrubbed
 * @property string $session_id
 * @property Country $Country
 * 
 * @method timestamp getDate()       Returns the current record's "date" value
 * @method integer   getTsop()       Returns the current record's "tsop" value
 * @method string    getIp()         Returns the current record's "ip" value
 * @method integer   getCountryId()  Returns the current record's "country_id" value
 * @method string    getFolder()     Returns the current record's "folder" value
 * @method string    getLanguage()   Returns the current record's "language" value
 * @method string    getSTId()       Returns the current record's "sTId" value
 * @method string    getAgent()      Returns the current record's "agent" value
 * @method string    getOs()         Returns the current record's "os" value
 * @method string    getBrowser()    Returns the current record's "browser" value
 * @method string    getVersion()    Returns the current record's "version" value
 * @method string    getUri()        Returns the current record's "uri" value
 * @method string    getModule()     Returns the current record's "module" value
 * @method string    getAction()     Returns the current record's "action" value
 * @method string    getFilename()   Returns the current record's "filename" value
 * @method array     getParameters() Returns the current record's "parameters" value
 * @method boolean   getScrubbed()   Returns the current record's "scrubbed" value
 * @method string    getSessionId()  Returns the current record's "session_id" value
 * @method Country   getCountry()    Returns the current record's "Country" value
 * @method Historic  setDate()       Sets the current record's "date" value
 * @method Historic  setTsop()       Sets the current record's "tsop" value
 * @method Historic  setIp()         Sets the current record's "ip" value
 * @method Historic  setCountryId()  Sets the current record's "country_id" value
 * @method Historic  setFolder()     Sets the current record's "folder" value
 * @method Historic  setLanguage()   Sets the current record's "language" value
 * @method Historic  setSTId()       Sets the current record's "sTId" value
 * @method Historic  setAgent()      Sets the current record's "agent" value
 * @method Historic  setOs()         Sets the current record's "os" value
 * @method Historic  setBrowser()    Sets the current record's "browser" value
 * @method Historic  setVersion()    Sets the current record's "version" value
 * @method Historic  setUri()        Sets the current record's "uri" value
 * @method Historic  setModule()     Sets the current record's "module" value
 * @method Historic  setAction()     Sets the current record's "action" value
 * @method Historic  setFilename()   Sets the current record's "filename" value
 * @method Historic  setParameters() Sets the current record's "parameters" value
 * @method Historic  setScrubbed()   Sets the current record's "scrubbed" value
 * @method Historic  setSessionId()  Sets the current record's "session_id" value
 * @method Historic  setCountry()    Sets the current record's "Country" value
 * 
 * @package    hyplexdemo
 * @subpackage model
 * @author     David Maignan
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseHistoric extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('historic');
        $this->hasColumn('date', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('tsop', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ip', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('country_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('folder', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('language', 'string', 5, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 5,
             ));
        $this->hasColumn('sTId', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('agent', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('os', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('browser', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('version', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('uri', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('module', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('action', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('filename', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('parameters', 'array', null, array(
             'type' => 'array',
             'notnull' => true,
             ));
        $this->hasColumn('scrubbed', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('session_id', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'INNODB');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Country', array(
             'local' => 'country_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}