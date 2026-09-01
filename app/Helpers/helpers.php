<?php
use App\Models\UserWebform;
if (!function_exists('getCurrentUserWebForms')) {
    function getCurrentUserWebForms($id) {
        $uniqueUserWebforms = UserWebform::join('webforms', 'user_webforms.webform_id', '=', 'webforms.id')
            ->select('user_webforms.webform_id','webforms.*') 
            ->distinct()
            ->where('user_webforms.user_id', $id) 
            ->get();
        return  $uniqueUserWebforms;
    }
}