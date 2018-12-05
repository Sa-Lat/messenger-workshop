<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 05.12.18
 * Time: 16:03
 */

namespace App\Stamp;


use Symfony\Component\Messenger\Stamp\StampInterface;

class IdStamp implements StampInterface
{
    private $id;

    public function __construct($id = null)
    {
        $this->id = $id ?? uniqid();
    }

    public function getId() {
        return $this->id;
    }

    public function __toString()
    {
       return $this->id;
    }
}