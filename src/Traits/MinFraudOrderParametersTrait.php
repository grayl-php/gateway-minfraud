<?php

   namespace Grayl\Gateway\MinFraud\Traits;

   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Trait MinFraudOrderParametersTrait.
    * The trait for manipulating MinFraud order parameters in a MinFraudInsightsRequestData entity.
    *
    * @property KeyedDataBag $order_parameters Omnipay order parameters bag ( key = value format )
    * @package Grayl\Gateway\MinFraud
    */
   trait MinFraudOrderParametersTrait
   {

      /**
       * Gets the amount
       *
       * @return float
       */
      public function getAmount (): float
      {

         // Return it
         return $this->order_parameters->getVariable( 'amount' );
      }


      /**
       * Sets the amount
       *
       * @param float $amount The amount
       */
      public function setAmount ( float $amount ): void
      {

         // Set the amount
         $this->order_parameters->setVariable( 'amount',
                                               $amount );
      }


      /**
       * Gets the currency
       *
       * @return string
       */
      public function getCurrency (): string
      {

         // Return it
         return $this->order_parameters->getVariable( 'currency' );
      }


      /**
       * Sets the currency
       *
       * @param string $currency The currency
       */
      public function setCurrency ( string $currency ): void
      {

         // Set the currency
         $this->order_parameters->setVariable( 'currency',
                                               $currency );
      }

   }