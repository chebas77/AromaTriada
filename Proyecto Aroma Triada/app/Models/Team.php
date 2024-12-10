<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Get the owner of the team.
     */
    public function owner()
    {
        return $this->belongsTo(Jetstream::userModel(), 'user_id');
    }

    /**
     * Get all of the team's users including their roles.
     */
    public function users()
    {
        return $this->belongsToMany(Jetstream::userModel(), Jetstream::membershipModel())
                    ->withPivot('role')
                    ->withTimestamps();
    }

    /**
     * Get the team's invitations.
     */
    public function teamInvitations()
    {
        return $this->hasMany(Jetstream::teamInvitationModel());
    }

    /**
     * Determine if the given user belongs to the team.
     */
    public function hasUser($user)
    {
        return $this->users->contains($user);
    }

    /**
     * Determine if the user has the given permission.
     */
    public function userHasPermission($user, $permission)
    {
        if ($user->ownsTeam($this)) {
            return true;
        }

        $permissions = $this->permissions[$user->membership->role] ?? [];

        return in_array($permission, $permissions);
    }
}
