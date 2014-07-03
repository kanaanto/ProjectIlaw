<?php

class Clusterbulb extends \Eloquent {
	protected $fillable = [];
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'clusterbulb_view';

	public function bulb_cluster(){
		return $this->belongsToMany('Bulb');
	}


}