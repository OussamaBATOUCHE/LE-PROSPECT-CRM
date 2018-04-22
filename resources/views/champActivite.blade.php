@extends('admin')

@section('content')
<section class="content">
  <div style="text-align:right ">
    <a class="btn btn-success" class="btn btn-success" data-toggle="modal" data-target="#addChampModal" ><i class="fa fa-plus-square"></i>&nbsp; Ajouter</a>
  </div>
  @if (session('status')){!! session('status') !!}@endif
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Gestion des champs d'activités</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Libelle</th>
                <th colspan="2"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($champs as $champ)
              <tr>
                <td>{{$champ->id}}</td>
                <td>{{$champ->LibChampAct}}</td>
                @php
                  $lib = str_replace("'","\'",$champ->LibChampAct);
                @endphp
                <td><a class="btn btn-warning fa fa-pencil" onclick="charge('{{$lib}}')" data-toggle="modal" data-target="#updateChampModal" ></a></td>
                <td><a class="btn btn-danger fa fa-trash" href="{{url('champActivite_delete/'.$champ->id)}}"></a></td>
              </tr>
              @endforeach
            </tbody>
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->


<div class="modal fade" id="addChampModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Ajouter un Champ d'Activité</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="createChamp">
          @csrf
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input type="text" class="form-control" name="LibChampAct">
          </div>
          <button class="btn btn-primary" type="submit">Ajouter</button>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

@if(!$champs->isEmpty())
<div class="modal fade" id="updateChampModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Modifier un Champ d'Activité</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="updateChamp/{{ $champ->id }}">
          @csrf
          {{ method_field('PATCH') }}
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input id="lib" type="text" class="form-control" name="LibChampAct">
          </div>
          <button class="btn btn-primary" type="submit">Modifier</button>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
@endif
<script>
function charge(lib) {
  document.getElementById('lib').value=lib;
}
</script>
@endsection
