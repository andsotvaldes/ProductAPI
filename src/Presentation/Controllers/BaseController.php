<?php
namespace App\Presentation\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    public function returnJSONCall($status,$message,$data){
        $return = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return $this->json($return,$status);
    }
}
