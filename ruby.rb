# Multipass example using entp's multipass gem (http://github.com/entp/multipass)
#   Make sure to install the gem: "gem install multipass"

require 'rubygems'
require 'multipass'

SITE_KEY = "Your Site Key"
API_KEY = "Your API Key"

multipass_string = MultiPass.encode(
  SITE_KEY, 
  API_KEY, 
  :customer_name => "John Doe",
  :customer_email => "john.doe@yoursite.com", 
  :uid => "123456", 
  :expires => (Time.now + 120), # Expire two minutes from now 
  :url_safe => true # Convert unsafe characters
)