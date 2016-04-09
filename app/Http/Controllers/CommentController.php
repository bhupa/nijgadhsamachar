<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Session;
use App\Comment;


class CommentController extends Controller
{
   public function addcomment(Request $request, $news)
   {
            $comment = new Comment;

			$body = trim(strip_tags($request->get('comment')));

			$status = false;

			if(strlen( $body ) > 1)

			{
				$comment->content = $body;
				$comment->user_id = \Auth::user()->user_id;
				$comment->news_id = $news->news_id;
				$status =  $comment->save();
			}

			return ['status'=>$status];
   }
   public function deletecomment( Request $request,$comment)
   {

   	if(\Auth::user()->user_id == $comment->user_id)
   	{
        $status = $comment->delete();

		return ['status'=>$status];	
	}
   }
   public function editcomment(Request $request,$comment)
   {

			$body = trim(strip_tags($request->get('comment')));

			$status = false;

			if(strlen( $body ) > 1)

			{
				$comment->content = $body;

				if(\Auth::user()->user_id == $comment->user_id)
				{
					 $comment->save();
					 $status = $comment->content;
					
				}
				
			}
			   return ['status'=>$status];

			
   }
}
