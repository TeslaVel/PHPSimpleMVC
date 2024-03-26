<?php
class MaxRule {
  public static function validate($value, $max, $isString) {
    $val = $isString ? strlen($value) : $value;
    return $val <= $max;
  }
}