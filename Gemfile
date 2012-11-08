source 'https://rubygems.org'

# Rails
gem 'rails', '3.2.8'
# Authentication
gem 'devise'
gem 'omniauth-facebook'

group :development do
  # Quick and Dirty Database
  gem 'sqlite3'

  # Deploy with Capistrano
  gem 'capistrano'

  # Guard for LiveReloading
  gem 'guard'
  gem 'rb-inotify', :require => false
  gem 'rb-fsevent', :require => false
  gem 'rb-fchange', :require => false

  # Because everybody loves them
  gem "nifty-generators"
end

# Use unicorn as the app server
gem 'unicorn'

group :production do
  # PostgreSQL Driver
  gem 'pg'
end

# Slim complains when playing with other asset gems
gem 'slim'
gem 'jquery-rails'

# Gems used only for assets and not required
# in production environments by default.
group :assets do
  gem 'sass-rails',   '~> 3.2.3'
  gem 'coffee-rails', '~> 3.2.1'
  gem 'uglifier', '>= 1.0.3'
  gem 'guard-livereload'
end

group :test do
  gem "mocha"
end