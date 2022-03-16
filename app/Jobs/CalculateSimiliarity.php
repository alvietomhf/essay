<?php

namespace App\Jobs;

use App\Models\ExamResult;
use App\Models\ExamResultDetail;
use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateSimiliarity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $result;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ExamResult $result)
    {
        $this->result = $result;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $result = ExamResult::where('id', $this->result->id)
                                ->with([
                                    'exam' => function ($q) {
                                        $q->withCount(['questions']);
                                    },
                                    'details',
                                ])
                                ->first();

            $score = 0;

            foreach($result->details as $key => $detail) {
                $question = Question::findOrFail($detail->question_id);
                $answerStudent = $detail->answer;
                $answerKey = $question->answer_key;

                // $command = escapeshellcmd('C:\Users\Alvieto\AppData\Local\Programs\Python\Python39\python.exe ' . public_path() .  '\rabbinkarp.py ' . escapeshellarg($answerStudent) . ' ' . escapeshellarg($answerKey));
                $command = escapeshellcmd('/usr/bin/python3 /var/www/rabbin-similiarity/public/rabbinlinux.py ' . escapeshellarg($answerStudent) . ' ' . escapeshellarg($answerKey));
                $output = rtrim(shell_exec($command), "\n");

                $simScore = floatval($output);
                $humanScore = 0;

                $resultDetail = ExamResultDetail::findOrFail($detail->id);
                $resultDetail->update(['similiarity_score' => $simScore]);

                if ($simScore > 0 && $simScore <= 0.1) $humanScore = 10;
                elseif ($simScore > 0.1 && $simScore <= 0.2) $humanScore = 20;
                elseif ($simScore > 0.2 && $simScore <= 0.3) $humanScore = 30;
                elseif ($simScore > 0.3 && $simScore <= 0.4) $humanScore = 40;
                elseif ($simScore > 0.4 && $simScore <= 0.5) $humanScore = 50;
                elseif ($simScore > 0.5 && $simScore <= 0.6) $humanScore = 60;
                elseif ($simScore > 0.6 && $simScore <= 0.7) $humanScore = 70;
                elseif ($simScore > 0.7 && $simScore <= 0.8) $humanScore = 80;
                elseif ($simScore > 0.8 && $simScore <= 0.9) $humanScore = 90;
                elseif ($simScore > 0.9 && $simScore <= 1) $humanScore = 100;

                $score += $humanScore;
            }

            $finalScore = round($score / $result->exam->questions_count); 

            ExamResult::where('id', $result->id)->update(['score' => $finalScore]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
