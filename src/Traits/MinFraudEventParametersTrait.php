<?php

   namespace Grayl\Gateway\MinFraud\Traits;

   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Trait MinFraudEventParametersTrait.
    * The trait for manipulating MinFraud event parameters in a MinFraudInsightsRequestData entity.
    *
    * @property KeyedDataBag $event_parameters Omnipay event parameters bag ( key = value format )
    * @package Grayl\Gateway\MinFraud
    */
   trait MinFraudEventParametersTrait
   {

      /**
       * Gets the transaction type
       *
       * @return string
       */
      public function getTransactionType (): string
      {

         // Return it
         return $this->event_parameters->getVariable( 'type' );
      }


      /**
       * Sets the transaction type
       *
       * @param string $transaction_type The transaction type
       */
      public function setTransactionType ( string $transaction_type ): void
      {

         // Set the transaction type
         $this->event_parameters->setVariable( 'type',
                                               $transaction_type );
      }


      /**
       * Gets the transaction date
       *
       * @return string
       */
      public function getTransactionDate (): string
      {

         // Return it
         return $this->event_parameters->getVariable( 'time' );
      }


      /**
       * Sets the transaction date
       *
       * @param string $transaction_date Date and time of transaction in DATE_RFC3339 format
       */
      public function setTransactionDate ( string $transaction_date ): void
      {

         // Set the transaction date
         $this->event_parameters->setVariable( 'time',
                                               $transaction_date );
      }


      /**
       * Gets the transaction ID
       *
       * @return string
       */
      public function getTransactionID (): string
      {

         // Return it
         return $this->event_parameters->getVariable( 'transaction_id' );
      }


      /**
       * Sets the transaction ID
       *
       * @param string $transaction_id The transaction ID
       */
      public function setTransactionID ( string $transaction_id ): void
      {

         // Set the transaction ID
         $this->event_parameters->setVariable( 'transaction_id',
                                               $transaction_id );
      }

   }