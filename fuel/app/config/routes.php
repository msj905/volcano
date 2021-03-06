<?php
return array(
	// Default route.
	'_root_'  => 'dashboard',
	
	// Error route.
	'_404_'   => 'error/404',
	
	// Customer routes.
	'(customers)/(:num)/(products)/(:num)/(cancel|activate)'       => '$1/$3/$5/$2/$4',
	'(customers)/(:num)/(paymentmethods)/(:num)/(delete)'          => '$1/$3/$5/$2/$4',
	
	// Statistics routes.
	'(statistics)'                                                 => '$1/customers/activity',
	'(statistics)/(:segment)'                                      => '$1/$2/index',
	
	// Settings routes.
	'(settings)/(:num)/(switch)'                                   => '$1/$3/$2',
	'(settings)/(:segment)/(:num)/(:segment)'                      => '$1/$2/$4/$3',
	
	// General routes.
	'(:segment)/(:num)/(edit)'                                     => '$1/$3/$2',
	
	'(:segment)/(:num)/(:segment)'                                 => '$1/$3/index/$2',
	'(:segment)/(:num)/(:segment)/(:segment)'                      => '$1/$3/$4/$2',
	'(:segment)/(:num)/(:segment)/(:num)/(edit)'                   => '$1/$3/$5/$2/$4',
	
	'(:segment)/(:num)/(:segment)/(:num)/(:segment)'               => '$1/$3/$5/index/$4',
	'(:segment)/(:num)/(:segment)/(:num)/(:segment)/(:segment)'    => '$1/$3/$5/$6/$4',
	'(:segment)/(:num)/(:segment)/(:num)/(:segment)/(:num)/(edit)' => '$1/$3/$5/$7/$4/$6',
);
