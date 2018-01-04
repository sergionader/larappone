<?php

        $repo_dir = '/opt/bitnami/apps/larappone';
        $git_bin_path = '/opt/bitnami/git/bin/git';

        $msg = 'Git Status -> ';
        chdir($repo_dir);
        $output = shell_exec('sudo ' . $git_bin_path . ' pull');

        $msg = $msg . $output;
        echo $msg;
