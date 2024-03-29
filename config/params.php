<?php

return [
	'adminEmail' => 'admin@example.com',

	// all language available in this site
	'languages' => [
		'en-US' => 'english',
		'vi-VN' => 'vietnamese',
	],

	'imageUrl' => '/images/',

	'postNoImage' => 'avatar.jpg',
	'userNoImage' => 'avatar.jpg',

	'userDefaultImages' => [
		'avatar.jpg'
	],

	'postImagePath' => [
		'original' => '/images/post/large/',
		'scaled' => '/images/post/medium/',
		'icon' => '/images/post/small/',
	],

	'userImagePath' => [
		'original' => '/images/user/large/',
		'scaled' => '/images/user/medium/',
		'icon' => '/images/user/small/',
	],
	
	'recaptcha' => [
		'sitekey' => '6LcLTgETAAAAAKWKr46mNw8B9UfqzT9zj5R0Qykb',
		'secret'  => '6LcLTgETAAAAADLhWJUpcqpFec_rRwFN407qj-5K',
	]
];
