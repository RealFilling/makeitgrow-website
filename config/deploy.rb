require "bundler/capistrano"

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


  desc "Post Setup"
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
end

after "deploy:update_code", "deploy:post_setup"