<?php

use Core\Scheduler;
use Core\Database;
use Core\Utility;

Scheduler::register('exam/commands/process-answers');
Scheduler::register('exam/commands/auto-generate');

\Modules\Default\Libraries\Sdk\Dashboard::add('examDashboardStatistic');

function examDashboardStatistic()
{
    $db = new Database;

    $data = [];
    $data['groups'] = $db->exists('exam_groups');
    $data['members'] = $db->exists('exam_group_member');
    $data['questions'] = $db->exists('exam_questions');
    $data['schedules'] = $db->exists('exam_schedules');


    return view('exam/views/dashboard/statistic', compact('data'));
}

function generateQuestionSchedule($schedule_id, $message = true)
{
    $db = new Database;

    $db->delete('exam_schedule_user_data', [
        'schedule_id' => $schedule_id
    ]);

    $schedule = $db->single('exam_schedules', ['id' => $schedule_id]);
    $schedule->question = $db->single('exam_questions', "id = (SELECT question_id FROM exam_schedule_questions WHERE schedule_id = $schedule_id)");

    $db->query = "SELECT * FROM users WHERE id IN (SELECT user_id FROM exam_group_member WHERE group_id IN (SELECT group_id FROM exam_schedule_groups WHERE schedule_id = $schedule_id))";
    $users = $db->exec('all');
    foreach($users as $user)
    {    
        $db->query = "SELECT * FROM exam_question_items WHERE question_id = ".$schedule->question->id;
        // random
        if($schedule->randomize_question)
        {
            $db->query .= " ORDER BY RAND()";
        }

        // jumlah soal
        if($schedule->question_showed)
        {
            $db->query .= " LIMIT $schedule->question_showed";
        }
        $items = $db->exec('all');

        $randomize_answer = $schedule->randomize_answer;
        $items = array_map(function($item) use ($db, $randomize_answer){
            $db->query = "SELECT id, item_id, description FROM exam_question_answers WHERE item_id=$item->id";
            if($randomize_answer)
            {
                $db->query .= " ORDER BY RAND()";
            }

            $item->answers = $db->exec('all');

            return $item;
        }, $items);

        $data = json_encode($items);
        $db->query = "INSERT INTO exam_schedule_user_data (schedule_id, user_id, `data`) VALUES ($schedule_id, $user->id, ?)";
        $db->exec(false, [$data]);

        // $parent_path = Utility::parentPath();
        // $json = $parent_path . 'public/json/' . env('APP_PREFIX');
        // if(!file_exists($json))
        // {
        //     mkdir($json);
        // }

        // $filename = $schedule_id . '-' . $user->id.'.json';
        // file_put_contents($json . '/' . $filename, $data);
    }

    $msg = "$schedule->name generate success\n";
    if($message)
    {
        echo $msg;
    }
    
    return $msg;
}

// Fungsi untuk memparsing soal
function parseSoal($text, $num_of_options = 5) {
    // Pisahkan soal berdasarkan baris
    $lines = explode("\n", $text);
    
    // Inisialisasi array untuk soal
    $soalList = [];

    // Proses setiap 9 baris menjadi satu soal
    for ($i = 0; $i < count($lines); $i += ($num_of_options + 4)) {
        // Pastikan ada cukup baris untuk soal
        // if ($i + 8 < count($lines)) {
            // Inisialisasi soal
            $soal = [];
            
            // Deskripsi soal
            $soal['description'] = str_replace('\n','<br>',trim($lines[$i + 1]));

            // Pilihan jawaban
            $pilihan = [];
            $kunci_jawaban = strtolower(substr(trim($lines[$i + ($num_of_options+2)]), -1)); // Mengambil kunci jawaban setelah berdasarkan karakter terakhir
            for ($j = 2; $j <= ($num_of_options+1); $j++) {
                $alphabet = strtolower(substr(trim($lines[$i + $j]), 0, 1));
                $pilihan[$alphabet] = [
                    'description' => substr(trim($lines[$i + $j]), 3),
                    'score' => $alphabet == $kunci_jawaban
                ];
            }
            $soal['answers'] = $pilihan;
            
            // Simpan soal ke dalam list
            $soalList[] = $soal;
        // }
    }

    return $soalList;
}

function detectCheating(array $logs)
{
    $blurTime = null;
    $incidents = [];
    $totalDuration = 0;

    // urutkan berdasarkan waktu
    usort($logs, function ($a, $b) {
        return strtotime($a['time']) <=> strtotime($b['time']);
    });

    // daftar event yang dianggap "keluar" dari halaman
    $outEvents = ['tab_blur', 'minimize_or_switch'];

    // daftar event yang dianggap "kembali" ke halaman
    $backEvents = ['tab_focus', 'visible'];

    foreach ($logs as $log) {
        $event = $log['type'];
        $time  = strtotime($log['time']);

        // Jika event keluar halaman → mulai track
        if (in_array($event, $outEvents)) {
            if (!$blurTime) {
                $blurTime = $time;
            }
        }

        // Jika event kembali → tutup track
        if (in_array($event, $backEvents)) {
            if ($blurTime) {
                $duration = $time - $blurTime;

                if ($duration > 0) {
                    $incidents[] = [
                        'start'    => date('Y-m-d H:i:s', $blurTime),
                        'end'      => date('Y-m-d H:i:s', $time),
                        'duration' => $duration
                    ];
                    $totalDuration += $duration;
                }

                $blurTime = null;
            }
        }
    }

    // jika ujian berakhir dalam keadaan blur, bisa dianggap 1 pelanggaran tambahan
    // Optional: abaikan atau tambahkan logika di sini

    $count = count($incidents);

    // Rumus skor kecurangan
    $score = ($count * 10) + ($totalDuration / 2);

    // kategori risiko
    if ($score <= 20) {
        $risk = "Rendah";
    } elseif ($score <= 40) {
        $risk = "Sedang";
    } elseif ($score <= 70) {
        $risk = "Tinggi";
    } else {
        $risk = "Sangat Tinggi";
    }

    return [
        'total_incidents' => $count,
        'total_duration'  => $totalDuration,
        'score'           => $score,
        'risk_level'      => $risk,
        'details'         => $incidents
    ];
}
