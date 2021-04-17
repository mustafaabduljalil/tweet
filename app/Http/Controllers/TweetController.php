<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tweet\CreateRequest;
use App\Http\Resources\Tweet\TweetResource;
use App\Services\TweetService;

class TweetController extends Controller
{
    protected $tweetService;

    public function __construct(TweetService $tweetService)
    {
        $this->tweetService = $tweetService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return object
     */
    public function store(CreateRequest $request)
    {
        return new TweetResource($this->tweetService->store($request->validated()));
    }
}
