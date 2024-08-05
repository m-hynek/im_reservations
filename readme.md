IM reservations any% speedrun
=================

10.4.32-MariaDB

php 8.1

manual sql migration

no docker

- calendar reservation hours are selected by draging cursor over multiple rows
- frontend is trash
- ui is not validating anything, sending whatever user clicks to backend
- clicking on planned event will prompt delete

what was skipped due to time limit

- tests
- refactor presenter so it won't manipulate ORM and only interacts with service
- stan/sniffer
- migrations
- commits (why tho?)
- actual frontend
- better project structure as core is almost unchanged nette-project skeleton
- docker
- refactor
