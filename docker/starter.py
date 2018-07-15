import os

def init():
  compose_up()
  output = get_running_containers()
  
  if output.find('zeedo-php-fpm') > 0 :
    launch_composer_install()

def compose_remove():
  print "Removing... \n"
  os.system("rm -Rf docker/data/*")
  os.system("docker-compose stop && docker-compose rm -v")

def compose_up() :
  print "Starting zeedo build with docker: \n"
  os.system("docker-compose up --build -d ")

def compose_down(container) :
  print "Stopping", container, ": \n"
  os.system("docker-compose stop " + container)
  os.system("docker-compose rm " + container)

def get_running_containers() :
  runningContainers = os.popen("docker ps -f status=running")
  output = runningContainers.read()
  return output

def start_syslog() :
  print "Start service syslog..."
  containerId = os.popen("docker ps -q --filter name=zeedo-php-fpm")
  if containerId.read():
    os.system("docker exec -it zeedo-php-fpm /bin/bash -c '/etc/init.d/rsyslog start'")
  else:
    print "Transport_php container must be initialized to start service"

def launch_composer_install() :
  print "Composer Install..."
  containerId = os.popen("docker ps -q --filter name=zeedo-php-fpm")
  os.system("docker exec -it zeedo-php-fpm /bin/bash -c 'APP_ENV=prod composer install --no-dev && chmod 777 -R var/cache/'")
  os.system("docker exec -it zeedo-php-fpm /bin/bash -c 'composer update'")

def testPhpunit() :
  print "Initializing tests...."
  os.system("docker exec -it zeedo-php-fpm bin/phpunit -c phpunit.xml tests/")


