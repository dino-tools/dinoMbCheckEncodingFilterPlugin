<?php

/**
 * 不正なエンコーディングを検出するフィルター
 * 
 * @package    lib
 * @subpackage filter
 * @author     Kiryu Tsukimiya <tsukimiya@dino.co.jp>
 * @version    $Id: dinoMbCheckEncodingFilter.class.php 105 2008-09-09 12:03:02Z nakai $
 *
 */
class dinoMbCheckEncodingFilter extends sfFilter
{
  /**
   * Executes this filter
   * 
   * @param sfFilterChain $filterChain
   */
  public function execute($filterChain)
  {
    if ($this->isFirstCall())
    {
      $encoding = $this->getParameter('encoding', ini_get('mbstring.internal_encoding'));
      
      $request = $this->getContext()->getRequest();
      $parameters = $request->getParameterHolder()->getAll();
      
      array_walk_recursive($parameters, array('self', 'checkEncoding'), $encoding);
    }
    
    // execute next filter
    $filterChain->execute();
  }
  
  /**
   * check illegal character
   *
   * @param string $value
   * @param string $key
   * @param string $encoding
   */
  public static function checkEncoding($value, $key, $encoding)
  {
    if (mb_check_encoding($key, $encoding) == false ||
        mb_check_encoding($value, $encoding) == false)
    {
      throw new sfException('Illegal character detected.');
    }
  }
}