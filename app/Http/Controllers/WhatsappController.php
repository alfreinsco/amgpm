<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendBirthdayWishes;
use Carbon\Carbon;

use App\Models\User;

// Import helper functions
require_once app_path('Helpers/app.php');

class WhatsappController extends Controller
{
    private $gatewayUrl;

    public function __construct(){
        $this->gatewayUrl = config('app.wa_gateway_url');
    }

    /**
     * Display WhatsApp management page.
     */
    public function index()
    {
        return view('pengaturan.whatsapp.index');
    }

    public function getContacts(Request $request)
    {
        $query = $request->get('q', '');

        $contacts = User::whereNotNull('whatsapp')
                       ->where('whatsapp', '!=', '')
                       ->when($query, function($q) use ($query) {
                           $q->where(function($subQuery) use ($query) {
                               $subQuery->where('nama', 'LIKE', '%' . $query . '%')
                                       ->orWhere('whatsapp', 'LIKE', '%' . $query . '%');
                           });
                       })
                       ->select('id', 'nama', 'whatsapp')
                       ->orderBy('nama')
                       ->limit(20)
                       ->get();

        // Format for Select2
        $results = $contacts->map(function($contact) {
            return [
                'id' => $contact->whatsapp,
                'text' => $contact->nama . ' (' . $contact->whatsapp . ')'
            ];
        });

        return response()->json([
            'results' => $results,
            'pagination' => [
                'more' => false
            ]
        ]);
    }

    /**
     * Get gateway status.
     */
    public function getStatus(): JsonResponse
    {
        try {
            $response = Http::timeout(5)->get($this->gatewayUrl . '/status');

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json([
                'success' => false,
                'message' => 'Gateway tidak merespons'
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat terhubung ke gateway: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get session status.
     */
    public function getSession(Request $request): JsonResponse
    {
        $sessionName = $request->get('session', 'amgpm');

        try {
            $response = Http::timeout(10)->get($this->gatewayUrl . '/session');

            if ($response->successful()) {
                $result = $response->json();

                // Check if 'amgpm' exists in the response data array
                if (isset($result['data']) && is_array($result['data']) && in_array($sessionName, $result['data'])) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Session found',
                        'data' => ['connected' => true]
                    ]);
                }

                return response()->json([
                    'success' => false,
                    'message' => 'Session not found',
                    'data' => ['connected' => false]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan status sesi'
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add new session.
     */
    public function addSession(Request $request): JsonResponse
    {
        $sessionName = $request->get('session', 'amgpm');

        try {
            $response = Http::timeout(30)->post($this->gatewayUrl . '/session/add', [
                'sessionId' => $sessionName,
                'readIncomingMessages' => true
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan sesi'
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete session.
     */
    public function deleteSession(Request $request): JsonResponse
    {
        $sessionName = 'amgpm';

        try {
            $response = Http::get($this->gatewayUrl . '/session/logout?session=' . $sessionName);

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus sesi'
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send text message.
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $validator = validator($request->all(), [
            'to' => 'required|string',
            'message' => 'required|string',
            'is_group' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $sessionName = 'amgpm';
        $to = \formatPhoneNumber($request->to);
        $message = $request->message;
        $isGroup = $request->boolean('is_group', false);



        try {
            $response = Http::timeout(30)->post($this->gatewayUrl . '/message/send-text', [
                'session' => $sessionName,
                'to' => $to,
                'text' => $message,
                'is_group' => $isGroup
            ]);

            if ($response->successful()) {
                $responseData = $response->json();



                return response()->json([
                    'success' => true,
                    'message' => 'Message sent successfully',
                    'data' => $responseData
                ]);
            } else {


                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send message'
                ], 500);
            }
        } catch (\Exception $e) {


            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send image message.
     */
    public function sendImage(Request $request): JsonResponse
    {
        $validator = validator($request->all(), [
            'to' => 'required|string',
            'imageUrl' => 'required|url',
            'text' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $sessionName = 'amgpm';
        $to = formatPhoneNumber($request->to);
        $imageUrl = $request->imageUrl;
        $text = $request->text ?? '';
        $isGroup = $request->boolean('isGroup', false);



        try {
            $response = Http::post($this->gatewayUrl . '/message/send-image', [
                'session' => $sessionName,
                'to' => $to,
                'text' => $text,
                'image_url' => $imageUrl,
                'is_group' => $isGroup
            ]);

            if ($response->successful()) {
                $responseData = $response->json();



                return response()->json([
                    'success' => true,
                    'message' => 'Message sent successfully',
                    'data' => $responseData
                ]);
            } else {


                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send message'
                ], 500);
            }
        } catch (\Exception $e) {


            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send document message.
     */
    public function sendDocument(Request $request): JsonResponse
    {
        $validator = validator($request->all(), [
            'to' => 'required|string',
            'text' => 'nullable|string',
            'document_url' => 'required|url',
            'document_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $sessionName = 'amgpm';
        $to = formatPhoneNumber($request->to);
        $document_url = $request->document_url;
        $document_name = $request->document_name;
        $text = $request->text ?? '';
        $is_group = $request->boolean('is_group', false) ?? false;



        try {
            // dd($to, $text, $document_url, $document_name, $is_group);
            $response = Http::post($this->gatewayUrl . '/message/send-document', [
                'session' => $sessionName,
                'to' => $to,
                'text' => $text,
                'document_url' => $document_url,
                'document_name' => $document_name,
                'is_group' => $is_group
            ]);

            if ($response->successful()) {
                $responseData = $response->json();



                return response()->json([
                    'success' => true,
                    'message' => 'Message sent successfully',
                    'data' => $responseData
                ]);
            } else {


                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send message',
                    'error_message' => 'HTTP Error: ' . $response->status()
                ], 500);
            }
        } catch (\Exception $e) {


            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send birthday wishes manually for members with birthday tomorrow
     */
    public function sendBirthdayWishes(Request $request): JsonResponse
    {
        try {
             // Get tomorrow's date
            $tomorrow = Carbon::tomorrow();
            
            // Find members with birthday tomorrow
            $birthdayMembers = User::whereNotNull('tanggal_lahir')
                ->whereNotNull('whatsapp')
                ->whereRaw('MONTH(tanggal_lahir) = ? AND DAY(tanggal_lahir) = ?', [
                    $tomorrow->month,
                    $tomorrow->day
                ])
                ->get();
            
            if ($birthdayMembers->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada anggota yang berulang tahun besok',
                    'data' => ['count' => 0]
                ]);
            }
            
            // Dispatch jobs for each birthday member
            $dispatchedCount = 0;
            foreach ($birthdayMembers as $member) {
                SendBirthdayWishes::dispatch($member);
                $dispatchedCount++;
            }
            
            // Log the manual trigger
            Log::info('Manual birthday wishes triggered', [
                'triggered_by' => Auth::id(),
                'members_count' => $dispatchedCount,
                'tomorrow_date' => $tomorrow->format('Y-m-d')
            ]);
            
            return response()->json([
                'success' => true,
                'message' => "Berhasil mengirim ucapan ulang tahun untuk {$dispatchedCount} anggota",
                'data' => [
                    'count' => $dispatchedCount,
                    'members' => $birthdayMembers->map(function($member) {
                        return [
                            'nama' => $member->nama,
                            'whatsapp' => $member->whatsapp,
                            'tanggal_lahir' => $member->tanggal_lahir->format('d-m-Y')
                        ];
                    })
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error in manual birthday wishes trigger', [
                'error' => $e->getMessage(),
                'triggered_by' => Auth::id()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

}
