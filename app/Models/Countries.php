<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;
    protected $table = 'countries';
    public $fillable = [ ];
    public $timestamps = false;

  
    public static function scopeIsActive($query, $val)
	{
		return $query->where('IsActive','=', $val);
	}
	public static function scopeCountryCode($query, $val)
	{
		return $query->where('country_code','=', $val);
	}
	public static function scopegetCountryies($query)
	{
		return $query->whereIn('country_code', ['FR','BE','ES','DE','IT','GB','NL','PT','IE','GR','SK','SE','FI','AT']);
	}

	public static function scopeCountryName($query, $val)
	{
		return $query->where('CountryName','=', $val);
	}

	public static function scopeCurrencyCode($query, $val)
	{
		return $query->where('currency_code','=', $val);
	}

	public static function scopeCountryID($query, $val)
	{
		return $query->where('id','=', $val);
	}

}
