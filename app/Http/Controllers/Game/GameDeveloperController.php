<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\CreateGameDeveloperRequest;
use App\Http\Requests\Game\FilterGameDeveloperRequest;
use App\Http\Requests\Game\UpdateGameDeveloperRequest;
use App\ViewModels\GameDeveloperViewModel;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Support\MediaLibrary\MediaPathGenerator;

class GameDeveloperController extends Controller
{
    public function index(FilterGameDeveloperRequest $request)
    {
        return view('admin.game.developer.index', new GameDeveloperViewModel());
    }

    public function create()
    {
        return view('admin.game.developer.create');
    }

    public function store(CreateGameDeveloperRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {

        $gameDeveloper = GameDeveloper::create($request->safe()->except(['thumbnail']));



//        $media = $gameDeveloper->addMediaFromRequest('thumbnail')
//            ->withResponsiveImages()
//            ->toMediaCollection('thumbnails', 'images');

        $mediaPath = app(MediaPathGenerator::class)->getPath($media);

        $gameDeveloper->thumb_path = $mediaPath.$media->file_name;
        $gameDeveloper->save();

        $storage = Storage::disk('images');

        $filePath = pathinfo($mediaPath.$media->file_name);

        $manager = new ImageManager(new Driver());

        $image = $manager->read($storage->path($mediaPath.$media->file_name));
        $image->save($storage->path($mediaPath.$filePath['filename'].'_original.'.$filePath['extension']), 85);

        $webpImage = clone $image;
        $webpImage->toWebp(75)->save($storage->path($mediaPath.$filePath['filename']).'.webp');

        if($gameDeveloper->thumbs) {

            $storage->makeDirectory($mediaPath.'/webp');
            $storage->makeDirectory($mediaPath.'/'.$filePath['extension']);

            foreach($gameDeveloper->thumbs as $thumb) {

                $webpThumbDir = $mediaPath.'/webp/'.$thumb[0].'x'.$thumb[1];
                $originalThumbDir = $mediaPath.'/'.$filePath['extension'].'/'.$thumb[0].'x'.$thumb[1];

                $storage->makeDirectory($webpThumbDir);
                $storage->makeDirectory($originalThumbDir);

                $thumbImage = clone $image;
                $thumbImage->scale($thumb[0], $thumb[1])->encodeByExtension(quality: 85)->save($storage->path($originalThumbDir.'/'.$filePath['filename'].'.'.$filePath['extension']));

                $thumbWebpImage = clone $image;
                $thumbWebpImage->scale($thumb[0], $thumb[1])->toWebp(75)->save($storage->path($webpThumbDir.'/'.$filePath['filename'].'.webp'));

            }
        }




        dd($gameDeveloper);

//        $file = $request->file('thumbnail')->store('','images');
//dd($file);

//        $gameDeveloper = GameDeveloper::create($request->safe()->except(['thumbnail']));
//
//        $media = $gameDeveloper->addMediaFromRequest('thumbnail', 'public')
//            ->withResponsiveImages()
//            ->toMediaCollection();

//        $storage = Storage::disk('images');
//
//
//
//        $manager = new ImageManager(new Driver());
//        $image = $manager->read($request->file('thumbnail'));
//
//        $image->toWebp(90)
//            ->save($storage->path("/webp/".$file));
//
//        dd($image);
//
//
//
////            ->usingFileName('xvcxvc')
//
//
//
//        dd($media);
//        $gameDeveloper->save();
//
//
//        dd($gameDeveloper);
////        $request->file('thumbnail')->store('thumbs');

        flash()->info(__('game.developer.created'));

        return to_route('game-developers.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(GameDeveloper $gameDeveloper)
    {
        return view('admin.game.developer.edit', compact('gameDeveloper'));
    }

    public function update(UpdateGameDeveloperRequest $request, GameDeveloper $gameDeveloper)
    {
        $gameDeveloper->fill($request->validated())->save();

        flash()->info(__('game.developer.updated'));

        return to_route('game-developers.index');
    }

    public function destroy(GameDeveloper $gameDeveloper)
    {
        $gameDeveloper->delete();

        flash()->info(__('game.developer.deleted'));

        return to_route('game-developers.index');
    }

    public function atest(Request $request)
    {
        $developers = GameDeveloper::select(['id', 'name', 'slug'])->orderby('id')->get();

        if($request->sort){
            return response()->json([
                ['id' => 1, 'name' => 'bob', 'age' => '123'],
            ]);
        }
        return response()->json($developers);
    }
}
