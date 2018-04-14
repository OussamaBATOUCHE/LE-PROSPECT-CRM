@extends('admin')

@section('content')
<section class="content">
  <div style="text-align:right ">
    <a class="btn btn-success" class="btn btn-success" data-toggle="modal" data-target="#addScoreModal" >+ Ajouter</a>
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
                <th>Libelle</th>
                <th>Description</th>
                <th>Action</th>
                <th>Obs</th>
                <th>Modifier</th>
                <th>Supprimer</th>
              </tr>
            </thead>
            <tbody>
              @foreach($scores as $score)
              <tr>
                <td>{{$score->id}}</td>
                <td>{{$score->LibScore}}</td>
                <td>{{$score->description}}</td>
                <td>{{$score->action}}</td>
                <td>{{$score->obs}}</td>
                <td><a class="btn btn-warning fa fa-pen-square" href="{{url('score_update/'.$score->id)}}"></a></td>
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
        <form method="post" action="createChambre">
          @csrf
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input type="text" class="form-control" name="type" required>
          </div>
          <div class="form-group">
            <textarea name="description" class="form-control-label" rows="8" width="100%" placeholder="Description" required></textarea>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Action</label>
            <input type="text" class="form-control" name="action" required>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Observation</label>
            <input type="text" class="form-control" name="type" required>
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
@endsection
