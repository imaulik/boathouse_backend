<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Vessel_details;
use App\Models\Home_slider;
use App\Models\HomeTestimonial;
use App\Models\Latest_news;
use App\Models\Vessel_gallery;
use App\Models\Vessel_bids;
use App\Models\Vessel_additional_field;
use App\Models\vessel_user_deposit;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Validator;
use DateTime;
use DB;
use Auth;
use Carbon\Carbon;

class Vessel_detailsController extends BaseController {

    public function __construct() {
        
    }

    public function saveVessel_detail(Request $request) {
        $data = $request->all();
        if (isset($data['vessel_additional_fields']) && count($data['vessel_additional_fields']) > 0) {
            $vessel_additional_fields = $data['vessel_additional_fields'];
        }
        if (isset($data['galllery_images']) && count($data['galllery_images']) > 0) {
            $auction_gallery_images = $data['galllery_images'];
        }
        if (isset($data['auction_begins'])) {
            $data['auction_begins'] = new DateTime($data['auction_begins']);
        }
        if (isset($data['auction_ends'])) {
            $data['auction_ends'] = new DateTime($data['auction_ends']);
        }

        if (isset($data['id'])) {

            $vessel_details = Vessel_details::find($data['id']);
            if ($vessel_details) {
                if (isset($data['title'])) {
                    $data['slug'] = str_replace(" - ", " ", strtolower($data['title']));
                    $data['slug'] = str_replace(" -", " ", strtolower($data['slug']));
                    $data['slug'] = str_replace("- ", " ", strtolower($data['slug']));
                    $data['slug'] = str_replace("-", " ", strtolower($data['slug']));
                    $data['slug'] = str_replace(" ", "-", strtolower($data['slug']));
                    $data['slug'] = preg_replace("/[^A-Za-z0-9\-]/", "", $data['slug']);
                    $data['slug'] = $this->generateSlug($data['slug'], $request->id);
                }

                $rules = ['slug' => 'unique:vessel_details,slug,' . $data['id']];
                $validator = Validator::make($data, $rules);
                if ($validator->fails()) {
                    return $this->JSONformatUnsuccessResponse('Slug Already Registerd');
                } else {
                    $vessel_details->update($data);
                    if (isset($auction_gallery_images) && count($auction_gallery_images) > 0) {
                        $x = Vessel_gallery::where('vessel_id', $vessel_details->id)->whereNotIn('image_name', $auction_gallery_images)->delete();

                        $storedImages = Vessel_gallery::where('vessel_id', $vessel_details->id)->get();

                        $imgToSave = [];
                    
                        foreach ($auction_gallery_images as $auction_gallery_image) {
                            $cnt = $storedImages->where('image_name',$auction_gallery_image)->count();
                            if($cnt===0){
                                array_push($imgToSave, $auction_gallery_image);
                            }
                        } 
                        

                        foreach ($imgToSave as $imgSave) {
                            $gal = [];
                            $gal['vessel_id'] = $vessel_details->id;
                            $gal['image_name'] = $imgSave;

                            Vessel_gallery::create($gal);
                        }
                    } else {
                        Vessel_gallery::where('vessel_id', $vessel_details->id)->delete();
                    }

                    if ($vessel_details && isset($vessel_additional_fields) && count($vessel_additional_fields) > 0) {
                        Vessel_additional_field::where('vessel_id', $vessel_details->id)->delete();
                        foreach ($vessel_additional_fields as $vessel_additional_field) {
                            $additional = [];
                            $additional['vessel_id'] = $vessel_details->id;
                            $additional['title'] = $vessel_additional_field['title'];
                            if (isset($vessel_additional_field['field_filename'])) {
                                $additional['field_filename'] = $vessel_additional_field['field_filename'];
                            }
                            Vessel_additional_field::create($additional);
                        }
                    }
                    return $this->JSONformatSuccessResponse('Updated Successfully');
                }
            } else {
                return $this->JSONformatUnsuccessResponse('User not Registerd');
            }
        } else {
            if (isset($data['title'])) {
                $data['slug'] = str_replace(" - ", " ", strtolower($data['title']));
                $data['slug'] = str_replace(" -", " ", strtolower($data['slug']));
                $data['slug'] = str_replace("- ", " ", strtolower($data['slug']));
                $data['slug'] = str_replace("-", " ", strtolower($data['slug']));
                $data['slug'] = str_replace(" ", "-", strtolower($data['slug']));
                $data['slug'] = preg_replace("/[^A-Za-z0-9\-]/", "", $data['slug']);
                $data['slug'] = $this->generateSlug($data['slug']);
            }
            $rules = ['slug' => 'unique:vessel_details,slug'];
            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return $this->JSONformatUnsuccessResponse('Slug Already Registerd');
            } else {
                $data['user_id'] = auth('web')->id();
                $vessel = Vessel_details::create($data);
                if ($vessel && isset($auction_gallery_images) && count($auction_gallery_images) > 0) {
                    foreach ($auction_gallery_images as $auction_gallery_image) {
                        $gal = [];
                        $gal['vessel_id'] = $vessel->id;
                        $gal['image_name'] = $auction_gallery_image;
                        Vessel_gallery::create($gal);
                    }
                }
                if ($vessel && isset($vessel_additional_fields) && count($vessel_additional_fields) > 0) {
                    foreach ($vessel_additional_fields as $vessel_additional_field) {
                        $additional = [];
                        $additional['vessel_id'] = $vessel->id;
                        $additional['title'] = $vessel_additional_field['title'];
                        if (isset($vessel_additional_field['field_filename'])) {
                            $additional['field_filename'] = $vessel_additional_field['field_filename'];
                        }
                        Vessel_additional_field::create($additional);
                    }
                }
                return $this->JSONformatSuccessResponse('Created Successfully');
            }
        }
    }

    public function getVessel_details(Request $request) {
        $filter = $request->all();
        if (isset($filter)) {

            $query = Vessel_details::query();
            $today_date = Carbon::now();
            $today_date = $today_date->format('Y-m-d H:i:s');
            if ($filter['globalFilter'] == 'sold') {
                $query->orWhere('auction_ends', '<=', $today_date);
            }
            if ($filter['globalFilter'] == 'current') {
                $query->orWhere('auction_ends', '>=', $today_date);
            }
            $totalrecords = $query->count();

            $query1 = Vessel_details::query();



            $query1 = $query1->take($filter['rows'])
                    ->skip($filter['first']);
            $query1 = $query1->with('galleryimages');
            $query1 = $query1->where(function ($qu2) use ($filter) {
                        $qu2->orWhere('title', 'like', '%' . $filter['globalFilter'] . '%');
                        $today_date = Carbon::now();
                        $today_date = $today_date->format('Y-m-d H:i:s');
                        if ($filter['globalFilter'] == 'sold') {
                            $qu2->orWhere('auction_ends', '<=', $today_date);
                        }
                        if ($filter['globalFilter'] == 'current') {
                            $qu2->orWhere('auction_ends', '>=', $today_date);
                        }
                    })
                    ->orderBy($filter['columns'], $filter['sortype']);
            $data = $query1->get();
            return $this->JSONformatSuccessResponse(compact('data', 'totalrecords'));
        } else {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getVessel_detail(Request $request) {
        if ($request->id) {
            $vessel_detail = Vessel_details::with(['galleryimages', 'additionalFields'])->find($request->id);
            return $this->JSONformatSuccessResponse($vessel_detail);
        } else {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function getAllVessel_details(Request $request) {
        $vessel_detail = Vessel_details::get()->toArray();
        return $this->JSONformatSuccessResponse($vessel_detail);
    }

    public function deleteVessel_detail(Request $request) {
        if ($request->id) {
            Vessel_bids::where('vessel_id', $request->id)->delete();
            Vessel_comment::where('vessel_id', $request->id)->delete();
            vessel_user_deposit::where('vessel_id', $request->id)->delete();
            Vessel_gallery::where('vessel_id', $request->id)->delete();
            Vessel_details::where('id', $request->id)->delete();
            return $this->JSONformatSuccessResponse('Deleted Successfully');
        } else {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function generateSlug($slug, $id = 0, $x = 0) {

        if ($x == 0) {
            
        } else {
            if ($x == 1) {
                $slug = $slug . '-' . $x;
            } else {
                $slug = substr($slug, 0, strrpos($slug, "-")) . "-" . $x;
            }
        }
        if ($this->getVessel_detailsCountBySlug($slug, $id) == 0) {
            return $slug;
        } else {
            return $this->generateSlug($slug, $id, $x = $x + 1);
        }
    }

    public function getVessel_detailsCountBySlug($slug, $id) {

        $query = Vessel_details::where('slug', '=', $slug)->where('id', '=', $id)->get();
        return count($query);
    }

    public function ViewOurAuctions() {
        $today_date = Carbon::now();
        $today_date = $today_date->format('Y-m-d H:i:s');

        $current_datas = Vessel_details::where('auction_ends', '>=', $today_date)->orderBy('auction_ends', 'ASC')
                        ->get()->toArray();

        return view('view-our-auctions', compact('current_datas'));
    }

    public function SoldOurAuctions() {
        $today_date = Carbon::now();
        $today_date = $today_date->format('Y-m-d H:i:s');
        $data = Vessel_details::where('auction_ends', '<=', $today_date)
                        ->get()->toArray();
        return view('sold-our-auctions', compact('data'));
    }

    public function ViewOurAuctionsBySlug($slug) {

        $data = Vessel_details::where('slug', $slug)->with(['galleryimages', 'additionalFields', 'commentselect', 'bidselect'])->first()->toArray();
        if (Auth::user()) {
            $user_details = vessel_user_deposit::where('user_id', Auth::user()->id)
                            ->where('vessel_id', $data['id'])
                            ->get()->toArray();

            if (isset($user_details) && count($user_details) > 0) {
                $user_details = $user_details[0];
            }
        } else {
            $user_details = '';
        }
        if (isset($data['auction_begins']) && isset($data['auction_ends'])) {
            $today_date = Carbon::now();
            $today_date = $today_date->format('Y-m-d H:i:s');
            $data['today_date'] = $today_date;
            if ($data['auction_begins'] <= $today_date && $data['auction_ends'] >= $today_date) {
                $data['auction_closed'] = 0;
            } else {
                $data['auction_closed'] = 1;
            }
            $other_autions = Vessel_details::where('id', '!=', $data['id'])
                            ->where('auction_ends', '>=', $today_date)
                            ->get()->toArray();
        }
        if (isset($data['bidselect']) && count($data['bidselect']) > 0) {
            $highest_bid = Vessel_bids::where('vessel_id', $data['id'])
                            ->orderBy('id', 'desc')
                            ->first()->toArray();
            if (isset($highest_bid['id'])) {
                $data['last_bid_price'] = $highest_bid['bid_amount'];
                $data['last_bid'] = 0;
            }
        } else {
            $data['last_bid_price'] = $data['auction_start_price'];
            $data['last_bid'] = 1;
        }
        $data['bid_count'] = count($data['bidselect']);

        if ($data['auction_begins'] >= $data['today_date']) {
            $data['bid_opening'] = 1;
        } else {
            $data['bid_opening'] = 0;
        }
//echo '<pre>';
//print_r($data);
//die();
        if (!empty($data['gallery_order'])) {
            $galleryimages = \Helper::sortArrayByArray($data['galleryimages'], json_decode($data['gallery_order'], JSON_NUMERIC_CHECK));
        } else {
            $galleryimages = $data['galleryimages'];
        }
//        return view('auctions', compact('data', 'other_autions', 'user_details'));
        return view('auctions', compact('data', 'other_autions', 'user_details', 'galleryimages'));
    }

    public function ViewHowAuctionWork(Request $request) {

//        $data = Vessel_details::where('slug', $slug)->with(['galleryimages'])->first()->toArray();

        return view('how-it-works');
    }

    public function gethomeAuctionDetails(Request $request) {
        $today_date = Carbon::now();
        $today_date = $today_date->format('Y-m-d H:i:s');
        $data = Vessel_details::where('auction_begins', '<=', $today_date)
                        ->where('auction_ends', '>=', $today_date)
                        ->take(2)
                        ->orderBy('auction_ends', 'asc')
                        ->get()->toArray();
        $home_sliders = Home_slider::get()->toArray();
        $latest_news = Latest_news::orderBy('created_at', 'desc')->get()->toArray();
        $home_testimonials = HomeTestimonial::where('status', '=', 0)->get()->toArray();
        return view('home', compact('data', 'home_sliders', 'latest_news', 'home_testimonials'));
    }

    public function deleteVessel_detail_gallery_image(Request $request) {
        if ($request->id) {
            Vessel_gallery::where('id', $request->id)->delete();
            return $this->JSONformatSuccessResponse('Deleted Successfully');
        } else {
            return $this->JSONformatUnsuccessResponse('Please provide parameter');
        }
    }

    public function fileUploadCheck(Request $request) {
        $data = $request->all();

        $image_filename = UploadController::uploadPDFfile($data['field_filename']);
        if ($image_filename['success'] == 'true') {
            return response()->json($image_filename, 200);
        } else {
            return response()->json($image_filename, 200);
        }
    }

    public function getMYVessel_details(Request $request) {
        $today_date = Carbon::now();
        $today_date = $today_date->format('Y-m-d H:i:s');
        //latest Bids
        $latest_bids = Vessel_details::with(['depositselect', 'userselect', 'bidselect'])
                        ->whereHas('depositselect', function($qu1) {
                            $qu1->where('user_id', auth('web')->id());
                        })
                        ->whereHas('bidselect', function($qu1) {
                            $qu1->where('user_id', auth('web')->id());
                        })
                        ->orderBy('auction_ends', 'desc')
                        ->get()->toArray();
        foreach ($latest_bids as $key => $value) {
            if (isset($value['bidselect']) && count($value['bidselect']) > 0) {
                $highest_bid = Vessel_bids::where('vessel_id', $value['id'])
                                ->orderBy('id', 'desc')
                                ->first()->toArray();
                if (isset($highest_bid['id'])) {
                    $latest_bids[$key]['last_bid_price'] = $highest_bid['bid_amount'];
                }
            } else {
                $latest_bids[$key]['last_bid_price'] = $value['auction_start_price'];
            }
            $latest_bids[$key]['bid_count'] = count($value['bidselect']);
        }


        //latest Active Auction
        $latest_active_auction = Vessel_details::with(['depositselect', 'userselect', 'bidselect'])
                        ->where('user_id', auth('web')->id())
                        ->where('auction_begins', '<=', $today_date)
                        ->where('auction_ends', '>=', $today_date)
                        ->orderBy('auction_ends', 'desc')
                        ->get()->toArray();

        //latest Closed Auction
        $latest_closed_auction = Vessel_details::with(['depositselect', 'userselect', 'bidselect'])
                        ->where('user_id', auth('web')->id())
                        ->where('auction_ends', '<', $today_date)
                        ->orderBy('auction_ends', 'desc')
                        ->get()->toArray();

        //latest Paid/Unpaid Auction
        $latest_paid_unpaid_auction = Vessel_details::with(['depositselect', 'userselect', 'bidselect'])
                        ->whereHas('depositselect', function($qu1) {
                            $qu1->where('user_id', auth('web')->id());
                        })
                        ->where('auction_ends', '>=', $today_date)
                        ->orderBy('auction_ends', 'desc')
                        ->get()->toArray();


        return view('user.auctions_history', compact('latest_bids', 'latest_active_auction', 'latest_closed_auction', 'latest_paid_unpaid_auction'));
    }

    public function saveVesselGalleryOrder(Request $request) {
        $data = $request->all();
        $vessel_details = Vessel_details::findOrFail($data['vessel_id']);

        $update = [];
        $update['gallery_order'] = json_encode($data['itemsOrderToSave']);
        $vessel_details->update($update);
        return response()->json(["success" => true]);
    }

}
