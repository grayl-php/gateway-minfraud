<?php

   namespace Grayl\Gateway\MinFraud\Entity;

   use Grayl\Gateway\Common\Entity\RequestDataAbstract;
   use Grayl\Gateway\MinFraud\Traits\MinFraudAccountParametersTrait;
   use Grayl\Gateway\MinFraud\Traits\MinFraudBillingParametersTrait;
   use Grayl\Gateway\MinFraud\Traits\MinFraudCreditCardParametersTrait;
   use Grayl\Gateway\MinFraud\Traits\MinFraudCustomParametersTrait;
   use Grayl\Gateway\MinFraud\Traits\MinFraudDeviceParametersTrait;
   use Grayl\Gateway\MinFraud\Traits\MinFraudEmailParametersTrait;
   use Grayl\Gateway\MinFraud\Traits\MinFraudEventParametersTrait;
   use Grayl\Gateway\MinFraud\Traits\MinFraudOrderParametersTrait;
   use Grayl\Gateway\MinFraud\Traits\MinFraudPaymentParametersTrait;
   use Grayl\Gateway\MinFraud\Traits\MinFraudShippingParametersTrait;
   use Grayl\Mixin\Common\Entity\FlatDataBag;
   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Class MinFraudInsightsRequestData
    * The entity for an Insights request to MinFraud
    *
    * @package Grayl\Gateway\MinFraud
    */
   class MinFraudInsightsRequestData extends RequestDataAbstract
   {

      // Traits
      use MinFraudAccountParametersTrait;
      use MinFraudBillingParametersTrait;
      use MinFraudCreditCardParametersTrait;
      use MinFraudCustomParametersTrait;
      use MinFraudDeviceParametersTrait;
      use MinFraudEmailParametersTrait;
      use MinFraudEventParametersTrait;
      use MinFraudOrderParametersTrait;
      use MinFraudPaymentParametersTrait;
      use MinFraudShippingParametersTrait;

      /**
       * A set of device parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $device_parameters;

      /**
       * A set of event parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $event_parameters;

      /**
       * A set of account parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $account_parameters;

      /**
       * A set of email parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $email_parameters;

      /**
       * A set of billing parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $billing_parameters;

      /**
       * A set of shipping parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $shipping_parameters;

      /**
       * A set of payment parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $payment_parameters;

      /**
       * A set of credit card parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $credit_card_parameters;

      /**
       * A set of order parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $order_parameters;

      /**
       * A set of item parameters for the API
       *
       * @var FlatDataBag
       */
      private FlatDataBag $item_parameters;

      /**
       * A set of custom parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $custom_parameters;


      /**
       * Class constructor
       *
       * @param string $action The action performed in this request (send, etc.)
       */
      public function __construct ( string $action )
      {

         // Call the parent constructor
         parent::__construct( $action );

         // Create the bags
         $this->device_parameters      = new KeyedDataBag();
         $this->event_parameters       = new KeyedDataBag();
         $this->account_parameters     = new KeyedDataBag();
         $this->email_parameters       = new KeyedDataBag();
         $this->billing_parameters     = new KeyedDataBag();
         $this->shipping_parameters    = new KeyedDataBag();
         $this->payment_parameters     = new KeyedDataBag();
         $this->credit_card_parameters = new KeyedDataBag();
         $this->order_parameters       = new KeyedDataBag();
         $this->item_parameters        = new FlatDataBag();
         $this->custom_parameters      = new KeyedDataBag();
      }


      /**
       * Gets the entire array of device params
       *
       * @return array
       */
      public function getDeviceParameters (): array
      {

         // Return it
         return $this->device_parameters->getVariables();
      }


      /**
       * Sets a parameter for the device array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setDeviceParameter ( string $key,
                                           ?string $value ): void
      {

         // Set the parameter
         $this->device_parameters->setVariable( $key,
                                                $value );
      }


      /**
       * Gets the entire array of event params
       *
       * @return array
       */
      public function getEventParameters (): array
      {

         // Return it
         return $this->event_parameters->getVariables();
      }


      /**
       * Sets a parameter for the event array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setEventParameter ( string $key,
                                          ?string $value ): void
      {

         // Set the parameter
         $this->event_parameters->setVariable( $key,
                                               $value );
      }


      /**
       * Gets the entire array of account params
       *
       * @return array
       */
      public function getAccountParameters (): array
      {

         // Return it
         return $this->account_parameters->getVariables();
      }


      /**
       * Sets a parameter for the account array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setAccountParameter ( string $key,
                                            ?string $value ): void
      {

         // Set the parameter
         $this->account_parameters->setVariable( $key,
                                                 $value );
      }


      /**
       * Gets the entire array of email params
       *
       * @return array
       */
      public function getEmailParameters (): array
      {

         // Return it
         return $this->email_parameters->getVariables();
      }


      /**
       * Sets a parameter for the email array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setEmailParameter ( string $key,
                                          ?string $value ): void
      {

         // Set the parameter
         $this->email_parameters->setVariable( $key,
                                               $value );
      }


      /**
       * Gets the entire array of billing params
       *
       * @return array
       */
      public function getBillingParameters (): array
      {

         // Return it
         return $this->billing_parameters->getVariables();
      }


      /**
       * Sets a parameter for the billing array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setBillingParameter ( string $key,
                                            ?string $value ): void
      {

         // Set the parameter
         $this->billing_parameters->setVariable( $key,
                                                 $value );
      }


      /**
       * Gets the entire array of shipping params
       *
       * @return array
       */
      public function getShippingParameters (): array
      {

         // Return it
         return $this->shipping_parameters->getVariables();
      }


      /**
       * Sets a parameter for the shipping array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setShippingParameter ( string $key,
                                             ?string $value ): void
      {

         // Set the parameter
         $this->shipping_parameters->setVariable( $key,
                                                  $value );
      }


      /**
       * Gets the entire array of payment params
       *
       * @return array
       */
      public function getPaymentParameters (): array
      {

         // Return it
         return $this->payment_parameters->getVariables();
      }


      /**
       * Sets a parameter for the payment array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setPaymentParameter ( string $key,
                                            ?string $value ): void
      {

         // Set the parameter
         $this->payment_parameters->setVariable( $key,
                                                 $value );
      }


      /**
       * Gets the entire array of credit card params
       *
       * @return array
       */
      public function getCreditCardParameters (): array
      {

         // Return it
         return $this->credit_card_parameters->getVariables();
      }


      /**
       * Sets a parameter for the credit card array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setCreditCardParameter ( string $key,
                                               ?string $value ): void
      {

         // Set the parameter
         $this->credit_card_parameters->setVariable( $key,
                                                     $value );
      }


      /**
       * Gets the entire array of order params
       *
       * @return array
       */
      public function getOrderParameters (): array
      {

         // Return it
         return $this->order_parameters->getVariables();
      }


      /**
       * Sets a parameter for the order array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setOrderParameter ( string $key,
                                          ?string $value )
      {

         // Set the parameter
         $this->order_parameters->setVariable( $key,
                                               $value );
      }


      /**
       * Gets the entire array of item params
       *
       * @return array
       */
      public function getItemParameters (): array
      {

         // Return it
         return $this->item_parameters->getPieces();
      }


      /**
       * Adds a new item to the item param array
       *
       * @param string $category The category of the item
       * @param string $sku      The unique SKU of the item
       * @param int    $quantity The quantity of the item
       * @param float  $price    The price of the item
       */
      public function putItem ( string $category,
                                string $sku,
                                int $quantity,
                                float $price )
      {

         // Add the item
         $this->item_parameters->putPiece( [ 'category' => $category,
                                             'item_id'  => $sku,
                                             'quantity' => $quantity,
                                             'price'    => $price, ] );
      }


      /**
       * Gets the entire array of custom params
       *
       * @return array
       */
      public function getCustomParameters (): array
      {

         // Return it
         return $this->custom_parameters->getVariables();
      }


      /**
       * Sets a parameter for the custom array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setCustomParameter ( string $key,
                                           ?string $value ): void
      {

         // Set the parameter
         $this->custom_parameters->setVariable( $key,
                                                $value );
      }

   }