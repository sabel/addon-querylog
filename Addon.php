<?php

/**
 * Querylog_Addon
 *
 * @category   Addon
 * @package    addon.querylog
 * @author     Ebine Yutaka <yutaka@ebine.org>
 * @copyright  2004-2008 Mori Reo <mori.reo@sabel.jp>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 */
class Querylog_Addon extends Sabel_Object implements Sabel_Addon
{
  const VERSION = 1.0;
  
  public function execute(Sabel_Bus $bus)
  {
    $bus->insertProcessor("view", new Querylog_Processor("querylog"), "before");
  }
}
