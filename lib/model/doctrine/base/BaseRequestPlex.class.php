<?php

/**
 * BaseRequestPlex
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property timestamp $date
 * @property string $type
 * @property string $search_infos
 * @property string $user_culture
 * @property string $user_ip
 * @property string $user_agent
 * @property string $user_folder
 * @property string $filename
 * @property string $user_info
 * @property string $header
 * @property string $header_raw
 * @property clob $response_raw
 * @property int $response_code
 * @property clob $response_processed
 * @property decimal $elapsed_plex_request
 * @property decimal $elapsed_process_response
 * 
 * @method timestamp   getDate()                     Returns the current record's "date" value
 * @method string      getType()                     Returns the current record's "type" value
 * @method string      getSearchInfos()              Returns the current record's "search_infos" value
 * @method string      getUserCulture()              Returns the current record's "user_culture" value
 * @method string      getUserIp()                   Returns the current record's "user_ip" value
 * @method string      getUserAgent()                Returns the current record's "user_agent" value
 * @method string      getUserFolder()               Returns the current record's "user_folder" value
 * @method string      getFilename()                 Returns the current record's "filename" value
 * @method string      getUserInfo()                 Returns the current record's "user_info" value
 * @method string      getHeader()                   Returns the current record's "header" value
 * @method string      getHeaderRaw()                Returns the current record's "header_raw" value
 * @method clob        getResponseRaw()              Returns the current record's "response_raw" value
 * @method int         getResponseCode()             Returns the current record's "response_code" value
 * @method clob        getResponseProcessed()        Returns the current record's "response_processed" value
 * @method decimal     getElapsedPlexRequest()       Returns the current record's "elapsed_plex_request" value
 * @method decimal     getElapsedProcessResponse()   Returns the current record's "elapsed_process_response" value
 * @method RequestPlex setDate()                     Sets the current record's "date" value
 * @method RequestPlex setType()                     Sets the current record's "type" value
 * @method RequestPlex setSearchInfos()              Sets the current record's "search_infos" value
 * @method RequestPlex setUserCulture()              Sets the current record's "user_culture" value
 * @method RequestPlex setUserIp()                   Sets the current record's "user_ip" value
 * @method RequestPlex setUserAgent()                Sets the current record's "user_agent" value
 * @method RequestPlex setUserFolder()               Sets the current record's "user_folder" value
 * @method RequestPlex setFilename()                 Sets the current record's "filename" value
 * @method RequestPlex setUserInfo()                 Sets the current record's "user_info" value
 * @method RequestPlex setHeader()                   Sets the current record's "header" value
 * @method RequestPlex setHeaderRaw()                Sets the current record's "header_raw" value
 * @method RequestPlex setResponseRaw()              Sets the current record's "response_raw" value
 * @method RequestPlex setResponseCode()             Sets the current record's "response_code" value
 * @method RequestPlex setResponseProcessed()        Sets the current record's "response_processed" value
 * @method RequestPlex setElapsedPlexRequest()       Sets the current record's "elapsed_plex_request" value
 * @method RequestPlex setElapsedProcessResponse()   Sets the current record's "elapsed_process_response" value
 * 
 * @package    hyplexdemo
 * @subpackage model
 * @author     David Maignan
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRequestPlex extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('request_plex');
        $this->hasColumn('date', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('type', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('search_infos', 'string', 4000, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 4000,
             ));
        $this->hasColumn('user_culture', 'string', 10, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 10,
             ));
        $this->hasColumn('user_ip', 'string', 20, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('user_agent', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('user_folder', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('filename', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('user_info', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));
        $this->hasColumn('header', 'string', 4000, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 4000,
             ));
        $this->hasColumn('header_raw', 'string', 4000, array(
             'type' => 'string',
             'length' => 4000,
             ));
        $this->hasColumn('response_raw', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('response_code', 'int', null, array(
             'type' => 'int',
             'notnull' => true,
             ));
        $this->hasColumn('response_processed', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('elapsed_plex_request', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             'scale' => 14,
             ));
        $this->hasColumn('elapsed_process_response', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             'scale' => 14,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
        $this->option('type', 'INNODB');
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}