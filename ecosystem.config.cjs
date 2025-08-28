module.exports = {
  apps: [
    {
      name: 'webapp',
      script: 'php',
      args: 'artisan serve --host=0.0.0.0 --port=3000',
      cwd: '/home/user/webapp',
      env: {
        APP_ENV: 'local',
        APP_DEBUG: 'true',
        PORT: 3000
      },
      watch: false,
      instances: 1,
      exec_mode: 'fork',
      log_file: './logs/webapp.log',
      out_file: './logs/webapp-out.log',
      error_file: './logs/webapp-error.log'
    }
  ]
}