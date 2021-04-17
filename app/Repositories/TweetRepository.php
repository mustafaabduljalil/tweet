<?php


namespace App\Repositories;

use App\Tweet;

class TweetRepository
{
    protected $tweet;

    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

    /**
     * Store new tweet.
     *
     * @return \App\Tweet $tweet
     */
    public function store($data)
    {
        return $this->tweet->create($data);
    }

    /**
     * Get tweets counts.
     *
     * @return int
     */
    public function getTweetCount(){
        return $this->tweet->count();
    }

}
