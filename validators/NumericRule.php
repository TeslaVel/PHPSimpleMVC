<?php
class NumericRule {
  public static function validate($value) {
    return is_numeric($value);
  }
}