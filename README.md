## road_rage          

**Launching the project step by step for beginners.**

**Basic requirements:**
- composer,
- MySQL,
- PHP 7.1

1. Prepare an empty database with any name.    
2. Prepare an email address (e.g. gmail)  
3. In the project directory, launch the console.
4. Enter: "composer install" in the command line.        
You will be asked for access data to the database and mailbox.
5. In order to create and fill DB, run the following commands in command line:   
"php app/console doctrine:schema:create" (create)   
"php app/console doctrine:fixtures:load" (fill)
6. Start of the development server.   
Command line: "php app/console server:start"
7. Go to the displayed address, for example: http://127.0.0.1:8000
8. Sign in. Login details can be found at:   
/src/TruckBundle/DataFixtures/ORM/UserFixtures.php   
Sample login/password: ccwrcadmin/ccwrcadmin

**Brief operator's manual.**

**START:** START new case (automatic code) → red  ![#ff7575](https://placehold.it/15/ff7575/000000?text=+)   
**PG:** Payment Guarantee (request) → red ![#ff7575](https://placehold.it/15/ff7575/000000?text=+)   
**CPG:** Confirmation Payment Guarantee → red ![#ff7575](https://placehold.it/15/ff7575/000000?text=+)    
**RO:** Repair Order → orange ![#ff9c42](https://placehold.it/15/ff9c42/000000?text=+)    
**ETA:** Estimated Arrival Time (dealer → client) → orange ![#ff9c42](https://placehold.it/15/ff9c42/000000?text=+)   
**STRR:** STaRt Repair → green ![#93eeaa](https://placehold.it/15/93eeaa/000000?text=+)   
**END:** END case → grey ![#e6e6e6](https://placehold.it/15/e6e6e6/000000?text=+)   

**WPG:** Withdrawal Payment Guarantee → red ![#ff7575](https://placehold.it/15/ff7575/000000?text=+)    
**WCPG:** Withdrawal Confirmation Payment Guarantee → red ![#ff7575](https://placehold.it/15/ff7575/000000?text=+)    
**WRO:** Withdrawal Repair Order → red ![#ff7575](https://placehold.it/15/ff7575/000000?text=+)   

**Incoming:** General purpose code. Incoming phone call/fax/mail/etc. (without color change).   
**Out:** General purpose code. Outgoing phone call/fax/mail/etc. (without color change).

Use.  :truck:

![Alt text](https://images85.fotosik.pl/539/d1586755efdfd686.jpg "beta - operator panel")

*A Symfony project created on June 1, 2017, 2:58 pm.*
