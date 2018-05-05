<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Auth;
use App\User;

class MessageController extends Controller
{
    public function get(){
    	$html = '';

			$messages = Message::orderBy('id', 'asc')->get();
			$users = User::get();

			$html = '
			<div class="modal-body" style="padding: 0px;">
				
					 <div class="row">
						 <div class="col-md-4" style="overflow: overlay; height: 24.3em;">
							 <ul>';
			foreach($users as $user){	
			$html .= '
                      <li>
		                  <a href="#">
		                    <h4>'.$user->name.'</h4>
		                  </a>
		                  </li>';
			}
			$html .= '
		              </ul>
		            </div>
                    <div class="col-md-8">
                      <div class="myContent">';

                foreach($messages as $message){
                	if ($message->user_id != Auth::User()->id) {
                		//Me
                        $html .='
                         <div class="container darker">
                           <img src="adminLTE/dist/img/user2-160x160.jpg" alt="Avatar">
                           <p>'.$message->message.'</p>
                           <span class="time-left">'.$message->created_at.'</span>
                         </div> ';
                	} else {
                		//Another User
                		$html .='
                         <div class="container">
                           <img src="adminLTE/dist/img/user4-128x128.jpg" alt="Avatar">
                           <p>'.$message->message.'</p>
                           <span class="time-right">'.$message->created_at.'</span>
                         </div> ';
                	}
                }

            $html .='
            </div>

              <div style="width: 95%;">

                    <input type="text" class="col-md-10 send" placeholder="Votre Message" required style="    margin-top: 5px;    width: 90.333333%;">
                    <img class="btn-send" src="adminLTE/dist/img/sendSemiCircle.png" title="Envoyer" style="width:9%">

              </div>
              </div>
              <div>

      </div>
        ';

                    return $html;


    }

    public function store(Request $rq){
    	$message = new Message;
    	$message->message = $rq->input('message');
    	$message->user_id = Auth::User()->id;
    	$message->save();
    }

/*
    public function ajax(){
info('bdit ajax');
        ini_set('max_execution_time',7200);
    	while (Message::where('check',0)->count() < 1) {
    		sleep(1);
    		info('rani kamalt sleep');
    	}
    	if (Message::where('check',0)->count() > 0) {
    		info('rani fal if');
    		$data = Message::where('check',0)->first();
    		$id = $data->id;
    		$edit = Message::find($id);
    		$edit->check = 1;
    		$edit->save();
info('rah nretourni');
    		return response()->json([
               'message'=>$data->message
    		]);
    		info('rani retournit');
    	}
    info('rani kamalt ajax');
		}
		*/
       
		public function ajax(){
			info('rah nedkhol ajax');

			ini_set('max_execution_time',7200);

			 info("rah ndir while");

			if (Message::where('check',0)->count() < 1) {

				ajax(); 

			}else {
				$data = Message::where('check',0)->first();
				$id = $data->id;
				$edit = Message::find($id);
				$edit->check = 1;
				$edit->save();
				return response()->json([
          'message' => $data->message
				]);
			}
		}


//     public function ajax(){
// info('bdit ajax');
//         ini_set('max_execution_time',7200);
//         info('rah nedkhol fal while');
//     	while (Message::where('check',0)->count() < 1) {
//     		info('rah ndir sleep');
//     		sleep(1);
//     		info('rani kamalt sleep');
//     	}
//     	info('khrajt mal while rani rayah if');
//     	if (Message::where('check',0)->count() > 0) {
//     		info('rani fal if');
//     		$data = Message::where('check',0)->first();
//     		$id = $data->id;
//     		$edit = Message::find($id);
//     		$edit->check = 1;
//     		$edit->save();
// info('rah nretourni');
//     		return response()->json([
//                'message'=>$data->message
//     		]);
//     		info('rani retournit');
//     	}
//     info('rani kamalt ajax');
//     }


//by oussama
/*
 public function getAll(){
     $messages = Message::get();
     $list = array();
     $i=0;
     foreach ($messages as $message) {
        $sender = User::where('id',$message->user_id)->first();
        $reciever = User::where('id',$message->receiver)->first();
        $list[$i] = ['sender'=> $sender->name." ".$sender->prenom,
                         'reciever'=> $reciever->name." ".$reciever->prenom];
                         $i++;
     }
     //return $list[0]["sender"];
     return view("messages")->with('messages', $messages)->with('detailsMessage', $list);
 }

 public function deleteMsgs(Request $rq){
   foreach ($rq->messages as $message) {
     Message::find($message)->delete();
   }
   return back()->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Messages supprimés.</div>');
 }
 public function deleteMsg($id){
     Message::find($id)->delete();
   return back()->with('status', '<div class="alert alert-success alert-dismissible show" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><spanaria-hidden="true">&times;</span></button>Un Message a été supprimé.</div>');
 }
 */
//end by oussama
}
