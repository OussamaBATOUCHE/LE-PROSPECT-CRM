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


@include('layouts.modals.createScore')

@include('layouts.modals.updateScore')

@endsection
