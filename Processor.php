<?php

/**
 * Querylog_Processor
 *
 * @category   Addon
 * @package    addon.querylog
 * @author     Ebine Yutaka <yutaka@ebine.org>
 * @copyright  2004-2008 Mori Reo <mori.reo@sabel.jp>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */
class Querylog_Processor extends Sabel_Bus_Processor
{
  protected $responseName = "QUERY_LOG_HTML";
  
  public function execute(Sabel_Bus $bus)
  {
    $response = $bus->get("response");
    
    if (!$queries = Sabel_Db_Statement::getExecutedQueries()) {
      return $response->setResponse($this->responseName, "");
    }
    
    $rows = array();
    for ($i = 0, $c = count($queries); $i < $c; $i++) {
      $query = $queries[$i];
      
      $binds = "";
      if (!empty($query["binds"])) {
        $buf = array();
        foreach ($query["binds"] as $k => $v) {
          $buf[] = "{$k} => {$v}";
        }
        
        $binds = implode(", ", $buf);
      }
      
      $rows[$i]["sql"]   = $query["sql"];
      $rows[$i]["binds"] = $binds;
      $rows[$i]["time"]  = sprintf("%.3f", $query["time"] * 1000);
      
      if ($query["time"] > 2000) {
        // Slow Query
        // ...
      }
    }
    
    if ((ENVIRONMENT & PRODUCTION) > 0) {
      $response->setResponse($this->responseName, "");
    } else {
      ob_start();
      include (dirname(__FILE__) . DIRECTORY_SEPARATOR . "html.tpl");
      $response->setResponse($this->responseName, ob_get_clean());
    }
  }
}
