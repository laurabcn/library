#! /usr/bin/env python
from docker import starter

print "Welcome to API Zeedo docker environment operation, choose an option:"
print "1 - Build API environment"
print "2 - Remove environment"
print "3 - Composer install"
print "4 - Run Tests"
print "0 - Exit \n"

def switcher(choice='0'):
  switch = {
    '1': init,
    '2': remove,
    '3': composerInstall,
    '4': allTest,
    '0': exit
  }
  if choice in switch.keys() :
    func = switch.get(choice)
    print func
    return func()
  else:
    return nothing()

def init() :
  print "########## BUILDING ZEEDO API ##########"
  starter.init()

def remove():
  print "########## REMOVING ENVIRONMENT ##########"
  starter.compose_remove()

def nothing() :
  print "Invalid choice! Please choose one of the options bellow!"
  choice = raw_input("Your choice: ")
  switcher(choice)

def composerInstall() :
    print "###### COMPOSER INSTALL #######"
    starter.launch_composer_install()

def allTest() :
    print "###### TESTS ######"
    starter.testPhpunit()

def exit() :
  print "See you soon! \n"

choice = raw_input("Your choice: ")
switcher(choice)
