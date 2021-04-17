<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\FollowRequest;
use App\Services\TweetService;
use App\Services\UserService;
use Illuminate\Http\Response;
use PDF;

class UserController extends Controller
{
    protected $userService,$tweetService;

    public function __construct(UserService $userService,TweetService $tweetService)
    {
        $this->userService = $userService;
        $this->tweetService = $tweetService;
    }

    /**
     * Store a newly following.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return object
     */
    public function follow(FollowRequest $request)
    {
        $this->userService->follow($request);
        return response()->json(['message' => __('messages.followed_successfully')], Response::HTTP_OK);
    }

    /**
     * Download users report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return object
     */
    public function downloadUsersReport()
    {
        $users = $this->userService->reportList();
        $averagePerUser = $this->tweetService->getAveragePerUser();
        view()->share(['users' => $users,'averagePerUser' => $averagePerUser]);
        $pdf = PDF::loadView('reports.users');
        return $pdf->download('report.pdf');
    }
}
