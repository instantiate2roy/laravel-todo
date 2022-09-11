<?php

namespace App\Policies;

use App\Models\ToDo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ToDo $toDo)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ToDo $toDo)
    {
        //
        return $user->id === $toDo->userid
            ? Response::allow()
            : Response::deny('You are not authorized to Edit this Task!');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ToDo $toDo)
    {
        //
        return $user->id === $toDo->userid
            ? Response::allow()
            : Response::deny('You are not authorized to Delete this Task!');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ToDo $toDo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ToDo $toDo)
    {
        //
    }
}
