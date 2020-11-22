<?php

   namespace Grayl\Gateway\MinFraud\Traits;

   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Trait MinFraudDeviceParametersTrait.
    * The trait for manipulating MinFraud device parameters in a MinFraudInsightsRequestData entity.
    *
    * @property KeyedDataBag $device_parameters Omnipay device parameters bag ( key = value format )
    * @package Grayl\Gateway\MinFraud
    */
   trait MinFraudDeviceParametersTrait
   {

      /**
       * Gets the IP address
       *
       * @return string
       */
      public function getIPAddress (): string
      {

         // Return it
         return $this->device_parameters->getVariable( 'ip_address' );
      }


      /**
       * Sets the IP address
       *
       * @param string $ip_address The IP address
       */
      public function setIPAddress ( string $ip_address ): void
      {

         // Set the IP address
         $this->device_parameters->setVariable( 'ip_address',
                                                $ip_address );
      }


      /**
       * Gets the user agent
       *
       * @return string
       */
      public function getUserAgent (): string
      {

         // Return it
         return $this->device_parameters->getVariable( 'user_agent' );
      }


      /**
       * Sets the user agent
       *
       * @param string $user_agent The user agent
       */
      public function setUserAgent ( string $user_agent ): void
      {

         // Set the user agent
         $this->device_parameters->setVariable( 'user_agent',
                                                $user_agent );
      }


      /**
       * Gets the accept language
       *
       * @return string
       */
      public function getAcceptLanguage (): string
      {

         // Return it
         return $this->device_parameters->getVariable( 'accept_language' );
      }


      /**
       * Sets the accept language
       *
       * @param string $accept_language The accept language
       */
      public function setAcceptLanguage ( string $accept_language ): void
      {

         // Set the accept language
         $this->device_parameters->setVariable( 'accept_language',
                                                $accept_language );
      }


      /**
       * Gets the session ID
       *
       * @return string
       */
      public function getSessionID (): string
      {

         // Return it
         return $this->device_parameters->getVariable( 'session_id' );
      }


      /**
       * Sets the session ID
       *
       * @param string $session_id The session ID
       */
      public function setSessionID ( string $session_id ): void
      {

         // Set the session ID
         $this->device_parameters->setVariable( 'session_id',
                                                $session_id );
      }

   }