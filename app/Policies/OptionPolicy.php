<?php

namespace App\Policies;

use App\Models\Option;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OptionPolicy
{
    use HandlesAuthorization;

    /**
     * @var string[] The list of error message.
     */
    private $messages = [
        'not_the_owner' => 'You are not the owner of this option',
        'not_the_event_owner' => 'You are not the owner of this event',
        'event_is_committed' => 'This event has been committed'
    ];

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
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Option $option)
    {
        if (empty($user)) {
            return false;
        }

        if ($user->id !== $option->event->user_id) {
            return $this->deny($this->messages['not_the_owner']);
        }

        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event The event that the option belongs to.
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, \App\Models\Event $event)
    {
        if (empty($user)) {
            return false;
        }

        if ($user->id !== $event->user_id) {
            return $this->deny($this->messages['not_the_event_owner']);
        }

        if ($event->is_committed) {
            return $this->deny($this->messages['event_is_committed']);
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Option $option)
    {
        if (empty($user)) {
            return false;
        }

        if ($user->id !== $option->event->user_id) {
            return $this->deny($this->messages['not_the_owner']);
        }

        if ($option->event->is_committed) {
            return $this->deny($this->messages['event_is_committed']);
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Option $option)
    {
        if (empty($user)) {
            return false;
        }

        if ($user->id !== $option->event->user_id) {
            return $this->deny($this->messages['not_the_owner']);
        }

        if ($option->event->is_committed) {
            return $this->deny($this->messages['event_is_committed']);
        }

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Option $option)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Option $option)
    {
        return false;
    }
}
