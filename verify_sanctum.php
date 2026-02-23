<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

// Ensure test user exists
$user = User::firstOrCreate(
    ['email' => 'sanctum_test@example.com'],
    ['name' => 'Sanctum Test', 'password' => Hash::make('password'), 'role' => 'user']
);

echo "Test User ID: " . $user->id . "\n";

// We need to make actual HTTP requests to the running server
$baseUrl = 'http://127.0.0.1:8001/api';

echo "1. Testing Login...\n";
$response = Http::post("$baseUrl/login", [
    'email' => 'sanctum_test@example.com',
    'password' => 'password',
]);

if ($response->failed()) {
    echo "Login Failed: " . $response->body() . "\n";
    exit(1);
}

$data = $response->json();
if (!isset($data['access_token'])) {
    echo "No access token received!\n";
    var_dump($data);
    exit(1);
}

$token = $data['access_token'];
echo "Login Successful. Token: " . substr($token, 0, 10) . "...\n";

echo "2. Testing /me (Protected Route)...\n";
$meResponse = Http::withToken($token)->get("$baseUrl/me");

if ($meResponse->failed()) {
    echo "Me Request Failed: " . $meResponse->body() . "\n";
    exit(1);
}

$meData = $meResponse->json();
if ($meData['email'] !== 'sanctum_test@example.com') {
    echo "User mismatch!\n";
    var_dump($meData);
    exit(1);
}
echo "Me Request Successful. User: " . $meData['email'] . "\n";

echo "3. Testing Logout...\n";
$logoutResponse = Http::withToken($token)->post("$baseUrl/logout");

if ($logoutResponse->failed()) {
    echo "Logout Failed: " . $logoutResponse->body() . "\n";
    exit(1);
}
echo "Logout Failed: Code " . $logoutResponse->status() . "\n"; // Wait, success means it didn't fail

if ($logoutResponse->successful()) {
    echo "Logout Successful.\n";
}

// Verify token is revoked
echo "4. Verifying Token Revocation...\n";
$revokedResponse = Http::withHeaders(['Accept' => 'application/json'])->withToken($token)->get("$baseUrl/me");
if ($revokedResponse->status() === 401) {
    echo "Token successfully revoked (401 Unauthorized).\n";
} else {
    echo "Warning: Token might still be valid? Status: " . $revokedResponse->status() . "\n";
    echo "Response Body: " . $revokedResponse->body() . "\n";
}

echo "Verification Complete.\n";
