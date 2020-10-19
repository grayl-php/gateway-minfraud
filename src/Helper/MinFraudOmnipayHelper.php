<?php

   namespace Grayl\Gateway\MinFraud\Helper;

   use Grayl\Gateway\MinFraud\Entity\MinFraudInsightsRequestData;
   use Grayl\Mixin\Common\Traits\StaticTrait;
   use Grayl\Omnipay\Common\Controller\OmnipayResponseControllerAbstract;
   use Grayl\Omnipay\Common\Entity\OmnipayGatewayCreditCard;

   /**
    * A package of functions for working with MinFraud and Omnipay
    * These are kept isolated to maintain separation between the main library and specific user functionality
    *
    * @package Grayl\Gateway\MinFraud
    */
   class MinFraudOmnipayHelper
   {

      // Use the static instance trait
      use StaticTrait;

      /**
       * Translates a OmnipayGatewayCreditCard entity into a MinFraudInsightsRequestData
       *
       * @param MinFraudInsightsRequestData $request_data A MinFraudInsightsRequestData entity to translate into
       * @param OmnipayGatewayCreditCard    $credit_card  A OmnipayGatewayCreditCard entity to translate from
       */
      public function translateGatewayCreditCard ( MinFraudInsightsRequestData $request_data,
                                                   OmnipayGatewayCreditCard $credit_card ): void
      {

         // Credit card parameters
         $request_data->setCreditCardParam( 'last_4_digits',
                                            $this->getCreditCardEnding( $credit_card->getNumber() ) );
         $request_data->setCreditCardParam( 'issuer_id_number',
                                            $this->getCreditCardIssuer( $credit_card->getNumber() ) );
      }


      /**
       * Translates an OmnipayResponseControllerAbstract entity into a MinFraudInsightsRequestData
       *
       * @param MinFraudInsightsRequestData       $request_data     A MinFraudInsightsRequestData entity to translate into
       * @param OmnipayResponseControllerAbstract $gateway_response A OmnipayResponseControllerAbstract entity from a payment gateway to translate from
       */
      public function translateOmnipayResponseController ( MinFraudInsightsRequestData $request_data,
                                                           OmnipayResponseControllerAbstract $gateway_response ): void
      {

         // Event parameters
         $request_data->setEventParam( 'type',
                                       'purchase' );

         // Purchase parameters
         $request_data->setPaymentParam( 'was_authorized',
                                         true );

         // Credit card parameters
         $request_data->setCreditCardParam( 'avs_result',
                                            $gateway_response->getAVSCode() );
         $request_data->setCreditCardParam( 'cvv_result',
                                            $gateway_response->getCVVCode() );
      }


      /**
       * Gets the last four digits of a credit card number
       *
       * @param string $credit_card The credit card number
       *
       * @return string
       */
      private function getCreditCardEnding ( string $credit_card ): ?string
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
       * @return string
       */
      private function getCreditCardIssuer ( string $credit_card ): ?string
      {

         // Return the first six digits of the number
         return substr( $credit_card,
                        0,
                        6 );
      }

   }