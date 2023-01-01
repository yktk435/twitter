<?php

declare(strict_types=1);

namespace Deployer;

require 'recipe/laravel.php';
// require 'contrib/slack.php';

// Project name
set('application', 'Crewbit Laravel Boilerplate');

// Project repository
set('repository', 'git@github.com:crew-bit/laravel-boilerplate.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('ssh_type', 'native');
set('ssh_multiplexing', true);
set('git_tty', false);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts
host('prod.example.com')
    ->set('labels', ['stage' => 'prod'])
    ->set('remote_user', 'deploy')
    ->set('branch', 'master')
    ->set('deploy_path', '/var/www/html/{{hostname}}');

host('staging.example.com')
    ->set('labels', ['stage' => 'staging'])
    ->set('remote_user', 'deploy')
    ->set('branch', 'staging')
    ->set('deploy_path', '/var/www/html/{{hostname}}');

// Tasks
task('build', function () {
    run('cd {{release_path}} && build');
});

task('upload:build_assets', function () {
    $assets_dirs = [
        '/public/assets/js',
        '/public/assets/css',
        '/public/mix-manifest.json',
    ];
    foreach ($assets_dirs as $dir) {
        upload(__DIR__ . $dir, '{{release_path}}' . \dirname($dir));
    }
})->desc('Upload build assets');
// after('deploy:vendors', 'upload:build_assets');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Slack notify
// set('slack_webhook', '');
// before('deploy', 'slack:notify');
// after('deploy:success', 'slack:notify:success');

// Migrate database before symlink new release.
// before('deploy:symlink', 'artisan:migrate');
