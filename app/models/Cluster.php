<?php

class Cluster extends Eloquent {

	public function bulbs(){
		return $this->belongsToMany('Bulb')->withTimestamps();
	}

	
}
