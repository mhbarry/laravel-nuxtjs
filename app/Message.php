<?php

namespace App;

class Message extends BaseModel
{
    public function user() {
        return $this->belongsTo(User::class);
    }
}
