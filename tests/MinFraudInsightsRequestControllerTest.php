<?php

   namespace Grayl\Test\Gateway\MinFraud;

   use Grayl\Gateway\MinFraud\Controller\MinFraudInsightsRequestController;
   use Grayl\Gateway\MinFraud\Controller\MinFraudInsightsResponseController;
   use Grayl\Gateway\MinFraud\Entity\MinFraudGatewayData;
   use Grayl\Gateway\MinFraud\Helper\MinFraudOmnipayHelper;
   use Grayl\Gateway\MinFraud\Helper\MinFraudOrderHelper;
   use Grayl\Gateway\MinFraud\MinFraudPorter;
   use Grayl\Gateway\PDO\PDOPorter;
   use Grayl\Omnipay\AuthorizeNet\AuthorizeNetPorter;
   use Grayl\Omnipay\Common\Entity\OmnipayGatewayCreditCard;
   use Grayl\Store\Order\Controller\OrderController;
   use Grayl\Store\Order\OrderPorter;
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
       * Creates a test order object with good data that will pass MinFraud
       *
       * @return OrderController
       * @throws \Exception
       */
      public function testCreateOrderController ()
      {

         // Create the order
         $order = OrderPorter::getInstance()
                             ->newOrderController();

         // Check the type of object returned
         $this->assertInstanceOf( OrderController::class,
                                  $order );

         // Basic order data
         $data = $order->getOrderData();
         $data->setAmount( 25.00 );
         $data->setDescription( 'MinFraud test order' );

         // Customer creation
         $order->setOrderCustomer( OrderPorter::getInstance()
                                              ->newOrderCustomer( $order->getOrderID(),
                                                                  'Jim',
                                                                  'Doe',
                                                                  'jim@gmailer.com',
                                                                  '1450 SE Burnside Ave.',
                                                                  '',
                                                                  'Portland',
                                                                  'OR',
                                                                  '97235',
                                                                  'US',
                                                                  null ) );

         // Payment
         $order->setOrderPayment( OrderPorter::getInstance()
                                             ->newOrderPayment( $order->getOrderID(),
                                                                'testgood',
                                                                'paypal',
                                                                $order->getOrderAmount(),
                                                                'authorize',
                                                                true,
                                                                null ) );

         // Items
         $order->putOrderItem( OrderPorter::getInstance()
                                          ->newOrderItem( $order->getOrderID(),
                                                          'item1',
                                                          'Test Item',
                                                          '2',
                                                          16.00 ) );
         $order->putOrderItem( OrderPorter::getInstance()
                                          ->newOrderItem( $order->getOrderID(),
                                                          'item2',
                                                          'Test Item 2',
                                                          '1',
                                                          10.00 ) );

         // Save the order
         $order->saveOrder();

         // Return the object
         return $order;
      }


      /**
       * Creates a test credit card object to be used in a test
       *
       * @returns OmnipayGatewayCreditCard
       */
      public function testCreateOmnipayGatewayCreditCard (): OmnipayGatewayCreditCard
      {

         // Create the OmnipayGatewayCreditCard
         $credit_card = AuthorizeNetPorter::getInstance()
                                          ->newOmnipayGatewayCreditCard( '4111111111111111',
                                                                         12,
                                                                         2022,
                                                                         '869' );

         // Check the type of object returned
         $this->assertInstanceOf( OmnipayGatewayCreditCard::class,
                                  $credit_card );

         // Return the object
         return $credit_card;
      }


      /**
       * Tests the creation of a MinFraudInsightsRequestController object
       *
       * @param OrderController          $order       A configured OrderController with order information
       * @param OmnipayGatewayCreditCard $credit_card A configured OmnipayGatewayCreditCard entity with payment information
       *
       * @depends testCreateOrderController
       * @depends testCreateOmnipayGatewayCreditCard
       * @return MinFraudInsightsRequestController
       * @throws \Exception
       */
      public function testCreateMinFraudInsightsRequestController ( OrderController $order,
                                                                    OmnipayGatewayCreditCard $credit_card ): MinFraudInsightsRequestController
      {

         // Set default data needed to pass in a sterile environment
         $_SERVER[ 'HTTP_USER_AGENT' ]      = 'Mozilla';
         $_SERVER[ 'HTTP_ACCEPT_LANGUAGE' ] = 'en';

         // Create the controller
         $request_controller = MinFraudPorter::getInstance()
                                             ->newMinFraudInsightsRequestController();

         // Check the type of object returned
         $this->assertInstanceOf( MinFraudInsightsRequestController::class,
                                  $request_controller );

         // Grab the request data object
         $request_data = $request_controller->getRequestData();

         // Translate the Order information into the MinFraud request
         MinFraudOrderHelper::getInstance()
                            ->translateOrderController( $request_data,
                                                        $order );

         // Override the IP
         $request_data->setIpAddress( '8.8.8.8' );

         // Translate the credit card information into the MinFraud request
         MinFraudOmnipayHelper::getInstance()
                              ->translateGatewayCreditCard( $request_data,
                                                            $credit_card );

         // Return the object
         return $request_controller;
      }


      /**
       * Tests the sending of a MinFraudInsightsRequestData through a MinFraudInsightsRequestController
       *
       * @param MinFraudInsightsRequestController $request A configured MinFraudInsightsRequestController to use
       *
       * @return MinFraudInsightsResponseController
       * @depends      testCreateMinFraudInsightsRequestController
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
         $this->assertNotEmpty( $response->getRiskScore() );
         $this->assertIsFloat( $response->getRiskScore() );
         $this->assertGreaterThan( 0,
                                   $response->getRiskScore() );

         // TODO: Enable this check after dispositions have been added into the account
         // $this->assertNotNull( $response->getDisposition() );

         // Check the raw data
         $this->assertInstanceOf( Insights::class,
                                  $response->getData() );
      }


      /**
       * Tests the helper that updates an order with the latest MinFraud status
       *
       * @param OrderController                    $order    A configured OrderController with order information
       * @param MinFraudInsightsResponseController $response A MinFraudInsightsResponseController returned from the gateway
       *
       * @depends      testCreateOrderController
       * @depends      testSendMinFraudInsightsRequestController
       * @throws \Exception
       */
      public function testMinFraudOrderPaymentHelper ( OrderController $order,
                                                       MinFraudInsightsResponseController $response ): void
      {

         // Call the helper to update the OrderController with a new OrderPayment
         MinFraudOrderHelper::getInstance()
                            ->newOrderPaymentFromMinFraudResponseController( $order,
                                                                             $response,
                                                                             $response->getRiskScore() . ':' . $response->getDisposition() );

         // Now grab the payment
         $payment = $order->getOrderPayment();

         // Test the data
         $this->assertEquals( $response->getReferenceID(),
                              $payment->getReferenceID() );
         $this->assertEquals( 'insights',
                              $payment->getAction() );
         $this->assertEquals( 'minfraud',
                              $payment->getProcessor() );
      }

   }


