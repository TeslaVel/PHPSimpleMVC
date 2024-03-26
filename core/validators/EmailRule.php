<?php
class EmailRule {
  public static function validate($value) {
    return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
  }
}