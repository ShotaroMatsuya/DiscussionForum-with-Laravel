<?php

namespace LaravelForum;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    protected $guarded = []; //blackリストを空にしておけばmass-assignmentエラーは表示されなくなる
}
