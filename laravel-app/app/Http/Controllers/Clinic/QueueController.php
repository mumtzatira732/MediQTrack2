<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Queue;

class QueueController extends Controller
{
    public function index()
    {
        $queues = Queue::with('patient')
            ->where('clinic_id', auth()->guard('clinic')->id())
            ->latest()
            ->get();

        return view('clinic.dashboard', compact('queues'));
    }

    public function nextPhase($id)
    {
        $queue = Queue::findOrFail($id);

        if ($queue->phase === 'consultation') {
            $queue->phase = 'pharmacy';
            $queue->save();
        }

        return back()->with('success', 'Queue moved to Pharmacy.');
    }

    public function markAsDone($id)
    {
        $queue = Queue::findOrFail($id);

        if ($queue->phase === 'pharmacy') {
            $queue->phase = 'done';
            $queue->save();
        }

        return back()->with('success', 'Queue marked as done.');
    }
}
