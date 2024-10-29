<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    public function index(){


     $lojas=Loja::all();

     return view('lojas.index',compact('lojas'));
    }

    public function create(){

     return view('lojas.create');
    }

    public function store(Request $request){

     $loja=new Loja();


     $loja->fill($request->all());

     $loja->save();

     return redirect()->route('lojas.index')->withSuccess('Loja cadastrada com sucesso');

    }

    public function edit(Request $request){

        $loja=Loja::find($request->id);

        return view('lojas.edit', compact('loja'));
    }

    public function update(Request $request){

     $loja=Loja::find($request->id);

     $loja->update($request->all());



     return redirect()->back()->withSuccess('Loja editada com sucesso');
    }




    public function buscaLoja(Request $request){

     $busca=$request->pesquisa;

     if($busca==''){

         $lojas=Loja::all();


     }else{
         $lojas=Loja::where('nfantasia', 'like', '%'.$busca.'%')->get();
     }





     if($lojas->count() >=1){
         return view('buscas.busca_loja',compact('lojas'));
     }else{
         return response()->json(['status'=>'Loja não encontrada']);
     }
 }
 }
