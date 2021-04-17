<?php


namespace App\Services;


use App\Repositories\TweetRepository;
use App\Repositories\UserRepository;

class TweetService
{
    protected $tweetRepository,$userRepository;

    public function __construct(TweetRepository $tweetRepository,UserRepository $userRepository)
    {
        $this->tweetRepository = $tweetRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Store new tweet.
     *
     * @return \App\Tweet $tweet
     */
    public function store($data){
        return $this->tweetRepository->store($data);
    }

    /**
     * Get tweets average per user.
     *
     * @return int
     */
    public function getAveragePerUser(){
        $tweetCounts = $this->tweetRepository->getTweetCount();
        $tweetUsersCounts = $this->userRepository->reportList()->count();
        return $tweetCounts / $tweetUsersCounts ;
    }

}
