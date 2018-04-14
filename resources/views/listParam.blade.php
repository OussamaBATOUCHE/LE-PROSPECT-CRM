@extends('admin')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Parametres
      <small>menu de gestion</small>
    </h1>
  </section>
  @if (session('status')){!! session('status') !!} @endif
  <!-- Main content -->
  <section class="content">
          <div class="container">
            <div class="row container" style="text-align:center" onclick="window.open('scores')">
                <div class="col-md-10 alert alert-oussama">
                  <span>SCORES</span>
                </div>
            </div>
            <div class="row container" style="text-align:center">
                <div class="col-md-10 alert alert-oussama">
                  <span class="">Champs d'Activites</span>
                </div>
            </div>
            <div class="row container" style="text-align:center">
                <div class="col-md-10 alert alert-oussama">
                  <span class="">Produits et Service</span>
                </div>
            </div>
            <div class="row container" style="text-align:center">
                <div class="col-md-10 alert alert-oussama">
                  <span class="">Templates Emails</span>
                </div>
            </div>
            <div class="row container" style="text-align:center">
                <div class="col-md-10 alert alert-oussama">
                  <span class="">Messages</span>
                </div>
            </div>
  </section>
  <!-- /.content -->
@endsection
