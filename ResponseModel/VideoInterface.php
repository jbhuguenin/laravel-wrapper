<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 28/06/2018
 * Time: 14:50
 */

namespace App\Classes\ApiWrapper\ResponseModel;

/**
 * Interface VideoInterface
 * @package App\Classes\ApiWrapper\ResponseModel
 */
interface VideoInterface
{

    public function createInterviews();

    public function listInterviews();

    public function listCampaigns();
}