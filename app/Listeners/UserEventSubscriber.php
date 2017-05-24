<?php

namespace App\Listeners;

class UserEventSubscriber {
	
	public function onUserLogin($event) {
		print_r($event->info);
	}	

	public function onUserLogout($event) {
		print_r($event->info);
	}

	public function subscribe($events) {
		$events->listen(\App\Events\OrderShipped::class, self::class.'@onUserLogin');	
		$events->listen(\App\Events\OrderShipped::class, self::class.'@onUserLogout');
	}
}