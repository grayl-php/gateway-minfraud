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
         $request_data->setLast4Digits( MinFraudHelper::getInstance()
                                                      ->getCreditCardEnding( $credit_card->getNumber() ) );
         $request_data->setIssuerIdNumber( MinFraudHelper::getInstance()
                                                         ->getCreditCardIssuer( $credit_card->getNumber() ) );
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
         $request_data->setTransactionType( 'purchase' );

         // Purchase parameters
         $request_data->setIsAuthorized( true );

         // Credit card parameters
         $request_data->setAVSResult( $gateway_response->getAVSCode() );
         $request_data->setCVVResult( $gateway_response->getCVVCode() );
      }

   }