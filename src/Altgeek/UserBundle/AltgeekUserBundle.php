<?php

namespace Altgeek\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AltgeekUserBundle extends Bundle
{
	public function getParent()
  	{
    	return 'FOSUserBundle';
  	}
}
