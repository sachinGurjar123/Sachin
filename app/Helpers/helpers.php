<?php

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

function getUserName($name, $email = '', $mobile_no = '')
{
    if (!isset($name)) {
        if ($name == null) {
            $name = 'Guest';
        }
    } else {
        if ($name == null) {
            $name = 'Guest';
        }
    }

    if (!isset($email)) {
        if ($email == null) {
            $email = 'NA';
        }
    } else {
        if ($email == null) {
            $email = 'NA';
        }
    }

    if (!isset($mobile_no)) {
        if ($mobile_no == null) {
            $mobile_no = 'NA';
        }
    } else {
        if ($mobile_no == null) {
            $mobile_no = 'NA';
        }
    }

    return `<div>` . $name . `<br>(Mobile No: ` . $mobile_no . `) <br> (Email: ` . $email . `)</div>`;
}

function url_exists($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($code == 200);
}

function checkUserIsAdmin(User $user){
    if($user->hasRole('Admin')){
        return true;
    }else{
        return false;
    }
}

function checkUserIsCustomer(User $user){
    if($user->hasRole('Customer')){
        return true;
    }else{
        return false;
    }
}

function incrementKeyByModelId(Model $model, String $column_name){
    return $model->increment($column_name);
}

function incrementKeyByModelIdWithVal(Model $model, String $column_name, $value){
    return $model->increment($column_name, $value);
}
