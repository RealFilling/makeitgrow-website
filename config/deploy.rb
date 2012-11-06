set :application, "makeitgrow"

set :deploy, :remote_cache
set :deploy_to, "/home/app"
set :user, "root"
set :use_sudo, false

set :repository,  "http://github.com/RealFiling/makeitgrow-website.git"
set :branch, "master"
set :scm, :git
# set :git_shallow_clone, 1
set :keep_releases, 2
# set :scm, :git # You can set :scm explicitly or Capistrano will make an intelligent guess based on known version control directory names
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `git`, `mercurial`, `perforce`, `subversion` or `none`

role :web, "makeitgrowgame.com"                          # Your HTTP server, Apache/etc

# if you want to clean up old releases on each deploy uncomment this:
# after "deploy:restart", "deploy:cleanup"

namespace :deploy do
  desc "Start the Unicorn!"
  task :start do
    run "sudo service unicorn start"
  end

  desc "Stop the Unicorn!"
  task :stop do
    run "sudo service unicorn stop"
  end

  desc "Restart the Unicorn!"
  task :restart do
    # We use reload here instead of restart
    # We want to kill the pid and instantiate
    # a new Rails app instead!
    run "sudo service unicorn reload"
  end
end