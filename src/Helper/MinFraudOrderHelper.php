<?php

namespace Grayl\Gateway\MinFraud\Helper;

use Grayl\Gateway\MinFraud\Controller\MinFraudInsightsResponseController;
use Grayl\Gateway\MinFraud\Entity\MinFraudInsightsRequestData;
use Grayl\Mixin\Common\Traits\StaticTrait;
use Grayl\Store\Order\Controller\OrderController;
use Grayl\Store\Order\Entity\OrderCustomer;
use Grayl\Store\Order\Entity\OrderData;
use Grayl\Store\Order\Entity\OrderItemBag;
use Grayl\Store\Order\Entity\OrderPayment;
use Grayl\Store\Order\OrderPorter;

/**
 * A package of functions for working with MinFraud and orders
 * These are kept isolated to maintain separation between the main library and specific user functionality
 *
 * @package Grayl\Gateway\MinFraud
 */
class MinFraudOrderHelper
{

    // Use the static instance trait
    use StaticTrait;

    /**
     * Creates a new OrderPayment entity based on a MinFraud gateway's response
     *
     * @param OrderController                    $order    An OrderController to translate into
     * @param MinFraudInsightsResponseController $response The ResponseController entity to use
     * @param ?string                            $metadata Extra data associated to this PaymentLog
     *
     * @throws \Exception
     */
    public function newOrderPaymentFromMinFraudResponseController(
        OrderController $order,
        MinFraudInsightsResponseController $response,
        ?string $metadata
    ): void {

        // Use the OrderController to create and set the new payment log
        $order->setOrderPayment(
            OrderPorter::getInstance()
                ->newOrderPayment(
                    $order->getOrderID(),
                    $response->getReferenceID(),
                    $response->getGatewayName(),
                    0,
                    $response->getAction(),
                    $response->isSuccessful(),
                    $metadata
                )
        );

        // Save the order
        $order->saveOrder();
    }


    /**
     * Translates user and server data into a MinFraudInsightsRequestData
     *
     * @param MinFraudInsightsRequestData $request_data A MinFraudInsightsRequestData entity to translate into
     */
    public function translateHTTPData(MinFraudInsightsRequestData $request_data
    ): void {

        // Set the IP address
        $request_data->setDeviceParam(
            'ip_address',
            $_SERVER['REMOTE_ADDR']
        );

        // Set browser information
        $request_data->setDeviceParam(
            'user_agent',
            $_SERVER['HTTP_USER_AGENT']
        );
        $request_data->setDeviceParam(
            'accept_language',
            $_SERVER['HTTP_ACCEPT_LANGUAGE']
        );

        // Session ID if it exists
        $request_data->setDeviceParam(
            'session_id',
            session_id()
        );

        // Server time
        $request_data->setEventParam(
            'time',
            date(DATE_RFC3339)
        );
    }


    /**
     * Translates an OrderController into a MinFraudInsightsRequestData
     *
     * @param MinFraudInsightsRequestData $request_data A MinFraudInsightsRequestData entity to translate into
     * @param OrderController             $order        An OrderController entity to translate from
     */
    public function translateOrderController(
        MinFraudInsightsRequestData $request_data,
        OrderController $order
    ): void {

        // Translate all order sub entities
        $this->translateHTTPData($request_data);
        $this->translateOrderData(
            $request_data,
            $order->getOrderData()
        );
        $this->translateOrderItemBag(
            $request_data,
            $order->getOrderItemBag()
        );

        // If there is an OrderCustomer
        if ( ! empty ($order->getOrderCustomer())) {
            // Translate the OrderCustomer into the request
            $this->translateOrderCustomer(
                $request_data,
                $order->getOrderCustomer()
            );
        }

        // If there is an OrderPayment
        if ( ! empty ($order->getOrderPayment())) {
            // Translate the OrderPayment into the request
            $this->translateOrderPayment(
                $request_data,
                $order->getOrderPayment()
            );
        }
    }


    /**
     * Translates an OrderData entity into a MinFraudInsightsRequestData
     *
     * @param MinFraudInsightsRequestData $request_data A MinFraudInsightsRequestData entity to translate into
     * @param OrderData                   $data         An OrderData entity to translate from
     */
    private function translateOrderData(
        MinFraudInsightsRequestData $request_data,
        OrderData $data
    ): void {

        // Event parameters
        $request_data->setEventParam(
            'transaction_id',
            $data->getOrderID()
        );

        // Device parameters
        $request_data->setDeviceParam(
            'ip_address',
            $data->getIPAddress()
        );

        // Order parameters
        $request_data->setOrderParam(
            'amount',
            $data->getAmount()
        );
        $request_data->setOrderParam(
            'currency',
            $data->getCurrency()
        );

        // Custom parameters
        $request_data->setCustomParam(
            'description',
            $data->getDescription()
        );
    }


    /**
     * Translates an OrderCustomer into a MinFraudInsightsRequestData
     *
     * @param MinFraudInsightsRequestData $request_data A MinFraudInsightsRequestData entity to translate into
     * @param OrderCustomer               $customer     An OrderCustomer entity to translate from
     */
    private function translateOrderCustomer(
        MinFraudInsightsRequestData $request_data,
        OrderCustomer $customer
    ): void {

        // Billing parameters
        $request_data->setBillingParam(
            'first_name',
            $customer->getFirstName()
        );
        $request_data->setBillingParam(
            'last_name',
            $customer->getLastName()
        );
        $request_data->setBillingParam(
            'address',
            $customer->getAddress1()
        );
        $request_data->setBillingParam(
            'address_2',
            $customer->getAddress2()
        );
        $request_data->setBillingParam(
            'city',
            $customer->getCity()
        );
        // Note: State is not used in Maxmind, "region" is, and it cannot be input reliably
        $request_data->setBillingParam(
            'country',
            $customer->getCountry()
        );
        $request_data->setBillingParam(
            'postal',
            $customer->getPostcode()
        );
        $request_data->setBillingParam(
            'phone_number',
            $customer->getPhoneNumber()
        );

        // Shipping parameters
        $request_data->setShippingParam(
            'first_name',
            $customer->getFirstName()
        );
        $request_data->setShippingParam(
            'last_name',
            $customer->getLastName()
        );
        $request_data->setShippingParam(
            'address',
            $customer->getAddress1()
        );
        $request_data->setShippingParam(
            'address_2',
            $customer->getAddress2()
        );
        $request_data->setShippingParam(
            'city',
            $customer->getCity()
        );
        // Note: State is not used in Maxmind, "region" is, and it cannot be input reliably
        $request_data->setShippingParam(
            'country',
            $customer->getCountry()
        );
        $request_data->setShippingParam(
            'postal',
            $customer->getPostcode()
        );
        $request_data->setShippingParam(
            'phone_number',
            $customer->getPhoneNumber()
        );

        // Email parameters
        $request_data->setEmailParam(
            'address',
            $customer->getEmailAddress()
        );
        $request_data->setEmailParam(
            'domain',
            $this->getEmailAddressTLD($customer->getEmailAddress())
        );
    }


    /**
     * Translates an OrderItemBag into a MinFraudInsightsRequestData
     *
     * @param MinFraudInsightsRequestData $request_data A MinFraudInsightsRequestData entity to translate into
     * @param OrderItemBag                $bag          An OrderItemBag entity to translate from
     */
    private function translateOrderItemBag(
        MinFraudInsightsRequestData $request_data,
        OrderItemBag $bag
    ): void {

        // Loop through each item inside the bag
        foreach (
            $bag->getOrderItems() as $item
        ) {
            // Add the item into the request
            $request_data->putItem(
                'product',
                $item->getSKU(),
                $item->getQuantity(),
                $item->getPrice()
            );
        }
    }


    /**
     * Translates an OrderPayment into a MinFraudInsightsRequestData
     *
     * @param MinFraudInsightsRequestData $request_data A MinFraudInsightsRequestData entity to translate into
     * @param OrderPayment                $payment      An OrderPayment entity to translate from
     */
    private function translateOrderPayment(
        MinFraudInsightsRequestData $request_data,
        OrderPayment $payment
    ): void {

        // Payment parameters
        $request_data->setPaymentParam(
            'processor',
            $payment->getProcessor()
        );

        // Custom parameters
        $request_data->setCustomParam(
            'reference',
            $payment->getReferenceID()
        );
    }


    /**
     * Gets the TLD of an email address
     *
     * @param string $email The email address
     *
     * @return string
     */
    private function getEmailAddressTLD(string $email): ?string
    {

        // Return everything after the "@" symbol
        return substr(
            strrchr(
                $email,
                "@"
            ),
            1
        );
    }

}