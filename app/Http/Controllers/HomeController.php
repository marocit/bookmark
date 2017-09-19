<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Category;
use Illuminate\Http\Request;
use Dusterio\LinkPreview\Client;
use Gmopx\LaravelOWM\LaravelOWM;
use Thujohn\Twitter\Facades\Twitter;
use Intervention\Image\Facades\Image;

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

public function bookmark()
{
    $bookmarks = Bookmark::with('category')->latest();

    // if ($month = request('month')) {
    //     $bookmarks->whereMonth('created_at', 9);
    // }

    // $bookmarks = $bookmarks->Paginate(5);
    if($term = request('term')) {
        $bookmarks->where('title', 'LIKE', "%{$term}%");
        // $bookmarks = Bookmark::search('$term');
        // $bookmarks->search('$term');
    }

    // $bookmarks->get();

    $bookmarks = $bookmarks->Paginate(5);

    // $categories = Category::pluck('name', 'id')->all();
    return view('bookmark.index', compact('categories', 'bookmarks'));
}

public function store(Request $request)
{
    dd($request);
    $input = $request->all();
    Bookmark::create($input);
}

public function getResponseUrl(Request $request)
{
    $url = $request->all();
    $linkPrev = $this->obtainURL($url['url']);

    $destination = public_path('images/');
    $imageUrl = $linkPrev['cover'];
    $uniqid = uniqid();
    $finalImage = '';

    if($imageUrl){

        $img = Image::make($imageUrl);
        // header('Content-Type: image/png');
        $img->resize(null, 600, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($destination . $uniqid . ".jpg");
        $finalImage = $uniqid . ".jpg";
    }


        // return $img->response();

        // dd($img);
        // $mainFileExtension = $img->getClientOriginalExtension();



        // dd($linkPrev->all());
    Bookmark::forceCreate([
        'title' => $linkPrev['title'],
        'description' => $linkPrev['description'],
        'cover' => $finalImage,
        'url' => $url['url'],
        'category_id' => $url['category_id']

    ]);
    // return response()->json('Success', 200);
    return back();
}

protected function getUrl($url)
{
    $previewClient = new Client($url);
    $response = $previewClient->getPreview('general');
    $response = $response->toArray();
    //$response = json_decode($response);
    //return $decodedContents;
    return $response;
}

protected function obtainUrl($url)
{
    return $this->getUrl($url);
}

public function foo($lang = 'de', $units = 'imperial')
{
    $lowm = new LaravelOWM();
    $current_weather = $lowm->getCurrentWeather('berlin',$lang = 'de', $units = 'metric');

    return $current_weather->temperature;
}

public function destroy(Bookmark $bookmark)
    {
        // $bookmark = Bookmark::findOrFail($id);
        $bookmark->delete();
        if(request()->expectsJson()) {
            return response()->json('Deleted', 200);
        }
        return back();
    }

    public function twitterTest()
    {
        $data = Twitter::getUserTimeline(['count' => 5, 'format' => 'array']);
        dd($data);
        return view('twitter', compact('data'));
    }

}
