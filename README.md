<h1>Fake survey service</h1>

#### Setup:


1) git clone https://github.com/SergM2014/panda.git



2) cd panda

    

3) docker-compose up -d  


4)  docker exec -i database mysql -upanda -ppanda panda < panda.sql


5) exit


6) docker-compose exec app bash

   

7) composer install


  
8) chmod 777 logs.txt

    
   
9) now you can visit  http://localhost:8080



## Stopping the containers



1) Exit the app container.
   

     exit

    

2) Bring all the containers down.

    

     docker-compose down



## Exampe of usage


Access to admin part

login weisse011@gmail.com



password 111111





API endpoints

get info about all survays:

 /api/surveys



get single survay with id 3 ; 

 /api/survey/3


 get surveys of concrete user with id 1

 /api/user/1/survey



 datatables.net is used, jquery library