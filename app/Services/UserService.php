<?php


namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Store new user.
     *
     * @return \App\User $user
     */
    public function store($data)
    {
        return $this->userRepository->store($data);
    }

    /**
     * Get report users list.
     *
     * @return array
     */
    public function reportList()
    {
        return $this->userRepository->reportList();
    }

    /**
     * Get specific user details.
     *
     * @return \App\User $user
     */
    public function getUser($field,$value)
    {
        return $this->userRepository->getUser($field,$value);
    }

    /**
     * Follow user.
     *
     * @return \App\User $user
     */
    public function follow($request)
    {
        return $this->userRepository->follow($request);
    }

}
