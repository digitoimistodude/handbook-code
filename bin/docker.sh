#!/bin/bash
# Project starting bash script for Docker by rolle.
# More info: https://github.com/digitoimistodude/dudestack-docker

# Helpers:
currentfile=`basename $0`
txtbold=$(tput bold)
boldyellow=${txtbold}$(tput setaf 3)
boldgreen=${txtbold}$(tput setaf 2)
boldwhite=${txtbold}$(tput setaf 7)
yellow=$(tput setaf 3)
red=$(tput setaf 1)
green=$(tput setaf 2)
white=$(tput setaf 7)
txtreset=$(tput sgr0)
LOCAL_IP=$(ifconfig | grep -Eo "inet (addr:)?([0-9]*\.){3}[0-9]*" | grep -Eo "([0-9]*\.){3}[0-9]*" | grep -v "127.0.0.1")
YEAR=$(date +%y)

# Did you run setup.sh first? let's see about that...
if [ ! -f /usr/local/bin/createproject ]; then
  echo "${red}It seems you did not run setup.sh. Run sh setup.sh and try again.${txtreset}"
  exit
else

echo "${boldyellow}Project name in lowercase (without spaces or special characters):${txtreset} "
read -e PROJECTNAME
cd $HOME/Projects/dudestack
composer create-project -n ronilaukkarinen/dudestack $HOME/Projects/${PROJECTNAME} dev-master
cd $HOME/Projects/${PROJECTNAME}
git clone git@github.com:digitoimistodude/dudestack-docker.git $HOME/Projects/dudestack-docker
cp -R $HOME/Projects/dudestack-docker/* $HOME/Projects/${PROJECTNAME}
echo "${yellow}Updating .dev url in docker-compose.yml...:${txtreset}"
sed -i -e "s/PROJECTNAME/${PROJECTNAME}/g" docker-compose.yml
docker-compose up --build -d
echo "${yellow}Installing Capistrano in the project directory${txtreset}"
cap install
echo "${boldgreen}Capistrano installed${txtreset}"
echo "${yellow}Generating config/deploy.rb${txtreset}"
echo "set :application, \"$PROJECTNAME\"
set :repo_url,  \"git@bitbucket.org:YOUR_BITBUCKET_ACCOUNT_HERE/$PROJECTNAME.git\"
set :branch, :master
set :log_level, :debug
set :linked_files, %w{.env}
set :linked_dirs, %w{media}
set :composer_install_flags, '--no-dev --prefer-dist --no-scripts --optimize-autoloader'
set :composer_roles, :all

namespace :deploy do

  desc 'Restart application'
  task :restart do
    on roles(:app), in: :sequence, wait: 5 do
      # This task is required by Capistrano but can be a no-op
      # Your restart mechanism here, for example:
      # execute :service, :nginx, :reload
    end
  end

end" > "$HOME/Projects/$PROJECTNAME/config/deploy.rb"
echo "${boldgreen}deploy.rb generated${txtreset}"
echo "${yellow}Generating staging.rb${txtreset}"
echo "role :app, %w{YOUR_STAGING_USERNAME_HERE@YOUR_STAGING_SERVER_HERE}

set :ssh_options, {
    auth_methods: %w(password),
    password: \"YOUR_STAGING_SERVER_PASSWORD_HERE\",
    forward_agent: \"true\"
}

set :deploy_to, \"YOUR_STAGING_SERVER_HOME_PATH_HERE/projects/#{fetch(:application)}\"
SSHKit.config.command_map[:composer] = \"YOUR_STAGING_SERVER_HOME_PATH_HERE/bin/composer\"
set :deploy_via, :remote_cache
set :use_sudo, false
set :keep_releases, 2
set :tmp_dir, \"YOUR_STAGING_SERVER_HOME_PATH_HERE/tmp\"

namespace :deploy do

    desc \"Build\"
    after :updated, :build do
        on roles(:app) do
            within release_path  do

           end
        end
    end

  desc \"Set up symlinks\"
    task :finished do
        on roles(:app) do

            execute \"mkdir -p YOUR_STAGING_SERVER_PUBLIC_PATH_HERE\"
            execute \"rm -f YOUR_STAGING_SERVER_PUBLIC_PATH_HERE/content && ln -nfs #{current_path}/content YOUR_STAGING_SERVER_PUBLIC_PATH_HERE/content\"
            execute \"rm -f YOUR_STAGING_SERVER_PUBLIC_PATH_HERE/index.php && ln -nfs #{current_path}/index.php YOUR_STAGING_SERVER_PUBLIC_PATH_HERE/index.php\"
            execute \"rm -f YOUR_STAGING_SERVER_PUBLIC_PATH_HERE/wp-config.php && ln -nfs #{current_path}/wp-config.php YOUR_STAGING_SERVER_PUBLIC_PATH_HERE/wp-config.php\"
            execute \"rm -f YOUR_STAGING_SERVER_PUBLIC_PATH_HERE/wp && ln -nfs #{current_path}/wp YOUR_STAGING_SERVER_PUBLIC_PATH_HERE/wp\"
            execute \"rm -f YOUR_STAGING_SERVER_PUBLIC_PATH_HERE/vendor && ln -nfs #{current_path}/vendor YOUR_STAGING_SERVER_PUBLIC_PATH_HERE/vendor\"
            execute \"rm -f YOUR_STAGING_SERVER_PUBLIC_PATH_HERE/config && ln -nfs #{current_path}/config YOUR_STAGING_SERVER_PUBLIC_PATH_HERE/config\"

        end
    end

    desc 'composer install'
    task :composer_install do
        on roles(:app) do
            within release_path do
                if test(\"[ -f YOUR_STAGING_SERVER_HOME_PATH_HERE/bin/composer ]\")
                    puts \"Composer already exists, running update only...\"
                    execute 'composer', 'update'
                else
                    execute \"mkdir -p YOUR_STAGING_SERVER_HOME_PATH_HERE/bin && curl -sS https://getcomposer.org/installer | php && mv composer.phar YOUR_STAGING_SERVER_HOME_PATH_HERE/bin/composer && chmod +x YOUR_STAGING_SERVER_HOME_PATH_HERE/bin/composer\"
                    execute 'composer', 'update'
                    execute 'composer', 'install', '--no-dev', '--optimize-autoloader'
                end
            end
        end
    end

    after :updated, 'deploy:composer_install'

end" > "$HOME/Projects/$PROJECTNAME/config/deploy/staging.rb"
echo "${yellow}Generating production.rb${txtreset}"
echo "role :app, %w{$PROJECTNAME@YOUR_PRODUCTION_SERVER_HERE}

set :ssh_options, {
    auth_methods: %w(password),
    password: \"YOUR_PRODUCTION_SERVER_PASSWORD_HERE\",
    forward_agent: \"true\"
}

set :deploy_to, \"/home/$PROJECTNAME/deploy/\"
set :deploy_via, :remote_cache
set :use_sudo, false
set :keep_releases, 2
set :tmp_dir, \"/home/$PROJECTNAME/tmp\"
SSHKit.config.command_map[:composer] = \"/home/$PROJECTNAME/bin/composer\"

namespace :deploy do

    desc \"Build\"
    after :updated, :build do
        on roles(:app) do
            within release_path  do

           end
        end
    end

  desc \"Fix symlinks\"
    task :finished do
        on roles(:app) do

            execute \"rm -f /home/$PROJECTNAME/www.$PROJECTNAME.fi/content && ln -nfs #{current_path}/content /home/$PROJECTNAME/www.$PROJECTNAME.fi/content\"
            execute \"rm -f /home/$PROJECTNAME/www.$PROJECTNAME.fi/index.php && ln -nfs #{current_path}/index.php /home/$PROJECTNAME/www.$PROJECTNAME.fi/index.php\"
            execute \"rm -f /home/$PROJECTNAME/www.$PROJECTNAME.fi/wp-config.php && ln -nfs #{current_path}/wp-config.php /home/$PROJECTNAME/www.$PROJECTNAME.fi/wp-config.php\"
            execute \"rm -f /home/$PROJECTNAME/www.$PROJECTNAME.fi/wp && ln -nfs #{current_path}/wp /home/$PROJECTNAME/www.$PROJECTNAME.fi/wp\"
            execute \"rm -f /home/$PROJECTNAME/www.$PROJECTNAME.fi/vendor && ln -nfs #{current_path}/vendor /home/$PROJECTNAME/www.$PROJECTNAME.fi/vendor\"
            execute \"rm -f /home/$PROJECTNAME/www.$PROJECTNAME.fi/config && ln -nfs #{current_path}/config /home/$PROJECTNAME/www.$PROJECTNAME.fi/config\"

            # Media library:
            execute \"rm -f /home/$PROJECTNAME/www.$PROJECTNAME.fi/media && ln -nfs #{current_path}/media /home/$PROJECTNAME/www.$PROJECTNAME.fi/media\"
            execute \"chmod -R 775 #{current_path}/media\"

            # Permissions:
            execute \"chmod 755 #{current_path}/content\"
            #execute \"chmod -Rv 755 #{current_path}/content/wp-rocket-config\"

            # WP-CLI (optional):
            #within release_path do
            #    execute \"cd #{current_path} && vendor/wp-cli/wp-cli/bin/wp --path=/home/$PROJECTNAME/www.$PROJECTNAME.fi/wp rocket regenerate --file=advanced-cache\"
            #    execute \"cd #{current_path} && vendor/wp-cli/wp-cli/bin/wp --path=//home/$PROJECTNAME/www.$PROJECTNAME.fi/wp rocket regenerate --file=htaccess\"
            #end

        end
    end


    desc 'composer install'
    task :composer_install do
        on roles(:app) do
            within release_path do
                if test(\"[ -f /home/USERNAME/bin/composer ]\")
                    puts \"Composer already exists, running update only...\"
                    execute 'composer', 'update'
                else
                    execute \"mkdir -p /home/#{fetch(:application)}/bin/ && curl -sS https://getcomposer.org/installer | php && mv composer.phar /home/#{fetch(:application)}/bin/composer && chmod +x /home/#{fetch(:application)}/bin/composer\"
                    execute 'composer', 'update'
                    execute 'composer', 'install', '--no-dev', '--optimize-autoloader'
                end
            end
        end
    end

    after :updated, 'deploy:composer_install'

end" > "$HOME/Projects/$PROJECTNAME/config/deploy/production.rb"

cd "$HOME/Projects/$PROJECTNAME/"
rm README.md
echo "${yellow}Updating WordPress related stuff...:${txtreset}"
cp $HOME/Projects/dudestack/composer.json "$HOME/Projects/$PROJECTNAME/composer.json"
cd "$HOME/Projects/$PROJECTNAME/"
rm -rf .git
sh bin/composer.sh update
echo "${yellow}Updating .env (db credentials)...:${txtreset}"
sed -i -e "s/database_name/${PROJECTNAME}/g" .env
sed -i -e "s/database_user/wordpress/g" .env
sed -i -e "s/database_password/docker/g" .env
sed -i -e "s/database_host/mysql/g" .env
sed -i -e "s/example.com/${PROJECTNAME}.dev/g" .env
sed -i -e "s/example.com/${PROJECTNAME}.dev/g" .env
echo '
SENDGRID_API_KEY=YOUR_SENDGRID_API_KEY_HERE' >> .env

echo "${yellow}Installing WordPress...:${txtreset}"
echo "path: wp
url: http://${PROJECTNAME}.dev

core install:
  admin_user: YOUR_DEFAULT_WORDPRESS_ADMIN_USERNAME_HERE
  admin_password: YOUR_DEFAULT_WORDPRESS_ADMIN_PASSWORD_HERE
  admin_email: YOUR_DEFAULT_WORDPRESS_ADMIN_EMAIL_HERE
  title: \"${PROJECTNAME}\"" > wp-cli.yml


docker-compose exec --user www-data phpfpm ./vendor/wp-cli/wp-cli/bin/wp core install --title=$PROJECTNAME --admin_email=YOUR_DEFAULT_WORDPRESS_ADMIN_EMAIL_HERE
echo "${yellow}Removing default WordPress posts...:${txtreset}"
docker-compose exec --user www-data phpfpm ./vendor/wp-cli/wp-cli/bin/wp post delete 1 --force
docker-compose exec --user www-data phpfpm ./vendor/wp-cli/wp-cli/bin/wp post delete 2 --force
docker-compose exec --user www-data phpfpm ./vendor/wp-cli/wp-cli/bin/wp option update blogdescription ''
docker-compose exec --user www-data phpfpm ./vendor/wp-cli/wp-cli/bin/wp theme delete twentytwelve
docker-compose exec --user www-data phpfpm ./vendor/wp-cli/wp-cli/bin/wp theme delete twentythirteen
docker-compose exec --user www-data phpfpm ./vendor/wp-cli/wp-cli/bin/wp option update permalink_structure '/%postname%'
docker-compose exec --user www-data phpfpm ./vendor/wp-cli/wp-cli/bin/wp option update timezone_string 'Europe/Helsinki'
docker-compose exec --user www-data phpfpm ./vendor/wp-cli/wp-cli/bin/wp option update default_pingback_flag '0'
#echo "${yellow}Activating necessary plugins, mainly for theme development...:${txtreset}"
#docker-compose exec --user www-data phpfpm ./vendor/wp-cli/wp-cli/bin/wp plugin activate wordpress-seo
#docker-compose exec --user www-data phpfpm ./vendor/wp-cli/wp-cli/bin/wp plugin activate simple-history
#docker-compose exec --user www-data phpfpm ./vendor/wp-cli/wp-cli/bin/wp plugin activate clean-image-filenames
docker-compose exec --user root phpfpm chmod -R 775 content

rm "$HOME/Projects/$PROJECTNAME/.env.example"
echo "${yellow}Creating a bitbucket repo...${txtreset}"
curl -X POST -v -u YOUR_BITBUCKET_ACCOUNT_HERE:YOUR_BITBUCKET_PASSWORD_HERE "https://api.bitbucket.org/2.0/repositories/YOUR_BITBUCKET_TEAM_HERE/${PROJECTNAME}" -H "Content-Type: application/json"  -d '{"is_private": true, "project": {"key": "PROJECTS'"${YEAR}"'"}}'

echo "${yellow}Initializing the bitbucket repo...${txtreset}"
cd "$HOME/Projects/$PROJECTNAME"
git init
git remote add origin git@bitbucket.org:YOUR_BITBUCKET_TEAM_HERE/$PROJECTNAME.git
git add --all
git commit -m 'First commit - project started'
git push -u origin --all
docker-compose stop
docker-compose up -d
echo "${boldgreen}All done! Start coding at http://${PROJECTNAME}.dev!${txtreset} (Please note! no themes installed, so you may see a white page. We recommend air which is designed for dudestack: https://github.com/digitoimistodude/air)"
fi