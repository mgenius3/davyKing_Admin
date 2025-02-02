<?php


namespace App\Http\Controllers\WEB; // Updated namespace

use App\Http\Controllers\Controller; // Import the base Controller class

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;


class UserManagementController extends Controller
{
    public function index(Request $request)
    {

        Log::info('Login Request Data:', [session('admin_token')]);

        // Fetch users from the API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('admin_token'), // Assuming you store the admin token in the session
        ])->get(url('/api/v1/users'));

        // Check if the request was successful
        if ($response->successful()) {
            $users = $response->json()['data']; // Adjust based on the API response structure

            // Paginate the users manually
            $page = $request->input('page', 1); // Get the current page from the request
            $perPage = 10; // Number of items per page
            $offset = ($page - 1) * $perPage;

            $paginatedUsers = array_slice($users, $offset, $perPage, true);
            $usersPaginated = new LengthAwarePaginator(
                $paginatedUsers,
                count($users),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );
            return view('users.index', ['users' => $usersPaginated]);
        } else {
            // Handle API error
            return back()->with('error', 'Failed to fetch users from the API.');
        }
    }
}