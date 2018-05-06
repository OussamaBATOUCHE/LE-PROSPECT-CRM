<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prospect_score;
use App\Score;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function paramList()
    {
        if($this->UserType()==1){
            return view('listParam');
        }else {
         return  $this->messageDroitAccee();
        }
    }

    public function profil(){
        return view('profil');
    }

    public function scoresStat(){
          $data = array();
          $stat = DB::select('select idScore,count(idScore) as nbr from prospect_scores group by idScore');
          foreach ($stat as $s) {
            $score = Score::find($s->idScore);
            $data[] = [
                        "value"=>$s->nbr,
                        "color"=>$score->couleur,
                        "highlight"=>$score->couleur,
                        "label"=>$score->LibScore
                      ];
          }
          $returned = "<script>
                           var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
                           var pieChart       = new Chart(pieChartCanvas);
                           var PieData = ".json_encode($data).";
                           //alert('hello');
                           pieChart.Doughnut(PieData);
                      </script>";
          return $returned;
    }
}
