<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BitBucketController extends Controller
{
    public function index(Request $request)
    {
        // Vace to setup the right permission at the server side to have it working
        $repo_dir = '/opt/bitnami/apps/larappone';
        $git_bin_path = '/opt/bitnami/git/bin/git';

        $msg = 'Git Status -> ';
        chdir($repo_dir);
        $process = new Process('sudo ' . $git_bin_path . ' pull');
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $msg = $msg . $process->getOutput();
        echo $msg;
        Log::info('Git status: ' . $msg);
    }
}
