<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Queue;
use App\Models\Clinic;

class QueueController extends Controller
{
   public function join(Request $request)
{
    $request->validate([
        'clinic_id' => 'required|exists:clinics,clinic_id',
    ]);

    $patient = Auth::guard('patient')->user();

    // ✅ Check if patient already in queue (ACTIVE queue only)
    $existingQueue = Queue::where('patient_id', $patient->id)
        ->whereIn('status', ['pending', 'active'])
        ->whereIn('phase', ['waiting', 'consultation', 'pharmacy'])
        ->first();

    if ($existingQueue) {
        return redirect()->route('patient.home')->with('error', 'You are already in the queue.');
    }

    // ✅ Get clinic info
    $clinic = Clinic::findOrFail($request->clinic_id);

    // ✅ Generate queue number
    $queueNumber = 'Q' . rand(100, 999);

    // ✅ Save to database
    $queue = Queue::create([
        'queue_number' => $queueNumber,
        'status' => 'pending',
        'phase' => 'waiting',
        'patient_id' => $patient->id,
        'clinic_id' => $clinic->clinic_id,
        'counter_id' => null,
    ]);

    // ✅ Count how many people ahead in same clinic
    $peopleAhead = Queue::where('clinic_id', $clinic->clinic_id)
        ->where('status', 'waiting')
        ->where('created_at', '<', $queue->created_at)
        ->count();

    // ✅ Send Telegram message
    if ($patient->telegram_chat_id) {
        $peopleAhead = Queue::where('clinic_id', $queue->clinic_id)
            ->where('created_at', '<', $queue->created_at)
            ->whereIn('status', ['waiting', 'in_progress'])
            ->count();

        $clinicName = optional($queue->clinic)->clinic_name ?? 'Unknown Clinic';
        $queueNumber = $queue->queue_number;

        $message = "✅ You have successfully joined the queue!\n\n" .
            "📍 Queue Number: $queueNumber\n" .
            "🏥 Clinic: $clinicName\n" .
            "⏳ Status: Waiting to be assigned\n" .
            "👥 People ahead of you: $peopleAhead\n\n" .
            "Please wait until your number is called.";

        Http::post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage", [
            'chat_id' => $patient->telegram_chat_id,
            'text' => $message
        ]);
    }


    return redirect()->route('patient.home')->with('success', 'You have joined the queue.');
}




    // ✅ Tambah fungsi cancel
    public function cancelQueue($id)
    {
        $patient = auth()->guard('patient')->user();

        $queue = Queue::where('queue_id', $id)
            ->where('patient_id', $patient->id)
            ->whereIn('status', ['waiting', 'in_progress']) // boleh cancel kalau belum selesai
            ->first();

        if (!$queue) {
            return redirect()->route('patient.home')->with('error', 'Queue not found or cannot be cancelled.');
        }

        // ✅ Update kedua-dua status dan phase
        $queue->status = 'cancelled';
        $queue->phase = 'completed';
        $queue->save();

        return redirect()->route('patient.home')->with('success', 'You have successfully cancelled your queue.');
    }
}
