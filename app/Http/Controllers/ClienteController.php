<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(){


        $clientes=Cliente::all();
        return view('clientes.index', compact('clientes'));
     }


     public function create(){



        return view('clientes.create');
       }


       public function store(Request $request){

        $usaurio=new User();


        $usaurio->fill($request->all());

        $usaurio->profile="cliente";
        $usaurio->password=$request->cpf;

        $usaurio->save();

        $cliente= new Cliente();


        $cliente->nome=$request->name;
        $cliente->data_nascimento=$request->data_nascimento;
        $cliente->telefone=$request->telefone;
        $cliente->email=$request->email;
        $cliente->cpf=$request->cpf;
        $cliente->endereco=$request->endereco;
        $cliente->bairro=$request->bairro;
        $cliente->cidade=$request->cidade;
        $cliente->status="ativo";
        $cliente->user_id=$usaurio->id;

        $cliente->save();


        return redirect()->route('clientes.index')->withSuccess('Cliente cadastrado com sucesso');

       }

       public function edit(Request $request){

        $cliente=Cliente::find($request->id);







        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request){

        $usuario=User::find($request->id);
        $cliente=Cliente::where('email', $usuario->email)->first();

        if($request->password == null){
            $usuario->update(['name'=>$request->name]);
            $cliente->update([
                'nome'=>$request->name,
                'endereco'=>$request->endereco,
                'cpf'=>$request->cpf,
                'cidade'=>$request->cidade,
                'estado'=>$request->estado,

            ]);

        }else{

            $usuario->update(['password'=>$request->password]);
            $usuario->update(['name'=>$request->name, 'email'=>$request->email,'loja_id'=>$request->loja_id]);
        }





        return redirect()->back()->withSuccess('Usuário editado com sucesso');
       }


       public function buscaUsuario(Request $request){

        $busca=$request->pesquisa;

        if($busca==''){

            $usuarios=User::all();


        }else{
            $usuarios=User::where('name', 'like', '%'.$busca.'%')->get();
        }





        if($usuarios->count() >=1){
            return view('buscas.busca_usuario',compact('usuarios'));
        }else{
            return response()->json(['status'=>'Usuário não encontrado']);
        }
    } //
}
