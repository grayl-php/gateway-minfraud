<?php

   namespace Grayl\Gateway\MinFraud\Service;

   use Grayl\Gateway\Common\Service\RequestServiceInterface;
   use Grayl\Gateway\MinFraud\Entity\MinFraudGatewayData;
   use Grayl\Gateway\MinFraud\Entity\MinFraudInsightsRequestData;
   use Grayl\Gateway\MinFraud\Entity\MinFraudInsightsResponseData;
   use MaxMind\MinFraud\Model\Insights;

   /**
    * Class MinFraudInsightsRequestService
    * The service for working with MinFraud API insights requests
    *
    * @package Grayl\Gateway\MinFraud
    */
   class MinFraudInsightsRequestService implements RequestServiceInterface
   {

      /**
       * Sends a MinFraudInsightsRequestData object to the MinFraud gateway and returns a response
       *
       * @param MinFraudGatewayData         $gateway_data A configured MinFraudGatewayData entity to send the request through
       * @param MinFraudInsightsRequestData $request_data The MinFraudInsightsRequestData entity to send
       *
       * @return MinFraudInsightsResponseData
       * @throws \Exception
       */
      public function sendRequestDataEntity ( $gateway_data,
                                              $request_data ): object
      {

         // Build the request
         $api_request = $gateway_data->getAPI();

         // Add each type of param
         // The SDK uses immutable classes, so it must be called like this in case there are empty values or sections that are not used at all in this request

         // Device parameters
         if ( ! empty( $this->removeEmptyParameters( $request_data->getDeviceParameters() ) ) ) {
            $api_request = $api_request->withDevice( $this->removeEmptyParameters( $request_data->getDeviceParameters() ) );
         }

         // Event parameters
         if ( ! empty( $this->removeEmptyParameters( $request_data->getEventParameters() ) ) ) {
            $api_request = $api_request->withEvent( $this->removeEmptyParameters( $request_data->getEventParameters() ) );
         }

         // Account parameters
         if ( ! empty( $this->removeEmptyParameters( $request_data->getAccountParameters() ) ) ) {
            $api_request = $api_request->withAccount( $this->removeEmptyParameters( $request_data->getAccountParameters() ) );
         }

         // Email parameters
         if ( ! empty( $this->removeEmptyParameters( $request_data->getEmailParameters() ) ) ) {
            $api_request = $api_request->withEmail( $this->removeEmptyParameters( $request_data->getEmailParameters() ) );
         }

         // Billing parameters
         if ( ! empty( $this->removeEmptyParameters( $request_data->getBillingParameters() ) ) ) {
            $api_request = $api_request->withBilling( $this->removeEmptyParameters( $request_data->getBillingParameters() ) );
         }

         // Shippinh parameters
         if ( ! empty( $this->removeEmptyParameters( $request_data->getShippingParameters() ) ) ) {
            $api_request = $api_request->withShipping( $this->removeEmptyParameters( $request_data->getShippingParameters() ) );
         }

         // Payment parameters
         if ( ! empty( $this->removeEmptyParameters( $request_data->getPaymentParameters() ) ) ) {
            $api_request = $api_request->withPayment( $this->removeEmptyParameters( $request_data->getPaymentParameters() ) );
         }

         // Credit card parameters
         if ( ! empty( $this->removeEmptyParameters( $request_data->getCreditCardParameters() ) ) ) {
            $api_request = $api_request->withCreditCard( $this->removeEmptyParameters( $request_data->getCreditCardParameters() ) );
         }

         // Order parameters
         if ( ! empty( $this->removeEmptyParameters( $request_data->getOrderParameters() ) ) ) {
            $api_request = $api_request->withOrder( $this->removeEmptyParameters( $request_data->getOrderParameters() ) );
         }

         // Custom parameters
         if ( ! empty( $this->removeEmptyParameters( $request_data->getCustomParameters() ) ) ) {
            $api_request = $api_request->withCustomInputs( $this->removeEmptyParameters( $request_data->getCustomParameters() ) );
         }

         // Loop through each item
         foreach ( $request_data->getItemParameters() as $item ) {
            // Add the item (MinFraud returns immutable objects, so we need to redeclare $api_request to save the latest instance)
            $api_request = $api_request->withShoppingCartItem( $item );
         }

         // Send the request
         $response = $api_request->insights();

         // Return a new response entity with the action specified
         return $this->newResponseDataEntity( $response,
                                              $gateway_data->getGatewayName(),
                                              'insights',
                                              [] );
      }


      /**
       * Creates a new MinFraudInsightsResponseData object to handle data returned from the gateway
       *
       * @param Insights $api_response The response entity received directly from a gateway
       * @param string   $gateway_name The name of the gateway
       * @param string   $action       The action performed in this response (insights, factors, etc.)
       * @param string[] $metadata     Extra data associated with this response
       *
       * @return MinFraudInsightsResponseData
       */
      public function newResponseDataEntity ( $api_response,
                                              string $gateway_name,
                                              string $action,
                                              array $metadata ): object
      {

         // Return a new MinFraudInsightsResponseData entity
         return new MinFraudInsightsResponseData( $api_response,
                                                  $gateway_name,
                                                  $action );
      }


      /**
       * Removes null or empty values from an array of MinFraud parameters to prevent API errors
       *
       * @param array $parameters The array of parameters to clean
       *
       * @return array
       */
      private function removeEmptyParameters ( array $parameters ): array
      {

         // Loop through each value
         foreach ( $parameters as $key => $value ) {
            // If the value is empty, unset it
            if ( $value == '' || is_null( $value ) ) {
               // Unset it
               unset( $parameters[ $key ] );
            }
         }

         // Return the cleaned array
         return $parameters;
      }

   }