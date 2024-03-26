<?php
class RequiredRule {
  public static function validate($value) {
    return !empty($value);
  }
}