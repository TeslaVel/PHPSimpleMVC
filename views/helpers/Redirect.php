<?php
trait Redirect {
  public function redirectTo($baseUrl) {
    header("Location:  $baseUrl");
    exit;
  }
}