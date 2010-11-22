# Multipass example using entp's multipass gem (http://github.com/entp/multipass)
#   Make sure to install the gem: "gem install multipass"

require 'rubygems'
require 'multipass'

SITE_KEY = "Your Assistly subdomain"
API_KEY = "Your Multipass API Key generated under Admin -> Channels -> Portal"

multipass_string = MultiPass.encode(
  SITE_KEY, 
  API_KEY, 
  :name => "John Doe",
  :email => "john.doe@yoursite.com", 
  :uid => 123456, 
  :expires => 5.minutes.from_now, 
  :url_safe => true
)