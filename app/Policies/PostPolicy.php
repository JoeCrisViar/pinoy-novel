<?php

namespace App\Policies;

use App\Model\admin\admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view the post.
     *
     * @param  \App\Model\user\admin $user
     * @param  \App\post  $post
     * @return mixed
     */
    public function view(admin $user)
    {
        //
    }

    /**
     * Determine whether the admin can create posts.
     *
     * @param  \App\Model\user\admin  $user
     * @return mixed
     */
    public function create(admin $user)
    {
        return $this->getPermission($user, 1);
    }

    /**
     * Determine whether the admin can update the post.
     *
     * @param  \App\Model\user\admin  $user
     * @param  \App\post  $post
     * @return mixed
     */
    public function update(admin $user)
    {
        return $this->getPermission($user, 2);
    }

    /**
     * Determine whether the admin can delete the post.
     *
     * @param  \App\Model\user\admin  $user
     * @param  \App\post  $post
     * @return mixed
     */
    public function delete(admin $user)
    {
        
        return $this->getPermission($user, 3);
    }

    public function publish(admin $user)
    {
        
        return $this->getPermission($user, 4);
    }

    

    public function tag(admin $user)
    {
        
        return $this->getPermission($user, 8);
    }

    public function category(admin $user)
    {
        
        return $this->getPermission($user, 9);
    }


    protected function getPermission($user, $p_id)
    {
        foreach($user->roles as $role){
            foreach($role->permissions as $permission){
                
                if($permission->id == $p_id){
                    return true;
                }

            }
        }

        return false;

    }
}
