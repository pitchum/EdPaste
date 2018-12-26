<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Paste;
use Auth;
use App\User;
use \Input;
use \Hash;
use Session;
use Cookie;
use DB;
use \Carbon;

class EditPasteController extends Controller
{
  public function index($link, Request $request){
    $paste = Paste::where('link', $link)->firstOrFail();

    // Est-ce que l'utilisateur connecté est celui qui a écrit la paste ?
    if (Auth::user() != $paste->user || $paste->userId == 0) {
      return abort('404');
    }

    // Renvoi de la view
    return view('paste/edit', [
      'username' => ($paste->userId != 0) ? $paste->user->name : 'Guest',
      'link' => $link,
      'title' => ($paste->title != 'Untitled') ? $paste->title : '',
      'content' => $paste->content,
      'expiration' => $paste->expiration,
      'privacy' => $paste->privacy,
      'date' => $paste->created_at->format('M j, Y'),
      'fulldate' => $paste->created_at->format('d/m/Y - H:i:s'),
      'noSyntax' => $paste->noSyntax,
    ]);
  }

	public function edit($link, Requests\EditPaste $request){
    $paste = Paste::where('link', $link)->firstOrFail();

    // Est-ce que l'utilisateur connecté est celui qui a écrit la paste ?
    if (Auth::user() != $paste->user || $paste->userId == 0) {
      return abort('404');
    }

    $title = (empty(trim(Input::get('pasteTitle')))) ? 'Untitled' : Input::get('pasteTitle');

		$expiration = Input::get('expire');
		$privacy = Input::get('privacy');

		// Ici on vérifie que l'user a pas foutu le bronx dans les dropdown list
		$possibleValuesPrivacy = array("link", "password", "private");
		if (in_array($privacy, $possibleValuesPrivacy) == false) return view('paste/edit');

		// Si l'user a choisi password-protected, on hash son pass, sinon on met 'disabled' dans la variable
		if ($privacy == 'password') $password = bcrypt(Input::get('pastePassword'));
		else $password = 'disabled';

		$burnAfter = 0;
		// Ici on génère le timestamp d'expiration
		switch ($expiration) {
			case 'never':
        $timestampExp = 0;
        break;
			case 'burn':
        $timestampExp = date('Y-m-d H:i:s', time());
        $burnAfter = 1;
			  break;
			case '10m':
        $timestampExp = date('Y-m-d H:i:s', time()+600);
        break;
			case '1h':
        $timestampExp = date('Y-m-d H:i:s', time()+3600);
        break;
			case '1d':
        $timestampExp = date('Y-m-d H:i:s', time()+86400);
        break;
			case '1w':
        $timestampExp = date('Y-m-d H:i:s', time()+604800);
        break;
			default:
        die("User input error.");
        break;
		}

    $paste->title = $title;
    $paste->content = Input::get('pasteContent');
		$paste->expiration = $timestampExp;
		$paste->privacy = $privacy;
		$paste->password = $password;
		$paste->noSyntax = Input::has('noSyntax');
    $paste->burnAfter = $burnAfter;

    $paste->save();

    return redirect('/'.$link);
  }

  public function password($link, Request $request){
    $paste = Paste::where('link', $link)->firstOrFail();
    $messages = array(
      'pastePassword.required' => 'Please enter a password',
    );
    $this->validate($request, [
      'pastePassword' => 'required',
    ], $messages);

    if (Hash::check(Input::get('pastePassword'), $paste->password)) {
      Cookie::queue($paste->link, Input::get('pastePassword'), 15);
      return redirect('/'.$link);
    }
    else {
      return view('paste/password', ['link' => $paste->link, 'wrongPassword' => true]);
    }
  }
}
