This folder holds the core of simple framework.

cache - must be writable by the server; holds smarty caches
compiled - must be writable by the server; holds compiled smarty templates and ezpdo dao's
configs - smarty config files and ezpdo config files
dao - holds data access objects used by simple framework
install - run this on first installation
language - a place to put localizable files
lib - the cores of ezpdo 1.1.6, Scriptaculous 1.7.1 beta 4, Prototype 1.5.1, and Smarty Template Engine 2.6.17
logs - must be writable by the server; currently only ezpdo has a log
templates - smarty templates used by simple framework

development releases:
--------------------------------------
- can now add javascript to html head via sfwTemplater
- added ability to edit users
- fixed a bug with URL_PATHTOFILE (it was sometimes adding a trailing slash)
- fixed bug with sfwPermission (url size was too small)
- added ability to name php session in the config file
- added sfwVariable to for storing sitewide config vars


1.0a5 -
- extended the header js to include raw script in addition to including files

1.0a4 - Aug 16 2007:
- went live on Teams and Leaders
- changed the encryption, using a open source library (StonePhpSafeCrypt)
- output is now buffered, starting at sfwBoot.eng.php, ending at sfeTemplater::display()
- added sfwLogger
- added sfwExceptionHandler
- bug fixes all around
- added defines for url paths

1.0a3 - Aug 6 2007:
- added sessions
- added user authenication
- added user authorization (A sfwCookie maintains access requirements)
- added some user management
- reconfigured the file structure
- renamed some files
- data access has changed one dao factory.
- added an installer. bare bones, baby.
 
1.0a2 - July 26 2007:
- add more head tags to the sfwTemplater

1.0a1 - July 24 2007:
- set up the directory structure
- auto include the necessary files
- define main path vars 
- set up the bootstrap engine 
- connected the templating engine sfwTemplater, seems to work OK, needs more testing and functionality
- setup ezpdo, but haven't tested it
- got enough to do templates