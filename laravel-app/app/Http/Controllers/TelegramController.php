<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Patient;
use App\Models\Queue;

class TelegramController extends Controller
{
    public function webhook(Request $request)
    {
        $data = $request->all();
        Log::info('Incoming Telegram webhook:', $data);

        $message = $data['message']['text'] ?? null;
        $chatId = $data['message']['chat']['id'] ?? null;
        $name = $data['message']['chat']['first_name'] ?? 'there';

        if (!$chatId || !$message) {
            return response()->json(['ok' => true]);
        }

        $response = "❓ Unknown command. Please use /status or /cancel.";

        // Handle /start (with optional parameter)
        if (strpos($message, '/start') === 0) {
            $parts = explode(' ', $message);
            $patientId = $parts[1] ?? null;

            if ($patientId) {
                $patient = Patient::find($patientId);

                if ($patient) {
                    // Save telegram_chat_id if not already linked
                    if (!$patient->telegram_chat_id) {
                        $patient->telegram_chat_id = $chatId;
                        $patient->save();
                    }

                    $name = strtoupper($patient->name);
                    $response = "Hi $name! 🎉 Thank you for using MediQTrack. Your account is now linked to Telegram. We'll notify you when your queue updates.";
                } else {
                    $response = "⚠️ Invalid patient ID.";
                }
            } else {
                $response = "👋 Hi there! Please open this link from your MediQTrack account.";
            }
        }

        // Handle /status
        elseif ($message === '/status') {
    Log::info('/status triggered by chatId: ' . $chatId);

    $patient = Patient::where('telegram_chat_id', $chatId)->first();
    Log::info('Patient data for /status:', [$patient]);

    if (!$patient) {
        $response = "❌ Your Telegram is not linked to any patient account.";
    } else {
        $queue = Queue::where('patient_id', $patient->id)
            ->latest()
            ->first();
        Log::info('Queue data for /status:', [$queue]);

        if (!$queue) {
            $response = "ℹ️ You are not currently in any queue.";
        } else {
            $clinic = optional($queue->clinic)->clinic_name ?? 'Unknown Clinic';
            $myNumber = $queue->queue_number;
            $status = ucfirst($queue->status);
            $phase = ucfirst($queue->phase ?? 'Unknown');

            if (in_array($queue->status, ['pending', 'in_progress', 'waiting'])) {
                $aheadCount = Queue::where('clinic_id', $queue->clinic_id)
                    ->where('created_at', '<', $queue->created_at)
                    ->whereIn('status', ['pending', 'in_progress', 'waiting'])
                    ->count();

                $response = "📋 *Queue Status*\n"
                    . "🏥 Clinic: $clinic\n"
                    . "🔢 Your Number: $myNumber\n"
                    . "👥 People Ahead: $aheadCount\n"
                    . "⏳ Status: $status\n"
                    . "📍 Current Phase: $phase";
            } else {
                $response = "✅ Your last queue:\n"
                    . "🏥 Clinic: $clinic\n"
                    . "🔢 Queue Number: $myNumber\n"
                    . "✅ Status: $status\n"
                    . "📍 Phase (when completed): $phase";
            }
        }
    }
}

        // Handle /cancel
        elseif ($message === '/cancel') {
            $patient = Patient::where('telegram_chat_id', $chatId)->first();
            Log::info('Patient data for /cancel:', [$patient]);

            if (!$patient) {
                $response = "❌ You are not registered in our system.";
            } else {
                $queue = Queue::where('patient_id', $patient->id)
                    ->whereIn('status', ['pending', 'in_progress'])
                    ->latest()
                    ->first();

                Log::info('Queue to cancel:', [$queue]);

                if (!$queue) {
                    $response = "⚠️ You are not currently in any active queue.";
                } else {
                    $queue->status = 'cancelled';
                    $queue->phase = 'completed';
                    $queue->save();

                    $response = "✅ Your queue (Number: {$queue->queue_number}) has been cancelled.";
                }
            }
        }


        if (isset($response)) {
            $telegramSend = Http::post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage", [
                'chat_id' => $chatId,
                'text' => $response,
              
            ]);

            Log::info('Telegram sendMessage response:', $telegramSend->json());
        }


        return response()->json(['ok' => true]);
    }
}
