<?php
class AuthMiddleware {
  public static function handle() {
    if (!Auth::check()) {
      Flashify::create([
        'type' => 'danger',
        'message' => 'You are not logged to acces to this route',
      ]);

      Redirect::to('/'.Config::getAppPath().'/session/signin');
      exit;
    }
  }
}
