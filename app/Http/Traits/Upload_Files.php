<?php


namespace App\Http\Traits;


use Faker\Provider\Image;
use Illuminate\Support\Facades\File;

trait Upload_Files
{



    //---------------Upload Files----------------
    public function uploadFiles($folder_name,$file,$is_updated_file=null){
        //upload or update
        $fileNameToStore=null;

        if ($file){
            if ($is_updated_file!=null) {
             //   $fileNameToStore=$is_updated_file;
                File::delete(public_path("storage/uploads/{$is_updated_file}"));
            }
            $fileName_original =$file->getClientOriginalName();
            $fileNameWithExt =$file->getClientOriginalExtension();
            $fileName = $folder_name.'/'.pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //$ext =$file->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_'.$fileName_original . '_'.time() . '.' . $fileNameWithExt;
            $file->move("storage/uploads/{$folder_name}", $fileNameToStore);
        }else{
            $fileNameToStore=$is_updated_file;
        }

        return $fileNameToStore!=null?$fileNameToStore:null;
    }//end


    public function createImageFromTextManual($folder , $text , $size , $color_text, $color_background)
    {
        $img = \DefaultProfileImage::create($text, $size, $color_text, $color_background);
        $time = time().rand(11111,99999);
        $image_file = "{$folder}/{$time}.png";
        \Storage::put("public/uploads/{$image_file}", $img->encode());
        return $image_file;
    }
    public function storeDefaultImage($path,$name){
        $colors = array(
            "#162F44",
            "#2F97D0",
            "#670948",
            "#612248",
            "#19C44C",
            "#7A3A0E",
            "#FD9F1F",
            "#031D16",
            "#439CAF",
            "#818BC6",
            "#852A44",
            "#03D8EA",
            "#E4727E",
            "#ED7D6C",
            "#A8D4CE",
            "#1A958D",
            "#72AF4F",
            "#C75663",
            "#AC3F88",
            "#B8170A",
            "#CBA47D",
        );
        $key1 = array_rand($colors);
        $key2 = array_rand($colors);

        while ($key1 == $key2){
            $key1 = array_rand($colors);
            $key2 = array_rand($colors);
        }

        $fonts = array(
            public_path('assets/default/fonts/Sukar-Black.ttf'),
            public_path('assets/default/fonts/Sukar-Bold.ttf'),
            public_path('assets/default/fonts/GRIFON-BlackPersonalUse.otf'),
            public_path('assets/default/fonts/GRIFON-BoldPersonalUse.otf'),
            public_path('assets/default/fonts/Sukar-Regular.ttf'),
            public_path('assets/default/fonts/Kahlil.otf'),
            public_path('assets/default/fonts/Kahlil.ttf')
        );

        $fontKey = array_rand($fonts);

        $img = \DefaultProfileImage::create("$name", 256, $colors[$key1], $colors[$key2], $fonts[$fontKey]);
        $imageName = "$path/".time().'--'.base64_encode(time().'-'.base64_encode($name)).'.png';
        \Storage::put('storage/uploads/'.$imageName, $img->encode());
        return $imageName;
    }//end fun


}//end trait
