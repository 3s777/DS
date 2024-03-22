<?php

namespace App\Http\Controllers;

use App\Models\CollectableItem;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameGenre;
use Illuminate\Support\Facades\Http;
use Services\GamesDbApi\GamesDbApiContract;

class HomeController extends Controller
{
    public function __invoke() {

//        $user = User::with(['language'])->find(1)->language->slug;
//        dump(app()->getLocale());

//        $users = User::with('img:id,path,user_id')->get();

        $user = User::find(1);

        $user
            ->addMediaFromDisk('thumbs/CvIrbHsJiz5udsEi58qazYimsy64tGGuI73mE4HK.jpg', 'public')
            ->preservingOriginal()
            ->toMediaCollection('avatars');

        $mediaItems = $user->getMedia('avatars');

//        $mediaItems[0]->name = 'new name';
//        $mediaItems[0]->save();
        dump($mediaItems);

//        $users1 = User::with('morphImages')->find(1);
//
////        $user = User::with('img:id,path,user_id')->find(1);
//
//        dump($users1);

//        foreach($users as $user) {
//            dump($user->img);
//        }


//        $user = User::with(['cover'])->find(1);
//        dump($user);

//        $product = CollectableItem::createOrFirst([
//            'name' => 'sdfdsf11gg',
//            'properties' => ['xxgx', 'nng1n']
//        ]);

//        $product = CollectableItem::with(['developers'])->get();

$products = CollectableItem::with('developers')->get();



//        $product->developers()->sync([5,3]);



//        $response = Http::get(env('GAME_API_HOST')."/genres?key=".env('GAME_API_KEY'));

//        $c = CollectableItem::createOrFirst([
//            'name' => 'sdfdsf11',
//            'properties' => ['xxx', 'nn1n']
//        ]);
//
//        dd($c);

//        $platforms = app(GamesDbApiContract::class);
//
//        $games = $platforms->getGames();
//        dd($games[0]);
//
//        $genres = $response->json('results');
//        foreach ($genres as $genre) {
//            Genre::create([
//                'name' => $genre['name'],
//            ]);
//        }
//
//        dump($response->json('results'));

        return view('welcome', compact(['products']));
    }
}
