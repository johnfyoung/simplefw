<?php
//$Id$
/**
 * @file
 *
 * @author
 */


 /**
  * @orm whpPoll
  */
 class whpPoll
 {
 	  /**
 	   * @orm char(128)
 	   */
 	  public $name;
 	  
 	  /**
 	   * @orm datetime
 	   */
 	  public $startdate;

    /**
     * @orm datetime
     */
 	  public $enddate;
 	  
    /**
     * @orm has one whpClient
     */
 	  public $clientId;
 }
 
 ?>