@extends('admin')

@section('content')
<section class="content">
  <div style="text-align:right ">
    <a class="btn btn-success" class="btn btn-success" data-toggle="modal" data-target="#addGroupeModal" ><i class="fa fa-plus-square"></i>&nbsp; Ajouter</a>
  </div>
  @if (session('status')){!! session('status') !!}@endif
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Gestion des Groupes </h3>
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
              @foreach($Groupes as $Groupe)
              <tr>
                <td>{{$Groupe->id}}</td>
                <td>{{$Groupe->LibGrp}}</td>
                @php
                  $lib = str_replace("'","\'",$Groupe->LibGrp);
                @endphp
                <td><a class="btn btn-warning fa fa-pencil" onclick="charge('{{$lib}}')" data-toggle="modal" data-target="#updateGroupeModal" ></a></td>
                <td><a class="btn btn-danger fa fa-trash" href="{{url('groupe_delete/'.$Groupe->id)}}"></a></td>
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


<div class="modal fade" id="addGroupeModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Ajouter un Groupe d'Activité</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="createGroupe">
          @csrf
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input type="text" class="form-control" name="LibGrp">
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

@if(!$Groupes->isEmpty())
<div class="modal fade" id="updateGroupeModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Modifier un Groupe d'Activité</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="updateGroupe/{{ $Groupe->id }}">
          @csrf
          {{ method_field('PATCH') }}
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input id="lib" type="text" class="form-control" name="LibGrp">
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
