<?php

   namespace Grayl\Gateway\MinFraud\Entity;

   use Grayl\Gateway\Common\Entity\ResponseDataAbstract;
   use MaxMind\MinFraud\Model\Insights;

   /**
    * Class MinFraudInsightsResponseData
    * The class for working with an insights response from the MinFraud gateway
    * @method void __construct( Insights $api_response, string $gateway_name, string $action )
    * @method void setAPIResponse( Insights $api_response )
    * @method Insights getAPIResponse()
    *
    * @package Grayl\Gateway\MinFraud
    */
   class MinFraudInsightsResponseData extends ResponseDataAbstract
   {

      /**
       * The raw API response entity from the gateway
       *
       * @var Insights
       */
      protected $api_response;

   }