<?php

   namespace Grayl\Gateway\MinFraud\Entity;

   use Grayl\Gateway\Common\Entity\GatewayDataAbstract;
   use MaxMind\MinFraud;

   /**
    * Class MinFraudGatewayData
    * The entity for the MinFraud API
    * @method void __construct( MinFraud $api, string $gateway_name, string $environment )
    * @method void setAPI( MinFraud $api )
    * @method MinFraud getAPI()
    *
    * @package Grayl\Gateway\MinFraud
    */
   class MinFraudGatewayData extends GatewayDataAbstract
   {

      /**
       * Fully configured MinFraud entity
       *
       * @var MinFraud
       */
      protected $api;

   }