<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imovel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'imoveis';

    protected $appends = [
        'status',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        $buildEndereco = function (Imovel $imovel) {
            $infoEndereco = collect($imovel->only(['rua', 'numero', 'cidade', 'estado']));
            $enderecoCompleto = implode(', ', $infoEndereco->whereNotNull()->toArray());
            $imovel->endereco_completo = trim($enderecoCompleto);
        };

        static::creating($buildEndereco);

        static::updating($buildEndereco);
    }

    public function getStatusAttribute()
    {
        return 'Não Contratado';
    }

}
