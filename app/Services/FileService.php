<?php

namespace App\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * check the file in strorage Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function getFileUrl($file_url, $file_name = null, $type = null)
    {
        // dd($file_url, $file_name, $type);
        if ($file_name == null) {
            if ($type == 'user') {
                $url = self::return_user_default_image();
            } else {
                $url = url('/') . '/image-not-found.png';
            }
        } else {
            $url = self::file_exists_storage_path($file_url . $file_name, $type);
            // if (config()->get('services.s3.image_url')) {
            //     $url = self::file_exists_storage_path($file_url . $file_name);
            // } else {
            //     if ($type == 'user') {
            //         $url = self::return_user_default_image();
            //     } else {
            //         $url = url('/') . '/image-not-found.png';
            //     }
            // }
        }
        return $url;
    }

    /**
     * check the file in storage Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function file_exists_storage_path($url, $type = null)
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        if ($filesystem_disk == 's3') {
            if (url_exists(config()->get('services.s3.image_url') . $url)) {
                $path = config()->get('services.s3.image_url') . $url;
            } else {
                if ($type == 'user') {
                    $path = self::return_user_default_image();
                } else {
                    $path = url('/') . '/image-not-found.png';
                }
            }
        } else {
            if (Storage::disk('public')->exists($url)) {
                // $path = Storage::disk('local')->url($url);
                $path = config()->get('services.img.local_img_url') . $url;
            } else {
                if ($type == 'user') {
                    $path = self::return_user_default_image();
                } else {
                    $path = url('/') . '/image-not-found.png';
                }
            }
        }
        // dd($path);
        return $path;
    }

    /**
     * check the file in strorage Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function return_user_default_image()
    {
        if (request()->is('*api/*')) {
            $url = url('/') . '/default_user-api.png';
        } else {
            $url = url('/') . '/blank_user.png';
        }
        return $url;
    }

    /**
     * check the file in public Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function file_exists_public_path($url)
    {
        if (file_exists(public_path() . $url)) {
            return url('/') . $url;
        } else {
            return url('/') . '/image-not-found.png';
        }
    }

    /**
     * Remove the file from public Path.
     *
     * @param  string  $url
     * @return string
     */
    public static function remove_file_public_path($url)
    {
        if (file_exists(public_path() . $url)) {
            unlink(public_path($url));
            return true;
        } else {
            return false;
        }
    }

    /**
     * Upload file in storage.
     *
     * @param  Request $request
     * @param  String  $key
     * @param  String  $url public/upload/.$url
     * @param  String  $name
     * @return bool
     */
    public static function imageUploader(Request $request, $key, $url, $name = '')
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        $image_name = "";
        if ($request->hasFile($key)) {
            $image = $request->file($key);
            $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();

            if ($name) {
                $image_name = $name;
            } else {
                $image_name = $name . time() . '_' . uniqid() . '.' . $ext;
            }
            // dd($url, $image, $image_name, 'public');
            if (request()->is('*api/*')) {
                try {
                    Storage::disk($filesystem_disk)->putFileAs($url, $image, $image_name, 'public');
                    return $image_name;
                } catch (Exception $e) {
                    // Log::error('Image not uploaded. Request is'. $request->all(), 'Error: - '. $e);
                    return null;
                }
            } else {
                try {
                    Storage::disk($filesystem_disk)->putFileAs('public/' . $url, $image, $image_name, 'public');
                    return $image_name;
                } catch (Exception $e) {
                    // Log::error('Image not uploaded. Request is' . $request->all(), 'Error: - ' . $e);
                    return null;
                }
            }
        } else {
            return null;
        }
    }


    /**
     * Upload Multiple file in storage.
     *
     * @param  Request $request
     * @param  String  $key
     * @param  String  $url public/upload/.$url
     * @param  String  $name
     * @return array
     */
    public static function multipleImageUploader(Request $request, $key, $url, $name = '')
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        $image_name = [];
        // dd($request->all(), $request->hasFile($key), $request->file($key));
        if ($request->hasFile($key)) {
            foreach ($request->file($key) as $image) {
                // $image = $request->file($key);
                $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();

                if ($name) {
                    $image_name_str = $name;
                } else {
                    $image_name_str = $name . time() . '_' . uniqid() . '.' . $ext;
                }
                $path = Storage::disk($filesystem_disk)->putFileAs('public/' . $url, $image, $image_name_str, 'public');
                array_push($image_name, $image_name_str);
            }
            return $image_name;
        } else {
            return [];
        }
    }

    public static function removeImage(Model $model, String $column_name, $url)
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        if ($model->getOriginal($column_name) != "" && $model->getOriginal($column_name) != null) {
            if (Storage::disk($filesystem_disk)->exists('public/' . $url . '/' . $model->getRawOriginal($column_name))) {

                $file = 'public/' . $url . '/' . $model->getRawOriginal($column_name);
                $result = Storage::disk($filesystem_disk)->delete($file);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function fileUploaderWithoutRequest(UploadedFile $image, $url, $name = '')
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();

        if ($name) {
            $image_name = $name;
        } else {
            $image_name = $name . time() . '_' . uniqid() . '.' . $ext;
        }
        try {
            $path = Storage::disk($filesystem_disk)->putFileAs('public/' . $url, $image, $image_name, 'public');
            return $image_name;
        } catch (Exception $e) {
            // Log::error('Image not uploaded. Request is' . request()->all(), 'Error: - ' . $e);
            return null;
        }
    }
}
