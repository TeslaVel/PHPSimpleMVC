<?php
class StringRule {
  public static function validate($value) {
    return is_string($value);
  }
}