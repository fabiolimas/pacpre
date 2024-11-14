<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
 public function index(){


    $usuarios=User::whereIn('profile',['loja','admin'])->get();
    return view('usuarios.index', compact('usuarios'));
 }


 public function create(){

    $lojas=Loja::all();

    return view('usuarios.create', compact('lojas'));
   }


   public function store(Request $request){

    $usaurio=new User();


    $usaurio->fill($request->all());

    $usaurio->profile="loja";


    $usaurio->save();

    return redirect()->route('usuarios.index')->withSuccess('Usuário cadastrado com sucesso');

   }

   public function edit(Request $request){

    $usuario=User::find($request->id);

    $loja=Loja::find($usuario->loja_id);

    $lojas=Loja::all();



    return view('usuarios.edit', compact('lojas','loja','usuario'));
}

public function update(Request $request){

    $usuario=User::find($request->id);

    if($request->password == null){
        $usuario->update(['name'=>$request->name, 'email'=>$request->email,'loja_id'=>$request->loja_id]);

    }else{

        $usuario->update(['password'=>$request->password]);
        $usuario->update(['name'=>$request->name, 'email'=>$request->email,'loja_id'=>$request->loja_id]);
    }





    return redirect()->back()->withSuccess('Usuário editado com sucesso');
   }


   public function buscaUsuario(Request $request){

    $busca=$request->pesquisa;

    if($busca==''){

        $usuarios=User::where('profile','loja')->get();


    }else{
        $usuarios=User::where('name', 'like', '%'.$busca.'%')
        ->where('profile','loja')->get();
    }





    if($usuarios->count() != 0){
        return view('buscas.busca_usuario',compact('usuarios'));
    }else{
        return response()->json(['status'=>'Usuário não encontrado']);
    }
}


}
