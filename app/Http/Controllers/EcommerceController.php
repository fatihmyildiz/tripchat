<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class EcommerceController extends Controller {
    
    /**
     * Display ecommerce products of the resource.
     *
     * @return \Illuminate\View\View
     */
   public function index()
    {
        $title = "Ecommerce Products";
        $description = "Some description for the page";

        $hotelId = Auth::user()->hotel_id;

        $hotel = Hotel::findOrFail($hotelId);
        $rooms = $hotel->rooms;

        return view('pages.applications.ecommerce.products', compact('title', 'description', 'rooms'));
    }

    /**
     * Display ecommerce product list of the resource.
     *
     * @return \Illuminate\View\View
     */
   public function productList(){
    $title = "Ecommerce Product List";
    $description = "Some description for the page";
    if(auth()->check()) {
        $hotelId = auth()->user()->hotel_id;
        $rooms = Room::where('hotel_id', $hotelId)->get();
    } else {
        $rooms = [];
    }

    return view('pages.applications.ecommerce.product_list', compact('title', 'description', 'rooms'));


    }

    /**
     * Display ecommerce product details of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function productDetail(){
        $title = "Ecommerce Product Details";
        $description = "Some description for the page";
        return view('pages.applications.ecommerce.product_detail',compact('title','description'));
    }

    /**
     * Display ecommerce add product of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function addProduct(){
        $title = "Ecommerce Add Product";
        $description = "Some description for the page";
        return view('pages.applications.ecommerce.add_product',compact('title','description'));
    }

    /**
     * Display ecommerce cart of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function cart(){
        $title = "Ecommerce Cart";
        $description = "Some description for the page";
        return view('pages.applications.ecommerce.cart',compact('title','description'));
    }

    /**
     * Display ecommerce orders of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function orders(){
        $title = "Ecommerce Orders";
        $description = "Some description for the page";
        return view('pages.applications.ecommerce.reservations',compact('title','description'));
    }

    /**
     * Display ecommerce sellers of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function sellers(){
        $title = "Ecommerce Sellers";
        $description = "Some description for the page";
        return view('pages.applications.ecommerce.sellers',compact('title','description'));
    }

    /**
     * Display ecommerce invoice of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function invoice(){
        $title = "Ecommerce Invoice";
        $description = "Some description for the page";
        return view('pages.applications.ecommerce.invoice',compact('title','description'));
    }
}