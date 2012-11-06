set :application, "makeitgrow"
set :repository,  "http://github.com/RealFiling/makeitgrow-website.git"
set :scm, :git
# set :scm, :git # You can set :scm explicitly or Capistrano will make an intelligent guess based on known version control directory names
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `git`, `mercurial`, `perforce`, `subversion` or `none`

role :web, "makeitgrowgame.com"                          # Your HTTP server, Apache/etc

# if you want to clean up old releases on each deploy uncomment this:
# after "deploy:restart", "deploy:cleanup"