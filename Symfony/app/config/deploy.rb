# deploy.rb

set   :application,   "boxenmieten"
set   :deploy_to,     "/httpdocs/boxenmieten.ch"
set   :domain,        "vl01-de.whatwedo.ch"
set   :user,	      "boxenmieten.ch"
set	  :app_path,	  "app"

set   :scm,           :git
set   :repository,    "file:///d:/xampp/htdocs/boxenmieten"
set   :deploy_via,    :copy

set   :model_manager, "doctrine"

role  :web,           domain
role  :app,           domain
role  :db,			  domain, :primary => true

set	  :shared_files,      ["app/config/parameters.yml"]
set	  :shared_children,   [app_path + "logs", web_path + "/images/managed"]

set	  :use_composer,   true
set	  :update_vendors, true

set   :use_sudo,      false
set   :keep_releases, 10