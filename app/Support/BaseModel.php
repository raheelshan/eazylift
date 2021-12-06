<?php

namespace App\Support;
use Illuminate\Database\Eloquent\Model;
use App\Support\Database\CacheQueryBuilder;

class BaseModel extends Model
{
	use CacheQueryBuilder;
}
