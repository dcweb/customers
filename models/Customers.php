<?php

namespace Dcms\Customers\Models;

use Dcms\Core\Models\EloquentDefaults;

	class Customers extends EloquentDefaults
	{
		protected $connection = 'project';
	  protected $table  = "subscribers";
	}
