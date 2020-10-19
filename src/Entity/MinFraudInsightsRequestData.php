<?php

   namespace Grayl\Gateway\MinFraud\Entity;

   use Grayl\Gateway\Common\Entity\RequestDataAbstract;
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

      /**
       * A set of device parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $device_params;

      /**
       * A set of event parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $event_params;

      /**
       * A set of account parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $account_params;

      /**
       * A set of email parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $email_params;

      /**
       * A set of billing parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $billing_params;

      /**
       * A set of shipping parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $shipping_params;

      /**
       * A set of payment parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $payment_params;

      /**
       * A set of credit card parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $credit_card_params;

      /**
       * A set of order parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $order_params;

      /**
       * A set of custom parameters for the API
       *
       * @var KeyedDataBag
       */
      private KeyedDataBag $custom_params;

      /**
       * A set of item parameters for the API
       *
       * @var FlatDataBag
       */
      private FlatDataBag $item_params;


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
         $this->device_params      = new KeyedDataBag();
         $this->event_params       = new KeyedDataBag();
         $this->account_params     = new KeyedDataBag();
         $this->email_params       = new KeyedDataBag();
         $this->billing_params     = new KeyedDataBag();
         $this->shipping_params    = new KeyedDataBag();
         $this->payment_params     = new KeyedDataBag();
         $this->credit_card_params = new KeyedDataBag();
         $this->order_params       = new KeyedDataBag();
         $this->custom_params      = new KeyedDataBag();
         $this->item_params        = new FlatDataBag();
      }


      /**
       * Gets the entire array of device params
       *
       * @return array
       */
      public function getDeviceParams (): array
      {

         // Return it
         return $this->device_params->getVariables();
      }


      /**
       * Sets a parameter for the device array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setDeviceParam ( string $key,
                                       ?string $value ): void
      {

         // Set the parameter
         $this->device_params->setVariable( $key,
                                            $value );
      }


      /**
       * Gets the entire array of event params
       *
       * @return array
       */
      public function getEventParams (): array
      {

         // Return it
         return $this->event_params->getVariables();
      }


      /**
       * Sets a parameter for the event array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setEventParam ( string $key,
                                      ?string $value ): void
      {

         // Set the parameter
         $this->event_params->setVariable( $key,
                                           $value );
      }


      /**
       * Gets the entire array of account params
       *
       * @return array
       */
      public function getAccountParams (): array
      {

         // Return it
         return $this->account_params->getVariables();
      }


      /**
       * Sets a parameter for the account array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setAccountParam ( string $key,
                                        ?string $value ): void
      {

         // Set the parameter
         $this->account_params->setVariable( $key,
                                             $value );
      }


      /**
       * Gets the entire array of email params
       *
       * @return array
       */
      public function getEmailParams (): array
      {

         // Return it
         return $this->email_params->getVariables();
      }


      /**
       * Sets a parameter for the email array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setEmailParam ( string $key,
                                      ?string $value ): void
      {

         // Set the parameter
         $this->email_params->setVariable( $key,
                                           $value );
      }


      /**
       * Gets the entire array of billing params
       *
       * @return array
       */
      public function getBillingParams (): array
      {

         // Return it
         return $this->billing_params->getVariables();
      }


      /**
       * Sets a parameter for the billing array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setBillingParam ( string $key,
                                        ?string $value ): void
      {

         // Set the parameter
         $this->billing_params->setVariable( $key,
                                             $value );
      }


      /**
       * Gets the entire array of shipping params
       *
       * @return array
       */
      public function getShippingParams (): array
      {

         // Return it
         return $this->shipping_params->getVariables();
      }


      /**
       * Sets a parameter for the shipping array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setShippingParam ( string $key,
                                         ?string $value ): void
      {

         // Set the parameter
         $this->shipping_params->setVariable( $key,
                                              $value );
      }


      /**
       * Gets the entire array of payment params
       *
       * @return array
       */
      public function getPaymentParams (): array
      {

         // Return it
         return $this->payment_params->getVariables();
      }


      /**
       * Sets a parameter for the payment array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setPaymentParam ( string $key,
                                        ?string $value ): void
      {

         // Set the parameter
         $this->payment_params->setVariable( $key,
                                             $value );
      }


      /**
       * Gets the entire array of credit card params
       *
       * @return array
       */
      public function getCreditCardParams (): array
      {

         // Return it
         return $this->credit_card_params->getVariables();
      }


      /**
       * Sets a parameter for the credit card array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setCreditCardParam ( string $key,
                                           ?string $value ): void
      {

         // Set the parameter
         $this->credit_card_params->setVariable( $key,
                                                 $value );
      }


      /**
       * Gets the entire array of order params
       *
       * @return array
       */
      public function getOrderParams (): array
      {

         // Return it
         return $this->order_params->getVariables();
      }


      /**
       * Sets a parameter for the order array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setOrderParam ( string $key,
                                      ?string $value )
      {

         // Set the parameter
         $this->order_params->setVariable( $key,
                                           $value );
      }


      /**
       * Gets the entire array of custom params
       *
       * @return array
       */
      public function getCustomParams (): array
      {

         // Return it
         return $this->custom_params->getVariables();
      }


      /**
       * Sets a parameter for the custom array
       *
       * @param string  $key   The key for the parameter
       * @param ?string $value The value for the parameter
       */
      public function setCustomParam ( string $key,
                                       ?string $value ): void
      {

         // Set the parameter
         $this->custom_params->setVariable( $key,
                                            $value );
      }


      /**
       * Gets the entire array of item params
       *
       * @return array
       */
      public function getItemParams (): array
      {

         // Return it
         return $this->item_params->getPieces();
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
         $this->item_params->putPiece( [ 'category' => $category,
                                         'item_id'  => $sku,
                                         'quantity' => $quantity,
                                         'price'    => $price, ] );
      }

   }