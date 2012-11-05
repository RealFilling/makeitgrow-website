#!/bin/sh

# Update Apt
apt-get update

# Install nginx and git and build essentials and more
apt-get -y install nginx-full git-core build-essential zlib1g-dev libssl-dev libreadline-dev libyaml-dev libcurl4-openssl-dev curl 

# Install Node
cd /usr/src
wget -c http://nodejs.org/dist/v0.8.14/node-v0.8.14.tar.gz
tar xvf node*
cd node*
./configure
make
make install

# Install YAML
cd /usr/src
wget -c http://pyyaml.org/download/libyaml/yaml-0.1.4.tar.gz
tar xvf yaml*
cd yaml*
./configure
make
make install

# Install Rails
cd /usr/src
wget -c http://ftp.ruby-lang.org/pub/ruby/1.9/ruby-1.9.3-p286.tar.gz
tar xvf ruby*
cd ruby*
./configure
make
make install

ruby --version
gem --version

# Install Gems
gem install rails
gem install unicorn