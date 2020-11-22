<?php

   namespace Grayl\Gateway\MinFraud\Helper;

   use Grayl\Mixin\Common\Traits\StaticTrait;

   /**
    * A package of functions for working with MinFraud
    * These are kept isolated to maintain separation between the main library and specific user functionality
    *
    * @package Grayl\Gateway\MinFraud
    */
   class MinFraudHelper
   {

      // Use the static instance trait
      use StaticTrait;

      /**
       * Gets the last four digits of a credit card number
       *
       * @param string $credit_card The credit card number
       *
       * @return ?string
       */
      public function getCreditCardEnding ( string $credit_card ): ?string
      {

         // Return the last four digits of the number
         return substr( $credit_card,
                        - 4 );
      }


      /**
       * Gets the first six digits of a credit card number (issuer)
       *
       * @param string $credit_card The credit card number
       *
       * @return ?string
       */
      public function getCreditCardIssuer ( string $credit_card ): ?string
      {

         // Return the first six digits of the number
         return substr( $credit_card,
                        0,
                        6 );
      }


      /**
       * Gets the TLD of an email address
       *
       * @param string $email The email address
       *
       * @return ?string
       */
      public function getEmailAddressTLD ( string $email ): ?string
      {

         // Return everything after the "@" symbol
         return substr( strrchr( $email,
                                 "@" ),
                        1 );
      }

   }