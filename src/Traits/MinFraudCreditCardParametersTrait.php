<?php

   namespace Grayl\Gateway\MinFraud\Traits;

   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Trait MinFraudCreditCardParametersTrait.
    * The trait for manipulating MinFraud credit card parameters in a MinFraudInsightsRequestData entity.
    *
    * @property KeyedDataBag $credit_card_parameters Omnipay credit card parameters bag ( key = value format )
    * @package Grayl\Gateway\MinFraud
    */
   trait MinFraudCreditCardParametersTrait
   {

      /**
       * Gets the last 4 digits
       *
       * @return int
       */
      public function getLast4Digits (): int
      {

         // Return it
         return $this->credit_card_parameters->getVariable( 'last_4_digits' );
      }


      /**
       * Sets the last 4 digits
       *
       * @param int $last_4_digits The last 4 digits
       */
      public function setLast4Digits ( int $last_4_digits ): void
      {

         // Set the last 4 digits
         $this->credit_card_parameters->setVariable( 'last_4_digits',
                                                     $last_4_digits );
      }


      /**
       * Gets the issuer ID number
       *
       * @return string
       */
      public function getIssuerIDNumber (): string
      {

         // Return it
         return $this->credit_card_parameters->getVariable( 'issuer_id_number' );
      }


      /**
       * Sets the issuer ID number
       *
       * @param string $issuer_id_number The issuer ID number
       */
      public function setIssuerIDNumber ( string $issuer_id_number ): void
      {

         // Set the issuer ID number
         $this->credit_card_parameters->setVariable( 'issuer_id_number',
                                                     $issuer_id_number );
      }


      /**
       * Gets the AVS result
       *
       * @return string
       */
      public function getAVSResult (): string
      {

         // Return it
         return $this->credit_card_parameters->getVariable( 'avs_result' );
      }


      /**
       * Sets the AVS result
       *
       * @param string $avs_result The AVS result
       */
      public function setAVSResult ( string $avs_result ): void
      {

         // Set the AVS result
         $this->credit_card_parameters->setVariable( 'avs_result',
                                                     $avs_result );
      }


      /**
       * Gets the CVV result
       *
       * @return string
       */
      public function getCVVResult (): string
      {

         // Return it
         return $this->credit_card_parameters->getVariable( 'cvv_result' );
      }


      /**
       * Sets the CVV result
       *
       * @param string $cvv_result The CVV result
       */
      public function setCVVResult ( string $cvv_result ): void
      {

         // Set the CVV result
         $this->credit_card_parameters->setVariable( 'cvv_result',
                                                     $cvv_result );
      }

   }