<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Services\FaqService;
use App\Services\HelperService;
use App\Services\UtilityService;

class CFaqController extends Controller
{
    protected $helperService, $faqService, $utilityService, $responseMsg;

    public function __construct()
    {
        $this->helperService = new HelperService();
        $this->faqService = new FaqService();
        $this->utilityService = new UtilityService();
        //messages
        $this->responseMsg = $this->utilityService->responseMsg();
    }

    public function index(){
       $faqs = $this->faqService->activeData();
       return $this->faqService->returnItemsList($faqs, $this->responseMsg);
    }
}
