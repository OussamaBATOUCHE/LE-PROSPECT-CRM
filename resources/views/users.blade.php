@extends('admin')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Gestion des Utilisateurs</h3>
        </div><!-- /.box-header -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Nom</th>
                <th>email</th>
                <th>Suprimer</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->nom}}</td>
                <td>{{$user->email}}</td>
                <td><a class="btn btn-danger fa fa-times" href="{{url('deleteUser/'.$user->id)}}"></a></td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>email</th>
                  <th>Suprimer</th>
                </tr>
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
@endsection
