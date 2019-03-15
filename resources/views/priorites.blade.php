@extends('admin')

@section('content')
<section class="content">
  <div style="text-align:right ">
    <a class="btn btn-success" data-toggle="modal" data-target="#addprioriteModal" ><i class="fa fa-plus-square"></i>&nbsp; Ajouter</a>
  </div>
  @if (session('status')){!! session('status') !!}@endif
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Gestion des priorites</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Numero</th>
                <th>Libelle</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($priorites as $priorite)
              <tr>
                <td>{{$priorite->id}}</td>
                <td>{{$priorite->num}}</td>
                <td>{{$priorite->libPrio}}</td>
                @php
                  $lib = str_replace("'","\'",$priorite->libPrio);
                @endphp
                <td><a class="btn btn-warning fa fa-pencil" onclick="charge({{$priorite->id}},{{$priorite->num}},'{{$lib}}','{{$priorite->couleur}}')" data-toggle="modal" data-target="#updateprioriteModal" ></a><a class="btn btn-danger fa fa-trash" href="{{url('priorite_delete/'.$priorite->id)}}"></a></td>
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

@include('layouts.modals.createPriorite')

@include('layouts.modals.updatePriorite')




@endsection
