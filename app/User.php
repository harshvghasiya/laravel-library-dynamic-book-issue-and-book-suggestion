<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * [right This function is useed to get right of single user]
     * @return [type] [description]
     */
    public function right(){

      return $this->belongsTo('\App\Models\Right', "right_id", "id");
    }

    /**
     * [getAdminUserImageUrl This function will return image url of user for profile]
     * @return [type] [description]
     */
    public function getAdminUserImageUrl(){

        $imageUrl_u=NO_IMAGE_URL().'/'.'profille-image-not-foune.png';
        $imagePath=ADMIN_USER_IMAGE_UPLOAD_PATH().$this->image;
        $imageUrl=ADMIN_USER_IMAGE_UPLOAD_URL().$this->image;
        if (isset($this->image) && !empty($this->image) && file_exists($imagePath) ) {
            return $imageUrl;
        }else{
            $imageUrl=$imageUrl_u;
        }
        return $imageUrl;
    }      
}
