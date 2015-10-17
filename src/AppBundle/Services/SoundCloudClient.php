<?php

namespace AppBundle\Services;

use Njasm\Soundcloud\SoundcloudFacade;

class SoundCloudClient
{
    private $client;

    private $username;

    private $password;

    private $userId;

    public function __construct(SoundcloudFacade $client, $username, $password, $userId)
    {
        $this->client = $client;
        $this->username = $username;
        $this->password = $password;
        $this->userId = $userId;
        $this->client->userCredentials($this->username, $this->password);
    }

    public function uploadFile($fileName, $description, $title, $lat, $lon)
    {
        $params = [
            'track[title]' => $title,
//            'track[description]' => $description,
//            'track[tag_list]' => 'geo:lat=' . $lat . ' geo:lon=' . $lon,
        ];

        $fileName = '/home/matus/old_telephone_short+voice+EN+F.mp3';
        $response = $this->client->upload($fileName, $params);

        return $response->bodyArray();
    }

    public function getTracks()
    {
        $response = $this->client->get('/users/' . $this->userId . '/tracks')->request();

        return $response->bodyArray();
    }

    public function deleteAll()
    {
        $responses = [];

        foreach ($this->getTracks() as $track) {
            $responses[] = $this->client->delete('/tracks/'. $track['id'])->request()->bodyArray();
        }

        return $responses;
    }
}
