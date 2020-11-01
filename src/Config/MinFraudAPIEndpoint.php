<?php

   namespace Grayl\Gateway\MinFraud\Config;

   use Grayl\Gateway\Common\Config\GatewayAPIEndpointAbstract;

   /**
    * Class MinFraudAPIEndpoint
    * The class of a single MinFraud API endpoint
    *
    * @package Grayl\Gateway\MinFraud
    */
   class MinFraudAPIEndpoint extends GatewayAPIEndpointAbstract
   {

      /**
       * The MinFraud user ID
       *
       * @var string
       */
      protected string $user_id;

      /**
       * The MinFraud license key
       *
       * @var string
       */
      protected string $license_key;


      /**
       * Class constructor
       *
       * @param string $api_endpoint_id The ID of this API endpoint (default, provision, etc.)
       * @param string $user_id         The MinFraud user ID
       * @param string $license_key     The MinFraud license key
       */
      public function __construct ( string $api_endpoint_id,
                                    string $user_id,
                                    string $license_key )
      {

         // Call the parent constructor
         parent::__construct( $api_endpoint_id );

         // Set the class data
         $this->setUserID( $user_id );
         $this->setLicenseKey( $license_key );
      }


      /**
       * Gets the Minfraud User ID
       *
       * @return string
       */
      public function getUserID (): string
      {

         // Return it
         return $this->user_id;
      }


      /**
       * Sets the MinFraud user ID
       *
       * @param string $user_id The MinFraud user ID
       */
      public function setUserID ( string $user_id ): void
      {

         // Set the MinFraud user ID
         $this->user_id = $user_id;
      }


      /**
       * Gets the MinFraud license key
       *
       * @return string
       */
      public function getLicenseKey (): string
      {

         // Return it
         return $this->license_key;
      }


      /**
       * Sets the MinFraud license key
       *
       * @param string $license_key The MinFraud license key
       */
      public function setLicenseKey ( string $license_key ): void
      {

         // Set the MinFraud license key
         $this->license_key = $license_key;
      }

   }