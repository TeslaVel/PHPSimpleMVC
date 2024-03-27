<?php

class Redirect {
  public static function to($baseUrl) {
    header("Location:  $baseUrl");
    exit;
  }
}