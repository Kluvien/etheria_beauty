<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\Service;
use App\Models\Testimonial;
use App\Support\WhatsApp;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'services' => Service::where('is_active', true)->get(),
            'gallery' => GalleryItem::where('is_published', true)->latest()->get(),
            'testimonials' => Testimonial::where('is_published', true)->latest()->get(),
            'whatsappUrl' => WhatsApp::url(),
        ]);
    }
}