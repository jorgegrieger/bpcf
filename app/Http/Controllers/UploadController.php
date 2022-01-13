<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Carbon\Carbon;
use App\Models\Versao;
use DB;
use Auth;
use Mail;

class UploadController extends Controller
{
     public function index(){

      if(auth::user()->menuroles == "admin"){
         $arquivos = File::all();
         return view('dashboard.homepage1',compact('arquivos'));
      }else{
         $user = Auth::id();
         $arquivos = File::where('user_id','=',$user)->get();
      return view('dashboard.homepage',compact('arquivos'));
   }
}

  public function download($file_name) {
    $file_path = public_path('public\uploads/'.$file_name);
    return response()->download($file_path);
  }
   
   function getFile($filename){
      $file=Storage::disk('public')->get($filename);

     return (new Response($file, 200))
             ->header('Content-Type', 'multipart/form-data');
   }

   public function uploadFile(Request $req){

      $req->validate([
      'file' => 'required|mimes:csv,xlx,xls,xlsm,xlsx|max:10048|unique:files,name',
      'local' => 'required',
      'area' => 'required',
      'versao_id' => 'required',
      ],
      [
      'file.required' => 'O campo Arquivo é obrigatório',
      'local.required' => 'O campo Local é obrigatório',
      'area.required' => 'O campo Área é obrigatório',
      'versao_id.required' => 'O campo Versao é obrigatório',
      'file.mimes' => 'O arquivo precisa ter as seguintes extensões: csv,xlx,xls,xlsm,xlsx'
      ]);

      $fileModel = new File;

      if($req->file()) {
          $time = Carbon::now();
          $fileName = $time->format('d-m-Y').'_'.$req->file->getClientOriginalName();
          $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
          $fileLocal = $req->local;
          $fileArea = $req->area;
          $fileUser = Auth::id();
          $fileUsername = Auth::user()->name;
          $fileVersao = $req->versao_id;
        

          $fileModel->name = $time->format('d-m-Y').'_'.$req->file->getClientOriginalName();
          $fileModel->file_path = '/storage/' . $filePath;
          $fileModel->local = $fileLocal;
          $fileModel->area = $fileArea;
          $fileModel->user_id = $fileUser;
          $fileModel->versao_id = $fileVersao;
         
         

        \Mail::send('mail', array(
            'name' => $fileModel->name,
            'user' => $fileUsername,
            'local' => $fileModel->local,
            'area' => $fileModel->area,
            'versao' => $fileVersao,
          ), function($message) use ($req)
          {
             $message->from('bopcustofixo@bopaper.com.br');
             $message->to('eduardo.bona@bopaper.com.br','Admin')->subject('Novo arquivo inserido no sistema!!');
          });
         
          $fileModel->save();

 

          return back()
          ->with('success','O arquivo foi carregado com sucesso.')
          ->with('file', $fileName);
      }
 }

 public function deletar ($id)
{
$arquivo = \App\Models\File::find($id);
$arquivo->delete();

return redirect()->route('home')->with('mensagem', 'O arquivo '.$arquivo->nome.' foi deletado com sucesso.');   
}
}
