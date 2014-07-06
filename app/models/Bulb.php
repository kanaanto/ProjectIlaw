<?php

class Bulb extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	public function clusters(){
		return $this->belongsToMany('Cluster','cluster_bulb');
	}



}
