<?php

namespace App\Entities;

use App\Models\ProfilesModel;
use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $attributes = [
        'id' => null,
        'first_name' => null,
        'last_name' => null,
        'mail' => null,
        'phone' => null,
        'id_profile' => null
    ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function setProfileId(): void
    {
        if ( $this->attributes['mail'] && str_contains($this->attributes['mail'],'@company.com') ) {
            $this->attributes['id_profile'] = 1;
        } else {
            $this->attributes['id_profile'] = 2;
        }
    }

    public function getLinkProfile(): object|array|null
    {

        if ( is_null($this->attributes['id_profile']) ) return [];

        $profileModel = new ProfilesModel();
        return $profileModel->find($this->attributes['id_profile']);

    }

}
