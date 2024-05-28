<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\YouTube;
use Illuminate\Http\Request;
use App\Models\video;
use Google;
use Google\Service\YouTube\VideoStatus;
use Google\Service\YouTube\VideoSnippet;

class YouTubeController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $this->client->addScope('https://www.googleapis.com/auth/youtube.upload');
    }

    public function redirectToGoogle()
    {
        // dd($this->client);
        $authUrl = $this->client->createAuthUrl();
        return redirect($authUrl);
    }

    public function handleGoogleCallback(Request $request)
    {
        $code = $request->get('code');
        $accessToken = $this->client->fetchAccessTokenWithAuthCode($code);
        session(['access_token' => $accessToken]);

        return redirect('/upload');
    }
    public function showUploadForm()
    {
        return view('upload');
    }

    public function uploadVideo(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|file|mimes:mp4,avi,mkv',
        ]);

        $videoPath = $request->file('video')->store('videos');
        // dd($videoPath);

        $this->client->setAccessToken(session('access_token'));

        $youtube = new YouTube($this->client);

        $videoPath = $request->file('video')->path();
        // dd($videoPath);
        $snippet = new VideoSnippet();
        $snippet->setTitle($request->input('title'));
        $snippet->setDescription($request->input('description'));
        $snippet->setTags(['tag1', 'tag2']);
        $snippet->setCategoryId('22');

        $status = new VideoStatus();
        $status->privacyStatus = 'unlisted';

        $video = new Google\Service\YouTube\Video();
        $video->setSnippet($snippet);
        $video->setStatus($status);

        $response = $youtube->videos->insert(
            'snippet,status',
            $video,
            [
                'data' => file_get_contents($videoPath),
                'mimeType' => 'video/*',
                'uploadType' => 'multipart'
            ]
        );
        $video = Video::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'video_path' => $videoPath,
            'video_id' => $response->id,
        ]);
        return redirect('/upload')->with('status', 'Video Uploaded Successfully');
    }
}