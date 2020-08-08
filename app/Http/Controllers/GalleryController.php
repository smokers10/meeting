<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use App\Gallery;

class GalleryController extends Controller
{
    public function index($id)
    {
        $data = Gallery::where('id_mom', $id)->get();
        return view('mom.gallery.index', [
            'id' => $id,
            'data' => $data
        ]);
    }

    //crud
    public function publish(Request $request, $id)
    {
        $image = $request->file('image');
        if ($image) 
        {
            //validate
			$this->validate($request, [
				'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000000',
            ]);
            
            //rename file
			$chrc = array('[',']','@',' ','+','-','#','*','<','>','_','(',')',';',',','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
			$filename = $id.time().str_replace($chrc, '', $image->getClientOriginalName());
			$width = getimagesize($image)[0];
			$height = getimagesize($image)[1];

			//save image to server
			//creating thumbnail and save to server
			$destination = public_path('img/gallery/thumbnails/'.$filename);
			$img = Image::make($image->getRealPath());
			$thumbnail = $img->resize(400, 400, function ($constraint) {
				$constraint->aspectRatio();
			})->save($destination); 

			//saving image real to server
			$destination = public_path('img/gallery/covers/');
			$real = $image->move($destination, $filename);

			if ($thumbnail && $real) 
			{
                //save image
				$data = array(
					'gambar' => $filename,
					'id_mom' => $id
				);
				$rest = Gallery::Insert($data);
                if ($rest) 
                {
                    return redirect(route('gallery-index', $id));
                }
            }
        }
        else
        {
            return redirect(route('gallery-index', $id));
        }
    }

    function remove(Request $request, $id)
	{
        $id_gallery = $request['id-gallery'];

        //getting image
        $image = Gallery::where('id_gallery', $id_gallery)->value('gambar');

        if (true) 
        {
            //remove database
            $sql = Gallery::where('id_gallery', $id_gallery)->delete();
            if ($sql) 
            {
                //remove image
                $rmvThumbnail = unlink(public_path('img/gallery/thumbnails/'.$image));
                $rmvCover = unlink(public_path('img/gallery/covers/'.$image));

                return redirect(route('gallery-index', $id));
            } 
            else 
            {
                return redirect(route('gallery-index', $id));
            }
        } 
        else 
        {
            return redirect(route('gallery-index', $id));
        }
	}
}
