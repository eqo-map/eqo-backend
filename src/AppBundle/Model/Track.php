<?php

namespace AppBundle\Model;

class Track
{
    private $uri;

    private $lat;

    private $long;

    private $title;

    private $description;

    function __construct($description, $lat, $long, $title, $uri)
    {
        $this->description = $description;
        $this->lat = $lat;
        $this->long = $long;
        $this->title = $title;
        $this->uri = $uri;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return mixed
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }
}
