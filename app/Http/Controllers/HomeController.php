<?php

namespace App\Http\Controllers;

use App\Services\HomepageService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected HomepageService $homepageService
    ) {}

    /**
     * Show the dynamic application homepage.
     */
    public function index(): View
    {
        $data = $this->homepageService->getHomepageData();

        return view('home', $data);
    }
}

