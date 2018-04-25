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
            <div class="row container" style="text-align:center" onclick="location.href ='{{url('scores')}}'">
                <div class="col-md-10 alert alert-oussama">
                  <span>Scores</span>
                </div>
            </div>
            <div class="row container" style="text-align:center" onclick="location.href ='{{url('champActivite')}}'">
                <div class="col-md-10 alert alert-oussama">
                  <span class="">Champs d'Activites</span>
                </div>
            </div>
            <div class="row container" style="text-align:center" onclick="location.href ='{{url('groupes')}}'">
                <div class="col-md-10 alert alert-oussama">
                  <span class="">Groupes</span>
                </div>
            </div>
            <div class="row container" style="text-align:center" onclick="location.href ='{{url('produits')}}'">
                <div class="col-md-10 alert alert-oussama">
                  <span class="">Produits et Service</span>
                </div>
            </div>
            <div class="row container" style="text-align:center" onclick="location.href ='{{url('etats')}}'">
                <div class="col-md-10 alert alert-oussama">
                  <span class="">Etats des taches</span>
                </div>
            </div>
            <div class="row container" style="text-align:center" onclick="location.href ='{{url('priorites')}}'">
                <div class="col-md-10 alert alert-oussama">
                  <span class="">Priorites des taches</span>
                </div>
            </div>
            <div class="row container" style="text-align:center" onclick="alert('Cette fonctionnalite n\'est pas encore desponibel. ')">
                <div class="col-md-10 alert alert-oussama">
                  <span class="">Templates Emails</span>
                </div>
            </div>
            <div class="row container" style="text-align:center" onclick="alert('Cette fonctionnalite n\'est pas encore desponibel. ')">
                <div class="col-md-10 alert alert-oussama">
                  <span class="">Messages</span>
                </div>
            </div>
            <div class="row container" style="text-align:center" onclick="location.href ='{{url('prospectsBloques/1')}}'">
                <div class="col-md-10 alert alert-oussama">
                  <span class="">Prospect Bloqués</span>
                </div>
            </div>
  </section>
  <!-- /.content -->
@endsection
