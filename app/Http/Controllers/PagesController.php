<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use MonkeyLearn\Client as MonkeyLearn;
use DB;
use Mail;
use Session;
use App\Category;


class PagesController extends Controller {

	public function getIndex()
	{

		$posts = Post::with('category')->orderBy('created_at', 'desc')->paginate(5);
		$categories = Category::limit(8)->get();
		return view('pages.welcome')->withPosts($posts)->with('categories',$categories);
	}

	public function getAbout() {

		$first  = 'openAug';
		$second = 'Inc.';
		$fullname   = $first . " " . $second;
		$email = 'example@xyz.com';
		$data= [];
		$data['fullname'] = $fullname;
		$data['email']    = $email;

		return view('pages.about')->withData($data);
	}
	public function getContact() {

		return view('pages.contact');
	}

	public function postContact(Request $request) {

		$this->validate($request, [
			'email' => 'required|email',
			'subject' => 'min:3',
			'message' => 'min:10']);

		$data= array(
			'email' => $request->email,
			'subject' => $request->subject,
			'bodyMessage' => $request->message
			);

		Mail::send('emails.contact', $data, function($message) use($data){
			$message->from($data['email']);
			$message->to('akashsky1313@gmail.com');
			$message->subject($data['subject']);
		});

		Session::flash('success', 'Thanks for the feedback!');

        //redirect to another page
        return redirect()->route('house');
	}

	public function getPostCategoryWise($category)
	{
		$posts = Post::with('Category')->whereHas('Category', function($query) use ($category) {
			 			$query->where('name', $category);
						})->get();

		$categories = Category::limit(8)->get();
		return view('pages.distinct')->withPosts($posts)->with('categories',$categories);
	}

	public function getSentiment() {
	  $ml = new MonkeyLearn('289ec47e8ed51bb7d4232569551cda7b7343fa68');
    $comments = DB::table('comments')->pluck('comment')->toArray();
	  $module_id = 'cl_rZ2P7hbs';
	  $res = $ml->classifiers->classify($module_id, $comments, true);
    dd($res);
  //  return view('sentiment');
  }


}
