<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Personality;
use App\Models\Sect;
use App\Models\World;
use Illuminate\Http\Request;

class SortController extends Controller
{

    public function loadCategory()
    {
        $category = Category::where('trangthai', 0)->orderBy('tentheloai', 'ASC')->get();
        return $category;
    }
    public function loadPersonality()
    {
        $personality = Personality::where('trangthai', 0)->orderBy('tentinhcach', 'ASC')->get();
        return $personality;
    }
    public function loadWorldScene()
    {
        $worldScene = World::where('trangthai', 0)->orderBy('tenthegioi', 'ASC')->get();
        return $worldScene;
    }
    public function loadCurrent()
    {
        $current = Sect::where('trangthai', 0)->orderBy('tenluuphai', 'ASC')->get();
        return $current;
    }


    public function sort($sortBookUrl, $StatusUrl, $CategoryUrl, $CurrentUrl, $PersonalityUrl, $WorldSceneUrl)
    {

        $category = Category::where('slug', $CategoryUrl)->first();
        $current = Sect::where('slug', $CurrentUrl)->first();
        $personality = Personality::where('slug', $PersonalityUrl)->first();
        $worldScene = World::where('slug', $WorldSceneUrl)->first();

        if ($StatusUrl == 'tat-ca') {
            $book = Book::where('trangthai->1')
                ->where('theloai_id', $category->id)
                ->where('luuphai_id', $current->id)
                ->where('tinhcach_id', $personality->id)
                ->where('thegioi_id', $worldScene->id)
                ->orderBy($sortBookUrl, 'DESC')
                ->paginate(10);
            return  $book;
        } else if ($StatusUrl == 'hoan-thanh') {
            $statusKey = 1;
            $book = Book::where('trangthai->1')
                ->where('tinhtrang', $statusKey)
                ->where('theloai_id', $category->id)
                ->where('luuphai_id', $current->id)
                ->where('tinhcach_id', $personality->id)
                ->where('thegioi_id', $worldScene->id)
                ->orderBy($sortBookUrl, 'DESC')
                ->paginate(10);
            return  $book;
        } else {
            $statusKey = 1;
            $book = Book::where('trangthai->1')
                ->where('tinhtrang', $statusKey)
                ->where('theloai_id', $category->id)
                ->where('luuphai_id', $current->id)
                ->where('tinhcach_id', $personality->id)
                ->where('thegioi_id', $worldScene->id)
                ->orderBy($sortBookUrl, 'DESC')
                ->paginate(10);
            return  $book;
        }
    }
}
