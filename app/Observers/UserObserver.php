<?php

namespace App\Observers;

use App\Services\UploadImageService;
use App\User;

class UserObserver
{
    /**
     * Handle the user "saving" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function saving(User $user){
        $user->password = bcrypt($user->password);
        if(request()->has('image'))
            $user->image = UploadImageService::upload(request()->image,'users');
    }
}
