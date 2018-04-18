@extends('admin')

@section('content')
<section class="content">
  <div style="text-align:right ">
    <a class="btn btn-success" data-toggle="modal" data-target="#addproduitModal" >+ Ajouter</a>
  </div>
  @if (session('status')){!! session('status') !!}@endif
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Gestion des produits</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Libelle</th>
                <th>Type</th>
                <th>Prix</th>
                <th>Modifier</th>
                <th>Supprimer</th>
              </tr>
            </thead>
            <tbody>
              @foreach($produits as $produit)
              <tr>
                <td>{{$produit->id}}</td>
                <td>{{$produit->LibProd}}</td>
                <td>{{$produit->typePrd}}</td>
                <td>{{$produit->prixPrd}}</td>
                @php
                  $lib = str_replace("'","\'",$produit->LibProd);
                  $type = str_replace("'","\'",$produit->typePrd);
                @endphp
                <td><a class="btn btn-warning fa fa-pencil" onclick="charge('{{$lib}}','{{$type}}',{{$produit->prixPrd}})" data-toggle="modal" data-target="#updateproduitModal"  href="{{url('produit_update/'.$produit->id)}}"></a></td>
                <td><a class="btn btn-danger fa fa-trash" href="{{url('produit_delete/'.$produit->id)}}"></a></td>
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


<div class="modal fade" id="addproduitModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Ajouter un Produit</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="createProduit">
          @csrf
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input type="text" class="form-control" name="LibProd" required>
          </div>
          <div class="form-group">
            <label for="description" class="form-control-label">Type</label>
            <input type="text" class="form-control" name="typePrd" ></input>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Prix</label>
            <input type="number" class="form-control" name="prixPrd" required>
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

@if(!$produits->isEmpty())
<div class="modal fade" id="updateproduitModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h3 class="modal-title" id="addUserModalLabel" style="color:white" >Modifier un Produit</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="updateProduit/{{ $produit->id }}">
          @csrf
          {{ method_field('PATCH') }}
          <div class="form-group">
            <label class="form-control-label">Libelle</label>
            <input id="lib" type="text" class="form-control" name="LibProd" required>
          </div>
          <div class="form-group">
            <label for="type" class="form-control-label">Type</label>
            <input id="tp" type="text" class="form-control" name="typePrd" required></input>
          </div>
          <div class="form-group">
            <label  class="form-control-label">Prix</label>
            <input id="prix" type="number" class="form-control" name="prixPrd" required>
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
  function charge(lib,type,prix) {
    document.getElementById('lib').value=lib;
    document.getElementById('tp').value=type;
    document.getElementById('prix').value=prix;
  }
</script>
@endsection
