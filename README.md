## road_rage          

**Launching the project step by step for beginners.**

**Basic requirements:**
- composer,
- MySQL,
- PHP 7.1

1. Prepare an empty database with any name.    
2. Prepare an email address (e.g. gmail)  
3. In the project directory, launch the console.
4. Enter in the command line: "composer install".    
You will be asked for access data to the database and mailbox.
5. Creation and fill DB, run commands in command line:   
"php app/console doctrine:schema:create" (create)   
"php app/console doctrine:fixtures:load" (fill)
6. Start of the development server.   
Command line: "php app/console server:start"
7. Go to the displayed address, for example: http://127.0.0.1:8000
8. Sign in. Login details can be found in:   
/src/TruckBundle/DataFixtures/ORM/UserFixtures.php   
Sample login/password: ccwrcadmin/ccwrcadmin

**Very short operator's manual.**

**START:** START new case (automatic code) → red  ![#ff7575](https://placehold.it/15/ff7575/000000?text=+)   
**PG:** Payment Guarantee (request) → red ![#ff7575](https://placehold.it/15/ff7575/000000?text=+)   
**CPG:** Confirmation Payment Guarantee → red   
**RO:** Repair Order → orange   
**ETA:** Estimated Arrival Time (dealer → client) → orange   
**STRR:** STaRt Repair → green   
**END:** END case → grey   

**WPG:** Withdrawal Payment Guarantee → red   
**WCPG:** Withdrawal Confirmation Payment Guarantee → red   
**WRO:** Withdrawal Repair Order → red  

**Incoming:** General purpose code. Incoming phone call/fax/mail/etc. (without color change).   
**Out:** General purpose code. Outgoing phone call/fax/mail/etc. (without color change).

Use.  :truck:

![Alt text](https://images85.fotosik.pl/539/d1586755efdfd686.jpg "beta - operator panel")

*A Symfony project created on June 1, 2017, 2:58 pm.*
