<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Loja;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Servico;
use App\Mail\ContatoCliente;
use Illuminate\Http\Request;
use App\Models\PacotesCliente;
use Illuminate\Support\Facades\Mail;

class ClienteController extends Controller
{
    public function index(){


        $clientes=Cliente::paginate(20);
        return view('clientes.index', compact('clientes'));
     }


     public function create(){



        return view('clientes.create');
       }


       public function store(Request $request){

        $cpf=str_replace( array( '-', '.' ), '',  $request->cpf);

        //dd($request);
        $cliente=Cliente::where('cpf',$cpf )
        ->orWhere('email', $request->email)

        ->count();

        if($cliente >=1){

            return redirect()->route('clientes.index')->withError('Cliente já possui cadastro');

        }else{
            $usaurio=new User();


        $usaurio->fill($request->all());
        if($request->email == null){

            $usaurio->email='clientebalcao'.date('dmyHis',strtotime(now())).'@email.com';
        }else{

            $usaurio->email=$request->email;
        }

        $usaurio->profile="cliente";
        $usaurio->password=$cpf;

        $usaurio->save();

        $cliente= new Cliente();


        $cliente->nome=strtoupper($request->name);
        $cliente->data_nascimento=$request->data_nascimento;
        $cliente->telefone=$request->telefone;
        if($request->email == null){

            $cliente->email='clientebalcao'.date('dmyHis',strtotime(now())).'@email.com';
        }else{

            $cliente->email=$request->email;
        }

        $cliente->cpf=$cpf;
        $cliente->endereco=$request->endereco;
        $cliente->bairro=$request->bairro;
        $cliente->cidade=$request->cidade;
        $cliente->status="ativo";
        $cliente->user_id=$usaurio->id;

        $cliente->save();

        if($cliente->save()){

            if($request->email == null){


            }else{

                $sent=Mail::to(users:$request->email, name:$request->name)->send(mailable: new ContatoCliente([
                    'fromName'=>$request->name,
                    'email'=>$request->email,
                    'cpf'=>$cpf,
                ]));
            }


        }


        return redirect()->route('clientes.index')->withSuccess('Cliente cadastrado com sucesso');

        }



       }

       public function edit(Request $request){

        $cliente=Cliente::find($request->id);







        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request){
        $cpf=str_replace( array( '-', '.' ), '',  $request->cpf);


        $cliente=Cliente::find($request->id);
        $usuario=User::where('id',$cliente->user_id)->first();

        if($request->password == null){
            $usuario->update(['name'=>$request->name,'email'=>$request->email]);
            $cliente->update([
                'nome'=>strtoupper($request->name),
                'endereco'=>$request->endereco,
                'cpf'=>$cpf,
                'cidade'=>$request->cidade,
                'estado'=>$request->estado,
                'email'=>$request->email

            ]);

        }else{

            $usuario->update(['password'=>$cpf]);
            $usuario->update(['name'=>strtoupper($request->name), 'email'=>$request->email,'loja_id'=>$request->loja_id]);
        }





        return redirect()->back()->withSuccess('Usuário editado com sucesso');
       }


       public function buscaCliente(Request $request){

        $busca=$request->pesquisa;

        if($busca==''){

            $clientes=Cliente::all();


        }else{
            $clientes=Cliente::where('nome', 'like', '%'.$busca.'%')->get();
        }





        if($clientes->count() >=1){
            return view('buscas.busca_cliente',compact('clientes'));
        }else{
            return response()->json(['status'=>'Cliente não encontrado']);
        }
    }

    public function pacoteCliente(Request $request){

        $cpf=str_replace( array( '-', '.' ), '',  $request->pesquisacpf);
        $busca=$request->pesquisa;
        $buscacpf=$cpf;

        $cliente=Cliente::find($request->id);



        $servicos=Servico::all();

            $pacotes=PacotesCliente::join('pacotes','pacotes.id','pacotes_clientes.pacote_id')
            ->join('clientes','clientes.id','pacotes_clientes.cliente_id')
            ->select(
                'pacotes.descricao',
                'pacotes.valor',
                'pacotes.quantidade as qtd',
                 'pacotes_clientes.*',
                 'clientes.cpf','clientes.nome')


            // ->where('cliente_id', $busca)
            ->Where('pacotes_clientes.cliente_id',$cliente->id)

            ->orderBy('pacotes_clientes.id','asc')
            ->paginate(30);



            return view('clientes.pacotes_cliente',compact('pacotes','servicos','cliente'));

    }



}
