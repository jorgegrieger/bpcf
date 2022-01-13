<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Versao;
use App\Http\Requests\VersaoRequest;
class VersoesController extends Controller
{
    public function index()
    {
        $version = Versao::all();
        return view('dashboard.versoes', compact('version'));
    }

    public function salvar(VersaoRequest $request){
    
        Versao::create($request->all());
        
        
        \Session::flash('flash_message',[
            'msg'=>"Analista adicionado com Sucesso!",
            'class'=>"alert-success"
        ]);
    
        return back()
          ->with('success','Versão cadastrada com sucesso.');
    
    }
    
 public function deletar ($id)
 {
 $vers = \App\Models\Versao::find($id);
 $vers->delete();
 
 return redirect()->back()->with('mensagem', 'A versão: '.$vers->nome.' foi deletada com sucesso.');   
 }
}
