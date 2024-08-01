<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class QueueController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        $queue = Queue::where('date', $today)->latest()->first();
        $currentDateTime = Carbon::now();

        return view('queue.index', compact('queue'), ['currentDateTime' => $currentDateTime]);
    }

    public function generate()
    {
        $today = Carbon::today()->toDateString();
        $lastQueue = Queue::where('date', $today)->latest()->first();
        $newNumber = $lastQueue ? $lastQueue->number + 1 : 1;

        $queue = Queue::create(['number' => $newNumber, 'date' => $today]);

        //return redirect()->route('queue.print', $queue->id);
        return response()->json(['queueId' => $queue->id]);
        //$currentDateTime = Carbon::now();

        //return view('queue.index', compact('queue'), ['currentDateTime' => $currentDateTime]);

    }

    public function print($id)
    {
        $queue = Queue::findOrFail($id);
        return view('queue.print', compact('queue'));
    }

    // public function printQueue(Request $request) {
    //     // Generate queue number logic here

    //     // Printing logic
    //     try {
    //         $connector = new WindowsPrintConnector("Label");
    //         $printer = new Printer($connector);
    //         $printer->text("Test\n"); // Example text
    //         $printer->cut();
    //         $printer->close();
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }

    //     return response()->json(['success' => 'Printed successfully']);
    // }
}