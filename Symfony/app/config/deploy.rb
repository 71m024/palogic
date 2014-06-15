# deploy.rb

set   :application,   "boxenmieten"
set   :deploy_to,     "/httpdocs/boxenmieten.ch"
set   :domain,        "vl01-de.whatwedo.ch"

set   :scm,           :git
set   :repository,    "file:///d:/xampp/htdocs/boxenmieten"
set   :deploy_via,    :copy

role  :web,           domain
role  :app,           domain, :primary => true

set   :use_sudo,      false
set   :keep_releases, 3