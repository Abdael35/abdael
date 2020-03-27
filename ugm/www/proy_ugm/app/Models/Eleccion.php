<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Eleccion
 * 
 * @property int $id
 * @property string $periodo
 * @property Carbon $fecha
 * @property Carbon $fechaapertura
 * @property Carbon $horaapertura
 * @property Carbon $fechacierre
 * @property Carbon $horacierre
 * @property string $observaciones
 * 
 * @property Collection|Eleccioncomite[] $eleccioncomites
 * @property Collection|Funcionariocasilla[] $funcionariocasillas
 * @property Collection|Imeiautorizado[] $imeiautorizados
 * @property Collection|Voto[] $votos
 *
 * @package App\Models
 */
class Eleccion extends Model
{
	protected $table = 'eleccion';
	public $timestamps = false;

	protected $dates = [
		'fecha',
		'fechaapertura',
		'horaapertura',
		'fechacierre',
		'horacierre'
	];

	protected $fillable = [
		'periodo',
		'fecha',
		'fechaapertura',
		'horaapertura',
		'fechacierre',
		'horacierre',
		'observaciones'
	];

	public function eleccioncomites()
	{
		return $this->hasMany(Eleccioncomite::class);
	}

	public function funcionariocasillas()
	{
		return $this->hasMany(Funcionariocasilla::class);
	}

	public function imeiautorizados()
	{
		return $this->hasMany(Imeiautorizado::class);
	}

	public function votos()
	{
		return $this->hasMany(Voto::class);
	}
}
