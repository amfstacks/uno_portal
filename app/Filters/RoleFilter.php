<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login')->with('error', 'Please log in.');
        }

        $role = session()->get('role');
        if (!in_array($role, $arguments)) {
            return redirect()->to('/login')->with('error', 'Unauthorized access.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed
    }
}