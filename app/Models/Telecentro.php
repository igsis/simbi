<?php

namespace Simbi\Models;

use Illuminate\Database\Eloquent\Model;

class Telecentro extends Model
{
   protected $fillable = ['user_id','equipamento_id',
     'periodo','quantidade','data','data_envio'];

   public $timestamps = false;

   public function equipamento():object{
     return $this->belongsTo(Equipamento::class);
   }

   public function user():object{
     return $this->belongsTo(User::class);
   }

   public function insert(array $dados):bool{

     $dados['user_id'] = auth()->user()->id;

     try{
       $this::create($dados)->toSql();
     }catch(\Exception $e){
       dd($e->getMessage());
       return false;
     }
     return true; 
  }       
}
