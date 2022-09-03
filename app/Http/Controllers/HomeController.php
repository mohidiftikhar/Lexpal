<?php

namespace App\Http\Controllers;

use App\Http\Resources\DictionaryResource;
use App\Repositories\guest\GuestInterface;
use App\Repositories\guest\GuestRepository;
use App\Models\Slider;
use App\Repositories\app_links\AppLinksInterface;
use App\Repositories\language\LanguageInterface;
use App\Repositories\navigation\NavigationInterface;
use App\Repositories\pages\PageInterface;
use App\Repositories\plans\PlanInterface;
use App\Repositories\questions\QuestionInterface;
use App\Repositories\settings\SettingInterface;
use App\Repositories\slider_links\SliderLinksInterface;
use App\Repositories\sliders\SliderInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $settingRepository;
    protected $LanguageRepository;
    protected $guestRepository;
    protected $sliderRepository;
    protected $questionRepository;
    protected $appLinkRepository;
    protected $sliderLinkRepository;
    protected $navigationRepository;
    protected $pageRepository;
    protected $planRepository;
    public function __construct(PlanInterface $planRepository,
                                PageInterface $pageRepository,
                                NavigationInterface $navigationRepository,
                                LanguageInterface    $LanguageRepository,
                                SliderInterface      $sliderRepository,
                                QuestionInterface    $questionRepository,
                                AppLinksInterface    $appLinkRepository,
                                SliderLinksInterface $sliderLinkRepository,
                                GuestInterface       $guestRepository,
                                SettingInterface     $settingRepository
    )
    {
        $this->LanguageRepository = $LanguageRepository;
        $this->sliderRepository = $sliderRepository;
        $this->questionRepository = $questionRepository;
        $this->appLinkRepository = $appLinkRepository;
        $this->sliderLinkRepository = $sliderLinkRepository;
        $this->guestRepository = $guestRepository;
        $this->settingRepository = $settingRepository;
        $this->navigationRepository = $navigationRepository;
        $this->pageRepository = $pageRepository;
        $this->planRepository = $planRepository;
    }

    public function index()
    {
        $data = $this->LanguageRepository->getAllLanguages();

        $guest = $this->guestRepository->get_client_info();
        $sliders = $this->sliderRepository->all();
        $questions = $this->questionRepository->all();
        $app = $this->appLinkRepository->all();
        $sliderLink = $this->sliderLinkRepository->all();
        $navigations = $this->navigationRepository->all();
        $plans = $this->planRepository->all();
        $setting = $this->settingRepository->findById(1);
        return view('home.index')->with(compact('data', 'sliders', 'questions', 'sliderLink', 'app', 'guest','setting','navigations','plans'));
    }

    public function policy()
    {
        $setting = $this->settingRepository->findById(1);
        /*$our_policy = $setting['policy'];*/
        return view('home.policy',compact('setting'));
    }

    public function checkCount()
    {
        $guest = $this->guestRepository->get_client_info();

        if ($guest->tries > 0) {
            $guest = $this->guestRepository->get_client_info(true);
            $tries = true;
        } else {
            $tries = false;
        }

        return response()->json([
            'success' => true,
            'tries' => $tries,
            'remaining_tries' => $guest->tries
        ]);
    }

    public function searchDictionary(Request $request)
    {
        $request->validate([
            'languageType' => 'required',
            'languageId' => 'required|numeric',
            'search' => 'sometimes|string',
            'page' => 'required|numeric'
        ]);
        $languageType = (int)$request['languageType'];
        $entryword = ($languageType === 0) ? 'inflactedform' : 'inflactedform_1';

        if (!Auth::user() and $request->tries === 'true') {
            $guest = $this->guestRepository->get_client_info();
//            dd($guest);
            if ($guest->tries > 0) {
                $guestUpdated = $this->guestRepository->get_client_info(true);
                $tries = true;
                $remaining_tries = $guestUpdated->tries;
//                dd($remaining_tries);
                    $dictionaries = $this->LanguageRepository->searchDictionary($request->all());
            } else {
                return response()->json([
                    'message' => 'Your free tries ended, login to continue!',
                    'success' => false,
                    'status' => 400
                ], 300);
            }
        } else {
            $dictionaries = $this->LanguageRepository->searchDictionary($request->all());
            $tries = false;
            $remaining_tries = 1;
        }
        return response()->json([
            'success' => true,
            'message' => 'search results ' . $entryword,
            'languageType' => $languageType,
            'pagination' => [
                'currentPage' => $dictionaries->currentPage(),
                'nextPage' => (int)($dictionaries->currentPage() + 1)
            ],
            'data' => DictionaryResource::collection($dictionaries->items()),
            'tries' => $tries,
            'remaining_tries' => $remaining_tries
        ]);
    }

    public function translate()
    {
        $data = $this->LanguageRepository->getAllLanguages();
        return view('home.translate-detail', compact('data'));
    }
    public function slug($slug){
/*        dd($slug);*/
        $setting = $this->settingRepository->findById(1);
        $pages = $this->pageRepository->findByFields(['name' => $slug]);
        return view('home/dynamic-page', compact('pages','setting'));
    }
}
