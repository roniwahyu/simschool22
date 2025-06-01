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
     * @var list<string>
     */    
    
     protected $helpers = ['url', 'form', 'html'];

        /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');
        
    }

    protected function validateCSRF()
    {
        // Skip CSRF validation for GET requests
        if ($this->request->getMethod(true) === 'GET') {
            return true;
        }

        // Check header for CSRF token
        $token = $this->request->getHeaderLine('X-CSRF-TOKEN');
        
        if (empty($token)) {
            // If not in header, check POST data
            $token = $this->request->getPost('csrf_test_name');
        }
        
        if (empty($token) || $token !== csrf_hash()) {
            log_message('warning', 'CSRF validation failed: ' . current_url());
            return $this->sendError('Invalid security token', 403);
        }

        return true;
    }    /**
     * Helper method to render views with a layout
     *
     * @param string $view The view file to render
     * @param array $data Data to pass to the view
     * @param string|null $layout Layout file to use (null for no layout)
     * @return string
     */    protected function render(string $view, array $data = [], ?string $layout = null)
    {
        // Add any global data here
        $data = array_merge($data, [
            'session' => $this->session,
        ]);

        // Determine layout based on controller/method
        if ($layout === null) {
            // Use auth layout for authentication-related pages
            if ($this instanceof \App\Controllers\AuthController) {
                $layout = 'template/auth';
            } 
            // Use main layout for dashboard and other authenticated pages
            else if ($this->session && $this->session->get('isLoggedIn')) {
                $layout = 'template/main';
            }
            // Use default layout for public pages
            else {
                $layout = 'template/default';
            }
        }

        $viewContent = view($view, $data);
        
        if ($layout === false) {
            return $viewContent;
        }

        $data['content'] = $viewContent;
        return view($layout, $data);
    }
    /**
     * Check if request is AJAX
     */
    protected function isAjax()
    {
        return $this->request->isAJAX();
    }
    /**
     * Get validation errors as array
     */
    protected function getValidationErrors()
    {
        return $this->validation->getErrors();
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

}
