<?php

namespace Grayl\Gateway\MinFraud\Service;

use Grayl\Gateway\Common\Service\ResponseServiceInterface;
use Grayl\Gateway\MinFraud\Entity\MinFraudInsightsResponseData;
use MaxMind\MinFraud\Model\Insights;
use MaxMind\MinFraud\Model\Warning;

/**
 * Class MinFraudInsightsResponseService
 * The service for working with MinFraud API insights responses
 *
 * @package Grayl\Gateway\MinFraud
 */
class MinFraudInsightsResponseService implements
    ResponseServiceInterface
{

    /**
     * Returns a true / false value based on a gateway API response
     *
     * @param MinFraudInsightsResponseData $response_data The response object to check
     *
     * @return bool
     */
    public function isSuccessful($response_data): bool
    {

        // For a successful response
        if ($this->isDispositionSuccessful($response_data)) {
            // Success
            return true;
        }

        // Failed
        return false;
    }


    /**
     * Returns the reference MinFraud lookup ID from a gateway API response
     *
     * @param MinFraudInsightsResponseData $response_data The response object to get the ID from
     *
     * @return string
     */
    public function getReferenceID($response_data): ?string
    {

        // For a successful response
        if ( ! empty($response_data->getAPIResponse()->id)) {
            // Found an ID
            return $response_data->getAPIResponse()->id;
        }

        // No ID
        return null;
    }


    /**
     * Returns the warning message from a gateway API response
     *
     * @param MinFraudInsightsResponseData $response_data The response object to get the message from
     *
     * @return string
     */
    public function getMessage($response_data): ?string
    {

        // Get the warnings array
        $warnings = $this->getWarnings($response_data);

        // If there is an error
        if ( ! empty($warnings[0])) {
            // Return the Warning message
            return $warnings[0]->warning;
        }

        // No message
        return null;
    }


    /**
     * Returns the raw data from a gateway API response
     *
     * @param MinFraudInsightsResponseData $response_data The response object to get the data from
     *
     * @return Insights
     */
    public function getData($response_data): Insights
    {

        // Return the response object
        return $response_data->getAPIResponse();
    }


    /**
     * Gets the MinFraud score from a gateway API response
     *
     * @param MinFraudInsightsResponseData $response_data The response object to pull the score from
     *
     * @return float
     */
    public function getRiskScore(MinFraudInsightsResponseData $response_data
    ): ?float {

        // Return the risk score from the raw API response
        return $response_data->getAPIResponse()->riskScore;
    }


    /**
     * Gets the MinFraud disposition from a gateway API response
     * The response is determined by custom rules setup inside the MinFraud account
     * Returns one of the following enum values: accept, reject, manual_review
     *
     * @param MinFraudInsightsResponseData $response_data The response object to pull the disposition from
     *
     * @return string
     */
    public function getDisposition(MinFraudInsightsResponseData $response_data
    ): ?string {

        // Return the disposition from the raw API response
        return $response_data->getAPIResponse()->disposition->action;
    }


    /**
     * Checks the disposition of a gateway API response to make sure it passed
     *
     * @param MinFraudInsightsResponseData $response_data The response object to check for a successful disposition
     *
     * @return bool
     */
    private function isDispositionSuccessful(
        MinFraudInsightsResponseData $response_data
    ): bool {

        // Get the MinFraud disposition field
        $disposition = $this->getDisposition($response_data);

        // For a successful disposition
        if ( ! empty($response_data) && $disposition == 'accept') {
            // Disposition OK
            return true;
        }

        // Disposition failed
        return false;
    }


    /**
     * Gets the array of Warning objects from a gateway API response
     *
     * @param MinFraudInsightsResponseData $response_data The response object to get the warnings from
     *
     * @return Warning[]
     */
    private function getWarnings(MinFraudInsightsResponseData $response_data
    ): ?array {

        // Return the array of warnings from the response
        return $response_data->getAPIResponse()->warnings;
    }

}