<?php

   namespace Grayl\Test\Gateway\MinFraud;

   use Grayl\Gateway\MinFraud\Controller\MinFraudInsightsRequestController;
   use Grayl\Gateway\MinFraud\Controller\MinFraudInsightsResponseController;
   use Grayl\Gateway\MinFraud\Entity\MinFraudGatewayData;
   use Grayl\Gateway\MinFraud\Helper\MinFraudHelper;
   use Grayl\Gateway\MinFraud\MinFraudPorter;
   use Grayl\Gateway\PDO\PDOPorter;
   use MaxMind\MinFraud\Model\Insights;
   use PHPUnit\Framework\TestCase;

   /**
    * Test class for the MinFraud package
    * Note: Dispositions must be configured in the MinFraud account for this test to work
    *
    * @package Grayl\Gateway\MinFraud
    */
   class MinFraudInsightsRequestControllerTest extends TestCase
   {

      /**
       * Test setup for sandbox environment
       */
      public static function setUpBeforeClass (): void
      {

         // Change the MinFraud API environment to sandbox mode
         MinFraudPorter::getInstance()
                       ->setEnvironment( 'sandbox' );

         // Change the PDO API environment to sandbox mode
         PDOPorter::getInstance()
                  ->setEnvironment( 'sandbox' );
      }


      /**
       * Tests the creation of a MinFraudGatewayData object
       *
       * @return MinFraudGatewayData
       * @throws \Exception
       */
      public function testCreateMinFraudGatewayData (): MinFraudGatewayData
      {

         // Create the object
         $gateway = MinFraudPorter::getInstance()
                                  ->getSavedGatewayDataEntity( 'default' );

         // Check the type of object returned
         $this->assertInstanceOf( MinFraudGatewayData::class,
                                  $gateway );

         // Return the object
         return $gateway;
      }


      /**
       * Tests the creation of a MinFraudInsightsRequestController object
       *
       * @return MinFraudInsightsRequestController
       * @throws \Exception
       */
      public function testCreateMinFraudInsightsRequestController (): MinFraudInsightsRequestController
      {

         // Create the controller
         $request_controller = MinFraudPorter::getInstance()
                                             ->newMinFraudInsightsRequestController();

         // Check the type of object returned
         $this->assertInstanceOf( MinFraudInsightsRequestController::class,
                                  $request_controller );

         // Grab the request data object
         $request_data = $request_controller->getRequestData();

         // Device
         $request_data->setIPAddress( $_SERVER[ 'REMOTE_ADDR' ] );
         $request_data->setUserAgent( 'Mozilla' );
         $request_data->setAcceptLanguage( 'en' );
         $request_data->setSessionID( session_id() );

         // Event
         $request_data->setTransactionType( 'purchase' );
         $request_data->setTransactionDate( date( DATE_RFC3339 ) );
         $request_data->setTransactionID( 'test-' . time() );

         // Account
         $request_data->setUserID( 1123 );
         $request_data->setUsernameMD5( MinFraudHelper::getInstance()
                                                      ->getUsernameMD5( 'jim@gmailer.com' ) );

         // Email
         $request_data->setEmailAddress( 'jim@gmailer.com' );
         $request_data->setEmailDomain( MinFraudHelper::getInstance()
                                                      ->getEmailAddressTLD( 'jim@gmailer.com' ) );

         // Billing
         $request_data->setBillingFirstName( 'Jim' );
         $request_data->setBillingLastName( 'Doe' );
         $request_data->setBillingAddress1( '1450 SE Burnside Ave.' );
         $request_data->setBillingAddress2( null );
         $request_data->setBillingCity( 'Portland' );
         $request_data->setBillingPostcode( '97235' );
         $request_data->setBillingCountry( 'US' );
         $request_data->setBillingPhoneNumber( null );

         // Shipping
         $request_data->setShippingFirstName( 'Jim' );
         $request_data->setShippingLastName( 'Doe' );
         $request_data->setShippingAddress1( '1450 SE Burnside Ave.' );
         $request_data->setShippingAddress2( null );
         $request_data->setShippingCity( 'Portland' );
         $request_data->setShippingPostcode( '97235' );
         $request_data->setShippingCountry( 'US' );
         $request_data->setShippingPhoneNumber( null );

         // Payment
         $request_data->setIsAuthorized( true );
         $request_data->setProcessor( 'paypal' );

         // Credit card
         $request_data->setLast4Digits( MinFraudHelper::getInstance()
                                                      ->getCreditCardEnding( '4111111111111111' ) );
         $request_data->setIssuerIDNumber( MinFraudHelper::getInstance()
                                                         ->getCreditCardIssuer( '4111111111111111' ) );
         $request_data->setAVSResult( 'X' );
         $request_data->setCVVResult( 'M' );

         // Order
         $request_data->setAmount( 99.00 );
         $request_data->setCurrency( 'USD' );

         // Item
         $request_data->putItem( 'movie',
                                 'diehard',
                                 1,
                                 9.99 );
         $request_data->putItem( 'movie',
                                 'matrix',
                                 1,
                                 19.99 );

         // Custom
         $request_data->setCustomInput( 'processor_payment_id',
                                        'ID from the processor here' );

         // Return the object
         return $request_controller;
      }


      /**
       * Tests the sending of a MinFraudInsightsRequestData through a MinFraudInsightsRequestController
       *
       * @param MinFraudInsightsRequestController $request A configured MinFraudInsightsRequestController to use
       *
       * @return MinFraudInsightsResponseController
       * @depends testCreateMinFraudInsightsRequestController
       * @throws \Exception
       */
      public function testSendMinFraudInsightsRequestController ( MinFraudInsightsRequestController $request ): MinFraudInsightsResponseController
      {

         // Send the request using the gateway
         $response = $request->sendRequest();

         // Check the type of object returned
         $this->assertInstanceOf( MinFraudInsightsResponseController::class,
                                  $response );

         // Return the response
         return $response;
      }


      /**
       * Checks a MinFraudInsightsResponseController for data and errors
       *
       * @param MinFraudInsightsResponseController $response A MinFraudInsightsResponseController returned from the gateway
       *
       * @depends      testSendMinFraudInsightsRequestController
       */
      public function testMinFraudInsightsResponseController ( MinFraudInsightsResponseController $response ): void
      {

         // Test the data
         $this->assertIsBool( $response->isSuccessful() );
         $this->assertNotNull( $response->getReferenceID() );
         $this->assertNotNull( $response->getDisposition() );
         $this->assertNotEmpty( $response->getRiskScore() );
         $this->assertIsFloat( $response->getRiskScore() );
         $this->assertGreaterThan( 0,
                                   $response->getRiskScore() );

         // Check the raw data
         $this->assertInstanceOf( Insights::class,
                                  $response->getData() );
      }

   }