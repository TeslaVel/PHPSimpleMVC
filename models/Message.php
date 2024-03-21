<?php
require_once "BaseModel.php";

class Message extends BaseModel {

  public static $name = 'messages';

  public static $fillableFields = Array(
    'message', 'created_at', 'updated_at', 'user_id', 'post_id'
  );
}