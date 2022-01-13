@extends('dashboard.base')

@section('content')
<div class="container-fluid">
<div class="row">
      
     
 

                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header"><strong>Cadastrar versão</strong></div>
                    <div class="card-body">
                    <form action="{{route('versoes.salvar')}}" method="post" enctype="multipart/form-data">

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
                        <label for="nf-name"><strong>Nome da versão:</strong></label>
                        <input class="form-control" id="" type="text" name="nome" placeholder="Digite aqui a versão desejada">
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
                    <div class="card-header"><i class="fa fa-align-justify"></i>Versões cadastradas:</div>
                    <div class="card-body">
                      <table id="example1" class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Ação</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($version as $versao)
                          <tr>
                            <td>{{$versao->id}}</td>
                            <td>{{$versao->nome}}</td>
                            <td>
                            <a href="{{route('versoes.deletar',$versao->id)}}"><span class="badge badge-danger">Deletar</span></a></td>
                          @endforeach
                          </tr>
                        </tbody>
                      </table>
                      
                    </div>
                  </div>
                </div>
                <!-- /.col-->
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
      "responsive": true, "lengthChange": true, "autoWidth": true,
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


