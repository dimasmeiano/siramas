<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\{
    Folder, Project, Task, Subtask, TaskChecklist, TaskAssignee,
    TaskComment, TaskFile, TaskActivity, Tag, User
};
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Asumsikan sudah ada user dengan ID 1 & 2
        $user2 = User::find(2);
        $user3 = User::find(3);
        
        // Buat Folder
        $folder = Folder::create([
            'name' => 'Divisi Sosial',
            'created_by' => $user2->id,
        ]);

        // Buat Project
        $project = Project::create([
            'folder_id' => $folder->id,
            'name' => 'Bakti Sosial Ramadhan',
            'description' => 'Kegiatan berbagi sembako selama Ramadhan',
            'status' => 'In Progress',
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'created_by' => $user2->id,
        ]);

        // Buat Task
        $task = Task::create([
            'project_id' => $project->id,
            'title' => 'Koordinasi dengan RT/RW',
            'description' => 'Menghubungi pihak RT setempat',
            'priority' => 'High',
            'status' => 'Not Started',
            'start_date' => now(),
            'due_date' => now()->addDays(5),
            'created_by' => $user2->id,
        ]);

        // Buat Assignee
        TaskAssignee::create([
            'task_id' => $task->id,
            'user_id' => $user3->id,
        ]);

        // Buat Checklist
        TaskChecklist::insert([
            ['task_id' => $task->id, 'item' => 'Hubungi via WhatsApp'],
            ['task_id' => $task->id, 'item' => 'Atur Jadwal Pertemuan'],
        ]);

        // Buat Subtask
        Subtask::insert([
            [
                'task_id' => $task->id,
                'title' => 'Cek nomor RT aktif',
                'assignee_id' => $user3->id
            ],
            [
                'task_id' => $task->id,
                'title' => 'Kirim surat permohonan resmi',
                'assignee_id' => null // tambahkan null jika tidak ada
            ],
        ]);

        // Buat Komentar
        TaskComment::create([
            'task_id' => $task->id,
            'user_id' => $user3->id,
            'content' => 'Saya siap koordinasi dengan Pak RT besok.',
        ]);

        // File Dummy
        TaskFile::create([
            'task_id' => $task->id,
            'file_path' => 'uploads/surat_permohonan.pdf',
            'file_name' => 'Surat Permohonan.pdf',
            'uploaded_by' => $user3->id,
        ]);

        // Activity
        TaskActivity::create([
            'task_id' => $task->id,
            'user_id' => $user3->id,
            'activity' => 'Menambahkan komentar dan lampiran',
        ]);

        // Tag
        $tag = Tag::firstOrCreate(['name' => 'Urgent', 'color' => '#e74c3c']);
        $task->tags()->attach($tag->id);
    }
}
