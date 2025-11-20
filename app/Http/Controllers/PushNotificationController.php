<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Minishlink\WebPush\WebPush;
use App\Models\PushNotification;
use Illuminate\Support\Facades\URL;
use Minishlink\WebPush\Subscription;

class PushNotificationController extends Controller
{

    public function postSearch(Request $request){
        $query = $request->value;
        $post = Post::where('id', $query)->first();
        if(!empty($post)){
            $posts = Post::where('id', $query)->select('id','headline')->paginate(15);
        }else{
            $posts = Post::where('headline', 'LIKE', '%' . $query . '%')
                ->orWhere('post_content', 'LIKE', '%' . $query . '%')
                ->orWhere('id', 'LIKE' . $query)
                ->select('id','headline')
                ->paginate(15);
        }
        return view('back.pushNotification.index', compact('posts'));
    }

    public function index(){
                // DB::table('posts')->where('id', $request->postid)->update(['notify'=>1]);  
        //     Public Key:
// BCwHrNwPwzQyAndhhpCMUEgaNnh0-vSto_p3e-LCb5NYovX4rpnzAszruBL8dIkkswEaYG3SAdeWg_no1_yB4hE
// Private Key:
// ibszUXJwZkQwH1otOOgD7w8DYghL4Y70oVqGjpfC3ok

        $posts = Post::orderBy('id', 'desc')->select('id','headline')->paginate(15);
        return view('back.pushNotification.index',compact('posts'));
    }
    
    public function sendNotification(Request $request){
         $request->validate([
            'title' => 'required',
            'body' => 'required',
            'url' => 'required',
        ]);
        
        $auth = [
            'VAPID' => [
                'subject' => 'http://127.0.0.1:8000', // can be a mailto: or your website address
                'publicKey' => 'BCwHrNwPwzQyAndhhpCMUEgaNnh0-vSto_p3e-LCb5NYovX4rpnzAszruBL8dIkkswEaYG3SAdeWg_no1_yB4hE', // (recommended) uncompressed public key P-256 encoded in Base64-URL
                'privateKey' => 'ibszUXJwZkQwH1otOOgD7w8DYghL4Y70oVqGjpfC3ok', // (recommended) in fact the secret multiplier of the private key encoded in Base64-URL
            ],
        ];

        $webPush = new WebPush($auth);

        $payload = json_encode([
            'title' => $request->title,
            'body' => $request->body,
            'url' => $request->url,
        ]);

        $notifications = PushNotification::all();

        foreach ($notifications as $key => $notification) {
            $webPush->sendOneNotification(
                Subscription::create($notification->subscriptions),
                $payload,
                ['TTL' => 5000]
            );
        }
    }

    public function saveSubcription(Request $request){
        $items = new PushNotification();
        $items->subscriptions = json_decode($request->sub);
        $items->save();
        return response()->json(['success','added successfully'], 200);
    }




}
