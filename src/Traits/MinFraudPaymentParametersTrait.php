<?php

   namespace Grayl\Gateway\MinFraud\Traits;

   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Trait MinFraudPaymentParametersTrait.
    * The trait for manipulating MinFraud payment parameters in a MinFraudInsightsRequestData entity.
    *
    * @property KeyedDataBag $payment_parameters Omnipay payment parameters bag ( key = value format )
    * @package Grayl\Gateway\MinFraud
    */
   trait MinFraudPaymentParametersTrait
   {

      /**
       * Gets is authorized
       *
       * @return bool
       */
      public function isAuthorized (): bool
      {

         // Return it
         return $this->payment_parameters->getVariable( 'was_authorized' );
      }


      /**
       * Sets is authorized
       *
       * @param bool $is_authorized Is authorized?
       */
      public function setIsAuthorized ( bool $is_authorized ): void
      {

         // Set is authorized
         $this->payment_parameters->setVariable( 'was_authorized',
                                                 $is_authorized );
      }


      /**
       * Gets the processor
       *
       * @return string
       */
      public function getProcessor (): string
      {

         // Return it
         return $this->payment_parameters->getVariable( 'processor' );
      }


      /**
       * Sets the processor
       *
       * @param string $processor The processor
       */
      public function setProcessor ( string $processor ): void
      {

         // Set the processor
         $this->payment_parameters->setVariable( 'processor',
                                                 $processor );
      }

   }