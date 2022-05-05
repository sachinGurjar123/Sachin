<?php

namespace App\Services;

use App\Models\PageContent;

class PageContentService
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PageContent
     */
    public static function create(array $data)
    {
        $data = PageContent::create($data);
        return $data;
    }

    /**
     * Get the specified resource in storage.
     *
     * @param int $id
     * @return  App\Models\PageContent
     */
    public static function getById($id)
    {
        $data = PageContent::find($id);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function update(array $data, $id)
    {
        $data = PageContent::where('id', $id)->update($data);
        return $data;
    }

    /**
     * update status.
     *
     * @param Array $data
     * @param int $id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = PageContent::where('id', $id)->update($data);
        return $data;
    }

    /**
     * Delete data by contact_us.
     *
     * @param PageContent
     * @return bool
     */
    public static function delete($page_content)
    {
        $data = $page_content->delete();
        return $data;
    }
    /**
     * Get the specified resource in storage.
     *
     * @param int $id
     * @return  App\Models\PageContent
     */
    public static function datatable()
    {
        $data = PageContent::query();
        return $data;
    }

    /**
     * Get the specified resource in storage.
     *
     * @param int $slug
     * @return  App\Models\PageContent
     */
    public static function getBySlug($slug)
    {
        $data = PageContent::where('slug', $slug)->first();
        return $data;
    }
}
