<?php
trait BelongsTo {
  public function belongsTo($relatedModel, $fk) {
    return (new $relatedModel())->find($this->$fk);
  }
}
