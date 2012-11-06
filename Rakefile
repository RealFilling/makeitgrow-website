#!/usr/bin/env rake
# Add your own tasks in files placed in lib/tasks ending in .rake,
# for example lib/tasks/capistrano.rake, and they will automatically be available to Rake.

require File.expand_path('../config/application', __FILE__)

MakeitgrowWebsite::Application.load_tasks

task "start" => :environment do
  system 'rails server -p 8000 -b 127.0.0.1'
end