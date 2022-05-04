<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupportMsgRequest;
use App\Models\SupportMsg;
use App\Services\FaqService;
use App\Services\HelperService;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class CMoreInfoController extends Controller
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

    public function getContentPageUrl(Request $request)
    {
        // $data['about_us'] = route('about-us');
        // $data['privacy_policy'] = route('privacy-policy');
        // $data['terms_and_condition'] = route('terms-and-condition');

        $data['about_us'] = 'https://fastbus.com/about/';
        $data['privacy_policy'] = 'https://fastbus.com/privacy-policy/';
        $data['terms_and_condition'] = 'https://fastbus.com/terms-of-use/';

        if ($data) {
            $message = 'Get Content Page Urls successfully';
            return $this->utilityService->is200ResponseWithDataArrKey($message, $data);
        } else {
            $message = 'Error! while getting Content Page Urls';
            return $this->utilityService->is422Response($message);
        }
    }

    public function storeSupportMsg(SupportMsgRequest $request){
        $input = $request->all();
        $data = SupportMsg::create($input);
        if ($data) {
            $message = 'Get Query has been reached successfully';
            return $this->utilityService->is200Response($message);
        } else {
            $message = 'Error! while getting your query.';
            return $this->utilityService->is422Response($message);
        }
    }
}
