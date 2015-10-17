<?php

namespace AppBundle\Controller;

use AppBundle\Services\SoundCloudClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/dummyupload/{title}/{description}/{lat}/{lon}", name="homepage")
     */
    public function dummyupload($title, $description, $lat, $lon)
    {
        /** @var SoundCloudClient  $client*/
        $client = $this->get('sound_cloud_client');
        $response = $client->uploadFile(
            '/home/matus/old_telephone_short+voice+EN+F.mp3',
            $description,
            $title,
            $lat,
            $lon
        );

        return new JsonResponse($response);

    }

    /**
     * @Route("/upload")
     * @Method("POST")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request)
    {
        /** @var SoundCloudClient  $client*/
        $client = $this->get('sound_cloud_client');

        $description = $request->query->get('description');
        $title = $request->query->get('title');
        $lat = $request->query->get('lat');
        $lon = $request->query->get('lon');

        /** @var UploadedFile $file */
        $file = $request->files->get('recording');

        $file->move('/data', $file->getClientOriginalName());

        $fileName = '/data/' . $file->getClientOriginalName();
        var_export($fileName);

        $response = $client->uploadFile(
            $fileName,
            $description,
            $title,
            $lat,
            $lon
        );

        return new JsonResponse($response);
    }

    /**
     * @Route("/tracks/{lat}/{long}")
     */
    public function tracks($lat, $long)
    {

        /** @var SoundCloudClient  $client*/
        $client = $this->get('sound_cloud_client');
        return new JsonResponse($client->getTracks());
    }

    /**
     * @Route("/delete-all")
     * @return JsonResponse
     */
    public function deleteAll()
    {
        /** @var SoundCloudClient  $client*/
        $client = $this->get('sound_cloud_client');
        return new JsonResponse($client->deleteAll());
    }

}
