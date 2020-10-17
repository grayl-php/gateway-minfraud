<?php

namespace Grayl\Gateway\MinFraud\Controller;

use Grayl\Gateway\Common\Controller\ResponseControllerAbstract;
use Grayl\Gateway\Common\Entity\ResponseDataAbstract;
use Grayl\Gateway\Common\Service\ResponseServiceInterface;
use Grayl\Gateway\MinFraud\Entity\MinFraudInsightsResponseData;
use Grayl\Gateway\MinFraud\Service\MinFraudInsightsResponseService;

/**
 * Class MinFraudInsightsResponseController
 * The controller for working with MinFraudInsightsResponseData entities
 *
 * @package Grayl\Gateway\MinFraud
 */
class MinFraudInsightsResponseController extends
    ResponseControllerAbstract
{

    /**
     * The MinFraudInsightsResponseData object that holds the gateway API response
     *
     * @var MinFraudInsightsResponseData
     */
    protected ResponseDataAbstract $response_data;

    /**
     * The MinFraudInsightsResponseService entity to use
     *
     * @var MinFraudInsightsResponseService
     */
    protected ResponseServiceInterface $response_service;


    /**
     * Returns the risk score from the MinFraudInsightsResponseData entity
     *
     * @return float
     */
    public function getRiskScore(): ?float
    {

        // Use the service to get the risk score from the API response
        return $this->response_service->getRiskScore($this->response_data);
    }


    /**
     * Returns the disposition from the MinFraudInsightsResponseData entity
     *
     * @return string
     */
    public function getDisposition(): ?string
    {

        // Use the service to get the disposition from the API response
        return $this->response_service->getDisposition($this->response_data);
    }

}