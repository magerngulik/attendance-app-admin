<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\Experience;
use App\Models\MediaSosial;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Models\PortoEducation;

class PortofolioController extends Controller
{
    public function index(){
        $user = User::where('name','zul')->first();
        $portofolio =  Portfolio::get()->first();
        $umur =  $this->umur($portofolio['tanggal_lahir']);
        $project = Project::with('kategori')->get();

        $dataProject = [];

        foreach ($project as $item) {
            $dataProject[] = [
                "name" => $item->name,
                "image" => ImageHelper::convertImagePathToUrl($item->image),
                "kategori" => $item->kategori->name,
                "url" => $item->url
            ];
        };

        $education = PortoEducation::get();
        $categories =  Category::all();
        $experinces = Experience::with('experience')->get();

       

        return view('portofolio',[
            "media_social" => MediaSosial::all(),
            "user" => $user,
            "profile" => ImageHelper::convertImagePathToUrl($user['avatar']),
            "portofolio" => $portofolio,
            "umur" => $umur,
            "categorie" => $categories,
            "project" => $dataProject,
            "education" => $education,
            "experinces" => $experinces,
        ]);
    }



    public function umur($tanggal_lahir){
        $tanggal_lahir_obj = new DateTime($tanggal_lahir);
        $tanggal_sekarang = new DateTime();
        $selisih_tanggal = $tanggal_sekarang->diff($tanggal_lahir_obj);
        $umur = $selisih_tanggal->y;
        return $umur;
    }

}
