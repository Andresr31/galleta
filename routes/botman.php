<?php
use App\Http\Controllers\BotManController;

use App\Cookie;

$botman = resolve('botman');

$botman->hears('Break cookie', function ($bot) {

    $cookie = Cookie::all()->random(1)->first();

    $bot->reply($cookie->message);
});

$botman->hears('create cookie {text}', function ($bot, $text) {

  $cookie = new Cookie();
  $cookie -> message = $text;
  $cookie -> save(); 

  $bot->reply('Cookie saved !!');
});

$botman->hears('Update cookie {id} with {text}', function ($bot, $id, $text) {

  $cookie = Cookie::find($id);
  if ($cookie == null)
  {
    $bot->reply('The cookie dont exist!');
  }else{
    $cookie -> message = $text;
    $cookie -> save(); 
    $bot->reply('Cookie updated!');
  }
});

$botman->hears('1.Find cookie with {text}', function ($bot, $text) {

  $cookies = Cookie::where('message','=', $text)->get();

  foreach($cookies as $cookie)
  {
    $bot->reply('Cookie: '. $cookie->id);  
  }
  if(count($cookies)==0)
    $bot->reply('I could not find cookies whit that text');
  
});
$botman->hears('2.Find cookie with as {text}', function ($bot, $text) {

  $cookies = Cookie::where('message','LIKE', "%{$text}%")->get();

  foreach($cookies as $cookie)
  {
    $bot->reply('Cookie: '. $cookie->id. ' : '.$cookie->message);  
  }
  if(count($cookies)==0){
    $bot->reply('I could not find cookies whit that text');
  }
    
});

$botman->hears('delete cookie {id}', function ($bot, $id) {

  $control =  Cookie::where('id', '=', $id)->delete();
  if ($control == 0)
  {
    $bot->reply('The cookie dont exist!');
  }else{ 
    $bot->reply('The cookie was deleted!');
  }

  // $cookie = Cookie::find($id);
  // if ($cookie == null)
  // {
  //   $bot->reply('The cookie dont exist!');
  // }else{
  //   $cookie -> delete(); 
  //   $bot->reply('The cookie was deleted!');
  // }
    
});
//$botman->hears('Hi', function ($bot) {
  //  $bot->reply('Hello!');
//});
//$botman->hears('Start conversation', BotManController::class.'@startConversation');
