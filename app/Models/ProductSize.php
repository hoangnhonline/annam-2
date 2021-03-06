<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductSize extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'product_size';	

	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'product_id', 
                    'size_id', 
                ];
    
}
