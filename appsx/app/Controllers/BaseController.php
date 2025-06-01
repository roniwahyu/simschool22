<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url', 'form', 'html'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;
    protected $validation;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();

        // Set global data for all views
        $this->setGlobalViewData();
    }

    /**
     * Set global data for all views
     */
    protected function setGlobalViewData()
    {
        $data = [
            'title' => 'SmartSchool Dashboard',
            'current_url' => current_url(),
            'base_url' => base_url(),
            'session' => $this->session,
        ];

        // Make data available to all views
        view()->setData($data);
    }

    /**
     * Send JSON response
     */
    protected function sendResponse($data = [], $status = 200, $message = '')
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return $this->response->setJSON($response)->setStatusCode($status);
    }

    /**
     * Send success response
     */
    protected function sendSuccess($data = [], $message = 'Success')
    {
        return $this->sendResponse($data, 200, $message);
    }

    /**
     * Send error response
     */
    protected function sendError($message = 'Error', $status = 400, $data = [])
    {
        return $this->sendResponse($data, $status, $message);
    }

    /**
     * Set flash message
     */
    protected function setFlash($type, $message)
    {
        $this->session->setFlashdata($type, $message);
    }

    /**
     * Set success flash message
     */
    protected function setSuccess($message)
    {
        $this->setFlash('success', $message);
    }

    /**
     * Set error flash message
     */
    protected function setError($message)
    {
        $this->setFlash('error', $message);
    }

    /**
     * Check if request is AJAX
     */
    protected function isAjax()
    {
        return $this->request->isAJAX();
    }

    /**
     * Validate CSRF token for AJAX requests
     */
    protected function validateCSRF()
    {
        if (!$this->request->isValidCSRF()) {
            return $this->sendError('Invalid CSRF token', 403);
        }
        return true;
    }

    /**
     * Get validation errors as array
     */
    protected function getValidationErrors()
    {
        return $this->validation->getErrors();
    }

    /**
     * Render view with layout
     */
    protected function render($view, $data = [])
    {
        $data['content'] = view($view, $data);
        return view('layouts/main', $data);
    }
}
