@extends('dashboard.base')

@section('content')

          <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">

    
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i>Tabela de arquivos</div>
                    <div class="card-body">
                      <table id="example1" class="table table-responsive-sm table-bordered table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Área</th>
                            <th>Local</th>
                            <th>Versão</th>
                            <th>Inserido por:</th>
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
                            <td><a href="/download/{{$arquivo->name}}"><span class="badge badge-success">Download</span></a></td>
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
  </div>
  
</div>
<br>
  <!-- /.row-->
                
      
              <!-- /.row-->

              
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


