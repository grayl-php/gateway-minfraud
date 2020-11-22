<?php

   namespace Grayl\Gateway\MinFraud\Traits;

   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Trait MinFraudShippingParametersTrait.
    * The trait for manipulating MinFraud shipping parameters in a MinFraudInsightsRequestData entity.
    *
    * @property KeyedDataBag $shipping_parameters Omnipay shipping parameters bag ( key = value format )
    * @package Grayl\Gateway\MinFraud
    */
   trait MinFraudShippingParametersTrait
   {

      /**
       * Gets the shipping first name
       *
       * @return string
       */
      public function getShippingFirstName (): string
      {

         // Return it
         return $this->shipping_parameters->getVariable( 'first_name' );
      }


      /**
       * Sets the shipping first name
       *
       * @param string $shipping_first_name The shipping first name
       */
      public function setShippingFirstName ( string $shipping_first_name ): void
      {

         // Set the first name
         $this->shipping_parameters->setVariable( 'first_name',
                                                  $shipping_first_name );
      }


      /**
       * Gets the shipping last name
       *
       * @return string
       */
      public function getShippingLastName (): string
      {

         // Return it
         return $this->shipping_parameters->getVariable( 'last_name' );
      }


      /**
       * Sets the shipping last name
       *
       * @param string $shipping_last_name The shipping last name
       */
      public function setShippingLastName ( string $shipping_last_name ): void
      {

         // Set the last name
         $this->shipping_parameters->setVariable( 'last_name',
                                                  $shipping_last_name );
      }


      /**
       * Gets the shipping address 1
       *
       * @return string
       */
      public function getShippingAddress1 (): string
      {

         // Return it
         return $this->shipping_parameters->getVariable( 'address' );
      }


      /**
       * Sets the shipping address 1
       *
       * @param string $shipping_address_1 The shipping address 1
       */
      public function setShippingAddress1 ( string $shipping_address_1 ): void
      {

         // Set the address 1
         $this->shipping_parameters->setVariable( 'address',
                                                  $shipping_address_1 );
      }


      /**
       * Gets the shipping address 2
       *
       * @return ?string
       */
      public function getShippingAddress2 (): ?string
      {

         // Return it
         return $this->shipping_parameters->getVariable( 'address_2' );
      }


      /**
       * Sets the shipping address 2
       *
       * @param ?string $shipping_address_2 The shipping address 2
       */
      public function setShippingAddress2 ( ?string $shipping_address_2 ): void
      {

         // Set the address 2
         $this->shipping_parameters->setVariable( 'address_2',
                                                  $shipping_address_2 );
      }


      /**
       * Gets the shipping city
       *
       * @return string
       */
      public function getShippingCity (): string
      {

         // Return it
         return $this->shipping_parameters->getVariable( 'city' );
      }


      /**
       * Sets the shipping city
       *
       * @param string $shipping_city The shipping city
       */
      public function setShippingCity ( string $shipping_city ): void
      {

         // Set the city
         $this->shipping_parameters->setVariable( 'city',
                                                  $shipping_city );
      }


      /**
       * Gets the shipping postcode
       *
       * @return string
       */
      public function getShippingPostcode (): string
      {

         // Return it
         return $this->shipping_parameters->getVariable( 'postal' );
      }


      /**
       * Sets the shipping postcode
       *
       * @param string $shipping_postcode The shipping postcode
       */
      public function setShippingPostcode ( string $shipping_postcode ): void
      {

         // Set the postcode
         $this->shipping_parameters->setVariable( 'postal',
                                                  $shipping_postcode );
      }


      /**
       * Gets the shipping country
       *
       * @return string
       */
      public function getShippingCountry (): string
      {

         // Return it
         return $this->shipping_parameters->getVariable( 'country' );
      }


      /**
       * Sets the shipping country
       *
       * @param string $shipping_country The shipping country
       */
      public function setShippingCountry ( string $shipping_country ): void
      {

         // Set the country
         $this->shipping_parameters->setVariable( 'country',
                                                  $shipping_country );
      }


      /**
       * Gets the shipping phone number
       *
       * @return string
       */
      public function getShippingPhoneNumber (): ?string
      {

         // Return it
         return $this->shipping_parameters->getVariable( 'phone_number' );
      }


      /**
       * Sets the shipping phone number
       *
       * @param ?string $shipping_phone_number The shipping phone number
       */
      public function setShippingPhoneNumber ( ?string $shipping_phone_number ): void
      {

         // Set the phone number
         $this->shipping_parameters->setVariable( 'phone_number',
                                                  $shipping_phone_number );
      }

   }