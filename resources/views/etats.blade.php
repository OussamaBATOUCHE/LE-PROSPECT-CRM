@extends('admin')

@section('content')
<section class="content">
  <div style="text-align:right ">
    <a class="btn btn-success" data-toggle="modal" data-target="#addetatModal" ><i class="fa fa-plus-square"></i>&nbsp; Ajouter</a>
  </div>
  @if (session('status')){!! session('status') !!}@endif
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Gestion des etats</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Libelle</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($etats as $etat)
              <tr>
                <td>{{$etat->id}}</td>
                <td>{{$etat->LibEtat}}</td>
                @php
                  $lib = str_replace("'","\'",$etat->LibEtat);
                @endphp
                <td><a class="btn btn-warning fa fa-pencil" onclick="charge({{$etat->id}},'{{$lib}}')" data-toggle="modal" data-target="#updateetatModal" ></a><a class="btn btn-danger fa fa-trash" href="{{url('etat_delete/'.$etat->id)}}"></a></td>
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

@include('layouts.modals.createEtat')

@include('layouts.modals.updateEtat')




@endsection
