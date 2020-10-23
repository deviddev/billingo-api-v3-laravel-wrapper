<?php

namespace Deviddev\BillingoApiV3Wrapper;

use Deviddev\BillingoApiV3Wrapper\BillingoApiV3Service;
use Exception;
use Illuminate\Support\Facades\Storage;

class BillingoApiV3Wrapper extends BillingoApiV3Service
{
    /**
     * Download files path
     *
     * @var string
     */
    protected $downloadPath = 'invoices/';

    /**
     * Downloaded file extension
     *
     * @var string
     */
    protected $extension = '.pdf';

    /**
     * Call the default configuration and set up api key
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Delete the invoice
     *
     * @param integer $id
     *
     * @return self
     */
    public function cancelInvoice(int $id): self
    {
        $methodName = $this->setMethodName('cancel', true);

        $this->response = $this->api->$methodName($id);

        return $this;
    }

    /**
     * Check valid tax number
     *
     * @param string $tax_number
     *
     * @return self
     */
    public function checkTaxNumber(string $taxNumber): self
    {
        $methodName = $this->setMethodName('checkTaxNumber');

        $this->response = $this->api->$methodName($taxNumber);

        return $this;
    }

    /**
     * Call create$apiName method
     *
     * @throws Exception (methodExists)
     * @return self
     */
    public function create(): self
    {
        $methodName = $this->setMethodName('create', true);

        $this->response = $this->api->$methodName($this->model);

        return $this;
    }

    /**
     * Create invoice from proforma
     *
     * @param integer $id
     *
     * @return self
     */
    public function createInvoiceFromProforma(int $id): self
    {
        $methodName = $this->setMethodName('createDocumentFromProforma');

        $this->response = $this->api->$methodName($id);

        return $this;
    }

    /**
     * Download document
     *
     * @param integer $id
     *
     * @return string
     */
    public function downloadInvoice(int $id, string $path = null, string $extension = null): self
    {
        $methodName = $this->setMethodName('download', true);

        $filename = $id . ($extension ?? $this->extension);

        Storage::put(
            ($path ?? $this->downloadPath) . $filename,
            $this->api->$methodName($id)
        );

        $this->response['path'] = ($path ?? $this->downloadPath) . $filename;

        return $this;
    }

    /**
     * Get invoice public url
     *
     * @param integer $id
     *
     * @return self
     */
    public function getPublicUrl(int $id): self
    {
        $methodName = $this->setMethodName('getPublicUrl');

        $this->response = $this->api->$methodName($id);

        return $this;
    }

    /**
     * Call list$apiName method
     *
     * @param array $conditions
     *
     * @return self
     */
    public function list(array $conditions): self
    {
        $methodName = $this->setMethodName('list', true);

        $this->response = $this->api->$methodName(
            $conditions['page'] ?? null,
            $conditions['per_page'] ?? 25,
            $conditions['block_id'] ?? null,
            $conditions['partner_id'] ?? null,
            $conditions['payment_method'] ?? null,
            $conditions['payment_status'] ?? null,
            $conditions['start_date'] ?? null,
            $conditions['end_date'] ?? null,
            $conditions['start_number'] ?? null,
            $conditions['end_number'] ?? null,
            $conditions['start_year'] ?? null,
            $conditions['end_year'] ?? null
        );

        return $this;
    }

    /**
     * Call get$apiName method
     *
     * @param integer $id
     *
     * @return self
     */
    public function update(int $id): self
    {
        $methodName = $this->setMethodName('update', true);

        $this->response = $this->api->$methodName($this->model, $id);

        return $this;
    }

    /**
     * Send invoice in email
     *
     * @param integer $id
     *
     * @return self
     */
    public function sendInvoice(int $id): self
    {
        $methodName = $this->setMethodName('send', true);

        $this->response = $this->api->$methodName($id);

        return $this;
    }
}
