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
       * Gets the description
       *
       * @return string
       */
      public function getDescription (): string
      {

         // Return it
         return $this->custom_parameters->getVariable( 'description' );
      }


      /**
       * Sets the description
       *
       * @param string $description The description
       */
      public function setDescription ( string $description ): void
      {

         // Set the description
         $this->custom_parameters->setVariable( 'description',
                                                $description );
      }


      /**
       * Gets the reference
       *
       * @return string
       */
      public function getReference (): string
      {

         // Return it
         return $this->custom_parameters->getVariable( 'reference' );
      }


      /**
       * Sets the reference
       *
       * @param string $reference The reference
       */
      public function setReference ( string $reference ): void
      {

         // Set the reference
         $this->custom_parameters->setVariable( 'reference',
                                                $reference );
      }

   }