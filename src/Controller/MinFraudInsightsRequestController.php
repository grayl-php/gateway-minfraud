<?php

   namespace Grayl\Gateway\MinFraud\Controller;

   use Grayl\Gateway\Common\Controller\RequestControllerAbstract;
   use Grayl\Gateway\MinFraud\Entity\MinFraudInsightsRequestData;
   use Grayl\Gateway\MinFraud\Entity\MinFraudInsightsResponseData;

   /**
    * Class MinFraudInsightsRequestController
    * The controller for working with MinFraudInsightsRequestData entities
    * @method MinFraudInsightsRequestData getRequestData()
    * @method MinFraudInsightsResponseController sendRequest()
    *
    * @package Grayl\Gateway\MinFraud
    */
   class MinFraudInsightsRequestController extends RequestControllerAbstract
   {

      /**
       * Creates a new MinFraudInsightsResponseController to handle data returned from the gateway
       *
       * @param MinFraudInsightsResponseData $response_data The MinFraudInsightsResponseData entity received from the gateway
       *
       * @return MinFraudInsightsResponseController
       */
      public function newResponseController ( $response_data ): object
      {

         // Return a new MinFraudInsightsResponseController entity
         return new MinFraudInsightsResponseController( $response_data,
                                                        $this->response_service );
      }

   }