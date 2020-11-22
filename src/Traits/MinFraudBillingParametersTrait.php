<?php

   namespace Grayl\Gateway\MinFraud\Traits;

   use Grayl\Mixin\Common\Entity\KeyedDataBag;

   /**
    * Trait MinFraudBillingParametersTrait.
    * The trait for manipulating MinFraud billing parameters in a MinFraudInsightsRequestData entity.
    *
    * @property KeyedDataBag $billing_parameters Omnipay billing parameters bag ( key = value format )
    * @package Grayl\Gateway\MinFraud
    */
   trait MinFraudBillingParametersTrait
   {

      /**
       * Gets the billing first name
       *
       * @return string
       */
      public function getBillingFirstName (): string
      {

         // Return it
         return $this->billing_parameters->getVariable( 'first_name' );
      }


      /**
       * Sets the billing first name
       *
       * @param string $billing_first_name The billing first name
       */
      public function setBillingFirstName ( string $billing_first_name ): void
      {

         // Set the first name
         $this->billing_parameters->setVariable( 'first_name',
                                                 $billing_first_name );
      }


      /**
       * Gets the billing last name
       *
       * @return string
       */
      public function getBillingLastName (): string
      {

         // Return it
         return $this->billing_parameters->getVariable( 'last_name' );
      }


      /**
       * Sets the billing last name
       *
       * @param string $billing_last_name The billing last name
       */
      public function setBillingLastName ( string $billing_last_name ): void
      {

         // Set the last name
         $this->billing_parameters->setVariable( 'last_name',
                                                 $billing_last_name );
      }


      /**
       * Gets the billing address 1
       *
       * @return string
       */
      public function getBillingAddress1 (): string
      {

         // Return it
         return $this->billing_parameters->getVariable( 'address' );
      }


      /**
       * Sets the billing address 1
       *
       * @param string $billing_address_1 The billing address 1
       */
      public function setBillingAddress1 ( string $billing_address_1 ): void
      {

         // Set the address 1
         $this->billing_parameters->setVariable( 'address',
                                                 $billing_address_1 );
      }


      /**
       * Gets the billing address 2
       *
       * @return ?string
       */
      public function getBillingAddress2 (): ?string
      {

         // Return it
         return $this->billing_parameters->getVariable( 'address_2' );
      }


      /**
       * Sets the billing address 2
       *
       * @param ?string $billing_address_2 The billing address 2
       */
      public function setBillingAddress2 ( ?string $billing_address_2 ): void
      {

         // Set the address 2
         $this->billing_parameters->setVariable( 'address_2',
                                                 $billing_address_2 );
      }


      /**
       * Gets the billing city
       *
       * @return string
       */
      public function getBillingCity (): string
      {

         // Return it
         return $this->billing_parameters->getVariable( 'city' );
      }


      /**
       * Sets the billing city
       *
       * @param string $billing_city The billing city
       */
      public function setBillingCity ( string $billing_city ): void
      {

         // Set the city
         $this->billing_parameters->setVariable( 'city',
                                                 $billing_city );
      }


      /**
       * Gets the billing postcode
       *
       * @return string
       */
      public function getBillingPostcode (): string
      {

         // Return it
         return $this->billing_parameters->getVariable( 'postal' );
      }


      /**
       * Sets the billing postcode
       *
       * @param string $billing_postcode The billing postcode
       */
      public function setBillingPostcode ( string $billing_postcode ): void
      {

         // Set the postcode
         $this->billing_parameters->setVariable( 'postal',
                                                 $billing_postcode );
      }


      /**
       * Gets the billing country
       *
       * @return string
       */
      public function getBillingCountry (): string
      {

         // Return it
         return $this->billing_parameters->getVariable( 'country' );
      }


      /**
       * Sets the billing country
       *
       * @param string $billing_country The billing country
       */
      public function setBillingCountry ( string $billing_country ): void
      {

         // Set the country
         $this->billing_parameters->setVariable( 'country',
                                                 $billing_country );
      }


      /**
       * Gets the billing phone number
       *
       * @return string
       */
      public function getBillingPhoneNumber (): ?string
      {

         // Return it
         return $this->billing_parameters->getVariable( 'phone_number' );
      }


      /**
       * Sets the billing phone number
       *
       * @param ?string $billing_phone_number The billing phone number
       */
      public function setBillingPhoneNumber ( ?string $billing_phone_number ): void
      {

         // Set the phone number
         $this->billing_parameters->setVariable( 'phone_number',
                                                 $billing_phone_number );
      }

   }