<?php

   namespace Grayl\Gateway\MinFraud\Traits;

   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Trait MinFraudAccountParametersTrait.
    * The trait for manipulating MinFraud account parameters in a MinFraudInsightsRequestData entity.
    *
    * @property KeyedDataBag $account_parameters Omnipay account parameters bag ( key = value format )
    * @package Grayl\Gateway\MinFraud
    */
   trait MinFraudAccountParametersTrait
   {

      /**
       * Gets the user ID
       *
       * @return int
       */
      public function getUserID (): int
      {

         // Return it
         return $this->account_parameters->getVariable( 'user_id' );
      }


      /**
       * Sets the user ID
       *
       * @param int $user_id The internal numerical ID of the user
       */
      public function setUserID ( int $user_id ): void
      {

         // Set the user ID
         $this->account_parameters->setVariable( 'user_id',
                                                 $user_id );
      }


      /**
       * Gets the username MD5
       *
       * @return string
       */
      public function getUsernameMD5 (): string
      {

         // Return it
         return $this->account_parameters->getVariable( 'username_md5' );
      }


      /**
       * Sets the username MD5
       *
       * @param string $username_md5 An MD5 hash of the username itself
       */
      public function setUsernameMD5 ( string $username_md5 ): void
      {

         // Set the username MD5
         $this->account_parameters->setVariable( 'username_md5',
                                                 $username_md5 );
      }

   }