@extends('admin')

@section('content')
@include('layouts.modals.createEmailGroupe')
<section class="content">
  <div style="text-align:right;float: right">
  <a class="btn btn-info" onclick=""  data-toggle="modal" data-target="#emailGroupe"><i class="fa fa-at"></i>&nbsp; Email en groupe</a>


  </div>
  <div style="float:left">

  <h3>Contacts effectués</h3>
  </div>
  @if (session('status')){!! session('status') !!}@endif
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header ">
          <a href="{{url('cntctQue/1')}}" class="btn "><i class="fa fa-phone" style="color:blue;font-size:20px;"></i>&nbsp; Appels</a>
          <a href="{{url('cntctQue/2')}}" class="btn "><i class="fa fa-envelope" style="color:blue;font-size:20px;"></i>&nbsp; Emails</a>
          <a href="{{url('contacts')}}" class="btn "><i class="fa fa-list" style="color:blue;font-size:20px;"></i>&nbsp; Tous les contacts</a>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Objet</th>
                <th>Type</th>
                <th>Date</th>
                <th>Prochaine action</th>
                <th>Tache</th>
                <th>Prospect</th>
                <th>Commrcial</th>
              </tr>
            </thead>
            <tbody>
              @php
                $i = 0 ;
              @endphp
              @foreach($contacts as $contact)
              <tr>
                <th><a title="Details"
                   onclick="chargeUpdateContact( {{$contact->id}},
                                                 '{{$contact->type}}',
                                                 '{{str_replace("'","\'",$contact->remarque)}}',
                                                 '{{$contact->date}}',
                                                 '{{str_replace("'","\'",$prospects[$i]->societe)}}',
                                                 {{$prospects[$i]->id}},
                                                 {{ json_encode($details[$i]) }},
                                                 '{{$users[$i]["name"]." ".$users[$i]["prenom"]}}',
                                                 '{{$scores[$i]["LibScore"]}}'
                                               )"
                   data-toggle="modal" data-target="#updateContact">
                   {{substr($contact->objet,0,30)}}
                 </a></th>
                <th><span >
                  @if ($contact->type == "A")
                     <i class="fa fa-phone"></i>  - Appel 
                  @else
                     <i class="fa fa-envelope"></i>  - @if($details[$i]->envoye == "Oui") <i class="fa fa-check-circle"></i> @endif Email
                  @endif </span>
                </th>
                <th>{{$contact->date}}</th>
                <th>
                  @if ($pa[$i] != "")
                    <a data-toggle="popover" data-trigger="hover"  title="{{$pa[$i]["action"]}}" data-content="{{$pa[$i]["note"]}}">{{$pa[$i]["date"]}}</a>
                  @else
                     - -
                  @endif
                </th>
                <th>@if($taches[$i]!=null) <a href="tache/{{$taches[$i]->id}}"> {{substr($taches[$i]->titre,0,30)}} </a>@endif</th>
                <th><a href="{{url('detailsProspect/'.$prospects[$i]->id)}}">{{$prospects[$i]->societe}} <span class="label" style="background-color:{{$scores[$i]->couleur}}">{{$scores[$i]->num." - ".$scores[$i]->LibScore}}</span></a></th>
                <th><a href="profil/{{$users[$i]->id}}">
                  {{$users[$i]->name." ".$users[$i]->prenom}}
                    </a>
                </th>
              @php $i++; @endphp
              @endforeach
            </tbody>
            </tfoot>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<!--Lire et Modifier Contact-->
@include('layouts.modals.updateContact')

<script>


    $(document).ready(function(){
        var allSelected = false;
        $('[data-toggle="popover"]').popover({ trigger: "hover" , html: true }); // and now my popover accept hmtl text ^^

    });


</script>



@endsection
