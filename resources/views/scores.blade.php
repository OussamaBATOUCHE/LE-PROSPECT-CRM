@extends('admin')

@section('content')
<section class="content">
  <div style="text-align:right ">
    <a class="btn btn-success" data-toggle="modal" data-target="#addScoreModal" ><i class="fa fa-plus-square"></i>&nbsp; Ajouter</a>
  </div>
  @if (session('status')){!! session('status') !!}@endif
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Gestion des Scores</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Numero</th>
                <th>Libelle</th>
                <th>Description</th>
                <th>Action</th>
                <th>Cycle</th>
                <th>Obs</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($scores as $score)
              <tr>
                <td>{{$score->id}}</td>
                <td>{{$score->num}}</td>
                <td>{{$score->LibScore}}</td>
                <td>{{$score->description}}</td>
                <td>{{$score->action}}</td>
                <td>{{$score->cycle}}</td>
                <td>{{$score->obs}}</td>
                @php
                  $lib = str_replace("'","\'",$score->LibScore);
                  $description = str_replace("'","\'",$score->description);
                  $action = str_replace("'","\'",$score->action);
                  $obs = str_replace("'","\'",$score->obs);
                  $cycle = str_replace("'","\'",$score->cycle);
                @endphp
                <td><a class="btn btn-warning fa fa-pencil" onclick="charge({{$score->id}},{{$score->num}},'{{$lib}}','{{$description}}','{{$action}}','{{$cycle}}','{{$obs}}','{{$score->couleur}}')" data-toggle="modal" data-target="#updateScoreModal" ></a></td>
                <td><a class="btn btn-danger fa fa-trash" href="{{url('score_delete/'.$score->id)}}"></a></td>
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


<div class="modal fade" id="addScoreModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Ajouter un Score</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="createScore">
          @csrf
          <div class="form-group">
            <label class="form-control-label">Numero</label>
            <input type="text" class="form-control" name="num" required>
          </div>
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input type="text" class="form-control" name="LibScore" required>
          </div>
          <div class="form-group">
            <label for="description" class="form-control-label">Description</label>
            <textarea name="description" class="form-control" rows="8"  required></textarea>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Action</label>
            <input type="text" class="form-control" name="action" required>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Cycle</label>
            <input type="text" class="form-control" name="cycle" required>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Observation</label>
            <input type="text" class="form-control" name="obs" required>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Couleur</label>
            <input type="color" class="form-control" name="couleur" required>
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

@if(!$scores->isEmpty())
<div class="modal fade" id="updateScoreModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Modifier un Score</h3>
      </div>
      <div class="modal-body">

        <form id="updateScore" method="post" action="#">
          @csrf
          {{ method_field('PATCH') }}
          <div class="form-group">
            <label class="form-control-label">Numero</label>
            <input id="num" type="text" class="form-control" name="num" required>
          </div>
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input id="lib" type="text" class="form-control" name="LibScore">
          </div>
          <div class="form-group">
            <label for="description" class="form-control-label">Description</label>
            <textarea id="desc" name="description" class="form-control" rows="8"  required></textarea>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Action</label>
            <input id="act" type="text" class="form-control" name="action" required>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Cycle</label>
            <input id="cycle" type="text" class="form-control" name="cycle" required>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Observation</label>
            <input id="obs" type="text" class="form-control" name="obs" required>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Couleur</label>
            <input id="color" type="color" class="form-control" name="couleur" required>
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
function charge(id,num,lib,desc,act,cycle,obs,color) {

  document.getElementById('updateScore').action="updateScore/"+id;
  document.getElementById('num').value=num;
  document.getElementById('lib').value=lib;
  document.getElementById('desc').value=desc;
  document.getElementById('cycle').value=cycle;
  document.getElementById('act').value=act;
  document.getElementById('obs').value=obs;
  document.getElementById('color').value=color;

}
</script>
<script>
  $(function () {
    $('#example1').DataTable();
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endsection
