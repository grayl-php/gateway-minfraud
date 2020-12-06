<?php

   namespace Grayl\Gateway\MinFraud\Traits;

   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Trait MinFraudCustomParametersTrait.
    * The trait for manipulating MinFraud custom parameters in a MinFraudInsightsRequestData entity.
    *
    * @property KeyedDataBag $custom_parameters Omnipay custom parameters bag ( key = value format )
    * @package Grayl\Gateway\MinFraud
    */
   trait MinFraudCustomParametersTrait
   {

      /**
       * Gets the value of a custom input parameter
       *
       * @param string $key The key name of the custom input parameter as defined in MaxMind custom inputs
       *
       * @return string
       */
      public function getCustomInput ( string $key ): string
      {

         // Return it
         return $this->custom_parameters->getVariable( 'description' );
      }


      /**
       * Sets a custom input parameter
       *
       * @param string $key   The key name of the custom input parameter as defined in MaxMind custom input parameters
       * @param string $value The value of the custom input parameter
       */
      public function setCustomInput ( string $key,
                                       string $value ): void
      {

         // Set the custom input parameter
         $this->custom_parameters->setVariable( $key,
                                                $value );
      }

   }