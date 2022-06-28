<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * @var string[] The list of error message.
     */
    private $messages = [
        'not_the_owner' => 'You are not the owner of this event',
        'event_is_committed' => 'This event has been committed'
    ];

    /**
     * Determine whether the user can view any events.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return isset($user);
    }

    /**
     * Determine whether the user can view the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Event $event)
    {
        if (empty($user)) {
            return false;
        }

        // Allow the admin to view the event.
        if ($user->is_admin) {
            return true;
        }

        if ($user->id !== $event->user_id) {
            return $this->deny($this->messages['not_the_owner']);
        }

        return true;
    }

    /**
     * Determine whether the user can create events.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return isset($user);
    }

    /**
     * Determine whether the user can update the events.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Event $event)
    {
        if (empty($user)) {
            return false;
        }

        if ($user->id !== $event->user_id) {
            return $this->deny($this->messages['not_the_owner']);
        }

        if ($event->is_committed) {
            return $this->deny($this->messages['event_is_committed']);
        }

        return true;
    }

    /**
     * Determine whether the user can delete the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Event $event)
    {
        if (empty($user)) {
            return false;
        }

        if ($user->id !== $event->user_id) {
            return $this->deny($this->messages['not_the_owner']);
        }

        return true;
    }

    /**
     * Determine whether the user can restore the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Event $event)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the event.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Event $event)
    {
        return false;
    }
}
