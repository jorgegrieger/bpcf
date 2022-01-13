@extends('dashboard.base')

@section('content')
<div class="container-fluid">
<div class="row">
      
     


                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header"><strong>Enviar arquivos</strong></div>
                    <div class="card-body">
                    <form action="{{route('uploadFile')}}" method="post" enctype="multipart/form-data">

                                @csrf
                                    @if ($message = Session::get('success'))
                                      <div class="alert alert-success">
                                          <strong>{{ $message }}</strong>
                                      </div>
                                    @endif
                                    @if ($message = Session::get('mensagem'))
                                      <div class="alert alert-success">
                                          <strong>{{ $message }}</strong>
                                      </div>
                                    @endif

                                                  @if (count($errors) > 0)
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                              <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                  @endif


                        <div class="form-group">
                          <label for="nf-name"><strong>Local:</strong></label>
                          <select class="form-control" id="select1" name="local">
                              <option value="" selected>Selecionar</option>
                              <option value="Corporativo">Corporativo</option>
                              <option value="Arapoti">Arapoti</option>
                              <option value="Pisa">Pisa</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for=""><strong>Versão:</strong></label>
                        <select id="" name="versao_id" class="form-control" >
                                        <option value="" selected>Selecionar</option>
                							  @foreach($versao as $versaos)
                  								<option  value="{{$versaos->id}}">{{$versaos->nome}} </option>
                  							  @endforeach
                  						</select>
                              </div>
                        <div class="form-group">
                        <label for="nf-name"><strong>Usuário:</strong></label>
                        <input class="form-control" id="disabled-input" type="text" name="disabled-input" placeholder="{{ str_replace('-',' ',Auth::user()->name )}}" disabled="">
                        </div>
                        <div class="form-group">
                          <label for="nf-name"><strong>Área da empresa</strong></label>
                          <select class="form-control" id="select1" name="area">
                              <option value="" selected>Selecionar</option>
                              <option value="Acabamento">Acabamento</option>
                              <option value="Caldeira">Caldeira</option>
                              <option value="Coater">Coater</option>
                              <option value="Comercial">Comercial</option>
                              <option value="Controladoria">Controladoria</option>
                              <option value="Desagregador de Celulose">Desagregador de Celulose</option>
                              <option value="Desaguadora de Pasta (WetLap)">Desaguadora de Pasta (WetLap)</option>
                              <option value="Diretoria Geral">Diretoria Geral</option>
                              <option value="ETA">ETA</option>
                              <option value="ETE">ETE</option>
                              <option value="Facilities">Facilities</option>
                              <option value="Gestão Ambiental">Gestão Ambiental</option>
                              <option value="Jurídico">Jurídico</option>
                              <option value="Laboratório">Laboratório</option>
                              <option value="Manutenção">Manutenção</option>
                              <option value="Máquina de Papel">Máquina de Papel</option>
                              <option value="Melhoria Continua">Melhoria Contínua</option>
                              <option value="Operações">Operações</option>
                              <option value="Pasta">Pasta</option>
                              <option value="Patio Energia">Patio Energia</option>
                              <option value="Processo">Processo</option>
                              <option value="PTA">PTA</option>
                              <option value="RH">RH</option>
                              <option value="Segurança">Segurança</option>
                              <option value="Supercalandra">Supercalandra</option>
                              <option value="Suprimentos">Suprimentos</option>
                              <option value="TI">TI</option>
                              <option value="TMP">TMP</option>
                            </select>
                        </div>
                        <label for="nf-name"><strong>Selecionar Arquivo</strong></label>
                        <div class="custom-file">
<label class="custom-file-label" for="file-upload">
<i class="fa fa-cloud-upload"></i>Clique para escolher o arquivo...
</label>
<input type="file" name="file" value="Procurar" class="custom-file-input" id="file-upload">
</div> 


                     
                    </div>
                    <div class="card-footer">
                      <button class="btn btn-sm btn-primary" type="submit"> Enviar</button>
                   
                    </div>
                    </form>
                  </div>
                 
                  </div>
                </div>
                <!-- /.col-->
                <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">

    
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i>Meus arquivos enviados:</div>
                    <div class="card-body">
                      <table id="example1" class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Área</th>
                            <th>Local</th>
                            <th>Usuário</th>
                            <th>Ação</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($arquivos as $arquivo)
                          <tr>
                            <td>{{$arquivo->name}}</td>
                            <td>{{$arquivo->created_at->format('d/m/Y')}}</td>
                            <td>{{$arquivo->area}}</td>
                            <td>{{$arquivo->local}}</td>
                            <td>{{$arquivo->version->nome}}</td>
                            <td>{{str_replace('-',' ',$arquivo->user->name)}}
                            <td><a href="/download/{{$arquivo->name}}"><span class="badge badge-success">Download</span></a>
                            <a href="{{route('arquivo.deletar',$arquivo->id)}}"><span class="badge badge-danger">Deletar</span></a></td>
                          @endforeach
                          </tr>
                        </tbody>
                      </table>
                      
                    </div>
                  </div>
                </div>
                <!-- /.col-->
       </div>
              </div>
          
@endsection

@section('javascript')
<script src="{{url('https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <script src="{{url('https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap5.min.css')}}"></script>

<script src="{{url('https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap5.min.js')}}"></script>

<script>
  $('#file-upload').change(function() {
  var i = $(this).prev('label').clone();
  var file = $('#file-upload')[0].files[0].name;
  $(this).prev('label').text(file);
});
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"],
      "language":{
        "search": "Buscar:",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty":      "Mostrando 0 de 0 de 0 resultados",
        "infoFiltered":   "(filtrado de _MAX_ arquivos)",
        "first": "Primeira",
        "lengthMenu":   "Mostrar _MENU_ resultados",
        "zeroRecords": "Nenhum dado foi encontrado!",
        "paginate": {
				            "previous": "Anterior",
                    "next": "Próxima"
				    },
            "buttons": {
				            "copy": "Copiar",
                    "csv": "Exportar para csv",
                    "print":"Imprimir",
                    "colvis": "Filtrar Colunas"

				    }
      }
    }).container().appendTo('#example1_filter .col-md-12:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    }
    );
  });
</script>
@endsection


