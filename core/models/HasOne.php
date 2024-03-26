<?php
trait HasOne {
  public function hasOne($relatedModel, $foreignKey, $pk) {
    return (new $relatedModel())->find($foreignKey, $this->$pk);
  }
}

