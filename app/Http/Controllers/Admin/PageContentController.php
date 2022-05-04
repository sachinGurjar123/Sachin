<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageContentRequest;
use App\Models\PageContent;
use App\Services\ManagerLanguageService;
use App\Services\PageContentService;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    protected $mls;
    public function __construct()
    {
        $this->middleware('permission:page_content', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
        $this->mls = new ManagerLanguageService('messages');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = PageContentService::datatable();
            return datatables()->eloquent($items)->make(true);
        } else {
            return view('admin.page_content.index');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page_content.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageContentRequest $request)
    {
        $input = $request->except(['_token']);
        $page_content = PageContentService::create($input);
        return redirect()->route('page_contents.index')
            ->with('success', $this->mls->messageLanguage('created', 'page_content', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_content = PageContentService::getById($id);
        return view('admin.page_content.details', compact('page_content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $page_content = PageContentService::getById($id);
      return view('admin.page_content.edit',compact('page_content'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageContentRequest $request, PageContent $page_content)
    {
        $input = $request->except(['_token', '_method', 'proengsoft_jsvalidation']);
        $user = PageContentService::update($input, $page_content->id);
        return redirect()->route('page_contents.index')
            ->with('success', $this->mls->messageLanguage('updated', 'page_content', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PageContent $page_content)
    {
        $result = PageContentService::delete($page_content);
        if ($result) {
             $message = $this->mls->messageLanguage('deleted', 'page_content', 1);
            UtilityService::is200Response($message);
        } else {
            $message =  $this->mls->messageLanguage('not_deleted', 'page_content', 1);
            UtilityService::is422Response($message);
        }
    }
    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = PageContentService::status(['is_active' => $status], $id);
        if ($result) {
            $message = $this->mls->messageLanguage('updated', 'status', 1);
            UtilityService::is200Response($message);
        } else {
            $message =  $this->mls->messageLanguage('not_updated', 'status', 1);
            UtilityService::is422Response($message);
        }
    }
}
