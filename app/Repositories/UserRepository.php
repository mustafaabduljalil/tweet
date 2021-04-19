<?php


namespace App\Repositories;

use App\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Store new user.
     *
     * @return \App\User $user
     */
    public function store($data)
    {
        return $this->user->create($data);
    }

    /**
     * Get report users list.
     *
     * @return array
     */
    public function reportList()
    {
        return $this->user->whereHas('tweets')->withCount('tweets')->get();
    }

    /**
     * Get specific user.
     *
     * @return \App\User $user
     */
    public function getUser($field,$value)
    {
        return $this->user->where($field,$value)->first();
    }

    /**
     * Follow user.
     *
     * @return array
     */
    public function follow($request)
    {
        return $request->user()->following()->attach($request->following_id);
    }


}
