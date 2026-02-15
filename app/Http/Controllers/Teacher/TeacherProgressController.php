<?php

namespace App\Http\Controllers\Teacher;

use App\Services\WhatsAppService;
use App\Models\StudentModel;
use App\Http\Controllers\Controller;
use App\Models\MeetingModel;
use App\Models\StudentProgressModel;
use Illuminate\Http\Request;

class TeacherProgressController extends Controller
{
    public function create(MeetingModel $meeting)
    {
        abort_if(
            $meeting->class->teacher->user_id !== auth()->id(),
            403
        );

        $meeting->load('class.students');

        return view('teacher.progress.create', compact('meeting'));
    }

    public function store(Request $request, MeetingModel $meeting, WhatsAppService $whatsAppService)
    {
        abort_if(
            $meeting->class->teacher->user_id !== auth()->id(),
            403
        );

        $validated = $request->validate([
            'progress' => 'required|array',
            'progress.*.student_id' => 'required|exists:students,id',
            'progress.*.progress_value' => 'required|integer|min:0|max:100',
            'progress.*.catatan' => 'nullable|string',
        ]);

        foreach ($validated['progress'] as $item) {
            $progress = StudentProgressModel::updateOrCreate(
                [
                    'meeting_id' => $meeting->id,
                    'student_id' => $item['student_id'],
                ],
                [
                    'progress_value' => $item['progress_value'],
                    'progress_note' => $item['catatan'] ?? null,
                ]
            );

            $student = StudentModel::with(['user', 'parent.user'])->find($item['student_id']);

            if (!$student) {
                continue;
            }
            $message =
                "Halo,\n\n" .
                "Update Progress Belajar\n" .
                "{$meeting->meeting_date}\n\n" .
                "Nama              : {$student->fullname}\n" .
                "Topik Pembelajaran: {$meeting->material}\n" .
                "Topik Pembelajaran: {$meeting->note}\n" .
                "Nilai             : {$progress->progress_value}%; ({$progress->getProgressLabelAttribute()})\n\n" .
                "Catatan           :\n" .
                ($progress->progress_note ?? '-') . "\n\n" .
                "Terima kasih.";

            if ($student->user?->phone) {
                $whatsAppService->send($student->user->phone, $message);
            }
        }


        return redirect()
            ->route('teacher.classes.show', $meeting->class_id)->with('success', 'Progress tersimpan dan notifikasi terkirim');
    }
}
