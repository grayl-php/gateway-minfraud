<?php

   namespace Grayl\Gateway\MinFraud\Traits;

   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Trait MinFraudEmailParametersTrait.
    * The trait for manipulating MinFraud email parameters in a MinFraudInsightsRequestData entity.
    *
    * @property KeyedDataBag $email_parameters Omnipay email parameters bag ( key = value format )
    * @package Grayl\Gateway\MinFraud
    */
   trait MinFraudEmailParametersTrait
   {

      /**
       * Gets the email address
       *
       * @return string
       */
      public function getEmailAddress (): string
      {

         // Return it
         return $this->email_parameters->getVariable( 'address' );
      }


      /**
       * Sets the email address
       *
       * @param string $email_address The email address
       */
      public function setEmailAddress ( string $email_address ): void
      {

         // Set the email address
         $this->email_parameters->setVariable( 'address',
                                               $email_address );
      }


      /**
       * Gets the email domain
       *
       * @return string
       */
      public function getEmailDomain (): string
      {

         // Return it
         return $this->email_parameters->getVariable( 'domain' );
      }


      /**
       * Sets the email domain
       *
       * @param string $email_domain The email domain
       */
      public function setEmailDomain ( string $email_domain ): void
      {

         // Set the email domain
         $this->email_parameters->setVariable( 'domain',
                                               $email_domain );
      }

   }