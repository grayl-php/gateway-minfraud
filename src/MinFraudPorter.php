<?php

   namespace Grayl\Gateway\MinFraud;

   use Grayl\Gateway\Common\GatewayPorterAbstract;
   use Grayl\Gateway\MinFraud\Config\MinFraudAPIEndpoint;
   use Grayl\Gateway\MinFraud\Config\MinFraudConfig;
   use Grayl\Gateway\MinFraud\Controller\MinFraudInsightsRequestController;
   use Grayl\Gateway\MinFraud\Entity\MinFraudGatewayData;
   use Grayl\Gateway\MinFraud\Entity\MinFraudInsightsRequestData;
   use Grayl\Gateway\MinFraud\Service\MinFraudGatewayService;
   use Grayl\Gateway\MinFraud\Service\MinFraudInsightsRequestService;
   use Grayl\Gateway\MinFraud\Service\MinFraudInsightsResponseService;
   use Grayl\Mixin\Common\Traits\StaticTrait;
   use MaxMind\MinFraud;

   /**
    * Front-end for the MinFraud package
    * @method MinFraudGatewayData getSavedGatewayDataEntity ( string $api_endpoint_id )
    *
    * @package Grayl\Gateway\MinFraud
    */
   class MinFraudPorter extends GatewayPorterAbstract
   {

      // Use the static instance trait
      use StaticTrait;

      /**
       * The name of the config file for the MinFraud package
       *
       * @var string
       */
      protected string $config_file = 'gateway-minfraud.php';

      /**
       * The MinFraudConfig instance for this gateway
       *
       * @var MinFraudConfig
       */
      protected $config;


      /**
       * Creates a new MinFraud object for use in a MinFraudGatewayData entity
       *
       * @param MinFraudAPIEndpoint $api_endpoint A MinFraudAPIEndpoint with credentials needed to create a gateway API object
       *
       * @return MinFraud
       * @throws \Exception
       * @throws \Exception
       */
      public function newGatewayAPI ( $api_endpoint ): object
      {

         // Return the new API entity
         return new MinFraud( $api_endpoint->getUserID(),
                              $api_endpoint->getLicenseKey() );
      }


      /**
       * Creates a new MinFraudGatewayData
       *
       * @param string $api_endpoint_id The API endpoint ID to use (typically "default" if there is only one API gateway)
       *
       * @return MinFraudGatewayData
       * @throws \Exception
       */
      public function newGatewayDataEntity ( string $api_endpoint_id ): object
      {

         // Grab the gateway service
         $service = new MinFraudGatewayService();

         // Get a new API
         $api = $this->newGatewayAPI( $service->getAPIEndpoint( $this->config,
                                                                $this->environment,
                                                                $api_endpoint_id ) );

         // Configure the API as needed using the service
         $service->configureAPI( $api,
                                 $this->environment );

         // Return the gateway
         return new MinFraudGatewayData( $api,
                                         $this->config->getGatewayName(),
                                         $this->environment );
      }


      /**
       * Creates a new MinFraudInsightsRequestController entity
       *
       * @return MinFraudInsightsRequestController
       * @throws \Exception
       */
      public function newMinFraudInsightsRequestController (): MinFraudInsightsRequestController
      {

         // Create the MinFraudInsightsRequestData entity
         $request_data = new MinFraudInsightsRequestData( 'insights' );

         // Return a new MinFraudInsightsRequestController entity
         return new MinFraudInsightsRequestController( $this->getSavedGatewayDataEntity( 'default' ),
                                                       $request_data,
                                                       new MinFraudInsightsRequestService(),
                                                       new MinFraudInsightsResponseService() );
      }

   }