<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\cms_page;
use App\Models\HomeTestimonial;

class Helper {

    public function __construct() {
        
    }

    public static function getCMSpageContent($id) {
        $cms_page = cms_page::where('id', '=', $id)
                        ->first()->toArray();

        return $cms_page['description'];
    }

    public static function getCMSfaqContent($id) {
        $cms_faq = cms_page::where('id', '=', $id)
                        ->first()->toArray();
        if (isset($cms_faq['description'])) {
            $cms_faq['description'] = json_decode($cms_faq['description']);
        }

        return $cms_faq;
    }

    public static function getImageName($imageId, $imageArray) {
        foreach ($imageArray as $img) {
            if ($img['id'] == $imageId) {
                return $img['image_name'];
            }
        }
    }

    public static function sortArrayByArray(array $array, array $orderArray) {
        $new_arr = [];
        foreach ($orderArray as $k_o => $v_o)
        {
            
            foreach ($array as $k_a => $v_a)
            {
                if($v_o == $v_a['id'])
                {
                    array_push($new_arr, $v_a);
                }
            }
        }
        
        if(count($array) === count($orderArray))
        {
            return $new_arr;
        }
        foreach ($array as $gal_img)
        {
            if(!in_array($gal_img['id'], $orderArray))
            {
                array_push($new_arr, $gal_img);
            }
            
        }
        
        return $new_arr;
        
    }
}
