require "bundler/capistrano"
load "deploy/assets"

set :application, "makeitgrow"

set :deploy, :remote_cache
set :deploy_to, "/home/app"
set :user, "app"
set :password, "thegardenisgreen"
set :use_sudo, false

set :repository,  "git@github.com:RealFilling/makeitgrow-website.git"
set :scm, :git
set :git_shallow_clone, 1
ssh_options[:forward_agent] = true

server "makeitgrowgame.com", :web, :app, :db

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

  desc "Prepare for Battle!"
  task :post_setup do
    # Install unicorn
    run "chmod a+x #{current_path}/config/unicorn_init.sh"
    run "sudo ln -f -s #{current_path}/config/unicorn_init.sh /etc/init.d/unicorn"
    run "sudo update-rc.d unicorn defaults"
    # Link nginx config
    run "sudo rm /etc/nginx/sites-enabled/default -f"
    run "sudo ln -f -s #{current_path}/config/nginx.conf /etc/nginx/sites-enabled/mig"
    # Make all binstubs runnable
    run "chmod a+x #{current_path}/bin/*"
  end

  desc "Gather thy men!"
  task :pre_setup do
    run "rm #{current_path} #{shared_path} #{releases_path} -rf"
  end
end

before "deploy:setup", "deploy:pre_setup"
after "deploy:create_symlink", "deploy:post_setup"

namespace :logs do
  task :default do
    stream "tail -f #{shared_path}/log/*"
  end

  task :prod do
    stream "tail -f #{shared_path}/log/production.log"
  end

  task :unicorn do
    stream "tail -f #{shared_path}/log/unicorn.std*.log"
  end
end