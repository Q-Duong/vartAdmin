<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Slider;
use App\Models\TempFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private $folder;

    public function __construct()
    {
        $this->folder = 'albums';
    }

    public function index()
    {
        $getAllImages = Album::where('conference_id', 1)->orderBy('id', 'DESC')->paginate(30);
        return view('pages.admin.album.index', compact('getAllImages'));
    }


    //Admin
    public function create()
    {
        return view('pages.admin.album.create');
    }
    public function store(Request $request)
    {
        if ($request->album_path) {
			foreach ($request->album_path as $key => $file) {
                $temp = TempFile::firstWhere('folder', $file);
				Album::create([
					'album_path' => moveFileSource($temp->folder, $this->folder, $temp->filename),
                    'conference_id' => 1,
				]);
                $temp->delete();
			}
		}
        return Redirect()->back()->with('success', 'Successfully created');
    }
}
